<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Promo_Trial extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['promo_trial_wait'] = $this->Produk->get_produk_harga('a.id, a.no_promo, b.nama as detailer, c.nama as user, a.status');
    $data['promo_trial_appr'] = $this->Produk->get_produk_harga('a.id, a.no_promo, b.nama as detailer, c.nama as user, a.status');
    $data['id'] = $this->nsu->digit_id_generator(4,'prt');

    if ($data['promo_trial_wait']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['promo_trial_wait']['data']);
    }

    var_dump($data['promo_trial_wait']['data']->result());
    echo "<hr>";
    var_dump($data['promo_trial_appr']['data']->result());

    // $this->load->view('heads/head-form-simple-table');
    // $this->load->view('navbar');
    // $this->load->view('contents/master/produk', $data);
    // $this->load->view('footers/footer-js-form-simple-table');
  }

  public function store($operation = null)
  {
    if ($operation == 'edit') {
      # code...
    } elseif ($operation == 'delete') {
      # code...
    } else {
      # code...
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->digit_id_generator(4,'prt');
      $input_var['no_promo'] = 'PFT-HL-'.date('d').'-'.date('Y');
      $input_var['tanggal'] = date('Y-m-d');

      $promo_trial = array();
      $promo_trial_detail = array();
      $promo_trial_status = array();
      $status = strtolower('waiting');

      $promo_trial['id'] = $input_var['id'];
      $promo_trial['no_promo'] = $input_var['no_promo'];
      $promo_trial['tahun'] = $input_var['tahun'];
      $promo_trial['id_detailer'] = $input_var['id_detailer'];
      $promo_trial['tanggal'] = $input_var['tanggal'];
      $promo_trial['id_customer'] = $input_var['id_customer'];
      $promo_trial['keteranagan'] = $input_var['keteranagan'];
      $promo_trial['status'] = $status;
      $this->ppn->store($promo_trial);
      
      foreach ($input_var['id_produk'] as $key => $value) {
        $promo_trial_detail['id_promo'] = $input_var['id'];
        $promo_trial_detail['no_promo'] = $input_var['no_promo']
        $promo_trial_detail['id_produk'] = $input_var['id_produk'];
        $promo_trial_detail['jumlah'] = $input_var['jumlah'][$key];
        $this->ppnd->store($promo_trial_detail);
      }
      
      $promo_trial_status['id_promo'] = $input_var['id'];
      $promo_trial_status['no_promo'] = $input_var['no_promo'];
      $promo_trial_status['status'] = $status;
      $promo_trial_status['tanggal'] = date('Y-m-d H:i:s');
      $this->ppns->store($promo_trial_status);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data promo trial <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data promo trial <strong>berhasil</strong> disimpan.');
      }
    }
   
   redirect('/stock-product-nucleus'); 
  }

}