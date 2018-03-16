<?php 

class Permohonan_Produk_Distributor_Detail extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('permohonan_produk_distributor_detail');
    $this->db->query($query);
  }

  public function update($id, $id_produk, $data = array())
  {
    $this->db->set($data);
    $this->db->where('id_permohonan', $id);
    $this->db->where('id_produk', $id_produk);
    $query = $this->db->get_compiled_update('permohonan_produk_distributor_detail');
    $this->db->query($query);
  }

}