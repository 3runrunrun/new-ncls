<?php 

class Operasional extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_all($column = '*')
  {
    $this->db->select($column);
    $result = $this->db->get('operasional');
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
    $this->db->where('hapus', null);
    $result = $this->db->get('v_operasional');
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

  public function show_data($id, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('operasional a');
    $this->db->join('detailer b', 'a.id_detailer = b.id');
    $this->db->join('v_detailer_aktif c', 'a.id_detailer = c.id');
    $this->db->where('a.id_detailer', $id);
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

  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('operasional');
    $this->db->query($query);
  }

  public function update($id, $data = array())
  {
    $this->db->set($data);
    $this->db->where('id', $id);
    $query = $this->db->get_compiled_update('operasional');
    $this->db->query($query);
  }

  public function destroy($id)
  {
    $this->db->set('hapus',  date('Y-m-d'));
    $this->db->where('id', $id);
    $query = $this->db->get_compiled_insert('operasional');
    $this->db->query($query);
  }

  /**
   * CA
   */
  
  public function get_ca_waiting($column = '*')
  {
    $this->db->select($column);
    $this->db->where('jenis', 'ca');
    $this->db->where('status', 'waiting');
    $this->db->where('hapus', null);
    $result = $this->db->get('v_ca');
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

  public function get_ca_approved($column = '*')
  {
    $this->db->select($column);
    $this->db->where('jenis', 'ca');
    $this->db->where('status', 'approved');
    $this->db->where('hapus', null);
    $result = $this->db->get('v_ca');
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

  public function get_ca_hutang($column = '*')
  {
    $this->db->select($column);
    $this->db->where('jenis', 'ca');
    $this->db->where('status', 'approved');
    $this->db->where('status_ca', 'hutang');
    $this->db->where('hapus', null);
    $result = $this->db->get('v_ca');
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

  public function show_ca($id, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id', $id);
    $result = $this->db->get('v_ca');
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
}