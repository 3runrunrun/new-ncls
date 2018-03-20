<?php
class Kog_Kot extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function get_data($column = '*')
    {
        $this->db->select($column);
        $this->db->where('tahun', $this->session->userdata('tahun'));
        $result = $this->db->get('v_kog_kot');
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

    public function get_detail($column = '*')
    {
        $this->db->select($column);
        $this->db->where('tahun', $this->session->userdata('tahun'));
        $this->db->where('hapus', null);
        $result = $this->db->get('v_kog_kot_detail_rilis');
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
