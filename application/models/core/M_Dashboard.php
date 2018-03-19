<?php 

class M_Dashboard extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function sales_counter($column = '*')
  {
    $this->db->select($column, FALSE);
    $result = $this->db->get('v_dashboard_sales');
    if (!$result) {
      $ret_val = array(
        'status' => 'error',
        'data'   => $this->db->error(),
      );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data'   => $result,
      );
    }
    return $ret_val;
  }

  public function sales_person($column = '*')
  {
    $this->db->select($column, FALSE);
    $this->db->where('hapus', null);
    $result = $this->db->get('detailer');
    if (!$result) {
      $ret_val = array(
        'status' => 'error',
        'data'   => $this->db->error(),
      );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data'   => $result,
      );
    }
    return $ret_val;
  }

  public function profit()
  {
    $query = "select a.dana_wpr+b.master_operasional+dana_cogm+master_detailer-total_sales as profit
      from
      (select sum(dana) as dana_wpr from v_wpr_detail where tahun = ? and hapus is null) a,
      (select sum(total - potongan_ca) as master_operasional from operasional where tahun = ? and hapus is null) b,
      (select sum(biaya) as dana_cogm from cogm where tahun = ? and hapus is null) c,
      (select sum(gaji+tunjangan+housing+sewa_kendaraan) master_detailer from detailer_gaji where date_format(tanggal, '%Y') like  ? and hapus is null) d,
      (select sum(jumlah) as total_sales
      from
      (
        select coalesce((b.harga_master * sum(a.jumlah)) - (b.harga_master * sum(a.jumlah) * ((coalesce(c.diskon_on, 0) + coalesce(c.diskon_off, 0)) / 100)),0) as jumlah
        from sales a
        join produk_harga b
        on a.id_produk=b.id_produk
        left join sales_diskon c
        on a.id=c.id_sales
        where a.tahun = ?
        and a.hapus is null
        group by a.id
        ) a
      ) e";
    $bind_param = array($this->session->userdata('tahun'),
      $this->session->userdata('tahun'),
      $this->session->userdata('tahun'),
      $this->session->userdata('tahun'),
      $this->session->userdata('tahun'));
    $result = $this->db->query($query, $bind_param);
    if (!$result) {
      $ret_val = array(
        'status' => 'error',
        'data'   => $this->db->error(),
      );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data'   => $result,
      );
    }
    return $ret_val;
  }

}