<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Evaluasi_Target_Customer extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['achievement'] = $this->Achievement->get_data('COUNT(id) as sales_person');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/evaluasi/evaluasi-target-customer', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  
  }
  public function show($id)
  {
    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/evaluasi/detail');
    $this->load->view('footers/footer-js-form-simple-table');
  }

}