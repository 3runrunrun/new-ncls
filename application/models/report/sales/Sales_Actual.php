<?php 

class Sales_Actual extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data($column = '*')
  {
    $query = "select b.id_detailer as kode_sales,
      a.nama as nama_sales,
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
        c1.nama, a1.id_detailer, a1.id as id_sales
        from sales a1
        join produk_harga b1
        on a1.id_produk=b1.id_produk
        join detailer c1
        on a1.id_detailer=c1.id
        left join sales_diskon e1
        on e1.id_sales=a1.id
        group by date_format(a1.tanggal, '%m'), b1.id_produk, a1.id_detailer, e1.id_sales
      ) a
      join sales b
      on a.id_sales = b.id
      where b.tahun = ?
      group by date_format(b.tanggal, '%m'), a.id_detailer";
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
        c1.nama, a1.id_detailer, a1.id as id_sales
        from sales a1
        join produk_harga b1
        on a1.id_produk=b1.id_produk
        join detailer c1
        on a1.id_detailer=c1.id
        left join sales_diskon e1
        on e1.id_sales=a1.id
        group by date_format(a1.tanggal, '%m'), b1.id_produk, a1.id_detailer, e1.id_sales
      ) a
      join sales b
      on a.id_sales = b.id
      where b.tahun = ?";
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

  public function get_data_lower($column = '*')
  {
    $query = "select a.kode_detailer, a.nama_detailer, a.sales_reg, coalesce(sum(b.sales_dis_prog),0) as sales_dis_prog, c.nominal_target, ((a.sales_reg + coalesce(sum(b.sales_dis_prog),0)) / c.nominal_target) * 100 as achievement
      from
      (
        select 
        c1.id as kode_detailer,
        c1.nama as nama_detailer,
        a1.tahun,
        coalesce(b1.harga_master * sum(a1.jumlah), 0) as sales_reg
        from sales a1
        join produk_harga b1
        on a1.id_produk=b1.id_produk
        join detailer c1
        on a1.id_detailer=c1.id
        where a1.tahun = ?
        group by a1.tahun, a1.id_detailer
      ) a
      join
      (
        select a.id_detailer, sum(a.target) as target, sum(a.target * b.harga_master) as nominal_target
        from v_target_detailer a
        join produk_harga b
        on a.id_produk = b.id_produk
        group by tahun, id_detailer
      ) c
      on a.kode_detailer=c.id_detailer
      left join
      (
        select a2.id as id_sales, b2.diskon_on + b2.diskon_off as diskon, a2.id_detailer,
        coalesce((c2.harga_master * sum(a2.jumlah) * ((coalesce(b2.diskon_on, 0) + coalesce(b2.diskon_off, 0)) / 100)),0) as sales_dis_prog
        from sales a2
        left join sales_diskon b2
        on a2.id=b2.id_sales
        join produk_harga c2
        on a2.id_produk=c2.id_produk
        where a2.tahun = ?
        group by a2.id, a2.id_detailer
      ) b
      on a.kode_detailer=b.id_detailer
      group by b.id_detailer";
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