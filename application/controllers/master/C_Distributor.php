<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Distributor extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['distributor'] = $this->Distributor->get_data('a.id, UPPER(a.nama) as nama_distributor, UPPER(b.alias_distributor) as jenis, UPPER(c.nama) as nama_area, UPPER(c.alias_area) as alias_area');
    $data['jenis'] = $this->Master_Distributor->get_data('id, UPPER(nama) as nama, UPPER(alias_distributor) as alias_distributor');
    $data['area'] = $this->Area->get_data('id, UPPER(nama) as nama, UPPER(alias_area) as alias_area');

    if ($data['distributor']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['distributor']['data']);
    }

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/distributor', $data);
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
      
      $this->Distributor->store($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data distributor <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data distributor baru <strong>berhasil</strong> disimpan.');
      }
    }
    
    
    redirect('/master-distributor');
  }

}