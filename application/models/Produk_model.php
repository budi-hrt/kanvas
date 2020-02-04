<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_model
{
    public function get_all()
    {
        $this->db->where('is_active', 1);
        $query =  $this->db->get('produk');
        return $query;
    }
}
