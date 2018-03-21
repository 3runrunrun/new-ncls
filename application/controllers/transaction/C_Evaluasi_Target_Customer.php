<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Evaluasi_Target_Customer extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['achievement'] = $this->Achievement->get_data();
    $data['insentif'] = $this->Insentif->get_data('a.tahun, a.bulan, a.id_detailer, b.nama_detailer, a.id_outlet, c.nama_outlet, b.alias_area, b.nama_area, a.achievement, a.rupiah');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/evaluasi/evaluasi-target-customer', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  
  }

  public function show($id)
  {
    $data['detailer'] = $this->Detailer->show($id);
    $data['achievement_aktual'] = $this->Achievement->show_pertahun($id);
    $data['achievement'] = $this->Achievement->show($id, "
      a.tahun,
      a.id_detailer,
      b.nama_detailer,
      a.id_outlet,
      c.nama_outlet,
      c.nama_area,
      a.nominal_target_januari, 
      a.nominal_target_februari, 
      a.nominal_target_maret, 
      a.nominal_target_april, 
      a.nominal_target_mei, 
      a.nominal_target_juni, 
      a.nominal_target_juli, 
      a.nominal_target_agustus, 
      a.nominal_target_september, 
      a.nominal_target_oktober, 
      a.nominal_target_november, 
      a.nominal_target_desember, 
      a.nominal_jumlah_januari, 
      a.nominal_jumlah_februari, 
      a.nominal_jumlah_maret, 
      a.nominal_jumlah_april, 
      a.nominal_jumlah_mei, 
      a.nominal_jumlah_juni, 
      a.nominal_jumlah_juli, 
      a.nominal_jumlah_agustus, 
      a.nominal_jumlah_september, 
      a.nominal_jumlah_oktober, 
      a.nominal_jumlah_november, 
      a.nominal_jumlah_desember, 
      a.achievement_januari, 
      a.achievement_februari, 
      a.achievement_maret, 
      a.achievement_april, 
      a.achievement_mei, 
      a.achievement_juni, 
      a.achievement_juli, 
      a.achievement_agustus, 
      a.achievement_september, 
      a.achievement_oktober, 
      a.achievement_november, 
      a.achievement_desember, 
      a.hapus
      ");

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/evaluasi/detail', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

}