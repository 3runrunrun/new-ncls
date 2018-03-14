<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Customer extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['customer'] = $this->Customer->get_data('a.id, UPPER(b.alias_area) as alias_area, UPPER(b.nama) as nama_area, UPPER(a.nama) as nama, UPPER(a.spesialis) as spesialis, UPPER(a.lokasi_praktek) as lokasi_praktek, UPPER(c.nama) as nama_rm');
    $data['area'] = $this->Area->get_data('id, UPPER(nama) as nama, UPPER(alias_area) as alias_area');
    $data['rm'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['id'] = $this->nsu->digit_id_generator(4, 'cst');

    if ($data['customer']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['customer']['data']);
    }

    // var_dump($data['customer']['data']->result());

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/customer', $data);
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
      $input_var['id'] = $this->session->userdata('id_customer');
      $input_var['tanggal'] = date('Y-m-d');
      
      $this->Customer->store($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data customer <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data customer baru <strong>berhasil</strong> disimpan.');
      }
      $this->session->unset_userdata('id_customer');
    }
    redirect('/master-customer');
  }


}