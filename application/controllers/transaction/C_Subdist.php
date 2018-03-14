<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Subdist extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }


  public function index()
  {
    $data['total_target'] = $this->subeks->get_total_target();

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/subdist/subdist', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show($id)
  {
    $data['target'] = $this->subeks->show_target($id);

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/subdist/detail-subdist', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

}