<?php 

class Sales_Distributor extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data($column = '*')
  {
    /*$query = "select coalesce(a.id_area,'-') as id_area, coalesce(a.nama,'-') as nama_area, b.alias_distributor,
      coalesce((case when bulan = '01' then sum(a.jumlah) end),0) as januari,
      coalesce((case when bulan = '02' then sum(a.jumlah) end),0) as februari,
      coalesce((case when bulan = '03' then sum(a.jumlah) end),0) as maret,
      coalesce((case when bulan = '04' then sum(a.jumlah) end),0) as april,
      coalesce((case when bulan = '05' then sum(a.jumlah) end),0) as mei,
      coalesce((case when bulan = '06' then sum(a.jumlah) end),0) as juni,
      coalesce((case when bulan = '07' then sum(a.jumlah) end),0) as juli,
      coalesce((case when bulan = '08' then sum(a.jumlah) end),0) as agustus,
      coalesce((case when bulan = '09' then sum(a.jumlah) end),0) as september,
      coalesce((case when bulan = '10' then sum(a.jumlah) end),0) as oktober,
      coalesce((case when bulan = '11' then sum(a.jumlah) end),0) as november,
      coalesce((case when bulan = '12' then sum(a.jumlah) end),0) as desember
      from 
      (
        select 
        coalesce((b1.harga_master * sum(a1.jumlah)) - (b1.harga_master * sum(a1.jumlah) * ((coalesce(e1.diskon_on, 0) + coalesce(e1.diskon_off, 0)) / 100)),0) as jumlah, 
        date_format(a1.tanggal, '%m') as bulan,
        a1.id_produk,
        d1.nama,
        d1.id as id_area,
        c1.id_master
        from sales a1
        join produk_harga b1
        on a1.id_produk=b1.id_produk
        join distributor c1
        on a1.id_distributor=c1.id
        join area d1
        on d1.id=c1.id_area
        left join sales_diskon e1
        on e1.id_sales = a1.id
        where a1.tahun = ?
        group by date_format(a1.tanggal, '%m'), b1.id_produk, c1.id_area, c1.id_master
      ) a
      right join master_distributor b
      on a.id_master=b.id
      where coalesce(a.nama,'-') <> '-'
      group by a.id_area, b.id, a.bulan
      order by a.id_area";*/
    $query = "select coalesce(a.id_area,'-') as id_area, 
        b.id as id_jenis_distributor,
        c_order,
        coalesce(a.nama,'-') as nama_area,
        b.alias_distributor,
         coalesce((case when bulan = '01' then sum(a.jumlah) end),0) as januari,
         coalesce((case when bulan = '02' then sum(a.jumlah) end),0) as februari,
         coalesce((case when bulan = '03' then sum(a.jumlah) end),0) as maret,
         coalesce((case when bulan = '04' then sum(a.jumlah) end),0) as april,
         coalesce((case when bulan = '05' then sum(a.jumlah) end),0) as mei,
         coalesce((case when bulan = '06' then sum(a.jumlah) end),0) as juni,
         coalesce((case when bulan = '07' then sum(a.jumlah) end),0) as juli,
         coalesce((case when bulan = '08' then sum(a.jumlah) end),0) as agustus,
         coalesce((case when bulan = '09' then sum(a.jumlah) end),0) as september,
         coalesce((case when bulan = '10' then sum(a.jumlah) end),0) as oktober,
         coalesce((case when bulan = '11' then sum(a.jumlah) end),0) as november,
         coalesce((case when bulan = '12' then sum(a.jumlah) end),0) as desember
         from 
         (
           select 
           coalesce((b1.harga_master * sum(a1.jumlah)) - (b1.harga_master * sum(a1.jumlah) * ((coalesce(e1.diskon_on, 0) + coalesce(e1.diskon_off, 0)) / 100)),0) as jumlah, 
           date_format(a1.tanggal, '%m') as bulan,
           a1.id_produk,
           d1.nama,
           d1.id as id_area,
           c1.id_master,
           concat('a', c1.id_master) as c_order
           from sales a1
           join produk_harga b1
           on a1.id_produk=b1.id_produk
           join distributor c1
           on a1.id_distributor=c1.id
           join area d1
           on d1.id=c1.id_area
           left join sales_diskon e1
           on e1.id_sales = a1.id
           where a1.tahun = ?
           group by date_format(a1.tanggal, '%m'), b1.id_produk, c1.id_area, c1.id_master
         ) a
         right join master_distributor b
         on a.id_master=b.id
         where coalesce(a.nama,'-') <> '-'
         group by a.id_area, b.id, a.bulan
      union
      select 
        a.id_area,
        c.id,
        concat('b', c.id) as c_order,
        a.nama as nama_area,
        c.nama as nama_master_produk, 
        coalesce((case when a.bulan = '01' then sum(a.total) end),0) as januari,
        coalesce((case when a.bulan = '02' then sum(a.total) end),0) as februari,
        coalesce((case when a.bulan = '03' then sum(a.total) end),0) as maret,
        coalesce((case when a.bulan = '04' then sum(a.total) end),0) as april,
        coalesce((case when a.bulan = '05' then sum(a.total) end),0) as mei,
        coalesce((case when a.bulan = '06' then sum(a.total) end),0) as juni,
        coalesce((case when a.bulan = '07' then sum(a.total) end),0) as juli,
        coalesce((case when a.bulan = '08' then sum(a.total) end),0) as agustus,
        coalesce((case when a.bulan = '09' then sum(a.total) end),0) as september,
        coalesce((case when a.bulan = '10' then sum(a.total) end),0) as oktober,
        coalesce((case when a.bulan = '11' then sum(a.total) end),0) as november,
        coalesce((case when a.bulan = '12' then sum(a.total) end),0) as desember
      from
      (
        select sum(a1.target) as target, 
        coalesce((h1.harga_master * sum(a1.jumlah)) - (h1.harga_master * sum(a1.jumlah) * ((coalesce(g1.diskon_on, 0) + coalesce(g1.diskon_off, 0)) / 100)),0) as total,
        date_format(a1.tanggal, '%m') as bulan, 
        a1.id_produk as id_produk, 
        e1.nama, 
        e1.id as id_area
        from sales a1
        join produk_harga b1
        on a1.id_produk=b1.id_produk
        join produk c1
        on b1.id_produk=c1.id
        join distributor d1
        on a1.id_distributor=d1.id
        join area e1
        on e1.id=d1.id_area
        left join sales_diskon g1
        on g1.id_sales=a1.id
        join produk_harga h1
        on a1.id_produk=h1.id_produk
        where a1.tahun = ?
        group by date_format(a1.tanggal, '%m'), b1.id_produk, d1.id_area, a1.id
      )a
      join produk_jenis b
      on a.id_produk=b.id_produk
      right join master_jenis_produk c
      on b.id_jenis=c.id
      where id_area is not null
      group by a.bulan, a.id_area, c.id
      order by id_area, c_order";
    $bind_param = array($this->session->userdata('tahun'), $this->session->userdata('tahun'));
    $result = $this->db->query($query, $bind_param);
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error',
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data' => $result
        );
    }
    return $ret_val;
  }

  public function get_total($column = '*')
  {
    /*$query = "select 
        b.alias_distributor,
        coalesce((case when bulan = '01' then sum(a.jumlah) end),0) as januari,
        coalesce((case when bulan = '02' then sum(a.jumlah) end),0) as februari,
        coalesce((case when bulan = '03' then sum(a.jumlah) end),0) as maret,
        coalesce((case when bulan = '04' then sum(a.jumlah) end),0) as april,
        coalesce((case when bulan = '05' then sum(a.jumlah) end),0) as mei,
        coalesce((case when bulan = '06' then sum(a.jumlah) end),0) as juni,
        coalesce((case when bulan = '07' then sum(a.jumlah) end),0) as juli,
        coalesce((case when bulan = '08' then sum(a.jumlah) end),0) as agustus,
        coalesce((case when bulan = '09' then sum(a.jumlah) end),0) as september,
        coalesce((case when bulan = '10' then sum(a.jumlah) end),0) as oktober,
        coalesce((case when bulan = '11' then sum(a.jumlah) end),0) as november,
        coalesce((case when bulan = '12' then sum(a.jumlah) end),0) as desember
      from 
      (
          select
            SUM(jumlah) as jumlah,
            bulan,
            id_master
          FROM (
            select 
              coalesce((b1.harga_master * sum(a1.jumlah)) - (b1.harga_master * sum(a1.jumlah) * ((coalesce(e1.diskon_on, 0) + coalesce(e1.diskon_off, 0)) / 100)),0) as jumlah, 
              date_format(a1.tanggal, '%m') as bulan,
              a1.id_produk,
              d1.nama,
              d1.id as id_area,
              c1.id_master
            from sales a1
            join produk_harga b1
            on a1.id_produk=b1.id_produk
            join distributor c1
            on a1.id_distributor=c1.id
            join area d1
            on d1.id=c1.id_area
            left join sales_diskon e1
            on e1.id_sales = a1.id
            where a1.tahun = ?
            group by date_format(a1.tanggal, '%m'), b1.id_produk, c1.id_area, c1.id_master
          ) z
          group by z.bulan, z.id_master
      ) a
      right join master_distributor b
      on a.id_master=b.id
      group by a.id_master";*/
    $query = "select coalesce(a.id_area,'-') as id_area, 
            b.id as id_jenis_distributor,
            c_order,
            b.alias_distributor,
             coalesce((case when bulan = '01' then sum(a.jumlah) end),0) as januari,
             coalesce((case when bulan = '02' then sum(a.jumlah) end),0) as februari,
             coalesce((case when bulan = '03' then sum(a.jumlah) end),0) as maret,
             coalesce((case when bulan = '04' then sum(a.jumlah) end),0) as april,
             coalesce((case when bulan = '05' then sum(a.jumlah) end),0) as mei,
             coalesce((case when bulan = '06' then sum(a.jumlah) end),0) as juni,
             coalesce((case when bulan = '07' then sum(a.jumlah) end),0) as juli,
             coalesce((case when bulan = '08' then sum(a.jumlah) end),0) as agustus,
             coalesce((case when bulan = '09' then sum(a.jumlah) end),0) as september,
             coalesce((case when bulan = '10' then sum(a.jumlah) end),0) as oktober,
             coalesce((case when bulan = '11' then sum(a.jumlah) end),0) as november,
             coalesce((case when bulan = '12' then sum(a.jumlah) end),0) as desember
             from 
             (
               select 
               coalesce((b1.harga_master * sum(a1.jumlah)) - (b1.harga_master * sum(a1.jumlah) * ((coalesce(e1.diskon_on, 0) + coalesce(e1.diskon_off, 0)) / 100)),0) as jumlah, 
               date_format(a1.tanggal, '%m') as bulan,
               a1.id_produk,
               d1.nama,
               d1.id as id_area,
               c1.id_master,
               concat('a', c1.id_master) as c_order
               from sales a1
               join produk_harga b1
               on a1.id_produk=b1.id_produk
               join distributor c1
               on a1.id_distributor=c1.id
               join area d1
               on d1.id=c1.id_area
               left join sales_diskon e1
               on e1.id_sales = a1.id
               where a1.tahun = ?
               group by date_format(a1.tanggal, '%m'), b1.id_produk, c1.id_area, c1.id_master
             ) a
             right join master_distributor b
             on a.id_master=b.id
             where coalesce(a.nama,'-') <> '-'
             group by b.id, a.bulan
          union
          select 
            a.id_area,
            c.id,
            concat('b', c.id) as c_order,
            c.nama as nama_master_produk, 
            coalesce((case when a.bulan = '01' then sum(a.total) end),0) as januari,
            coalesce((case when a.bulan = '02' then sum(a.total) end),0) as februari,
            coalesce((case when a.bulan = '03' then sum(a.total) end),0) as maret,
            coalesce((case when a.bulan = '04' then sum(a.total) end),0) as april,
            coalesce((case when a.bulan = '05' then sum(a.total) end),0) as mei,
            coalesce((case when a.bulan = '06' then sum(a.total) end),0) as juni,
            coalesce((case when a.bulan = '07' then sum(a.total) end),0) as juli,
            coalesce((case when a.bulan = '08' then sum(a.total) end),0) as agustus,
            coalesce((case when a.bulan = '09' then sum(a.total) end),0) as september,
            coalesce((case when a.bulan = '10' then sum(a.total) end),0) as oktober,
            coalesce((case when a.bulan = '11' then sum(a.total) end),0) as november,
            coalesce((case when a.bulan = '12' then sum(a.total) end),0) as desember
          from
          (
            select sum(a1.target) as target, 
        coalesce((h1.harga_master * sum(a1.jumlah)) - (h1.harga_master * sum(a1.jumlah) * ((coalesce(g1.diskon_on, 0) + coalesce(g1.diskon_off, 0)) / 100)),0) as total,
        date_format(a1.tanggal, '%m') as bulan, 
        a1.id_produk as id_produk, 
        e1.nama, 
        e1.id as id_area
        from sales a1
        join produk_harga b1
        on a1.id_produk=b1.id_produk
        join produk c1
        on b1.id_produk=c1.id
        join distributor d1
        on a1.id_distributor=d1.id
        join area e1
        on e1.id=d1.id_area
        left join sales_diskon g1
        on g1.id_sales=a1.id
        join produk_harga h1
        on a1.id_produk=h1.id_produk
        where a1.tahun = ?
        group by date_format(a1.tanggal, '%m'), b1.id_produk, d1.id_area, a1.id
      ) a
      join produk_jenis b
      on a.id_produk=b.id_produk
      right join master_jenis_produk c
      on b.id_jenis=c.id
      where id_area is not null
      group by a.bulan, c.id
      order by c_order";
    $bind_param = array($this->session->userdata('tahun'), $this->session->userdata('tahun'));
    $result = $this->db->query($query, $bind_param);
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error',
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data' => $result
        );
    }
    return $ret_val;
  }

}