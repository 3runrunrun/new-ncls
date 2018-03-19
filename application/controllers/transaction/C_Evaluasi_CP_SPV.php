<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Evaluasi_CP_SPV extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['call_plan'] = $this->Call_Plan->get_data();
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/call-plan/spv/target', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function evaluasi()
  {
    $data['call_plan'] = $this->Call_Plan->get_data();

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/call-plan/spv/evaluasi', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function store($operation = null)
  {
    $this->db->trans_begin();
    if ($operation == 'edit') {
      # code...
    } elseif ($operation == 'delete') {
      # code...
    } elseif ($operation == 'frekuensi') {
      $input_var = $this->input->post();
      $input_var['tanggal'] = date('Y-m-d');

      $this->save_frekuensi($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan Frekuensi Target Call Plan <strong>gagal</strong>.');
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Frekuensi Target Call Plan <strong>berhasil</strong> disimpan.');
      }
      redirect('/evaluasi-call-plan');
    } else {
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->digit_id_generator(4, 'cp');
      $input_var['tahun'] = date('Y');
      $input_var['tanggal'] = date('Y-m-d');

      $this->save_cp($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan Target Call Plan <strong>gagal</strong>.');
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Target Call Plan <strong>berhasil</strong> disimpan.');
      }
    }
    

    redirect('/target-call-plan');
  }

  private function save_cp($data = array())
  {
    $val['id'] = $data['id'];
    $val['tahun'] = $data['tahun'];
    $val['tanggal'] = $data['tanggal'];
    $val['id_detailer'] = $data['id_detailer'];
    $val['id_spv'] = $data['id_spv'];
    $val['id_rm'] = $data['id_rm'];
    $val['nama'] = $data['nama'];
    $val['spesialis'] = $data['spesialis'];
    $val['target'] = $data['target'];
    $this->Call_Plan->store($val);
  }

  private function save_frekuensi($data = array())
  {
    $val['id_call_plan'] = $data['id_call_plan'];
    $val['tanggal'] = $data['tanggal'];
    $val['kunjungan'] = $data['kunjungan'];
    $this->Call_Plan_Masuk->store($val);
  }

}