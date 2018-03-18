<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Pros_Marketing_Act extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['pma'] = $this->Pma->get_data();
    $data['area'] = $this->Area->get_data('id, UPPER(nama) as nama, UPPER(alias_area) as alias_area');
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/pma/pma', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function store($operation = null)
  {
    $this->db->trans_begin();
    if ($operation == 'edit') {
      # code...
    } elseif ($operation == 'delete') {
      # code...
    } elseif ($operation == 'approve') {
      # code...
    } else {
      $status = strtolower('waiting');
      $input_var = $this->input->post();
      $input_var['id'] = $this->nsu->digit_id_generator(4, 'pma');
      $input_var['tahun'] = date('Y');
      $input_var['status'] = $status;
      $input_var['sampai'] = $this->nsu->add_date_by_days($input_var['dari'], $input_var['durasi']);

      $this->save_pma($input_var);
      $this->save_pmas($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan Prospect Marketing Activity <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Prospect Marketing Activity <strong>berhasil</strong> disimpan.');
      }
    }
    
    redirect('/pma');
  }

  public function store_expense()
  {
    $this->db->trans_begin();

    $input_var = $this->input->post();
    $this->save_pmad($input_var);
    $this->update_pma($input_var);

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $this->session->set_flashdata('error_msg', 'Penambahan expense planning <strong>gagal</strong>.');
    } else {
      // $this->db->trans_rollback();
      $this->db->trans_commit();
      $this->session->set_flashdata('success_msg', 'Expense planning <strong>berhasil</strong> disimpan.');
    }
    redirect('/pma');
  }

  // pma
  private function save_pma($data = array())
  {
    $val['id'] = $data['id'];
    $val['tahun'] = $data['tahun'];
    $val['nama'] = $data['nama'];
    $val['id_area'] = $data['id_area'];
    $val['kota'] = $data['kota'];
    $val['dari'] = $data['dari'];
    $val['sampai'] = $data['sampai'];
    $val['durasi'] = $data['durasi'];
    $val['id_detailer'] = $data['id_detailer'];
    $val['keterangan'] = $data['keterangan'];
    $val['status'] = $data['status'];
    $this->Pma->store($val);
  }

  private function save_pmad($data = array())
  {
    $val['id_pma'] = $data['id'];
    $val['city'] = $data['city'];
    $val['allowance'] = $data['allowance'];
    $val['tol_parkir'] = $data['tol_parkir'];
    $val['bensin'] = $data['bensin'];
    $val['comm'] = $data['comm'];
    $val['entertainment'] = $data['entertainment'];
    $val['medcare'] = $data['medcare'];
    $val['total'] = $data['total'];
    $val['potongan_ca'] = $data['potongan_ca'];
    $this->Pma_Detail->store($val);
  }

  private function save_pmas($data = array())
  {
    $val['id_pma'] = $data['id'];
    $val['tanggal'] = date('Y-m-d H:i:s');
    $val['status'] = $data['status'];
    $this->Pma_Status->store($val);
  }
  // end of pma
  
  // edit pma
  private function update_pma($data = array())
  {
    $val['total'] = $data['total'];
    $this->Pma->update($data['id'], $val);
  }
  // end of edit pma
  

}