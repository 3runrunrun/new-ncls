<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Actual_Sales extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['sales'] = $this->sala->get_data();
    $data['total'] = $this->sala->get_total();
    $data['sales_bawah'] = $this->sala->get_data_lower('a.id_detailer, b.nama_detailer, a.sales_reg, a.sales_disprog, a.nominal_target, a.achievement');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/sales-actual/sales-actual', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

}