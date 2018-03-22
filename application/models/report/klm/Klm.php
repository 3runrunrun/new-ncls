<?php

class Klm extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function get_per_user($column = '*')
    {
        $this->db->select($column)
            ->from('klm_per_user a')
            ->join('v_user b', 'a.id_user = b.id')
            ->where('a.tahun', $this->session->userdata('tahun'))
            ->where('a.hapus', null);
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

}
