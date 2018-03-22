<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Pemindahan_Sales extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['wait'] = $this->Pemindahan_Sales->get_waiting();
    $data['appr'] = $this->Pemindahan_Sales->get_approved();
    $data['produk'] = $this->Produk->get_produk_harga();
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['outlet'] = $this->Outlet->get_outlet_aktif('id, UPPER(alias_area) as alias_area, UPPER(nama_area) as nama_area, UPPER(nama_outlet) as nama_outlet, UPPER(kota) as kota, UPPER(nama_distributor) as nama_distributor, UPPER(alias_distributor) as alias_distributor, UPPER(nama_detailer) as nama_detailer, periode,UPPER(dispensing) as dispensing');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/pemindahan-sales/pemindahan-sales', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show($id, $approve = null)
  {
    $data['approve'] = $approve;
    $data['detail'] = $this->Pemindahan_Sales->show($id);
    $data['produk'] = $this->Pemindahan_Sales_Detail->show($id);
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/pemindahan-sales/detail', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function store($operation = null)
  {
    $this->db->trans_begin();

    if ($operation == 'delete') {
      # code...
    } elseif ($operation == 'edit') {
      # code...
    } elseif ($operation == 'approve') {
      $input_var = $this->input->post();

      $this->approve_ps($input_var);
      $this->update_tgl_ps($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Approval pemindahan sales <strong>gagal</strong>.');
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Approval pemindahan sales <strong>berhasil</strong> disimpan.');
      }
    } else {
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->letter_number_generator('ps');
      $input_var['tahun'] = date('Y');
      $input_var['status'] = strtolower('waiting');

      $this->save_ps($input_var);
      $this->save_psd($input_var);
      $this->save_pss($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Pemindahan sales <strong>gagal</strong>.');
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Pemindahan sales <strong>berhasil</strong> disimpan.');
      }
    }
    
    redirect('/pemindahan-sales');
  }

  private function save_ps($data = array())
  {
    $val['id'] = $data['id'];
    $val['tahun'] = $data['tahun'];
    $val['tanggal'] = $data['tanggal'];
    $val['periode'] = $data['periode'];
    $val['id_detailer_dari'] = $data['id_detailer_dari'];
    $val['id_spv_dari'] = $data['id_spv_dari'];
    $val['id_detailer_ke'] = $data['id_detailer_ke'];
    $val['id_spv_ke'] = $data['id_spv_ke'];
    $val['id_outlet_dari'] = $data['id_outlet_dari'];
    $val['id_outlet_ke'] = $data['id_outlet_ke'];
    $val['status'] = $data['status'];
    $this->Pemindahan_Sales->store($val);
  }

  private function save_psd($data = array())
  {
    foreach ($data['id_produk'] as $key => $value) {
      $val['id_pemindahan'] = $data['id'];
      $val['id_produk'] = $value;
      $val['jumlah'] = $data['jumlah'][$key];
      $this->Pemindahan_Sales_Detail->store($val);
    }
  }

  private function save_pss($data = array())
  {
    $val['id_pemindahan'] = $data['id'];
    $val['tanggal'] = date('Y-m-d H:i:s');
    $val['status'] = $data['status'];
    $this->Pemindahan_Sales_Status->store($val);
  }

  public function update_tgl_ps($data = array())
  {
    if ($data['status'] === 'spv') {
      $val['tgl_spv'] = date('Y-m-d');
      $this->Pemindahan_Sales->update($data['id'], $val);
    } elseif ($data['status'] === 'approved') {
      $val['tgl_rm'] = date('Y-m-d');
      $this->Pemindahan_Sales->update($data['id'], $val);
    }
  }

  private function approve_ps($data = array())
  {
    $val['id_pemindahan'] = $data['id'];
    $val['tanggal'] = date('Y-m-d H:i:s');
    $val['status'] = $data['status'];
    $val['id_approver'] = $data['id_approver'];
    $this->Pemindahan_Sales_Status->store($val);
  }

}