<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Reward extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['wait'] = $this->Wpr->get_waiting('a.id, a.no_wpr, UPPER(f.alias_area) as alias_area, UPPER(f.nama_area) as nama_area, UPPER(b.nama) as detailer, UPPER(f.nama_user) as user, SUM(f.dana) as dana, a.status');
    $data['appr'] = $this->Wpr->get_approved('a.id, a.no_wpr, UPPER(f.alias_area) as alias_area, UPPER(f.nama_area) as nama_area, UPPER(b.nama) as detailer, UPPER(f.nama_user) as user, SUM(f.dana) as dana, a.status');
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['user'] = $this->User->get_data('id, UPPER(alias_area) as alias_area, UPPER(nama) as nama, UPPER(jenis) as jenis');
    $data['produk'] = $this->Produk->get_produk_harga('id, UPPER(nama) as nama');
    $data['id'] = 'fpt-hl-' . date('d-Y');

    $this->load->view('heads/head-form-table-print');
    // $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/reward/reward', $data);
    // $this->load->view('footers/footer-js-form-simple-table');
    $this->load->view('footers/footer-js-form-table-print');
  }

  public function store($operation = null)
  {
    # code...
  }

}