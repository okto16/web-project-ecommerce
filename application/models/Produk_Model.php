<?php defined('BASEPATH') or exit('No direct script access allowed');

class Produk_Model extends CI_Model
{
    function getDataProduk()
    {
        $query = $this->db->get('tbl_produk');
        return $query->result();
    }

    function insertDataProduk($data)
    {
        $this->db->insert('tbl_produk', $data);
    }

    function getDataProdukDetail($idProduk)
    {
        $this->db->where('idProduk', $idProduk);
        $query = $this->db->get('tbl_produk');
        return $query->row();
    }
    function updateDataProduk($idProduk, $data)
    {
        $this->db->where('idProduk', $idProduk);
        $this->db->update('tbl_produk', $data);
    }
    public function updateStokProduk($idProduk, $newStock) {
        $data = array(
            'stok' => $newStock
        );

        $this->db->where('idProduk', $idProduk);
        $this->db->update('tbl_produk', $data);

        return $this->db->affected_rows() > 0;
    }
    function deleteDataProduk($idProduk)
    {
        $this->db->where('idProduk', $idProduk);
        $this->db->delete('tbl_produk');
    }
    public function getStokById($idProduk)
    {
        $this->db->select('stok');
        $this->db->where('idProduk', $idProduk);
        $query = $this->db->get('tbl_produk');

        if ($query->num_rows() > 0) {
            // Jika data ditemukan, kembalikan stok produk
            $row = $query->row();
            return $row->stok;
        } else {
            // Jika data tidak ditemukan, kembalikan 0 atau nilai yang sesuai
            return 0;
        }
    }
    public function getProductById($idProduk) {
        // Gantilah 'products' dengan nama tabel yang sesuai dalam database Anda
        $this->db->select('*');
        $this->db->from('tbl_produk');
        $this->db->where('idProduk', $idProduk);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null; // Produk tidak ditemukan
        }
    }
    function kurangiStok($idProduk, $jumlahDipesan)
    {
        // Dapatkan informasi produk berdasarkan ID
        $produk = $this->db->get_where('tbl_produk', array('idProduk' => $idProduk))->row();

        if ($produk) {
            // Hitung stok baru
            $stokBaru = $produk->stok - $jumlahDipesan;

            // Update stok produk
            $this->db->where('idProduk', $idProduk);
            $this->db->update('tbl_produk', array('stok' => $stokBaru));
        }
    }
    public function search($keyword) {
        $this->db->select('*'); 
        $this->db->from('tbl_produk');
        $this->db->like('idKat', $keyword);
        $this->db->or_like('namProduk', $keyword);
        $this->db->or_like('harga', $keyword);
        $this->db->or_like('stok', $keyword);
        $this->db->or_like('berat', $keyword);
        return $this->db->get()->result();
    }
    

}
