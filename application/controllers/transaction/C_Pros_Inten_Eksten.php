<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Pros_Inten_Eksten extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['ekstensifikasi'] = $this->eks->get_target_eksten('a.id, a.id_detailer, UPPER(e.alias_area) as alias_area, UPPER(e.nama) as nama_area, UPPER(f.nama) as nama_detailer, UPPER(c.nama) as nama_outlet, UPPER(d.nama) as nama_customer, a.id_produk, UPPER(g.nama) as nama_produk,  a.target');
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['outlet'] = $this->Outlet->get_outlet_aktif('id, UPPER(alias_area) as alias_area, UPPER(nama_outlet) as nama_outlet');
    $data['customer'] = $this->User->get_data('id, UPPER(alias_area) as alias_area, UPPER(nama) as nama, UPPER(jenis) as jenis');
    $data['produk'] = $this->Produk->get_produk_harga('id, UPPER(nama) as nama');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/ineks/eksten', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show($id)
  {
    $data['log_eksten'] = $this->eks->get_log_eksten($id);

    $this->load->view('heads/head-form-table-print');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/ineks/detail', $data);
    $this->load->view('footers/footer-js-form-table-print');
  }

  public function store_eksten($operation = null)
  {
    $this->db->trans_begin();
    if ($operation == 'edit') {
      # code...
    } elseif ($operation == 'delete') {
      # code...
    } else {
      $data = $this->eks->get_all();
      $rows = $data['data']->num_rows();
      $id = 'dks' . $this->nsu->zerofill_generator(7, $rows);

      $input_var = $this->input->post();
      $input_var['id'] = $id;

      $this->save_ekstensifikasi($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to save extensification or intensification.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Extensification or intensification has been <strong>saved</strong>.');
      }
      $this->session->unset_userdata('id_eksten');
    }
    
    redirect('/prospek-ineks');
  }

  private function save_ekstensifikasi($data = array())
  {
    foreach ($data['id_outlet'] as $key => $value) {
      $val['id'] = $data['id'];
      $val['tahun'] = date('Y');
      $val['tanggal'] = $data['tanggal'];
      $val['id_detailer'] = $data['id_detailer'];
      $val['id_outlet'] = $value;
      $val['id_customer'] = $data['id_customer'][$key];
      $val['pertemuan'] = $data['pertemuan'][$key];
      $val['dana'] = $data['dana'][$key];
      $val['biaya'] = $data['biaya'][$key];
      $val['id_produk'] = $data['id_produk'][$key];
      $val['target'] = $data['target'][$key];
      $this->eks->store($val);
    }
  }

  public function show_intens($id)
  {
    $data['eksten'] = $this->eks->show_eksten($id);

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/ineks/intens', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function store_intens($operation = null)
  {
    $this->db->trans_begin();
    if ($operation == 'edit') {
      # code...
    } elseif ($operation == 'delete') {
      # code...
    } else {
      $data = $this->ins->get_all();
      $rows = $data['data']->num_rows();
      $id = 'dns' . $this->nsu->zerofill_generator(7, $rows);

      $input_var = $this->input->post();
      $input_var['id'] = $id;
      $this->save_intens($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to save Detailer intensification.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Detailer intensification has been <strong>saved</strong>.');
      }
      $this->session->unset_userdata('id_eksten');
    }
    
    redirect('/prospek-ineks');
  }

  private function save_intens($data = array())
  {
    $val['id'] = $data['id'];
    $val['tahun'] = date('Y');
    $val['id_eksten'] = $data['id_eksten'];
    $val['tanggal'] = $data['tanggal'];
    $val['pertemuan'] = $data['pertemuan'];
    $val['dana'] = $data['dana'];
    $val['biaya'] = $data['biaya'];
    $val['target'] = $data['target'];
    $this->ins->store($val);
  }

}