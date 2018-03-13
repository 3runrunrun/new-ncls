<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Produk extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['produk'] = $this->Produk->get_data('a.id, a.nama, a.kemasan, b.harga_hna, b.harga_master');
    $row = $data['produk']['data']->num_rows();
    $data['id'] = $this->nsu->zerofill_generator(3, $row);

    if ($data['produk']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['produk']['data']);
    }

    // var_dump($data['operasional']['data']->result());

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/produk', $data);
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
      $input_var['id'] = $this->nsu->digit_id_generator(4,'pr');
      $input_var['tanggal'] = date('Y-m-d');

      $produk = array();
      $produk_harga = array();
      $produk_jenis = array();

      $produk['id'] = $input_var['id'];
      $produk['nama'] = $input_var['nama'];
      $produk['kemasan'] = $input_var['kemasan'];
      $produk['keterangan'] = $input_var['keterangan'];

      $produk_harga['id_produk'] = $input_var['id'];
      $produk_harga['tanggal'] = $input_var['tanggal'];
      $produk_harga['harga_master'] = $input_var['harga_master'];
      $produk_harga['harga_hna'] = $input_var['harga_hna'];

      $produk_jenis['id_produk'] = $input_var['id'];
      $produk_jenis['id_jenis'] = $input_var['id_jenis'];
      
      $this->Operasional->store($produk);
      $this->Operasional->store($produk_harga);
      $this->Operasional->store($produk_jenis);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data produk <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data produk baru <strong>berhasil</strong> disimpan.');
      }
    }
    redirect('/master-operasional');
  }


}