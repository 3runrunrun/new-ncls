<?php 

class Ekstensifikasi extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data($column = '*')
  {
    $this->db->select($column);
    $this->db->where('tahun', $this->session->userdata('tahun'));
    $this->db->where('hapus', null);
    $result = $this->db->get('ektensifikasi');
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

  public function get_target_eksten($column = '*')
  {
    $this->db->select($column);
    $this->db->from('v_target_detailer a');
    $this->db->join('detailer_fieldforce b', 'a.id_detailer = b.id_detailer');
    $this->db->join('outlet c', 'a.id_outlet = c.id');
    $this->db->join('v_user d', 'a.id_customer = d.id');
    $this->db->join('area e', 'b.id_area = e.id');
    $this->db->join('detailer f', 'a.id_detailer = f.id');
    $this->db->join('produk g', 'a.id_produk = g.id');
    $this->db->join('produk_harga h', 'a.id_produk = h.id_produk');
    $this->db->where('a.tahun', $this->session->userdata('tahun'));
    $this->db->where('a.hapus', null);
    $result = $this->db->get();
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

  public function show_eksten($id, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id', $id);
    $this->db->where('hapus', null);
    $result = $this->db->get('v_eksten_detail');
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
    $query = $this->db->set($data)->get_compiled_insert('ektensifikasi');
    $this->db->query($query);
  }

}