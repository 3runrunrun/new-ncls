<?php 

class Promo_Trial_Detail extends CI_Model {

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }
  public function store($data = array())
  {
    $query = $this->db->set($data)->get_compiled_insert('promo_trial_detail');
    $this->db->query($query);
  }
  public function show($no_promo, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('no_promo', $no_promo);
    $this->db->where('hapus', null);
    $result = $this->db->get('v_promo_detail');
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