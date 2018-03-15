<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Stock_Product_Nucleus extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/stok-nucleus/stok-produk');
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
      # code...
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->digit_id_generator(4,'pmhn');
      $input_var['tahun'] = date('Y');

      $pmh = array();
      $pmh_detail = array();
      $pmh_status = array();
      $status = strtolower('waiting');

      $pmh['id'] = $input_var['id'];
      $pmh['tahun'] = $input_var['tahun'];
      $pmh['tanggal'] = $input_var['tanggal'];
      $pmh['tanggal_target'] = $input_var['tanggal_target'];
      $pmh['status'] = $status;
      $this->ppn->store($pmh);
      
      foreach ($input_var['id_produk'] as $key => $value) {
        $pmh_detail['id_permohonan'] = $input_var['id'];
        $pmh_detail['id_produk'] = $value;
        $pmh_detail['jumlah'] = $input_var['jumlah'][$key];
        $this->ppnd->store($pmh_detail);
      }
      
      $pmh_status['id_permohonan'] = $input_var['id'];
      $pmh_status['tanggal'] = date('Y-m-d');
      $pmh_status['status'] = $status;
      $this->ppns->store($pmh_status);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data permohonan barang <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data permohonan barang <strong>berhasil</strong> disimpan.');
      }
    }
   
   redirect('/stock-product-nucleus'); 
  }

}