<?php 

class Pemindahan_Sales extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_waiting($column = '*')
  {
    $this->db->select($column);
    $this->db->where('hapus', null);
    $this->db->where('status', 'waiting');
    $this->db->where('tahun', $this->session->userdata('tahun'));
    $result = $this->db->get('v_pemindahan');
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

  public function get_approved($column = '*')
  {
    $this->db->select($column);
    $this->db->where('hapus', null);
    $this->db->where('status', 'approved');
    $this->db->where('tahun', $this->session->userdata('tahun'));
    $result = $this->db->get('v_pemindahan');
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

  public function show($id, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id', $id);
    $this->db->where('hapus', null);
    $this->db->where('tahun', $this->session->userdata('tahun'));
    $result = $this->db->get('v_pemindahan');
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

  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('pemindahan_sales');
    $this->db->query($query);
  }

  public function update($id, $data = array())
  {
    $this->db->set($data);
    $this->db->where('id', $id);
    $query = $this->db->get_compiled_update('pemindahan_sales');
    $this->db->query($query);
  }

}