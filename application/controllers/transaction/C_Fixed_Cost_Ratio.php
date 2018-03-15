<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Fixed_Cost_Ratio extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $this->load->view('heads/head-simple-form-table-chart');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/fixed-cost/fixed-cost');
    $this->load->view('footers/footer-js-simple-form-table-chart');
  }

}