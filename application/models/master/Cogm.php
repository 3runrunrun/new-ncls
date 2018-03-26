<?php 

class Cogm extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_all($column = '*')
  {
    $this->db->select($column);
    $result = $this->db->get('cogm');
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error',
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data' => $result
        );
    }
    return $ret_val;
  }

  public function get_data($column = '*')
  {
    $this->db->select($column);
    $this->db->where('tahun', $this->session->userdata('tahun'));
    $this->db->where('hapus', null);
    $result = $this->db->get('v_cogm');
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error',
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data' => $result
        );
    }
    return $ret_val;
  }

  public function get_cogm()
  {
    $query = "select a.tanggal, a.tahun, a.bulan, coalesce(sum(a.bahan_baku),0) as bahan_baku, 
      coalesce(sum(a.bahan_tambahan),0) as bahan_tambahan, 
      coalesce(sum(a.pengemas),0) as pengemas, 
      coalesce(sum(a.pekerja),0) as pekerja, 
      coalesce(sum(a.jasa_lab),0) as jasa_lab, 
      coalesce(sum(a.jasa_research),0) as jasa_research
      from
      (select a1.tanggal, a1.tahun, concat(date_format(a1.tanggal, '%m'), '-', a1.tahun) as bulan,
        (case when b1.id = 1 then coalesce(sum(a1.biaya),0) end) as bahan_baku,
        (case when b1.id = 2 then coalesce(sum(a1.biaya),0) end) as bahan_tambahan,
        (case when b1.id = 3 then coalesce(sum(a1.biaya),0) end) as pengemas,
        (case when b1.id = 4 then coalesce(sum(a1.biaya),0) end) as pekerja,
        (case when b1.id = 5 then coalesce(sum(a1.biaya),0) end) as jasa_lab,
        (case when b1.id = 6 then coalesce(sum(a1.biaya),0) end) as jasa_research
        from cogm a1
        join master_cogm b1
        on a1.id_cogm=b1.id
        where a1.tahun = ?
        group by a1.tahun, date_format(a1.tanggal, '%m'), a1.id_cogm
      ) a
      group by a.bulan";
    $bind_param = array($this->session->userdata('tahun'));
    $result = $this->db->query($query, $bind_param);
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error',
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data' => $result
        );
    }
    return $ret_val;
  }

  public function get_cogm_year()
  {
    $query = "select a.tanggal, a.tahun, a.bulan, coalesce(sum(a.bahan_baku),0) as bahan_baku, 
      coalesce(sum(a.bahan_tambahan),0) as bahan_tambahan, 
      coalesce(sum(a.pengemas),0) as pengemas, 
      coalesce(sum(a.pekerja),0) as pekerja, 
      coalesce(sum(a.jasa_lab),0) as jasa_lab, 
      coalesce(sum(a.jasa_research),0) as jasa_research
      from
      (select a1.tanggal, a1.tahun, concat(date_format(a1.tanggal, '%m'), '-', a1.tahun) as bulan,
        (case when b1.id = 1 then coalesce(sum(a1.biaya),0) end) as bahan_baku,
        (case when b1.id = 2 then coalesce(sum(a1.biaya),0) end) as bahan_tambahan,
        (case when b1.id = 3 then coalesce(sum(a1.biaya),0) end) as pengemas,
        (case when b1.id = 4 then coalesce(sum(a1.biaya),0) end) as pekerja,
        (case when b1.id = 5 then coalesce(sum(a1.biaya),0) end) as jasa_lab,
        (case when b1.id = 6 then coalesce(sum(a1.biaya),0) end) as jasa_research
        from cogm a1
        join master_cogm b1
        on a1.id_cogm=b1.id
        where a1.tahun = ?
        group by a1.tahun, date_format(a1.tanggal, '%m'), a1.id_cogm
      ) a
      group by a.tahun";
    $bind_param = array($this->session->userdata('tahun'));
    $result = $this->db->query($query, $bind_param);
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error',
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data' => $result
        );
    }
    return $ret_val;
  }

  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('cogm');
    $this->db->query($query);
  }
}