<?php 

class Sales_Daily extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_per_product()
  {
    $query = "select a.nama as nama_area, 
      a.id_produk as kode_produk,
      a.nama_produk,
      COALESCE(b.target * a.harga_diskon, 0) as target_rp,
      sum(a.jumlah) * a.harga_diskon as total_sales,
      coalesce((case when bulan = '01' then sum(a.jumlah) * a.harga_diskon end),0) as januari,
      coalesce((case when bulan = '02' then sum(a.jumlah) * a.harga_diskon end),0) as februari,
      coalesce((case when bulan = '03' then sum(a.jumlah) * a.harga_diskon end),0) as maret,
      coalesce((case when bulan = '04' then sum(a.jumlah) * a.harga_diskon end),0) as april,
      coalesce((case when bulan = '05' then sum(a.jumlah) * a.harga_diskon end),0) as mei,
      coalesce((case when bulan = '06' then sum(a.jumlah) * a.harga_diskon end),0) as juni,
      coalesce((case when bulan = '07' then sum(a.jumlah) * a.harga_diskon end),0) as juli,
      coalesce((case when bulan = '08' then sum(a.jumlah) * a.harga_diskon end),0) as agustus,
      coalesce((case when bulan = '09' then sum(a.jumlah) * a.harga_diskon end),0) as september,
      coalesce((case when bulan = '10' then sum(a.jumlah) * a.harga_diskon end),0) as oktober,
      coalesce((case when bulan = '11' then sum(a.jumlah) * a.harga_diskon end),0) as november,
      coalesce((case when bulan = '12' then sum(a.jumlah) * a.harga_diskon end),0) as desember
    from
    (
      select
      a1.id as id_sales, h1.harga_master * ((100 - coalesce(g1.diskon_on + g1.diskon_off,0)) / 100) as harga_diskon, 
      date_format(a1.tanggal, '%m') as bulan, c1.id as id_produk, c1.nama as nama_produk, a1.jumlah,
      e1.nama, e1.id as id_area
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
      and a1.hapus is null
      group by date_format(a1.tanggal, '%m'), b1.id_produk, d1.id_area, a1.id
    ) a
    left join
    (
      select c2.nama as nama_area, c2.id as id_area, a2.id_produk, sum(a2.target) as target
      from v_target_detailer a2
      join outlet b2
      on a2.id_outlet=b2.id
      join area c2
      on b2.id_area=c2.id
      where a2.tahun = ?
      and a2.hapus is null
      group by a2.id_produk, c2.id
    ) b
    on a.id_produk=b.id_produk and a.id_area=b.id_area
    group by a.id_area, a.id_produk";
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

  public function get_per_outlet()
  {
    $query = "select b.id as id_outlet, b.nama as nama_outlet, a.nama as nama_area, sum(target) as target,
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
      coalesce((case when a.bulan = '12' then sum(a.total) end),0) as desember,
      coalesce((case when a.id_area then sum(a.total) end),0) as total
      from
      (
        select sum(a1.target) as target,
        coalesce((h1.harga_master * sum(a1.jumlah)) - (h1.harga_master * sum(a1.jumlah) * ((coalesce(g1.diskon_on, 0) + coalesce(g1.diskon_off, 0)) / 100)),0) as total,
        date_format(a1.tanggal, '%m') as bulan, e1.nama, e1.id as id_area,
        f1.nama as nama_outlet, f1.id as id_outlet
        from sales a1
        join produk_harga b1
        on a1.id_produk=b1.id_produk
        join produk c1
        on b1.id_produk=c1.id
        join distributor d1
        on a1.id_distributor=d1.id
        join area e1
        on e1.id=d1.id_area
        join outlet f1
        on a1.id_outlet=f1.id
        left join sales_diskon g1
        on g1.id_sales=a1.id
        join produk_harga h1
        on a1.id_produk=h1.id_produk
        group by date_format(a1.tanggal, '%m'), f1.id
      )a
      join outlet b
      on b.id=a.id_outlet
      group by a.bulan, a.id_area, a.id_outlet";
    $result = $this->db->query($query);
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

  public function show_per_outlet($id)
  {
    $query = "select a.id_outlet, a.nama_outlet, b.id as id_produk, b.nama as nama_produk, a.nama as nama_area, sum(target) as target,
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
      coalesce((case when a.bulan = '12' then sum(a.total) end),0) as desember,
      coalesce((case when a.id_area then sum(a.total) end),0) as total
      from
      (
        select sum(a1.target) as target, 
        coalesce((h1.harga_master * sum(a1.jumlah)) - (h1.harga_master * sum(a1.jumlah) * ((coalesce(g1.diskon_on, 0) + coalesce(g1.diskon_off, 0)) / 100)),0) as total,
        date_format(a1.tanggal, '%m') as bulan, c1.id as id_produk, c1.nama as nama_produk, e1.nama, e1.id as id_area, f1.id as id_outlet, f1.nama as nama_outlet
        from sales a1
        join produk_harga b1
        on a1.id_produk=b1.id_produk
        join produk c1
        on b1.id_produk=c1.id
        join distributor d1
        on a1.id_distributor=d1.id
        join area e1
        on e1.id=d1.id_area
        join outlet f1
        on a1.id_outlet=f1.id
        left join sales_diskon g1
        on g1.id_sales=a1.id
        join produk_harga h1
        on a1.id_produk=h1.id_produk
        group by date_format(a1.tanggal, '%m'), b1.id_produk, f1.id, d1.id_area
      )a
      join produk b
      on b.id=a.id_produk
      where a.id_outlet = ?
      group by b.id, a.bulan, a.id_area, a.id_outlet;";
    $bind_query = array($id);
    $result = $this->db->query($query, $bind_query);
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