<?php 

class Wpr_Detail extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('wpr_detail');
    $this->db->query($query);
  }

}