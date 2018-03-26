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
    $data_pr = $this->Produk->get_all();
    $rows = $data_pr['data']->num_rows();
    $id = 'pr' . $this->nsu->zerofill_generator(5, $rows);

    $data['produk'] = $this->Produk->get_data('id, UPPER(nama_produk) as nama_produk, UPPER(kemasan) as kemasan, UPPER(jenis) as jenis, harga_master, harga_hna');
    $data['jenis'] = $this->Master_Jenis_Produk->get_data('id, UPPER(nama) as nama');
    $data['area'] = $this->Area->get_data('id, UPPER(nama) as nama, UPPER(alias_area) as alias_area');
    $data['id'] = $id;

    if ($data['produk']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['produk']['data']);
    }

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
      $input_var['id'] = $this->session->userdata('id_produk');
      $input_var['tanggal'] = date('Y-m-d');
      
      $this->save_produk($input_var);
      $this->save_harga($input_var);
      $this->save_jenis($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to save product.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Product has been <strong>saved</strong>.');
      }
      $this->session->unset_userdata('id_produk');
    }
    redirect('/master-product');
  }

  private function save_produk($data = array())
  {
    $val['id'] = $data['id'];
    $val['nama'] = $data['nama'];
    $val['kemasan'] = $data['kemasan'];
    $val['keterangan'] = $data['keterangan'];
    $this->Produk->store($val);
  }

  private function save_harga($data = array())
  {
    $val['id_produk'] = $data['id'];
    $val['tanggal'] = $data['tanggal'];
    $val['harga_master'] = $data['harga_master'];
    $val['harga_hna'] = $data['harga_hna'];
    $this->Produk_Harga->store($val);
  }

  private function save_jenis($data = array())
  {
    $val['id_produk'] = $data['id'];
    $val['id_jenis'] = $data['id_jenis'];
    $this->Produk_Jenis->store($val);
    /*foreach ($data['id_jenis'] as $key => $value) {
      $val['id_produk'] = $data['id'];
      $val['id_jenis'] = $value;
      $this->Produk_Jenis->store($val);
    }*/
  }

}