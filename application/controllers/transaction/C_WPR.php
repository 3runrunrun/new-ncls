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
    $data['promo_trial_wait'] = $this->pt->get_waiting('a.id, a.no_promo, UPPER(alias_area) as alias_area, UPPER(nama_area) as nama_area, UPPER(b.nama) as detailer, UPPER(c.nama) as user, a.status');
    $data['promo_trial_appr'] = $this->pt->get_approved('a.id, a.no_promo, UPPER(alias_area) as alias_area, UPPER(nama_area) as nama_area, UPPER(b.nama) as detailer, UPPER(c.nama) as user, a.status');
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['user'] = $this->User->get_data('id, UPPER(alias_area) as alias_area, UPPER(nama) as nama, UPPER(jenis) as jenis');
    $data['produk'] = $this->Produk->get_produk_harga('id, UPPER(nama) as nama');
    $data['id'] = 'fpt-hl-' . date('d-Y');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/wpr/wpr', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function store($operation = null)
  {
    $this->db->trans_begin();
    if ($operation == 'edit') {
      # code...
    } elseif ($operation == 'delete') {
      # code...
    } elseif ($operation == 'approve') {
      # code...
    } else {
      $input_var = $this->input->post();
      $status = strtolower('waiting');
      $no_wpr = $input_var['prefix_wpr'] . $input_var['suffix_wpr'];
      $input_var['id'] = $this->nsu->digit_id_generator(4,'wpr');
      $input_var['no_wpr'] = $no_wpr;
      $input_var['tahun'] = date('Y');
      $input_var['status'] = $status;
      unset($input_var['prefix_wpr']);
      unset($input_var['suffix_wpr']);
     
     $this->save_wpr($input_var);
     $this->save_wprd($input_var);
     $this->save_wprs($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan WPR <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'WPR <strong>berhasil</strong> disimpan.');
      }
    }
   
   redirect('/wpr'); 
  }  

  private function save_wpr($data = array())
  {
    $val['id'] = $data['id'];
    $val['no_wpr'] = $data['no_wpr'];
    $val['tahun'] = $data['tahun'];
    $val['id_detailer'] = $data['id_detailer'];
    $val['id_spv'] = $data['id_spv'];
    $val['id_direktur'] = $data['id_direktur'];
    $val['keterangan'] = $data['keterangan'];
    $val['status'] = $data['status'];
    $this->Wpr->store($val);
  }
  private function save_wprd($data = array())
  {
    $val['id_wpr'] = $data['id'];
    $val['id_user'] = $data['id_user'];
    $val['bank'] = $data['bank'];
    $val['norek'] = $data['norek'];
    $val['atas_nama'] = $data['atas_nama'];
    $val['dari'] = $data['dari'];
    $val['sampai'] = $data['sampai'];
    $val['dana'] = $data['dana'];
    $this->Wpr_Detail->store($val);
  }
  private function save_wprs($data = array())
  {
    $val['id_wpr'] = $data['id'];
    $val['id_approver'] = $data['id_direktur'];
    $val['tanggal'] = date('Y-m-d H:i:s');
    $val['status'] = $data['status'];
    $this->Wpr_Status->store($val);
  }
}