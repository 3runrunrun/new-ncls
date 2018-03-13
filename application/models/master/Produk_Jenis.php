<?php
class Produk_Jenis extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    
    public function store($data = array())
    {
        $query = $this->db->set($data)->get_compiled_insert('produk_jenis');
        $this->db->query($query);
    }

    public function update($id, $data = array())
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $query = $this->db->get_compiled_insert('produk_jenis');
        $this->db->query($query);
    }
    
    public function destroy($id)
    {
        $this->db->set('hapus', date('Y-m-d'));
        $this->db->where('id', $id);
        $query = $this->db->get_compiled_insert('produk_jenis');
        $this->db->query($query);
    }
}
