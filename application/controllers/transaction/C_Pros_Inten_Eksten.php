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
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['id_eksten'] = $this->nsu->digit_id_generator(4, 'dks');
    $data['id_intens'] = $this->nsu->digit_id_generator(4, 'dns');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/ineks/eksten', $data);
    $this->load->view('footers/footer-js-form-simple-table'); 
  }

  public function store_eksten($operation = null)
  {
    if ($operation == 'edit') {
      # code...
    } elseif ($operation == 'delete') {
      # code...
    } else {
      # code...
      $this->session->unset_userdata('id_eksten');
      $this->session->unset_userdata('id_intens');
    }
    
    redirect('/sales-eksten');
  }

}