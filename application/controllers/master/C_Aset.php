<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Aset extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['aset'] = $this->Aset->get_data();

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/aset', $data);
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
      $data = $this->Aset->get_all();
      $rows = $data['data']->num_rows();
      $id = 'as' . $this->nsu->zerofill_generator(5, $rows);

      $input_var = $this->input->post();
      $input_var['id'] = $id;
      $input_var['tahun'] = date('Y');
      
      $this->save_aset($input_var);
      $this->save_aset_penyusutan($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to save new asset.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'New asset has been <strong>saved</strong>.');
      }
    }

    redirect('/master-aset');
  }

  private function save_aset($data = array())
  {
    $val['id'] = $data['id'];
    $val['tahun'] = $data['tahun'];
    $val['nama'] = $data['nama'];
    $val['tanggal'] = $data['tanggal'];
    $val['nominal'] = $data['nominal'];
    $this->Aset->store($val);
  }
  private function save_aset_penyusutan($data = array())
  {
    $val['id_aset'] = $data['id'];
    $val['penyusutan'] = $data['penyusutan'];
    $this->Aset_Penyusutan->store($val);
  }

}