<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Entry_Breakdown extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index() //id = slc
  {
    # code...
  }

  public function show_general()
  {
    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/entry-breakdown/general');
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show_product()
  {
    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/entry-breakdown/per-product');
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
      $input_var['id'] = $this->nsu->letter_number_generator('slc');
      $input_var['tahun'] = date('Y');

      $slc = array();
      $slc_detail = array();

      $slc['id'] = $input_var['id'];
      $slc['tahun'] = $input_var['tahun'];
      $slc['tanggal'] = $input_var['tanggal'];
      $slc['id_wpr'] = $input_var['id_wpr'];
      $this->salcust->store($slc);
      
      foreach ($input_var['id_produk'] as $key => $value) {
        $slc_detail['id_sc'] = $input_var['id'];
        $slc_detail['id_produk'] = $input_var['id_produk'][$key];
        $slc_detail['jumlah'] = $input_var['jumlah'][$key];
        $this->salcustd->store($slc_detail);
      }

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data promo trial <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data promo trial <strong>berhasil</strong> disimpan.');
      }
    }
   
   redirect('/master-promo'); 
  }

}