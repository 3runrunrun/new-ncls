<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Operasional extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['operasional'] = $this->Operasional->get_data('a.id, tanggal, city, allowance, tol_parkir, bensin, comm, entertainment, medcare, other, total');
    $data['detailer'] = $this->Detailer->get_data('id, UPPER(nama) as nama');

    if ($data['operasional']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['operasional']['data']);
    }

    // var_dump($data['operasional']['data']->result());

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/operasional', $data);
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
      $input_var['id'] = $this->nsu->digit_id_generator(4,'op');
      $input_var['tahun'] = date('Y');
      
      $this->Operasional->store($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data operasional <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data operasional baru <strong>berhasil</strong> disimpan.');
      }
    }
    redirect('/master-operasional');
  }


}