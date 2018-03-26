<?php
class Customer_Non extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function get_all($column = '*')
    {
        $this->db->select($column);
        $result = $this->db->get('customer_non');
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
    public function get_data($column = '*')
    {
        $this->db->select($column);
        $this->db->where('hapus', null);
        $result = $this->db->get('v_customer_non');
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
        $query = $this->db->set($data)->get_compiled_insert('customer_non');
        $this->db->query($query);
    }
}
