<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Fixed_Cost_Ratio extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['performa'] = $this->Achievement->get_data();

    $data['promosi'] = $this->Fixed_Cost->get_promosi();
    $data['cogm'] = $this->Fixed_Cost->get_cogm();
    $data['operasional'] = $this->Fixed_Cost->get_operasional();

    // diagram
    $data['sales_person'] = $this->M_Dashboard->sales_person('count(id) as jml');

    $this->load->view('heads/head-simple-form-table-chart');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/fixed-cost/fixed-cost', $data);
    $this->load->view('footers/footer-js-simple-form-table-chart');
  }

  public function show($id)
  {
    $data['detail'] = $this->Detailer->show($id);
    $data['produk'] = $this->Achievement->show_produk($id, 'a.id_outlet, c.nama_outlet, a.id_produk, d.nama as nama_produk, a.nominal_target, a.nominal_jumlah, nominal_jumlah_januari, nominal_jumlah_februari, nominal_jumlah_maret, nominal_jumlah_april, nominal_jumlah_mei, nominal_jumlah_juni, nominal_jumlah_juli, nominal_jumlah_agustus, nominal_jumlah_september, nominal_jumlah_oktober, nominal_jumlah_november, nominal_jumlah_desember');
    $this->load->view('heads/head-form-table-print');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/fixed-cost/detail', $data);
    $this->load->view('footers/footer-js-form-table-print');
  }

}