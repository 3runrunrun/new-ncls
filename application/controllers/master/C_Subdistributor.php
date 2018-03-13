<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Subdistributor extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['subdistributor'] = $this->Subdist->get_data('a.id, a.nama as subdist, b.nama as area');
    $row = $data['subdistributor']['data']->num_rows();
    $data['id'] = $this->nsu->zerofill_generator(3, $row);

    if ($data['subdistributor']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['subdistributor']['data']);
    }

    var_dump($data['subdistributor']['data']->result());

    // $this->load->view('heads/head-form-simple-table');
    // $this->load->view('navbar');
    // $this->load->view('contents/master/operasional', $data);
    // $this->load->view('footers/footer-js-form-simple-table');
  }

  public function storeSubdist($operation = null)
  {
    $this->db->trans_begin();
    if ($operation == 'edit') {
      # code...
    } elseif ($operation == 'delete') {
      # code...
    } else {
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->digit_id_generator(4,'sd');
      
      $this->Subdist->store($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data sub distributor <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data sub distributor baru <strong>berhasil</strong> disimpan.');
      }
    }
    redirect('/master-subdistributor');
  }

  public function storeSubdistEkstern($operation = null)
  {
    $this->db->trans_begin();
    if ($operation == 'edit') {
      # code...
    } elseif ($operation == 'delete') {
      # code...
    } else {
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->digit_id_generator(4,'sks');
      $input_var['tahun'] = date('Y');
      
      $this->subeks->store($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data sub distributor ekstern <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data sub distributor ekstern baru <strong>berhasil</strong> disimpan.');
      }
    }
    redirect('/master-subdistributor');
  }

  public function storeSubdistIntern($operation = null)
  {
    $this->db->trans_begin();
    if ($operation == 'edit') {
      # code...
    } elseif ($operation == 'delete') {
      # code...
    } else {
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->digit_id_generator(4,'sns');
      $input_var['tahun'] = date('Y');
      
      $this->subins->store($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data sub distributor intern <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data sub distributor intern baru <strong>berhasil</strong> disimpan.');
      }
    }
    redirect('/master-subdistributor');
  }

}