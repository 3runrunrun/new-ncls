<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $this->load->view('heads/head-dashboard');
    $this->load->view('navbar');
    $this->load->view('contents/dashboard/dashboard');
    $this->load->view('footers/footer-js-dashboard');
  }

}