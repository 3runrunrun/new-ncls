<?php 

class Wpr extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data($column = '*')
  {
    $this->db->select($column);
    $this->db->from('wpr a');
    $this->db->join('detailer b', 'a.id_detailer = b.id');
    $this->db->join('detailer c', 'a.id_spv = c.id');
    $this->db->join('wpr_detail d', 'a.id = d.id_wpr');
    $this->db->where('a.tahun', $this->session->userdata('tahun'));
    $this->db->where('a.hapus', null);
    $this->db->group_by('d.id_wpr');
    $result = $this->db->get();
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
  public function get_waiting($column = '*')
  {
    $this->db->select($column);
    $this->db->from('wpr a');
    $this->db->join('detailer b', 'a.id_detailer = b.id');
    $this->db->join('detailer d', 'a.id_spv = d.id');
    $this->db->join('detailer e', 'a.id_direktur = e.id');
    $this->db->join('v_wpr_detail f', 'a.id = f.id_wpr');
    $this->db->group_by('a.id');
    $this->db->where('a.tahun', $this->session->userdata('tahun'));
    $this->db->where('a.status', 'waiting');
    $this->db->where('a.hapus', null);
    $result = $this->db->get();
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
  public function get_approved($column = '*')
  {
    $this->db->select($column);
    $this->db->from('wpr a');
    $this->db->join('detailer b', 'a.id_detailer = b.id');
    $this->db->join('detailer d', 'a.id_spv = d.id');
    $this->db->join('detailer e', 'a.id_direktur = e.id');
    $this->db->join('v_wpr_detail f', 'a.id = f.id_wpr');
    $this->db->group_by('a.id');
    $this->db->where('a.tahun', $this->session->userdata('tahun'));
    $this->db->where('a.status', 'approved');
    $this->db->where('a.hapus', null);
    $result = $this->db->get();
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
  public function get_klm_dana($column = '*')
  {
    $this->db->select($column);
    $this->db->from('wpr a');
    $this->db->join('wpr_detail b', 'a.id = b.id_wpr');
    $this->db->join('wpr_status c', 'a.id = c.id_wpr and c.status = "approved"');
    $this->db->group_by('DATE_FORMAT(c.tanggal,"%m")');
    $this->db->where('a.tahun', $this->session->userdata('tahun'));
    $this->db->where('a.status', 'approved');
    $this->db->where('a.hapus', null);       
    $result = $this->db->get();
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
  public function show_klm_dana($id, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('wpr a');
    $this->db->join('detailer b', 'a.id_detailer = b.id');
    $this->db->join('v_wpr_detail c', 'a.id = c.id_wpr');
    $this->db->join('wpr_status d', 'a.id = d.id_wpr and d.status = "approved"');
    $this->db->where('a.tahun', $this->session->userdata('tahun'));
    $this->db->where('a.status', 'approved'); 
    $this->db->where('DATE_FORMAT(d.tanggal,"%M")', $id);
    $this->db->where('a.hapus', null);       
    $result = $this->db->get();
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
  public function show($id, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('wpr a');
    $this->db->join('v_detailer_aktif b', 'a.id_detailer = b.id');
    $this->db->join('detailer d', 'a.id_spv = d.id');
    $this->db->join('detailer e', 'a.id_direktur = e.id');
    $this->db->where('a.id', $id);
    $this->db->where('a.tahun', $this->session->userdata('tahun'));
    $this->db->where('a.hapus', null);
    $this->db->group_by('a.id');
    $result = $this->db->get();
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
  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('wpr');
    $this->db->query($query);
  }
}