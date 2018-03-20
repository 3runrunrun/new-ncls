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
    $data['operasional'] = $this->Operasional->get_data('a.id, UPPER(b.nama) as nama, id_detailer, tanggal, city, allowance, tol_parkir, bensin, comm, entertainment, medcare, other, total');
    $data['detailer'] = $this->Detailer->get_data('id, UPPER(nama) as nama');

    if ($data['operasional']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['operasional']['data']);
    }
    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/operasional', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }
  public function cetak($id)
  {
    $data['operasional'] = $this->Operasional->show_data($id,'a.id, UPPER(c.nama_area) as nama_area, UPPER(b.nama) as nama, id_detailer, tanggal,  city, allowance, tol_parkir, bensin, comm, entertainment, medcare, other, total');
    $data['detailer'] = $this->Detailer->get_data('id, UPPER(nama) as nama');
    $data['maxtgl'] = $this->Operasional->show_data($id,'max(tanggal) as tgl_max, min(tanggal) as tgl_min, sum(city) as city,sum(allowance) as allowance, sum(tol_parkir) as tol_parkir, sum(bensin) as bensin, sum(comm) as comm, sum(entertainment) as entertainment, sum(medcare) as medcare, sum(other) as other, sum(total) as total');
    $data['nomer'] = $this->nsu->letter_number_generator('wpi',4);

    if ($data['operasional']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['operasional']['data']);
    }
    $this->load->view('contents/master/cetak-operasional', $data);
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