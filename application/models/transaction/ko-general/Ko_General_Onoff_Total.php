<?php 

class Ko_General_Onoff_Total extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('ko_general_onoff_total');
    $this->db->query($query);
  }

}