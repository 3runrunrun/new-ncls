<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Customer_non extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data_cust = $this->Customer_Non->get_all();
    $rows = $data_cust['data']->num_rows();
    $id = 'cstn' . $this->nsu->zerofill_generator(7, $rows);

    $data['customer'] = $this->Customer_Non->get_data('id, UPPER(alias_area) AS alias_area, UPPER(nama_area) AS nama_area, UPPER(nama) AS nama, UPPER(jenis) AS jenis, UPPER(id_outlet) AS id_outlet, UPPER(nama_outlet) AS nama_outlet, UPPER(nama_rm) AS nama_rm');
    $data['outlet'] = $this->Outlet->get_outlet_aktif('id, UPPER(jenis) as jenis, UPPER(alias_area) as alias_area, UPPER(nama_outlet) as nama_outlet');
    $data['area'] = $this->Area->get_data('id, UPPER(nama) as nama, UPPER(alias_area) as alias_area');
    $data['rm'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['id'] = $id;

    if ($data['customer']['status'] == 'error') {
      $this->session->set_flashdata('query_msg', $data['customer']['data']);
    }

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/customer-non', $data);
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
      $input_var['id'] = $this->session->userdata('id_customer_non');
      $input_var['tanggal'] = date('Y-m-d');
      
      $this->Customer_Non->store($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to save customer (non).');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Customer (non) has been <strong>saved</strong>.');
      }
      $this->session->unset_userdata('id_customer_non');
    }
    redirect('/master-customer-non');
  }

}