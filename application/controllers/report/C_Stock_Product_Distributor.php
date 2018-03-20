<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Stock_Product_Distributor extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['bsd'] = $this->bsd->get_data('id_area, UPPER(alias_area) as alias_area, UPPER(nama_area) as nama_area, UPPER(alias_distributor) as alias_distributor, UPPER(nama_distributor) as nama_distributor, id_produk, UPPER(nama_produk) as nama_produk, UPPER(kemasan) as kemasan, stok');
    $data['wait'] = $this->ppd->get_waiting('id, UPPER(alias_area) as alias_area, UPPER(nama_area) as nama_area, UPPER(alias_distributor) as alias_distributor, UPPER(nama_distributor) as nama_distributor, tanggal, status_permohonan');
    $data['deliv'] = $this->ppd->get_delivered('id, UPPER(alias_area) as alias_area, UPPER(nama_area) as nama_area, UPPER(alias_distributor) as alias_distributor, UPPER(nama_distributor) as nama_distributor, tanggal, status_permohonan');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/stok-distributor/stok-produk', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show($id, $approve = null)
  {
    $data['approve'] = $approve;
    $data['produk'] = $this->ppdd->show($id);
    $data['detail'] = $this->ppd->show($id);

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/stok-distributor/detail-produk', $data);
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

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Verifikasi permohonan barang <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Verifikasi permohonan barang <strong>berhasil</strong> disimpan.');
      }
    } else {
      # code
    }
   
   redirect('/stock-product-distributor'); 
  }

  private function save_pmhs($data = array())
  {
    $val['id_permohonan'] = $data['id'];
    $val['tanggal'] = $data['tanggal'];
    $val['status'] = $data['status'];
    $this->ppds->store($val);
  }

  private function update_pmhd($data = array())
  {
    foreach ($data['id_produk'] as $key => $value) {
      $val['batch_number'] = $data['batch_number'][$key];
      $val['expired'] = $data['expired'][$key];
      $this->ppdd->update($data['id'], $value, $val);
    }
  }

  public function cetak($id)
  {
    $data['produk'] = $this->ppdd->show($id);
    $data['detail'] = $this->ppd->show($id);
    $this->load->view('contents/report/stok-distributor/cetak',$data);
  }

}
