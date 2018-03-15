<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_General extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/faktur/ko-general/ko-general');
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
      $row = $this->kog->get_data();
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->zerofill_generator(4, $row['data']->num_rows()).'-HL-'.date('d').'-'.date('Y');
      $input_var['tahun'] = date('Y');

      $kog = array();
      $kogd = array();
      $kogo = array();
      $kogot = array();
      $kogs = array();
      $status = strtolower('waiting');

      $kog['id'] = $input_var['id'];
      $kog['tahun'] = $input_var['tahun'];
      $kog['id_detailer'] = $input_var['id_detailer'];
      $kog['tanggal'] = $input_var['tanggal'];
      $kog['id_distributor'] = $input_var['id_distributor'];
      $kog['id_rm'] = $input_var['id_rm'];
      $kog['id_direktur'] = $input_var['id_direktur'];
      $kog['tgl_spv'] = $input_var['tgl_spv'];
      $kog['tgl_rm'] = $input_var['tgl_rm'];
      $kog['tgl_direktur'] = $input_var['tgl_direktur'];
      $kog['status'] = $status;
      $kog['subdist'] = $input_var['subdist'];
      $this->kog->store($kog);
      
      foreach ($input_var['id_outlet'] as $key => $value) {
        $kogd['id_ko'] = $input_var['id'];
        $kogd['id_outlet'] = $input_var['id_outlet'][$key];
        $kogd['id_produk'] = $input_var['id_produk'][$key];
        $kogd['jumlah'] = $input_var['jumlah'][$key];
        $kogd['on_diskon_distributor'] = $input_var['on_diskon_distributor'][$key];
        $kogd['on_nf'] = $input_var['on_nf'][$key];
        $kogd['on_total'] = $input_var['on_total'][$key];
        $kogd['off_diskon_distributor'] = $input_var['off_diskon_distributor'][$key];
        $kogd['off_nf'] = $input_var['off_nf'][$key];
        $kogd['off_total'] = $input_var['off_total'][$key];
        $kogd['keterangan'] = $input_var['keterangan'][$key];
        $kogd['klaim'] = $input_var['klaim'][$key];
        $this->kogd->store($kogd);
      }
      
      $kogo['id_ko'] = $input_var['id'];
      $kogo['cn'] = $input_var['cn'];
      $kogo['diskon'] = $input_var['diskon'];
      $this->kogo->store($kogo);

      $kogot['id_ko'] = $input_var['id'];
      $kogot['total'] = $input_var['total'];
      $this->kogot->store($kogot);

      $kogs['id_ko'] = $input_var['id'];
      $kogs['tanggal'] = date('Y-m-d H:i:s');
      $kogs['status'] = $status;
      $kogs['id_rilis'] = $input_var['id_rilis'];
      $this->kogs->store($kogs);

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