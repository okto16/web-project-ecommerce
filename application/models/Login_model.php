<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{
    function cekUser($table,$field,$param){
        $this->db->from($table);
        $this->db->where($field,$param);
        $query = $this->db->get();

        if($query->num_rows() == 1){
            return $query->result();
        }else{
            return false;
        }
    }
}