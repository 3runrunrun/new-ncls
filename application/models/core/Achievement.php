<?php 

class Achievement extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data($column = '*')
  {
    // $query = "SELECT 
    //     a.id_detailer,
    //     b.nama_detailer,
    //     b.nama_area,
    //     b.alias_area,
    //     a.jumlah_diskon as total_sales,
    //     a.target,
    //     a.nominal_target,
    //     a.jumlah,
    //     a.jumlah / a.target * 100 as achievement_unit,
    //     a.jumlah_diskon / a.nominal_target * 100 as achievement
    //   FROM
    //   (SELECT 
    //     a1.id_detailer,
    //     SUM(a1.jumlah) as jumlah,
    //     SUM(a1.jumlah * b1.harga_master) as nominal_jumlah,
    //     c1.target,
    //     SUM(c1.target * b1.harga_master) as nominal_target,
    //     (SUM(a1.jumlah * b1.harga_master) - COALESCE(SUM(a1.jumlah * b1.harga_master) * ((COALESCE(d1.diskon_on, 0) + COALESCE(d1.diskon_off, 0)) / 100), 0)) AS jumlah_diskon
    //   FROM sales a1
    //   JOIN produk_harga b1 ON a1.id_produk = b1.id_produk
    //   LEFT JOIN sales_diskon d1 ON a1.id = d1.id_sales
    //   LEFT JOIN (SELECT
    //     a2.id_detailer,
    //     a2.id_produk,
    //     SUM(a2.target) as target
    //   FROM v_target_detailer a2
    //   WHERE a2.tahun = ?
    //   AND a2.hapus IS NULL
    //   GROUP BY a2.id_detailer, a2.id_produk) c1 ON a1.id_detailer = c1.id_detailer
    //   WHERE a1.tahun = ?
    //   AND a1.hapus IS NULL
    //   GROUP BY a1.id_detailer) a
    //   JOIN v_detailer_aktif b ON a.id_detailer = b.id";
    // $bind_param = array($this->session->userdata('tahun'), $this->session->userdata('tahun'));
    // $result = $this->db->query($query, $bind_param);
    $column = "a.tahun,
      a.id_detailer,
      c.nama_detailer,
      c.id_area,
      c.nama_area,
      c.alias_area,
      SUM(b.target) AS target,
      SUM(b.nominal_target) AS nominal_target,
      SUM(a.jumlah) AS jumlah,
      SUM(a.nominal_jumlah) AS nominal_jumlah,
      SUM(a.nominal_jumlah) / SUM(b.nominal_target) * 100 as achievement,
      a.hapus";
    $this->db->select($column, false);
    $this->db->from('acv_sales_detailer_produk a');
    $this->db->join('acv_target_detailer_produk b', 'a.id_detailer = b.id_detailer AND a.id_produk = b.id_produk');
    $this->db->join('v_detailer_aktif c', 'a.id_detailer = c.id');
    $this->db->where('a.tahun', $this->session->userdata('tahun'));
    $this->db->where('a.hapus', null);
    $this->db->group_by('a.id_detailer, a.tahun');
    $result = $this->db->get();
    if (!$result) {
      $ret_val = array(
        'status' => 'error',
        'data'   => $this->db->error(),
      );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data'   => $result,
      );
    }
    return $ret_val;
  }

  public function show_pertahun($id, $column = '*')
  {
    $column = "a.tahun,
      a.id_detailer,
      c.nama_detailer,
      c.id_area,
      c.nama_area,
      c.alias_area,
      SUM(b.target) AS target,
      SUM(b.nominal_target) AS nominal_target,
      SUM(a.jumlah) AS jumlah,
      SUM(a.nominal_jumlah) AS nominal_jumlah,
      SUM(a.nominal_jumlah) / SUM(b.nominal_target) * 100 as achievement,
      a.hapus";
    $this->db->select($column, false);
    $this->db->from('acv_sales_detailer_produk a');
    $this->db->join('acv_target_detailer_produk b', 'a.id_detailer = b.id_detailer AND a.id_produk = b.id_produk');
    $this->db->join('v_detailer_aktif c', 'a.id_detailer = c.id');
    $this->db->where('a.id_detailer', $id);
    $this->db->where('a.tahun', $this->session->userdata('tahun'));
    $this->db->where('a.hapus', null);
    $this->db->group_by('a.id_detailer, a.tahun');
    $result = $this->db->get();
    if (!$result) {
      $ret_val = array(
        'status' => 'error',
        'data'   => $this->db->error(),
      );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data'   => $result,
      );
    }
    return $ret_val;
  }

  // detailer per outlet
  public function show($id, $column = '*')
  {
    $this->db->select($column, false);
    $this->db->from('acv_sales_perbulan a');
    $this->db->join('v_detailer_aktif b', 'a.id_detailer = b.id');
    $this->db->join('v_outlet c', 'a.id_outlet = c.id');
    $this->db->where('a.id_detailer', $id);
    $this->db->where('a.tahun', $this->session->userdata('tahun'));
    $this->db->where('a.hapus', null);
    $result = $this->db->get();
    if (!$result) {
      $ret_val = array(
        'status' => 'error',
        'data'   => $this->db->error(),
      );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data'   => $result,
      );
    }
    return $ret_val;
  }

  // detailer per outlet per produk
  public function show_produk($id, $column = '*')
  {
    $this->db->select($column, false);
    $this->db->from('acv_sales_outlet_produk_perbulan_tahun a');
    $this->db->join('v_detailer_aktif b', 'a.id_detailer = b.id');
    $this->db->join('v_outlet c', 'a.id_outlet = c.id');
    $this->db->join('v_produk_harga d', 'a.id_produk = d.id');
    $this->db->where('a.id_detailer', $id);
    $this->db->where('a.tahun', $this->session->userdata('tahun'));
    $this->db->where('a.hapus', null);
    $result = $this->db->get();
    if (!$result) {
      $ret_val = array(
        'status' => 'error',
        'data'   => $this->db->error(),
      );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data'   => $result,
      );
    }
    return $ret_val;
  }

  /*public function show($id)
  {
    $query = "SELECT 
      a.id_detailer,
      b.nama_detailer,
      b.nama_area,
      b.alias_area,
      a.jumlah_diskon as total_sales,
      a.nominal_target,
      a.jumlah_diskon / a.nominal_target * 100 as achievement,
      a.id_produk,
      c.nama as nama_produk,
      coalesce((case when a.bulan = '01' then a.jumlah_diskon end),0) as januari,
      coalesce((case when a.bulan = '02' then a.jumlah_diskon end),0) as februari,
      coalesce((case when a.bulan = '03' then a.jumlah_diskon end),0) as maret,
      coalesce((case when a.bulan = '04' then a.jumlah_diskon end),0) as april,
      coalesce((case when a.bulan = '05' then a.jumlah_diskon end),0) as mei,
      coalesce((case when a.bulan = '06' then a.jumlah_diskon end),0) as juni,
      coalesce((case when a.bulan = '07' then a.jumlah_diskon end),0) as juli,
      coalesce((case when a.bulan = '08' then a.jumlah_diskon end),0) as agustus,
      coalesce((case when a.bulan = '09' then a.jumlah_diskon end),0) as september,
      coalesce((case when a.bulan = '10' then a.jumlah_diskon end),0) as oktober,
      coalesce((case when a.bulan = '11' then a.jumlah_diskon end),0) as november,
      coalesce((case when a.bulan = '12' then a.jumlah_diskon end),0) as desember
    FROM
    (
      SELECT 
      a1.id_detailer,
      a1.id_produk,
      date_format(a1.tanggal, '%m') as bulan,
      SUM(a1.jumlah) as jumlah,
      SUM(a1.jumlah * b1.harga_master) as nominal_jumlah,
      c1.target,
      SUM(c1.target * b1.harga_master) as nominal_target,
      (SUM(a1.jumlah * b1.harga_master) - COALESCE(SUM(a1.jumlah * b1.harga_master) * ((COALESCE(d1.diskon_on, 0) + COALESCE(d1.diskon_off, 0)) / 100), 0)) AS jumlah_diskon
      FROM sales a1
      JOIN produk_harga b1 ON a1.id_produk = b1.id_produk
      LEFT JOIN sales_diskon d1 ON a1.id = d1.id_sales
      LEFT JOIN 
      (
        SELECT
        a2.id_detailer,
        a2.id_produk,
        SUM(a2.target) as target
        FROM v_target_detailer a2
        WHERE a2.tahun = ?
        AND a2.hapus IS NULL
        GROUP BY a2.id_detailer, a2.id_produk
      ) c1 
      ON a1.id_detailer = c1.id_detailer
      WHERE a1.tahun = ?
      AND a1.hapus IS NULL
      GROUP BY a1.id_detailer, a1.id_produk, date_format(a1.tanggal, '%m')) a
      JOIN v_detailer_aktif b ON a.id_detailer = b.id
      JOIN produk c ON a.id_produk = c.id
      WHERE a.id_detailer = ?";
    $bind_param = array($this->session->userdata('tahun'), $this->session->userdata('tahun'), $id);
    $result = $this->db->query($query, $bind_param);
    if (!$result) {
      $ret_val = array(
        'status' => 'error',
        'data'   => $this->db->error(),
      );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data'   => $result,
      );
    }
    return $ret_val;
  }*/

}