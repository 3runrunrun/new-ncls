<?php 

class Fixed_Cost extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_promosi($column = '*')
  {
    $this->db->select($column);
    $this->db->where('tahun', $this->session->userdata('tahun'));
    $result = $this->db->get('v_fc_promosi');
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

  public function get_cogm($column = '*')
  {
    $this->db->select($column);
    $this->db->where('tahun', $this->session->userdata('tahun'));
    $result = $this->db->get('v_fc_cogm');
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

  public function get_operasional($column = '*')
  {
    $this->db->select($column);
    $this->db->where('tahun', $this->session->userdata('tahun'));
    $result = $this->db->get('v_fc_operasional');
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