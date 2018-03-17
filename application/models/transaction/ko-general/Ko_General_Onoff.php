<?php 

class Ko_General_Onoff extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function show($id, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_ko', $id);
    $this->db->where('hapus', null);
    $result = $this->db->get('ko_general_onoff');
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
    $query = $this->db->set($data)->get_compiled_insert('ko_general_onoff');
    $this->db->query($query);
  }

  public function update_cn($id, $cn, $data = array())
  {
    $this->db->set($data);
    $this->db->where('id_ko', $id);
    $this->db->where('cn', $cn);
    $query = $this->db->get_compiled_update('ko_general_onoff');
    $this->db->query($query);
  }

}