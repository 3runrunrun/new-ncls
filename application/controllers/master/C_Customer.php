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
    $data['customer'] = $this->Customer->get_data('a.id, a.nama, a.spesialis, a.lokasi_praktek, c.nama');
    $row = $data['customer']['data']->num_rows();
    $data['id'] = $this->nsu->zerofill_generator(3, $row);

    if ($data['customer']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['outlet']['data']);
    }

    var_dump($data['customer']['data']->result());

    // $this->load->view('heads/head-form-simple-table');
    // $this->load->view('navbar');
    // $this->load->view('contents/master/operasional', $data);
    // $this->load->view('footers/footer-js-form-simple-table');
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
      $input_var['id'] = $this->nsu->time_id_generator('cst');
      
      $this->Customer->store($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data customer <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data customer baru <strong>berhasil</strong> disimpan.');
      }
    }
    redirect('/master-customer');
  }


}