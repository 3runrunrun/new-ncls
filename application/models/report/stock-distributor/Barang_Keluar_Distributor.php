<?php 

class Barang_Keluar_Distributor extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('barang_keluar_distributor');
    $this->db->query($query);
  }

}