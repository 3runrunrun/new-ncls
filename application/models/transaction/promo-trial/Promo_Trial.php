<?php 

class Promo_Trial extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }
  public function get_data($column = '*',$where='')
  {
    $this->db->select($column);
    $this->db->from('promo_trial a');
    $this->db->join('detailer b', 'a.id_detailer = b.id');
    $this->db->join('v_user c', 'a.id_customer = c.id');
    $this->db->where(array('a.status =' => "$where"));
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
    $query = $this->db->set($data)->get_compiled_insert('promo_trial');
    $this->db->query($query);
  }public function update($id, $data = array())
  {
    $this->db->set($data);
    $this->db->where('id', $id);
    $query = $this->db->get_compiled_insert('promo_trial');
    $this->db->query($query);
  }
  public function destroy($id)
  {
    $this->db->set('hapus', date('Y-m-d'));
    $this->db->where('id', $id);
    $query = $this->db->get_compiled_insert('promo_trial');
    $this->db->query($query);
  }

}