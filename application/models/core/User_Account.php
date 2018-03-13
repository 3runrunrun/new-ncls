<?php
class User_Account extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function store($data = array())
    {
        $query = $this->db->set($data)->get_compiled_insert('user_account');
        $this->db->query($query);
    }
}
