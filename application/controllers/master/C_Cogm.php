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
    $data['laporan'] = $this->Cogm->get_cogm();
    $data['laporan_tahun'] = $this->Cogm->get_cogm_year();
    $data['jenis'] = $this->Master_Cogm->get_data('id, UPPER(nama) as nama');
    $data['cogm'] = $this->Cogm->get_data();

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

      $this->save_cogm($input_var);
      
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to add COGM.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'COGM has been <strong>saved</strong>.');
      }
    }
    
    redirect('/master-cogm');
  }

  private function save_cogm($data = array())
  {
    foreach ($data['id_cogm'] as $key => $value) {
      $data_co = $this->Cogm->get_all();
      $rows = $data_co['data']->num_rows();
      $id = 'co' . $this->nsu->zerofill_generator(7, $rows);

      $val['id'] = $id;
      $val['id_cogm'] = $value;
      $val['tahun'] = date('Y');
      $val['tanggal'] = $data['tanggal'][$key];
      $val['biaya'] = $data['biaya'][$key];
      $this->Cogm->store($val);
    }
  }

}