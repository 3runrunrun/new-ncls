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
    $data['operasional'] = $this->Operasional->get_data();
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(alias_area) as alias_area, UPPER(nama_detailer) as nama_detailer');

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
    $data['operasional'] = $this->Operasional->show_data($id,'a.id, UPPER(c.nama_area) as nama_area, UPPER(b.nama) as nama, id_detailer, dari, sampai,  city, allowance, tol_parkir, bensin, comm, entertainment, other, total');
    $data['detailer'] = $this->Detailer->get_data('id, UPPER(nama) as nama');
    $data['maxtgl'] = $this->Operasional->show_data($id,'max(dari) as tgl_max, min(dari) as tgl_min, sum(city) as city,sum(allowance) as allowance, sum(tol_parkir) as tol_parkir, sum(bensin) as bensin, sum(comm) as comm, sum(entertainment) as entertainment, sum(other) as other, sum(total) as total');
    $data['nomer'] = $this->nsu->letter_number_generator('wpi',4);

    if ($data['operasional']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['operasional']['data']);
    }
    $this->load->view('contents/master/cetak-operasional', $data);
  }

  public function get_ca()
  {
    $data['operasional'] = $this->Operasional->get_data();
    $data['wait'] = $this->Operasional->get_ca_waiting();
    $data['appr'] = $this->Operasional->get_ca_approved();
    $data['hutang'] = $this->Operasional->get_ca_hutang();
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(alias_area) as alias_area, UPPER(nama_detailer) as nama_detailer');

    if ($data['operasional']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['operasional']['data']);
    }
    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/operasional-ca', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show($id)
  {
    $data['operasional'] = $this->Operasional->show_ca($id);
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(alias_area) as alias_area, UPPER(nama_detailer) as nama_detailer');
    $data['id'] = $id;

    if ($data['operasional']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['operasional']['data']);
    }

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/operasional-ca-verifikasi', $data);
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
      $input_var = $this->input->post();
      $input_var['status_ca'] = strtolower('hutang');

      $this->save_sca($input_var);
      $redir = 'ca';
      
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to save CA approval.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'CA Approval has been <strong>saved</strong>.');
      }
    } elseif ($operation == 'report-ca') {
      $input_var = $this->input->post();
      $input_var['status'] = strtolower('approved');
      $input_var['status_ca'] = strtolower('reported');

      $this->update_ca($input_var);
      $this->save_sca($input_var);
      $redir = 'ca';
      
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to save CA approval.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'CA Approval has been <strong>saved</strong>.');
      }
    } else {
      $data = $this->Operasional->get_all();
      $rows = $data['data']->num_rows();
      $id = 'op' . $this->nsu->zerofill_generator(7, $rows);
      $status = strtolower('waiting');
      $status_ca = strtolower('hutang');

      $input_var = $this->input->post();
      $input_var['id'] = $id;
      $input_var['jenis'] = $operation;
      $input_var['bulan'] = date('m', strtotime($input_var['tanggal']));
      $input_var['tahun'] = date('Y');

      if ($operation == 'expense') {
        $this->save_expense($input_var);
        $redir = 'expenses';
      } elseif ($operation == 'ca') {
        $input_var['status'] = $status;
        $input_var['status_ca'] = $status_ca;
        $this->save_ca($input_var);
        $this->save_sca($input_var);
        $redir = 'ca';
      }
      
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to save operational cost submissions.');
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Operational cost submission has been <strong>saved</strong>.');
      }
    }
    redirect("/$redir");
  }

  private function save_expense($data = array())
  {
    $val['id'] = $data['id'];
    $val['jenis'] = $data['jenis'];
    $val['bulan'] = $data['bulan'];
    $val['tahun'] = $data['tahun'];
    $val['id_detailer'] = $data['id_detailer'];
    $val['dari'] = $data['dari'];
    $val['sampai'] = $data['sampai'];
    $val['city'] = $data['city'];
    $val['allowance'] = $data['allowance'];
    $val['tol_parkir'] = $data['tol_parkir'];
    $val['bensin'] = $data['bensin'];
    $val['comm'] = $data['comm'];
    $val['entertainment'] = $data['entertainment'];
    $val['other'] = $data['other'];
    $val['total'] = $data['total'];
    $this->Operasional->store($val);
  }

  private function save_ca($data = array())
  {
    $val['id'] = $data['id'];
    $val['jenis'] = $data['jenis'];
    $val['bulan'] = $data['bulan'];
    $val['tahun'] = $data['tahun'];
    $val['id_detailer'] = $data['id_detailer'];
    $val['dari'] = $data['dari'];
    $val['sampai'] = $data['sampai'];
    $val['total'] = $data['total'];
    $val['status'] = $data['status'];
    $val['status_ca'] = $data['status_ca'];
    $this->Operasional->store($val);
  }

  private function save_sca($data = array())
  {
    $val['id_operasional'] = (array_key_exists('id_operasional', $data) === true) ? $data['id_operasional'] : $data['id'] ;
    $val['tanggal'] = date('Y-m-d H:i:s');
    $val['status'] = $data['status'];
    $val['status_ca'] = $data['status_ca'];
    $val['id_approver'] = (array_key_exists('id_approver', $data) === true) ? $data['id_approver'] : NULL ;
    $this->Operasional_Status->store($val);
  }

  private function update_ca($data = array())
  {
    $val['city'] = $data['city'];
    $val['allowance'] = $data['allowance'];
    $val['tol_parkir'] = $data['tol_parkir'];
    $val['bensin'] = $data['bensin'];
    $val['comm'] = $data['comm'];
    $val['entertainment'] = $data['entertainment'];
    $val['other'] = $data['other'];
    $val['potongan_ca'] = $data['potongan_ca'];
    $this->Operasional->update($data['id'], $val);
  }

}