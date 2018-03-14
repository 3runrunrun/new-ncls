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
    $data['promo_trial_wait'] = $this->pt->get_waiting('a.id, a.no_promo, UPPER(alias_area) as alias_area, UPPER(nama_area) as nama_area, UPPER(b.nama) as detailer, UPPER(c.nama) as user, a.status');
    $data['promo_trial_appr'] = $this->pt->get_approved('a.id, a.no_promo, UPPER(alias_area) as alias_area, UPPER(nama_area) as nama_area, UPPER(b.nama) as detailer, UPPER(c.nama) as user, a.status');
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['user'] = $this->User->get_data('id, UPPER(alias_area) as alias_area, UPPER(nama) as nama, UPPER(jenis) as jenis');
    $data['produk'] = $this->Produk->get_produk_harga('id, UPPER(nama) as nama');
    $data['id'] = 'fpt-hl-' . date('d-Y');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/promo-trial/promo', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show($id, $approve = null)
  {
    $data['produk'] = $this->ptd->show($id);
    $data['detail'] = $this->pt->show($id, 'a.id, a.no_promo, UPPER(b.nama) as nama_detailer, UPPER(c.nama) as nama_customer, a.keterangan, a.status');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/promo-trial/detail-promo', $data);
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
      $input_var = $this->input->post();
      $input_var['no_promo'] = $this->session->userdata('no_promo');
      $input_var['id_promo'] = $this->session->userdata('id_promo');
      $input_var['tanggal'] = date('Y-m-d H:i:s');
      $this->save_approval($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Approval promo trial <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Approval promo trial <strong>berhasil</strong> disimpan.');
      }
      $this->session->unset_userdata('no_promo');
      $this->session->unset_userdata('id_promo');
    } else {
      $status = strtolower('waiting');
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->digit_id_generator(4,'prt');
      $input_var['no_promo'] = $this->session->userdata('no_promo');
      $input_var['tanggal'] = date('Y-m-d');
      $input_var['tahun'] = date('Y');
      $input_var['status'] = $status;

      $this->save_pt($input_var);
      $this->save_ptd($input_var);
      $this->save_pts($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data promo trial <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data promo trial <strong>berhasil</strong> disimpan.');
      }
      $this->session->unset_userdata('no_promo');
    }
   
   redirect('/promo-trial'); 
  }

  private function save_pt($data = array())
  {
    $val['id'] = $data['id'];
    $val['no_promo'] = $data['no_promo'];
    $val['tahun'] = $data['tahun'];
    $val['id_detailer'] = $data['id_detailer'];
    $val['tanggal'] = $data['tanggal'];
    $val['id_customer'] = $data['id_customer'];
    $val['keterangan'] = $data['keterangan'];
    $val['status'] = $data['status'];
    $this->pt->store($val);
  }
  private function save_ptd($data = array())
  {
    foreach ($data['id_produk'] as $key => $value) {
      $val['id_promo'] = $data['id'];
      $val['no_promo'] = $data['no_promo'];
      $val['id_produk'] = $data['id_produk'][$key];
      $val['jumlah'] = $data['jumlah'][$key];
      $this->ptd->store($val);
    }
  }
  private function save_pts($data = array())
  {
    $val['id_promo'] = $data['id'];
    $val['no_promo'] = $data['no_promo'];
    $val['status'] = $data['status'];
    $val['tanggal'] = date('Y-m-d H:i:s');
    $this->pts->store($val);
  }

  public function save_approval($data = array())
  {
    $val['id_promo'] = $data['id_promo'];
    $val['no_promo'] = $data['no_promo'];
    $val['status'] = $data['status'];
    $val['tanggal'] = date('Y-m-d H:i:s');
    $this->pts->store($val);
  }

}