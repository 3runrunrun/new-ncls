<?php 

class Sales_Tender_Subdist extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('sales_tender_subdist');
    $this->db->query($query);
  }

}