<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Tender extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/faktur/ko-tender/ko-tender');
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
      $row = $this->kot->get_data();
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->zerofill_generator(4, $row['data']->num_rows()).'-HL-'.date('d').'-'.date('Y');
      $input_var['tahun'] = date('Y');

      $kot = array();
      $kotd = array();
      $koto = array();
      $kotot = array();
      $kots = array();
      $status = strtolower('waiting');

      $kot['id'] = $input_var['id'];
      $kot['sp'] = $input_var['sp'];
      $kot['tahun'] = $input_var['tahun'];
      $kot['id_detailer'] = $input_var['id_detailer'];
      $kot['tanggal'] = $input_var['tanggal'];
      $kot['id_distributor'] = $input_var['id_distributor'];
      $kot['id_rm'] = $input_var['id_rm'];
      $kot['id_direktur'] = $input_var['id_direktur'];
      $kot['tgl_spv'] = $input_var['tgl_spv'];
      $kot['tgl_rm'] = $input_var['tgl_rm'];
      $kot['tgl_direktur'] = $input_var['tgl_direktur'];
      $kot['status'] = $status;
      $kot['subdist'] = $input_var['subdist'];
      $this->kot->store($kot);
      
      foreach ($input_var['id_outlet'] as $key => $value) {
        $kotd['id_ko'] = $input_var['id'];
        $kotd['id_outlet'] = $input_var['id_outlet'][$key];
        $kotd['id_produk'] = $input_var['id_produk'][$key];
        $kotd['jumlah'] = $input_var['jumlah'][$key];
        $kotd['on_diskon_distributor'] = $input_var['on_diskon_distributor'][$key];
        $kotd['on_nf'] = $input_var['on_nf'][$key];
        $kotd['on_total'] = $input_var['on_total'][$key];
        $kotd['off_diskon_distributor'] = $input_var['off_diskon_distributor'][$key];
        $kotd['off_nf'] = $input_var['off_nf'][$key];
        $kotd['off_total'] = $input_var['off_total'][$key];
        $kotd['keterangan'] = $input_var['keterangan'][$key];
        $kotd['klaim'] = $input_var['klaim'][$key];
        $this->kotd->store($kotd);
      }
      
      $koto['id_ko'] = $input_var['id'];
      $koto['cn'] = $input_var['cn'];
      $koto['diskon'] = $input_var['diskon'];
      $this->koto->store($koto);

      $kotot['id_ko'] = $input_var['id'];
      $kotot['total'] = $input_var['total'];
      $this->kotot->store($kotot);

      $kots['id_ko'] = $input_var['id'];
      $kots['tanggal'] = date('Y-m-d H:i:s');
      $kots['status'] = $status;
      $kots['id_rilis'] = $input_var['id_rilis'];
      $this->kots->store($kots);

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