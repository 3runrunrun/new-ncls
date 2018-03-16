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
    $data['bsn'] = $this->bsn->get_data('a.id_produk, UPPER(b.nama) as nama_produk, UPPER(b.kemasan) as kemasan, a.stok');
    $data['wait'] = $this->ppn->get_waiting();
    $data['deliv'] = $this->ppn->get_delivered();
    $data['produk'] = $this->Produk->get_produk_harga();

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/stok-nucleus/stok-produk', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show($id, $approve = null)
  {
    $data['produk'] = $this->ppnd->show($id);
    $data['detail'] = $this->ppn->show($id);

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/stok-nucleus/detail-produk', $data);
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
      $input_var['tanggal'] = date('Y-m-d');

      $this->update_pmhd($input_var);
      $this->save_pmhs($input_var);
      $this->save_barang_masuk($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Approval permohonan barang <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Approval permohonan barang <strong>berhasil</strong> disimpan.');
      }
    } else {
      $status = strtolower('waiting');
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->digit_id_generator(4,'pmhn');
      $input_var['tahun'] = date('Y');
      $input_var['status'] = $status;

      $this->save_pmh($input_var);
      $this->save_pmhd($input_var);
      $this->save_pmhs($input_var);
      
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

  public function print($id)
  {
    $data['produk'] = $this->ppnd->show($id);
    $data['detail'] = $this->ppn->show($id);

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/stok-nucleus/detail-produk', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  /**
   |
   | Private function
   |
   */

  private function save_pmh($data = array())
  {
    $val['id'] = $data['id'];
    $val['tahun'] = $data['tahun'];
    $val['tanggal'] = $data['tanggal'];
    $val['tanggal_target'] = $data['tanggal_target'];
    $val['status'] = $data['status'];
    $this->ppn->store($val);
  }

  private function save_pmhd($data = array())
  {
    foreach ($data['id_produk'] as $key => $value) {
      $val['id_permohonan'] = $data['id'];
      $val['id_produk'] = $value;
      $val['jumlah'] = $data['jumlah'][$key];
      $this->ppnd->store($val);
    }
  }

  private function save_pmhs($data = array())
  {
    $val['id_permohonan'] = $data['id'];
    $val['tanggal'] = $data['tanggal'];
    $val['status'] = $data['status'];
    $this->ppns->store($val);
  }

  private function update_pmhd($data = array())
  {
    foreach ($data['id_produk'] as $key => $value) {
      $val['batch_number'] = $data['batch_number'][$key];
      $val['expired'] = $data['expired'][$key];
      $this->ppnd->update($data['id'], $value, $val);
    }
  }

  private function save_barang_masuk($data = array())
  {
    foreach ($data['id_produk'] as $key => $value) {
      $val['id_produk'] = $value;
      $val['tahun'] = date('Y');
      $val['tanggal'] = $data['tanggal'];
      $val['jumlah'] = $data['jumlah'][$key];
      $this->bmn->store($val);
    }
  }

}