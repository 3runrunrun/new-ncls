<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Daily_Sales extends CI_Controller {

  public function  __construct(){
    parent:: __construct();
    date_default_timezone_set('Asia/Jakarta');
    error_reporting(0);
  }

  public function index()
  {
    # code...
  }

  public function show_product()
  {
    $data['sales'] = $this->gsal->get_per_product();

    $data['dist_subdist'] = $this->Dist_Subdist->get_data('id, UPPER(alias_distributor) as alias_distributor, UPPER(nama) as nama, UPPER(alias_area) as alias_area');
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['outlet'] = $this->Outlet->get_outlet_aktif('id, UPPER(alias_area) as alias_area, UPPER(nama_outlet) as nama_outlet');
    $data['produk'] = $this->Produk->get_produk_harga('id, UPPER(nama) as nama, UPPER(kemasan) as kemasan, harga_master, harga_hna');
    $data['faktur'] = $this->Kog_Kot->get_data('id, jenis_faktur');
    $data['detail_faktur'] = $this->Kog_Kot->get_detail();

    $this->load->view('heads/head-form-table-print');
    $this->load->view('navbar');
    $this->load->view('contents/report/daily-sales/per-product', $data);
    $this->load->view('footers/footer-js-form-table-print');
  }

  public function show_outlet()
  {
    $data['sales'] = $this->gsal->get_per_outlet();

    $data['dist_subdist'] = $this->Dist_Subdist->get_data('id, UPPER(alias_distributor) as alias_distributor, UPPER(nama) as nama, UPPER(alias_area) as alias_area');
    $data['detailer'] = $this->Detailer->get_detailer_aktif('id, UPPER(nama_detailer) as nama_detailer, UPPER(alias_area) as alias_area');
    $data['outlet'] = $this->Outlet->get_outlet_aktif('id, UPPER(alias_area) as alias_area, UPPER(nama_outlet) as nama_outlet');
    $data['produk'] = $this->Produk->get_produk_harga('id, UPPER(nama) as nama, UPPER(kemasan) as kemasan, harga_master, harga_hna');
    $data['faktur'] = $this->Kog_Kot->get_data('id, jenis_faktur');
    $data['detail_faktur'] = $this->Kog_Kot->get_detail();

    $this->load->view('heads/head-form-simple-table');
    $this->load->view('navbar');
    $this->load->view('contents/report/daily-sales/per-outlet', $data);
    $this->load->view('footers/footer-js-form-simple-table');
  }

  public function detail_outlet($id)
  {
    $data['outlet'] = $this->Outlet->show($id);
    $data['sales'] = $this->gsal->show_per_outlet($id);

    $this->load->view('heads/head-form-table-print');
    $this->load->view('navbar');
    $this->load->view('contents/report/daily-sales/detail-per-outlet', $data);
    $this->load->view('footers/footer-js-form-table-print');
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
      $input_var['id'] = $this->nsu->letter_number_generator('sal');
      $input_var['tahun'] = date('Y');
      
      if (isset($input_var['id_ko']) === false) {
        // jika tidak ada diskon
        $this->save_sal($input_var);
        if ($input_var['dist_subdist'] === 's') {
          $this->save_salsub($input_var);
        }
      } else {
        // jika ada diskon
        if ($input_var['general_tender'] === 'g') { // general
          $this->save_sal($input_var);
          $this->save_sald($input_var);

          if ($input_var['dist_subdist'] === 's') {
            $this->save_salsub($input_var);
          }

        } elseif ($input_var['general_tender'] === 't') { // tender
          $this->save_salt($input_var);
          $this->save_saltd($input_var);

          if ($input_var['dist_subdist'] === 's') {
            $this->save_saltsub($input_var);
          }
        }
      }

      // kurangi stok distributor / subdist
      if ($input_var['dist_subdist'] === 's') {
        $this->save_bks($input_var);
      } elseif ($input_var['dist_subdist'] === 'd') {
        $this->save_bkd($input_var);
      }

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $this->session->set_flashdata('error_msg', 'Penambahan data area <strong>gagal</strong>.');
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $this->session->set_flashdata('success_msg', 'Data area baru <strong>berhasil</strong> disimpan.');
      }
    
      if ($input_var['halaman'] === 'produk') {
        redirect('/daily-sales-product');
      }
      
      redirect('/daily-sales-outlet');
    }
  }
  
  // sales distributor
  private function get_target_perbulan($data = array())
  {
    $data = $this->Target_Detailer->get_perbulan($data['id_detailer'], $data['id_outlet'], $data['id_produk']);
    return $data['data']->result_array();
  }

  private function save_sal($data = array())
  {
    $target = $this->get_target_perbulan($data);

    if ($target[0]['target_perbulan'] === null) {
      $val['target'] = 0;
    } else {
      $val['target'] = $target[0]['target_perbulan'];
    }

    $val['id'] = $data['id'];
    $val['tahun'] = $data['tahun'];
    $val['tanggal'] = $data['tanggal'];
    $val['id_detailer'] = $data['id_detailer'];
    $val['id_outlet'] = $data['id_outlet'];
    $val['id_produk'] = $data['id_produk'];
    $val['jumlah'] = $data['jumlah'];
    $val['id_distributor'] = $data['id_distributor'];

    $this->sal->store($val);
  }

  private function save_sald($data = array())
  {
    $val['id_sales'] = $data['id'];
    $val['id_ko'] = $data['id_ko'];
    $val['diskon_on'] = $data['diskon_on'];
    $val['diskon_off'] = $data['diskon_off'];
    $this->sald->store($val);
  }
  // end sales distributor

  // sales subdist
  private function save_salsub($data = array())
  {
    $val['id_sales'] = $data['id'];
    $val['id_subdist'] = $data['id_distributor'];
    $this->salsub->store($val);
  }
  // end of sales subdist
  
  // sales tender
  private function save_salt($data = array())
  {
    $target = $this->get_target_perbulan($data);

    if ($target[0]['target_perbulan'] === null) {
      $val['target'] = 0;
    } else {
      $val['target'] = $target[0]['target_perbulan'];
    }

    $val['id'] = $data['id'];
    $val['tahun'] = $data['tahun'];
    $val['tanggal'] = $data['tanggal'];
    $val['id_detailer'] = $data['id_detailer'];
    $val['id_outlet'] = $data['id_outlet'];
    $val['id_produk'] = $data['id_produk'];
    $val['jumlah'] = $data['jumlah'];
    $val['id_distributor'] = $data['id_distributor'];

    $this->salt->store($val);
  }

  private function save_saltd($data = array())
  {
    $val['id_sales'] = $data['id'];
    $val['id_ko'] = $data['id_ko'];
    $val['diskon_on'] = $data['diskon_on'];
    $val['diskon_off'] = $data['diskon_off'];
    $this->saltd->store($val);
  }
  // end of sales tender

  // sales tender subdist
  private function save_saltsub($data = array())
  {
    $val['id_sales'] = $data['id'];
    $val['id_subdist'] = $data['id_distributor'];
    $this->saltsub->store($val);
  }
  // end of sales tender subdist
  
  // barang keluar distributor
  private function save_bkd($data = array())
  {
    $val['id_produk'] = $data['id_produk'];
    $val['id_distributor'] = $data['id_distributor'];
    $val['tahun'] = $data['tahun'];
    $val['tanggal'] = $data['tanggal'];
    $val['jumlah'] = $data['jumlah'];
    $this->bkd->store($val);
  }
  // end of barang keluar distributor

  // barang keluar subdist
  private function save_bks($data = array())
  {
    $val['id_produk'] = $data['id_produk'];
    $val['id_subdist'] = $data['id_distributor'];
    $val['tahun'] = $data['tahun'];
    $val['tanggal'] = $data['tanggal'];
    $val['jumlah'] = $data['jumlah'];
    $this->bks->store($val);
  }
  // end of barang keluar subdist
}