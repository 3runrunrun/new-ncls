<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Daily_Sales extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    # code...
  }

  public function show_product()
  {
    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/daily-sales/per-product');
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show_outlet()
  {
    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/daily-sales/per-outlet');
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function store($operation = null)
  {
    $this->db->trans_begin();
    if ($operation == 'edit') {
      # code...
    } elseif ($operation == 'delete') {
      # code...
    } else {
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->letter_number_generator('sal');
      $input_var['tahun'] = date('Y');

      $sales = array();
      $sales_diskon = array();
      $sales_subdist = array();

      $sales['id'] = $input_var['id'];
      $sales['tahun'] = $input_var['tahun'];
      $sales['id_distributor'] = $input_var['id_distributor'];
      $sales['id_detailer'] = $input_var['id_detailer'];
      $sales['id_outlet'] = $input_var['id_outlet'];
      $sales['id_produk'] = $input_var['id_produk'];
      $sales['target'] = $input_var['target'];
      $sales['jumlah'] = $input_var['jumlah'];
      $this->sal->store($sales);

      $sales_diskon['id_sales'] = $input_var['id'];
      $sales_diskon['id_ko'] = $input_var['id_ko'];
      $sales_diskon['diskon_on'] = $input_var['diskon_on'];
      $sales_diskon['diskon_off'] = $input_var['diskon_off'];
      $sales_diskon['cn'] = $input_var['cn'];
      $this->sald->store($sales_diskon);

      $sales_subdist['id_sales'] = $input_var['id'];
      $sales_subdist['id_subdist'] = $input_var['id_subdist'];
      $this->salsub->store($sales_subdist);      

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data area <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data area baru <strong>berhasil</strong> disimpan.');
      }
    }
    
    redirect('/master-area');
  }

  // sales
  public function save_sales($data = array())
  {
    $val['id'] = $data['id'];
    $val['tahun'] = $data['tahun'];
    $val['tanggal'] = $data['tanggal'];
    $val['id_detailer'] = $data['id_detailer'];
    $val['id_outlet'] = $data['id_outlet'];
    $val['id_produk'] = $data['id_produk'];
    
    if ($data['dist_subdist'] === 's') {
      $val['id_distributor'] = 0;
    } else {
      $val['id_distributor'] = $data['id_distributor'];
    }
    
  }
  // end of sales

}