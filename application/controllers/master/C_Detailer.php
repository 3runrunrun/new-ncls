<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Detailer extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $data['id'] = $this->nsu->digit_id_generator(4, 'dt');
    $data['spv'] = $this->Detailer->get_data('id, UPPER(nama) as nama');
    $data['rm'] = $this->Detailer->get_data('id, UPPER(nama) as nama');
    $data['direktur'] = $this->Detailer->get_data('id, UPPER(nama) as nama');
    $data['detailer_lama'] = $this->Detailer->get_data('id, UPPER(nama) as nama');
    $data['area'] = $this->Area->get_data('id, UPPER(nama) as nama');
    $data['jabatan'] = $this->Master_Jabatan->get_data('id, UPPER(jabatan) as jabatan');

    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(nama_area) as nama_area, tanggal_masuk, status');

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/master/detailer', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function print($id)
  {
    $data['halaman1'] = $this->Detailer->show($id, 'nama_detailer, jenis_kelamin, nama_area, tanggal_masuk, jabatan, id_spv, id_rm, agama, ktp, notelp, nohp, tempat_lahir, tanggal_lahir, kewarganegaraan, pendidikan_terakhir, status_kawin, gaji, housing, sewa_kendaraan, tunjangan, bank, norek, keterangan');
    $data['istri'] = $this->Detailer->show_istri($id, 'istri');
    $data['anak'] = $this->Detailer->show_anak($id, 'anak');
    // $data['halaman2'] = $this->Detailer->show($id, 'nama_detailer, jenis_kelamin, nama_area, tanggal_masuk, jabatan, id_spv, id_rm, agama, tempat_lahir, tanggal_lahir, notelp, nohp, gaji, housing, sewa_kendaraan, tunjangan, bank, norek, keterangan');

    // var_dump($data['halaman2']['data']->row());

    $this->load->view('contents/master/cetak-detailer', $data);

    // $this->load->view('heads/head-form-simple-table');
    // $this->load->view('navbar');
    // $this->load->view('contents/master/detailer', $data);
    // $this->load->view('footers/footer-js-form-simple-table');
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
      $input_var['id'] = $this->session->userdata('id_dt');

      $this->save_detailer($input_var);
      if ($input_var['status_kawin'] == 'kawin') {
        $this->save_detailer_keluarga($input_var);
        $this->save_detailer_anak($input_var);
      }
      $this->save_detailer_ff($input_var);
      $this->save_detailer_gaji($input_var);

      $this->save_user_account($input_var);
      $this->session->unset_userdata('id_dt');
      
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data detailer <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data detailer baru <strong>berhasil</strong> disimpan.');
      }
    }
    
    redirect('/master-detailer');
  }

  private function save_detailer($data = array())
  {
    $val['id'] = $data['id'];
    $val['ktp'] = $data['ktp'];
    $val['nama'] = $data['nama'];
    $val['tempat_lahir'] = $data['tempat_lahir'];
    $val['tanggal_lahir'] = $data['tanggal_lahir'];
    $val['kewarganegaraan'] = $data['kewarganegaraan'];
    $val['jenis_kelamin'] = $data['jenis_kelamin'];
    $val['agama'] = $data['agama'];
    $val['pendidikan_terakhir'] = $data['pendidikan_terakhir'];
    $val['status_kawin'] = $data['status_kawin'];
    $val['status'] = 'aktif';
    $val['keterangan'] = $data['keterangan'];
    $this->Detailer->store($val);
  }
  private function save_detailer_keluarga($data = array())
  {
    $val['id_detailer'] = $data['id'];
    $val['istri'] = $data['istri'];
    $this->Detailer_Keluarga->store($val);
  }
  private function save_detailer_anak($data = array())
  {
    $val['id_detailer'] = $data['id'];
    $val['anak'] = $data['anak'];
    $this->Detailer_Anak->store($val);
  }
  private function save_detailer_ff($data = array())
  {
    $val['id_detailer'] = $data['id'];
    $val['id_area'] = $data['id_area'];
    $val['subarea'] = $data['subarea'];
    $val['id_jabatan'] = $data['id_jabatan'];
    $val['id_spv'] = $data['id_spv'];
    $val['id_rm'] = $data['id_rm'];
    $val['id_direktur'] = $data['id_direktur'];
    $val['id_detailer_lama'] = $data['id_detailer_lama'];
    $val['notelp'] = $data['notelp'];
    $val['nohp'] = $data['nohp'];
    $val['golongan'] = $data['golongan'];
    $val['tanggal_masuk'] = date('Y-m-d');
    $this->Detailer_Fieldforce->store($val);
  }
  private function save_detailer_gaji($data = array())
  {
    $val['id_detailer'] = $data['id'];
    $val['tanggal'] = date('Y-m-d');
    $val['bank'] = $data['bank'];
    $val['norek'] = $data['norek'];
    $val['gaji'] = $data['gaji'];
    $val['tunjangan'] = $data['tunjangan'];
    $val['housing'] = $data['housing'];
    $val['sewa_kendaraan'] = $data['sewa_kendaraan'];
    $this->Detailer_Gaji->store($val);
  }
  private function save_user_account($data = array())
  {
    $username = explode(' ', $data['nama']);
    $val['username'] = strtolower($username[0]);
    $val['password'] = $this->nsu->password_generator(8); // cek libary "nsu" di folder application/libraries
    $val['jenis'] = $data['id_jabatan'];
    $this->User_Account->store($val);
  }

}