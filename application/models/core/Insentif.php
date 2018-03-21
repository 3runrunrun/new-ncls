<?php 

class Insentif extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data($column = '*')
  {
    $this->db->select($column, false);
    $this->db->from('ins_insentif_perbulan a');
    $this->db->join('v_detailer_aktif b', 'a.id_detailer = b.id');
    $this->db->join('v_outlet c', 'a.id_outlet = c.id');
    $this->db->where('a.tahun', $this->session->userdata('tahun'));
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

}