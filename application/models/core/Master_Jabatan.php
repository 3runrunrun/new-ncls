<?php
class Master_Jabatan extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function get_data($column = '*')
    {
        $this->db->select($column);
        $result = $this->db->get('master_jabatan');
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
        $query = $this->db->set($data)->get_compiled_insert('master_jabatan');
        $this->db->query($query);
    }
}
