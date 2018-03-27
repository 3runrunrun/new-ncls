<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Prospect_RTD extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['rtd'] = $this->Rtd->get_data();
    $data['area'] = $this->Area->get_data('id, UPPER(nama) as nama, UPPER(alias_area) as alias_area');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/rtd/rtd', $data);
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
      $data = $this->Rtd->get_all();
      $rows = $data['data']->num_rows();
      $id = 'rtd' . $this->nsu->zerofill_generator(7, $rows);

      $status = strtolower('waiting');
      $input_var = $this->input->post();
      $input_var['id'] = $id;
      $input_var['tahun'] = date('Y');
      $input_var['status'] = $status;
      $input_var['sampai'] = $this->nsu->add_date_by_days($input_var['dari'], $input_var['durasi']);

      $this->save_rtd($input_var);
      $this->save_rtds($input_var);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', '<strong>Failed</strong> to save RTD prospect.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'RTD Prospect has been <strong>saved</strong>.');
      }
    }
    
    redirect('/rtd');
  }

  // rtd
  private function save_rtd($data = array())
  {
    $val['id'] = $data['id'];
    $val['id_area'] = $data['id_area'];
    $val['tahun'] = $data['tahun'];
    $val['nama'] = $data['nama'];
    $val['dari'] = $data['dari'];
    $val['sampai'] = $data['sampai'];
    $val['durasi'] = $data['durasi'];
    $val['biaya'] = $data['biaya'];
    $val['status'] = $data['status'];
    $val['keterangan'] = $data['keterangan'];
    $this->Rtd->store($val);
  }

  public function save_rtds($data = array())
  {
    $val['id_rtd'] = $data['id'];
    $val['tanggal'] = date('Y-m-d H:i:s');
    $val['status'] = $data['status'];
    $this->Rtd_Status->store($val);
  }
  // end rtd

}