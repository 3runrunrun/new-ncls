<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Klm extends CI_Controller {

	public function  __construct(){
		parent:: __construct();
		date_default_timezone_set('Asia/Jakarta');
		error_reporting(0);
	}

	public function index()
	{
    # code...
	}
	public function show_sales()
	{
		
		$this->load->view('heads/head-simple-form-table-chart');
		$this->load->view('navbar');
		$this->load->view('contents/report/klm/sales-leveling');
		$this->load->view('footers/footer-js-simple-form-table-chart');
	}

}