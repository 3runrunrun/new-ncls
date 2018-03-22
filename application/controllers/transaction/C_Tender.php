<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Tender extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    $row = $this->get_total_row();
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['dist_subdist'] = $this->Dist_Subdist->get_data('id, UPPER(alias_distributor) as alias_distributor, UPPER(nama) as nama, UPPER(alias_area) as alias_area');
    $data['outlet'] = $this->Outlet->get_outlet_aktif('id, UPPER(alias_area) as alias_area, UPPER(nama_outlet) as nama_outlet');
    $data['produk'] = $this->Produk->get_produk_harga('id, UPPER(nama) as nama, UPPER(kemasan) as kemasan, harga_master, harga_hna');
    $data['prefix'] = $this->nsu->zerofill_generator(4, $row);

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/transaction/faktur/ko-tender/ko-tender', $data);
    $this->load->view('footers/footer-js-form-simple-table'); 
  }

  public function get_total_row()
  {
    $data = $this->kot->all();
    return $data['data']->num_rows();
  }

  public function show($id, $approve = null)
  {
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['detail'] = $this->kot->show($id);
    $data['produk'] = $this->kotd->show($id);
    $data['onoff'] = $this->koto->show($id);
    $data['total'] = $this->kotot->show($id);

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');

    if ($approve !== null) {
      $this->load->view('contents/transaction/faktur/ko-tender/verifikasi', $data);
    } else {
      $this->load->view('contents/transaction/faktur/ko-tender/detail', $data);
    }
    
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
      $input_var['tahun'] = date('Y');
      $input_var['tanggal'] = date('Y-m-d');

      $this->update_kotd($input_var);
      $this->udpate_koto($input_var);
      $this->update_kotot($input_var);
      $this->update_tanggal_faktur($input_var);
      $this->save_kots($input_var);

      // jika status rilis, maka lakukan operasi update stok (nucleus, distributor / subdist)
      if ($input_var['status'] === 'rilis') {
        if ($input_var['dist_subdist'] == 'd') {
          $this->save_bmd($input_var);
        } elseif ($input_var['dist_subdist'] == 's') {
          $this->save_bms($input_var);
        }
        $this->save_bkn($input_var);
      }
      
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Approval faktur KO Tender <strong>gagal</strong>.');
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Approval faktur KO Tender <strong>berhasil</strong> disimpan.');
      }
      redirect('/daftar-faktur'); 
    } else {
      $status = strtolower('waiting');
      $input_var = $this->input->post();
      $input_var['id'] = $this->session->userdata('no_tender');
      $input_var['tahun'] = date('Y');
      $input_var['status'] = $status;

      $this->save_kot($input_var);
      $this->save_kotd($input_var);
      $this->save_koto($input_var);
      $this->save_kotot($input_var);
      $this->save_kots($input_var);

      if ($input_var['dist_subdist'] == 'd') {
        $input_var['id_permohonan'] = $this->nsu->digit_id_generator(4, 'pmhd');
        $this->save_ppd($input_var);
      } elseif ($input_var['dist_subdist'] == 's') {
        $input_var['id_permohonan'] = $this->nsu->digit_id_generator(4, 'pmhs');
        $this->save_pps($input_var);
      }

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penyimpanan Faktur KO Tender <strong>gagal</strong>.');
      } else {
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Faktur KO Tender <strong>berhasil</strong> disimpan.');
      }
      $this->session->unset_userdata('no_tender');
    }
   
   redirect('/ko-tender'); 
  }

  /**
   |
   | Private function
   |
   */
  
  private function save_kot($data = array())
  {
    $val['id'] = $data['id'];
    $val['sp'] = $data['sp'];
    $val['tahun'] = $data['tahun'];
    $val['id_detailer'] = $data['id_detailer'];
    $val['tanggal'] = $data['tanggal'];
    $val['id_distributor'] = $data['id_distributor'];
    $val['id_rm'] = $data['id_rm'];
    $val['id_direktur'] = $data['id_direktur'];
    $val['status'] = $data['status'];
    if ($data['dist_subdist'] == 's') {
      $val['subdist'] = 'y';
    }
    $this->kot->store($val);
  }

  private function save_kotd($data = array())
  {
    foreach ($data['id_outlet'] as $key => $value) {
      $val['id_ko'] = $data['id'];
      $val['id_outlet'] = $value;
      $val['id_produk'] = $data['id_produk'][$key];
      $val['jumlah'] = $data['jumlah'][$key];
      $val['on_diskon_distributor'] = $data['on_diskon_distributor'][$key];
      $val['on_nf'] = $data['on_nf'][$key];
      $val['on_total'] = $data['on_total'][$key];
      $val['off_diskon_distributor'] = $data['off_diskon_distributor'][$key];
      $val['off_nf'] = $data['off_nf'][$key];
      $val['off_total'] = $data['off_total'][$key];
      $val['keterangan'] = $data['keterangan'][$key];
      $this->kotd->store($val);
    }
  }

  private function save_koto($data = array())
  {
    foreach ($data['cn'] as $key => $value) {
      $val['id_ko'] = $data['id'];
      $val['cn'] = $value;
      $val['diskon'] = $data['diskon'][$key];
      $this->koto->store($val);
    }
  }

  private function save_kotot($data = array())
  {
    $val['id_ko'] = $data['id'];
    $val['total'] = $data['total'];
    $this->kotot->store($val);
  }

  private function save_kots($data = array())
  {
    $val['id_rilis'] = $data['id_direktur'];
    switch ($data['status']) {
      case 'waiting':
        $val['id_rilis'] = $data['id_detailer'];
        break;
      case 'spv':
      case 'rm':
      case 'rilis':
        $val['id_rilis'] = $data['id_rilis'];
        break;
      default:
        $val['id_rilis'] = $data['id_direktur'];
        break;
    }

    $val['id_ko'] = $data['id'];
    $val['tanggal'] = date('Y-m-d H:i:s');
    $val['status'] = $data['status'];
    $this->kots->store($val);
  }

  private function update_tanggal_faktur($data = array())
  {
    switch ($data['status']) {
      case 'spv':
        $val['tgl_spv'] = date('Y-m-d H:i:s');
        break;
      case 'rm':
        $val['tgl_rm'] = date('Y-m-d H:i:s');
        break;
      case 'rilis':
        $val['tgl_direktur'] = date('Y-m-d H:i:s');
        break;
    }
    $this->kot->update($data['id'], $data['sp'], $val);
  }


  private function update_kotd($data = array())
  {
    foreach ($data['id_outlet'] as $key => $value) {
      $val['jumlah'] = $data['jumlah'][$key];
      $val['on_diskon_distributor'] = $data['on_diskon_distributor'][$key];
      $val['on_nf'] = $data['on_nf'][$key];
      $val['on_total'] = $data['on_total'][$key];
      $val['off_diskon_distributor'] = $data['off_diskon_distributor'][$key];
      $val['off_nf'] = $data['off_nf'][$key];
      $val['off_total'] = $data['off_total'][$key];
      $val['keterangan'] = $data['keterangan'][$key];
      $this->kotd->update_detail($data['id'], $value, $data['id_produk'][$key], $val);
    }
  }

  private function udpate_koto($data = array())
  {
    foreach ($data['cn'] as $key => $value) {
      $val['cn'] = $value;
      $val['diskon'] = $data['diskon'][$key];
      $this->koto->update_cn($data['id'], $value, $val);
    }
  }

  private function update_kotot($data = array())
  {
    $val['total'] = $data['total'];
    $this->kotot->update($data['id'], $val);
  }
  
  
  // permohonan produk distributor
  private function save_ppd($data = array())
  {
    $val['id'] = $data['id_permohonan'];
    $val['tahun'] = $data['tahun'];
    $val['id_distributor'] = $data['id_distributor'];
    $val['tanggal'] = $data['tanggal'];
    $val['status'] = $data['status'];
    $this->ppd->store($val);
    $this->save_ppdd($data);
    $this->save_ppds($data);
  }
  
  private function save_ppdd($data = array())
  {
    foreach ($data['id_produk'] as $key => $value) {
      $val['id_permohonan'] = $data['id_permohonan'];
      $val['id_produk'] = $value;
      $val['jumlah'] = $data['jumlah'][$key];
      $this->ppdd->store($val);
    }
  }

  private function save_ppds($data = array())
  {
    $val['id_permohonan'] = $data['id_permohonan'];
    $val['tanggal'] = $data['tanggal'];
    $val['status'] = $data['status'];
    $this->ppds->store($val);
  }
  // end of - permohonan produk distributor
  
  // permohonan produk subdist
  private function save_pps($data = array())
  {
    $val['id'] = $data['id_permohonan'];
    $val['tahun'] = $data['tahun'];
    $val['id_subdist'] = $data['id_distributor'];
    $val['tanggal'] = $data['tanggal'];
    $val['status'] = $data['status'];
    $this->pps->store($val);
    $this->save_ppsd($data);
    $this->save_ppss($data);
  }
  
  private function save_ppsd($data = array())
  {
    foreach ($data['id_produk'] as $key => $value) {
      $val['id_permohonan'] = $data['id_permohonan'];
      $val['id_produk'] = $value;
      $val['jumlah'] = $data['jumlah'][$key];
      $this->ppsd->store($val);
    }
  }

  private function save_ppss($data = array())
  {
    $val['id_permohonan'] = $data['id_permohonan'];
    $val['tanggal'] = $data['tanggal'];
    $val['status'] = $data['status'];
    $this->ppss->store($val);
  }
  // end of permohonan produk subdist

  // barang masuk distributor
  private function save_bmd($data = array())
  {
    foreach ($data['id_produk'] as $key => $value) {
      $val['id_produk'] = $value;
      $val['id_distributor'] = $data['id_distributor'];
      $val['tahun'] = $data['tahun'];
      $val['tanggal'] = $data['tanggal'];
      $val['jumlah'] = $data['jumlah'][$key];
      $this->bmd->store($val);
    }
  }
  // end of barang masuk distributor
  
  // barang masuk subdist
  private function save_bms($data = array())
  {
    foreach ($data['id_produk'] as $key => $value) {
      $val['id_produk'] = $value;
      $val['id_subdist'] = $data['id_distributor'];
      $val['tahun'] = $data['tahun'];
      $val['tanggal'] = $data['tanggal'];
      $val['jumlah'] = $data['jumlah'][$key];
      $this->bms->store($val);
    }
  }
  // end of barang masuk subdist
  
  // barang keluar nucleus
  private function save_bkn($data = array())
  {
    foreach ($data['id_produk'] as $key => $value) {
      $val['id_produk'] = $value;
      $val['tahun'] = $data['tahun'];
      $val['tanggal'] = $data['tanggal'];
      $val['jumlah'] = $data['jumlah'][$key];
      $this->bkn->store($val);
    }
  }
  // end of barang keluar nucleus
  public function cetak($id)
  {
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['detail'] = $this->kot->show($id);
    $data['produk'] = $this->kotd->show($id);
    $data['onoff'] = $this->koto->show($id);
    $data['total'] = $this->kotot->show($id);
    
    $this->load->view('contents/transaction/faktur/ko-tender/cetak',$data);
  }

}