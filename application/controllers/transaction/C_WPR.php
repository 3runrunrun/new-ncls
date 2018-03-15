<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_WPR extends CI_Controller {

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

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/wpr/wpr', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function show($id, $approve = null)
  {
    $data['detail'] = $this->Wpr->show($id, 'a.id, a.no_wpr, UPPER(b.nama_detailer) as detailer, UPPER(d.nama) as supervisor, e.id as id_approver, UPPER(e.nama) as direktur, a.status, UPPER(b.nama_area) as nama_area, UPPER(b.alias_area) as alias_area');
    $data['request'] = $this->Wpr_Detail->show($id, 'UPPER(nama_user) AS nama_user, UPPER(spesialis) AS spesialis, dari, sampai, dana, UPPER(bank) AS bank, UPPER(norek) as norek, UPPER(atas_nama) as atas_nama, no_wpr, id_wpr');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/wpr/wpr-detail', $data);
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
      $input_var['id_wpr'] = $this->session->userdata('id_wpr');

      $this->save_approval($input_var);
      
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'WPR approval <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'WPR approval <strong>berhasil</strong> disimpan.');
      }
      $this->session->unset_userdata('id_wpr');
    } else {
      $input_var = $this->input->post();
      $status = strtolower('waiting');
      $suffix_wpr = $this->session->userdata('suffix_wpr');
      $no_wpr = $input_var['prefix_wpr'] . $suffix_wpr;

      $input_var['id'] = $this->nsu->digit_id_generator(4,'wpr');
      $input_var['no_wpr'] = $no_wpr;
      $input_var['tahun'] = date('Y');
      $input_var['status'] = $status;
      unset($input_var['prefix_wpr']);
      unset($input_var['suffix_wpr']);
     
      $this->save_wpr($input_var);
      $this->save_wprd($input_var);
      $this->save_wprs($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan WPR <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'WPR <strong>berhasil</strong> disimpan.');
      }
      $this->session->unset_userdata('suffix_wpr');
    }
   
   redirect('/wpr'); 
  }  

  private function save_wpr($data = array())
  {
    $val['id'] = $data['id'];
    $val['no_wpr'] = $data['no_wpr'];
    $val['tahun'] = $data['tahun'];
    $val['id_detailer'] = $data['id_detailer'];
    $val['id_spv'] = $data['id_spv'];
    $val['id_direktur'] = $data['id_direktur'];
    $val['keterangan'] = $data['keterangan'];
    $val['status'] = $data['status'];
    $this->Wpr->store($val);
  }
  private function save_wprd($data = array())
  {
    $val['id_wpr'] = $data['id'];
    $val['id_user'] = $data['id_user'];
    $val['bank'] = $data['bank'];
    $val['norek'] = $data['norek'];
    $val['atas_nama'] = $data['atas_nama'];
    $val['dari'] = $data['dari'];
    $val['sampai'] = $data['sampai'];
    $val['dana'] = $data['dana'];
    $this->Wpr_Detail->store($val);
  }
  private function save_wprs($data = array())
  {
    $val['id_wpr'] = $data['id'];
    $val['id_approver'] = $data['id_direktur'];
    $val['tanggal'] = date('Y-m-d H:i:s');
    $val['status'] = $data['status'];
    $this->Wpr_Status->store($val);
  }

  public function save_approval($data = array())
  {
    $val['id_wpr'] = $data['id_wpr'];
    $val['id_approver'] = $data['id_approver'];
    $val['status'] = $data['status'];
    $val['tanggal'] = date('Y-m-d H:i:s');
    $this->Wpr_Status->store($val);
  }

  public function print($id)
  {
    echo cetak;
  }
}