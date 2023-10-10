<?php
class Return_Model extends CI_Model
{
    public function addReturn($data)
    {
        $this->db->insert('tbl_return', $data);
        return $this->db->insert_id();
    }
    public function getDataReturn() {
        $query = $this->db->get('tbl_return');
        return $query->result();
    }
}
