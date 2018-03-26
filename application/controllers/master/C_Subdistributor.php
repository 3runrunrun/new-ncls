<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Subdistributor extends CI_Controller {

  // ngikut tabel
  private $jenis_subdist = 10;

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    // eks
    $data_eks = $this->subeks->get_all();
    $rows = $data_eks['data']->num_rows();
    $id_sks = 'sks' . $this->nsu->zerofill_generator(7, $rows);

    // ins
    $data_ins = $this->subins->get_all();
    $rows = $data_ins['data']->num_rows();
    $id_sns = 'sns' . $this->nsu->zerofill_generator(7, $rows);

    $data['subdistributor'] = $this->Subdist->get_data('a.id, UPPER(a.nama) as nama_subdist, UPPER(b.alias_area) as alias_area, UPPER(b.nama) as nama_area');
    $data['jenis'] = $this->Master_Distributor->get_data_no_subdist('id, UPPER(nama) as nama, UPPER(alias_distributor) as alias_distributor');
    $data['area'] = $this->Area->get_data('id, UPPER(nama) as nama, UPPER(alias_area) as alias_area');
    $data['user'] = $this->User->get_data('id, UPPER(alias_area) as alias_area, UPPER(nama) as nama, UPPER(jenis) as jenis');
    $data['produk'] = $this->Produk->get_produk_harga('id, UPPER(nama) as nama, UPPER(kemasan) as kemasan, harga_master, harga_hna');
    $data['id_sks'] = $id_sks;
    $data['id_sns'] = $id_sns;

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
      $input_var['subdist'] = strtolower('y');
      $input_var['id_master'] = $this->jenis_subdist;
      
      $this->save_dist($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to save subdistributor.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'New subdistributor is <strong>saved</strong>.');
      }
    }
    redirect('/master-subdistributor');
  }

  private function save_dist($data = array())
  {
    $val['id_master'] = $data['id_master'];
    $val['id_area'] = $data['id_area'];
    $val['nama'] = $data['nama'];
    $val['subdist'] = $data['subdist'];
    $this->Distributor->store($val);
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
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to save the subdistributor\'s target.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Subdistributor\'s target is <strong>saved</strong>.');
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