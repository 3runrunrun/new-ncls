<?php 

class Wpr extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data($column = '*')
  {
    $this->db->select($column);
    $this->db->from('wpr a');
    $this->db->join('detailer b', 'a.id_detailer = b.id');
    $this->db->join('detailer c', 'a.id_spv = c.id');
    $this->db->join('wpr_detail d', 'a.id = d.id_wpr');
    $this->db->group_by('d.id_wpr');
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
  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('wpr');
    $this->db->query($query);
  }
}