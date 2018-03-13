<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Cogm extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['jenis'] = $this->Master_Cogm->get_data('id, UPPER(nama) as nama');
    $data['cogm'] = $this->Cogm->get_data('a.id, b.nama as jenis, a.tanggal, a.biaya');

    if ($data['cogm']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['cogm']['data']);
    }

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/cogm', $data);
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
      
      $this->Area->store($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data COGM <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data COGM <strong>berhasil</strong> disimpan.');
      }
    }
    
    redirect('/master-cogm');
  }

  private function save_cogm($data = array())
  {
    $data['id'] = $this->nsu->digit_id_generator(4, 'co');
  }

}