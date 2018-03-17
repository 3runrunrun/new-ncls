<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Data_Faktur extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['general'] = $this->kog->get_list_faktur('id, id_detailer, UPPER(nama) AS nama_detailer, tanggal, jenis_ko, status, tgl_spv, tgl_rm, tgl_direktur');
    $data['tender'] = $this->kot->get_list_faktur('sp, id, id_detailer, UPPER(nama) AS nama_detailer, tanggal, jenis_ko, status, tgl_spv, tgl_rm, tgl_direktur');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/faktur/daftar-faktur', $data);
    $this->load->view('footers/footer-js-form-simple-table'); 
  }

}