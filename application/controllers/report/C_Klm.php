<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Klm extends CI_Controller {

	public function  __construct(){
		parent:: __construct();
		date_default_timezone_set('Asia/Jakarta');
		error_reporting(0);
	}

	public function show_sales()
	{
		$data['achievement_customer'] = $this->Klm->get_per_user('a.id_user, b.nama_area, b.alias_area, b.nama as nama_user, a.nominal_sales, a.total_dana, a.ratio_dana');

		$this->load->view('heads/head-simple-form-table-chart');
		$this->load->view('navbar');
		$this->load->view('contents/report/klm/sales-leveling', $data);
		$this->load->view('footers/footer-js-simple-form-table-chart');
	}

	public function show_dana()
	{
		$data['appr'] = $this->Wpr->get_klm_dana('DATE_FORMAT(c.tanggal,"%M") as tanggal, sum(b.dana) as dana');

		$this->load->view('heads/head-form-simple-table');
		$this->load->view('navbar');
		$this->load->view('contents/report/klm/dana',$data);
		$this->load->view('footers/footer-js-form-simple-table');
	}

	public function detail_dana($id)
	{
		$data['appr'] = $this->Wpr->show_klm_dana($id,'a.no_wpr, UPPER(c.alias_area) as alias_area, UPPER(c.nama_area) as nama_area, UPPER(b.nama) as nama, c.dana, d.status, DATE_FORMAT(d.tanggal,"%M") as tanggal');

		$this->load->view('heads/head-form-simple-table');
		$this->load->view('navbar');
		$this->load->view('contents/report/klm/dana-detail',$data);
		$this->load->view('footers/footer-js-form-simple-table');
	}

	public function cetak($id)
	{
		$data['appr'] = $this->Wpr->show_klm_dana($id,'a.no_wpr, UPPER(c.alias_area) as alias_area, UPPER(c.nama_area) as nama_area, UPPER(b.nama) as nama, c.dana, d.status, DATE_FORMAT(d.tanggal,"%M") as tanggal');

		$this->load->view('contents/report/klm/cetak',$data);
	}

}