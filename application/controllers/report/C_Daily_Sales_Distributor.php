<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Daily_Sales_Distributor extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['sales_area'] = $this->salo->get_data();
    $data['sales_total'] = $this->salo->get_total();

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/sales-distributor/sales-distributor', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function store($operation = null)
  {
    # code...
  }

}