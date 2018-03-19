<?php
class Entry_Breakdown extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function get_general($column = '*')
    {
        $query = "SELECT 
                a.id,
                b.id_user,
                b.nama_user,
                a.tanggal,
                SUM(c.jumlah * d.harga_master) as value
            FROM sales_customer a
            JOIN v_wpr_detail b ON a.id_wpr = b.id_wpr
            JOIN sales_customer_detail c ON a.id = c.id_sc
            JOIN produk_harga d ON c.id_produk = d.id_produk
            WHERE a.hapus IS NULL
            AND a.tahun = ?
            GROUP BY a.id";
        $bind_param = array($this->session->userdata('tahun'));
        $result = $this->db->query($query, $bind_param);
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

    public function get_per_product($column = '*')
    {
        $query = "SELECT 
                b.id_produk,
                d.nama as nama_produk,
                SUM(b.jumlah) as jumlah,
                (SUM(b.jumlah * c.harga_master)) as value
            FROM sales_customer a
            JOIN sales_customer_detail b ON a.id = b.id_sc
            JOIN produk_harga c ON b.id_produk = c.id_produk
            JOIN produk d ON b.id_produk = d.id
            WHERE a.hapus IS NULL
            AND a.tahun = ?
            GROUP BY b.id_produk";
        $bind_param = array($this->session->userdata('tahun'));
        $result = $this->db->query($query, $bind_param);
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

    public function show_general($id, $column = '*')
    {
        $this->db->select($column);
        $this->db->where('id', $id);
        $this->db->where('tahun', $this->session->userdata('tahun'));
        $this->db->where('hapus', null);
        $result = $this->db->get('v_breakdown_detail');
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

    public function show_detail($id, $column = '*')
    {
        $this->db->select($column);
        $this->db->where('id', $id);
        $this->db->where('tahun', $this->session->userdata('tahun'));
        $this->db->where('hapus', null);
        $result = $this->db->get('v_breakdown');
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
