<?php 

class Sales_Distributor extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data($column = '*')
  {
    $query = "select coalesce(a.id_area,'-') as id_area, coalesce(a.nama,'-') as nama_area, b.alias_distributor,
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
      order by a.id_area";
    $bind_param = array($this->session->userdata('tahun'));
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
    $query = "select 
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
      group by a.id_master";
    $bind_param = array($this->session->userdata('tahun'));
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