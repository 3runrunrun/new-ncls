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
    $data['subdistributor'] = $this->Subdist->get_data('a.id, UPPER(a.nama) as nama_subdist, UPPER(b.alias_area) as alias_area, UPPER(b.nama) as nama_area');
    $data['area'] = $this->Area->get_data('id, UPPER(nama) as nama, UPPER(alias_area) as alias_area');
    $data['user'] = $this->User->get_data('id, UPPER(alias_area) as alias_area, UPPER(nama) as nama, UPPER(jenis) as jenis');
    $data['produk'] = $this->Produk->get_produk_harga('id, UPPER(nama) as nama, UPPER(kemasan) as kemasan, harga_master, harga_hna');
    $data['id_subdist'] = $this->nsu->digit_id_generator(4,'sd');
    $data['id_sks'] = $this->nsu->digit_id_generator(4,'sks');
    $data['id_sns'] = $this->nsu->digit_id_generator(4,'sns');

    if ($data['subdistributor']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['subdistributor']['data']);
    }

    // var_dump($data['subdistributor']['data']->result());

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/subdist', $data);
    $this->load->view('footers/footer-js-form-simple-table');
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
      $input_var['id'] = $this->session->userdata('id_subdist');
      
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
      $input_var['id'] = $this->session->userdata('id_sks');
      $input_var['tahun'] = date('Y');
      $input_var['tanggal'] = date('Y-m-d');
      
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
      $input_var['id'] = $this->session->userdata('id_sns');
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