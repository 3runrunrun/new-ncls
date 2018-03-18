<?php
class Target_Detailer extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function get_perbulan($id, $id_outlet, $id_produk, $column = '*')
    {
        $this->db->select($column);
        $this->db->where('id_detailer', $id);
        $this->db->where('id_outlet', $id_outlet);
        $this->db->where('id_produk', $id_produk);
        $this->db->where('tahun', $this->session->userdata('tahun'));
        $this->db->where('hapus', null);
        $result = $this->db->get('v_target_detailer_perbulan');
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
