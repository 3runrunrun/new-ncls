<?php 

class Permohonan_Produk_Distributor extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_waiting($column = '*')
  {
    $this->db->select($column, FALSE);
    $this->db->where('tahun', $this->session->userdata('tahun'));
    $this->db->where('status', 'waiting');
    $this->db->where('hapus', null);
    $result = $this->db->get('v_ppd');
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

  public function get_delivered($column = '*')
  {
    $this->db->select($column, FALSE);
    $this->db->where('tahun', $this->session->userdata('tahun'));
    $this->db->where('status', 'delivered');
    $this->db->where('hapus', null);
    $result = $this->db->get('v_ppd');
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

  public function show($id, $column = '*')
  {
    $this->db->select($column, FALSE);
    $this->db->where('id', $id);
    $this->db->where('hapus', null);
    $result = $this->db->get('v_ppd');
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
    $query = $this->db->set($data)->get_compiled_insert('permohonan_produk_distributor');
    $this->db->query($query);
  }

}