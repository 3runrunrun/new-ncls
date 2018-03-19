<?php 

class Achievement extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data($column = '*')
  {
    $query = "SELECT 
        a.id_detailer,
        b.nama_detailer,
        b.nama_area,
        b.alias_area,
        a.jumlah_diskon as total_sales,
        a.nominal_target,
        a.jumlah_diskon / a.nominal_target * 100 as achievement
      FROM
      (SELECT 
        a1.id_detailer,
        SUM(a1.jumlah) as jumlah,
        SUM(a1.jumlah * b1.harga_master) as nominal_jumlah,
        c1.target,
        SUM(c1.target * b1.harga_master) as nominal_target,
        (SUM(a1.jumlah * b1.harga_master) - COALESCE(SUM(a1.jumlah * b1.harga_master) * ((COALESCE(d1.diskon_on, 0) + COALESCE(d1.diskon_off, 0)) / 100), 0)) AS jumlah_diskon
      FROM sales a1
      JOIN produk_harga b1 ON a1.id_produk = b1.id_produk
      LEFT JOIN sales_diskon d1 ON a1.id = d1.id_sales
      LEFT JOIN (SELECT
        a2.id_detailer,
        a2.id_produk,
        SUM(a2.target) as target
      FROM v_target_detailer a2
      WHERE a2.tahun = ?
      AND a2.hapus IS NULL
      GROUP BY a2.id_detailer, a2.id_produk) c1 ON a1.id_detailer = c1.id_detailer
      WHERE a1.tahun = ?
      AND a1.hapus IS NULL
      GROUP BY a1.id_detailer) a
      JOIN v_detailer_aktif b ON a.id_detailer = b.id";
    $bind_param = array($this->session->userdata('tahun'), $this->session->userdata('tahun'));
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
  }

  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('call_plan');
    $this->db->query($query);
  }

}