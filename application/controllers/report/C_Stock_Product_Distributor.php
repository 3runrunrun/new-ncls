<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Stock_Product_Distributor extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/stok-distributor/stok-produk');
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show($id, $approve = null)
  {
    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/stok-distributor/detail-produk');
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function store($operation = null)
  {
    # code...
  }

}