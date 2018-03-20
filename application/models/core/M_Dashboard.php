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

  public function daily_sales_activity()
  {
    $query = "SELECT 
        id_area,
        nama_area,
        SUM(ppg) as ppg,
        SUM(penta) as penta,
        SUM(ptkp) as ptkp,
        SUM(jki) as jki
      FROM
      (
        select coalesce(a.id_area, '-') as id_area, coalesce(a.nama,'-') as nama_area,
        coalesce((case when a.id_master = '1' then sum(a.jumlah) end),0) as ppg,
        coalesce((case when a.id_master = '2' then sum(a.jumlah) end),0) as penta,
        coalesce((case when a.id_master = '3' then sum(a.jumlah) end),0) as ptkp,
        coalesce((case when a.id_master = '4' then sum(a.jumlah) end),0) as jki
        from 
        (
          select 
          coalesce((b1.harga_master * sum(a1.jumlah)) - (b1.harga_master * sum(a1.jumlah) * ((coalesce(e1.diskon_on, 0) + coalesce(e1.diskon_off, 0)) / 100)),0) as jumlah, 
          date_format(a1.tanggal, '%m') as bulan,
          a1.id_produk,
          d1.nama,
          d1.id as id_area,
          c1.id_master
          from sales a1
          join produk_harga b1
          on a1.id_produk=b1.id_produk
          join distributor c1
          on a1.id_distributor=c1.id
          join area d1
          on d1.id=c1.id_area
          left join sales_diskon e1
          on e1.id_sales = a1.id
          WHERE a1.tahun = ?
          AND a1.hapus IS NULL
          group by date_format(a1.tanggal, '%m'), b1.id_produk, c1.id_area, c1.id_master, a1.id
        ) a
        join master_distributor b
        on a.id_master=b.id
        group by a.id_area, b.id
      ) z
      GROUP BY z.id_area";
    $bind_param = array($this->session->userdata('tahun'));
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

  public function top_sales()
  {
    $query = "SELECT 
        a.id_detailer,
        b.nama_detailer,
        b.nama_area,
        b.alias_area,
        a.achievement_perbulan
      FROM
      (SELECT 
        a1.id_detailer,
        SUM(a1.jumlah) as jumlah,
        SUM(a1.jumlah * b1.harga_master) as nominal_jumlah,
        c1.target,
        (SUM(a1.jumlah * b1.harga_master) - COALESCE(SUM(a1.jumlah * b1.harga_master) * ((COALESCE(d1.diskon_on, 0) + COALESCE(d1.diskon_off, 0)) / 100), 0)) AS jumlah_diskon,
        ((SUM(a1.jumlah * b1.harga_master) - COALESCE(SUM(a1.jumlah * b1.harga_master) * ((COALESCE(d1.diskon_on, 0) + COALESCE(d1.diskon_off, 0)) / 100), 0)) / c1.target * 100) as achievement_perbulan
      FROM sales a1
      JOIN produk_harga b1 ON a1.id_produk = b1.id_produk
      LEFT JOIN sales_diskon d1 ON a1.id = d1.id_sales
      LEFT JOIN (SELECT
        a2.id_detailer,
        a2.id_produk,
        SUM(a2.target * a2.harga_master) as target
      FROM v_target_detailer a2
      WHERE a2.tahun = ?
      AND a2.hapus IS NULL
      GROUP BY a2.id_detailer) c1 ON a1.id_detailer = c1.id_detailer
      WHERE date_format(a1.tanggal, '%m') like ?
      AND a1.hapus IS NULL
      GROUP BY a1.id_detailer) a
      JOIN v_detailer_aktif b ON a.id_detailer = b.id
      order by a.achievement_perbulan desc
      limit 1";
    $bind_param = array($this->session->userdata('tahun'), date('m'));
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