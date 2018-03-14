<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_WPR extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    
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
      $input_var['id'] = $this->nsu->digit_id_generator(4,'wpr');
      $input_var['no_wpr'] = $input_var['prefix_wpr'].'-PFT-HL-'.date('d').'-'.date('Y');
      $input_var['tahun'] = date('Y');

      $wpr = array();
      $wpr_detail = array();
      $wpr_status = array();
      $status = strtolower('waiting');

      $wpr['id'] = $input_var['id'];
      $wpr['no_wpr'] = $input_var['no_wpr'];
      $wpr['tahun'] = $input_var['tahun'];
      $wpr['id_detailer'] = $input_var['id_detailer'];
      $wpr['id_spv'] = $input_var['id_spv'];
      $wpr['keterangan'] = $input_var['keterangan'];
      $wpr['status'] = $status;
      $this->Wpr->store($wpr);
      
      foreach ($input_var['id_user'] as $key => $value) {
        $wpr_detail['id_wpr'] = $input_var['id'];
        $wpr_detail['id_user'] = $input_var['id_user'][$key];
        $wpr_detail['bank'] = $input_var['bank'][$key];
        $wpr_detail['norek'] = $input_var['norek'][$key];
        $wpr_detail['atas_nama'] = $input_var['atas_nama'][$key];
        $wpr_detail['dari'] = $input_var['dari'][$key];
        $wpr_detail['sampai'] = $input_var['sampai'][$key];
        $wpr_detail['dana'] = $input_var['dana'][$key];
        $this->Wpr_Detail->store($wpr_detail);
      }
      
      $wpr_status['id_wpr'] = $input_var['id'];
      $wpr_status['id_approver'] = $input_var['id_approver'];
      $wpr_status['tanggal'] = date('Y-m-d H:i:s');
      $wpr_status['status'] = $status;
      $this->Wpr_Status->store($wpr_status);

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