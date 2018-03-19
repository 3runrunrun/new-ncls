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
    $data['entry_breakdown'] = $this->Entry_Breakdown->get_general();
    $data['wpr'] = $this->Wpr_Detail->get_approved();
    $data['produk'] = $this->Produk->get_produk_harga('id, UPPER(nama) as nama, UPPER(kemasan) as kemasan, harga_master, harga_hna');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/entry-breakdown/general', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show_product()
  {
    $data['entry_breakdown'] = $this->Entry_Breakdown->get_per_product();
    $data['wpr'] = $this->Wpr_Detail->get_approved();
    $data['produk'] = $this->Produk->get_produk_harga('id, UPPER(nama) as nama, UPPER(kemasan) as kemasan, harga_master, harga_hna');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/entry-breakdown/per-product', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show($id)
  {
    $data['detail'] = $this->Entry_Breakdown->show_detail($id);
    $data['produk'] = $this->Entry_Breakdown->show_general($id);

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/entry-breakdown/detail-breakdown', $data);
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
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->letter_number_generator('slc');
      $input_var['tahun'] = date('Y');

      $this->save_salcust($input_var);
      $this->save_salcustd($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data penjualan sales med rep <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data penjualan sales med rep <strong>berhasil</strong> disimpan.');
      }
      if ($input_var['halaman'] === 'general') {
        redirect('/entry-breakdown-general'); 
      }
    }
   
   redirect('/entry-breakdown-product'); 
  }

  public function save_salcust($data = array())
  {
    $val['id'] = $data['id'];
    $val['tahun'] = $data['tahun'];
    $val['tanggal'] = $data['tanggal'];
    $val['id_wpr'] = $data['id_wpr'];
    $this->salcust->store($val);
  }

  public function save_salcustd($data = array())
  {
    foreach ($data['id_produk'] as $key => $value) {
      $val['id_sc'] = $data['id'];
      $val['id_produk'] = $value;
      $val['jumlah'] = $data['jumlah'][$key];
      $this->salcustd->store($val);
    }
  }

}