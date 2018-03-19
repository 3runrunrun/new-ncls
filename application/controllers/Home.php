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
    $data['sales_person'] = $this->M_Dashboard->sales_person('count(id) as jml');
    $data['sales_counter'] = $this->M_Dashboard->sales_counter('count(id) as jml');
    $data['profit'] = $this->M_Dashboard->profit();
    $data['dsa'] = $this->M_Dashboard->daily_sales_activity();

    $this->load->view('heads/head-dashboard');
    $this->load->view('navbar');
    $this->load->view('contents/dashboard/dashboard', $data);
    $this->load->view('footers/footer-js-dashboard');
  }

  public function login()
  {
    $this->load->view('heads/head-login');
    $this->load->view('contents/login');
    $this->load->view('footers/footer-js-login');
  }

  public function auth()
  {
    $input_var = $this->input->post();
    $this->session->set_userdata('tahun', $input_var['tahun']);
    redirect('/dashboard');
  }

}