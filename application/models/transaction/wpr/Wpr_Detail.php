<?php 

class Wpr_Detail extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }
  public function get_approved($column = '*')
  {
    $this->db->select($column);
    $this->db->where('tahun', $this->session->userdata('tahun'));
    $this->db->where('status', 'approved');
    $this->db->where('hapus', null);
    $result = $this->db->get('v_wpr_detail');
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
    $this->db->select($column);
    $this->db->where('id_wpr', $id);
    $this->db->where('hapus', null);
    $result = $this->db->get('v_wpr_detail');
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
    $query = $this->db->set($data)->get_compiled_insert('wpr_detail');
    $this->db->query($query);
  }

}