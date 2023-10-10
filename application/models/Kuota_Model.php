<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kuota_Model extends CI_Model
{
    function getDataKuota()
    {
        $query = $this->db->get('tbl_kuota_pupuk');
        return $query->result();
    }

    function insertDataKuota($data)
    {
        $this->db->insert('tbl_kuota_pupuk', $data);
    }
    public function getDataKuotaByUserId($userId)
    {
        $this->db->where('Nik', $userId);
        return $this->db->get('tbl_kuota_pupuk')->result();
    }
    function getDataKuotaDetail($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_kuota_pupuk');
        return $query->row();
    }
    function updateDataKuota($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_kuota_pupuk', $data);
    }
    function deleteDataKuota($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_kuota_pupuk');

    }
    public function getKuotaByNikAndProduk($Nik, $idProduk)
    {
        // Ambil kuota produk berdasarkan `nik` dan `idProduk`
        $this->db->select('jumlahKuota');
        $this->db->from('tbl_kuota_pupuk');
        $this->db->where('Nik', $Nik);
        $this->db->where('idProduk', $idProduk);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->jumlahKuota;
        }
        return 0; // Jika tidak ada kuota tersedia
    }

    public function kurangiKuotaByNikAndProduk($Nik, $idProduk, $jumlah)
    {
        // Kurangkan kuota produk berdasarkan `nik` dan `idProduk`
        $this->db->where('Nik', $Nik);
        $this->db->where('idProduk', $idProduk);
        $this->db->set('jumlahKuota', 'jumlahKuota - ' . $jumlah, FALSE);
        $this->db->update('tbl_kuota_pupuk');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE; // Kuota tidak mencukupi
        }
    }
    public function search($keyword)
    {
        $this->db->select('*');
        $this->db->from('tbl_kuota_pupuk');
        $this->db->like('id', $keyword);
        $this->db->or_like('namProduk', $keyword);
        $this->db->or_like('jumlahKuota', $keyword);
        $this->db->or_like('tahun', $keyword);
        return $this->db->get()->result();
    }
}