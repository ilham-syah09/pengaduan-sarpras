<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MUser extends CI_Model
{
	public function getAllKategori()
	{
		$this->db->order_by('namaKategori');

		return $this->db->get('kategori')->result();
	}

	public function getPengaduan($where)
	{
		$this->db->select('pengaduan.*, kategori.namaKategori');
		$this->db->join('kategori', 'kategori.id = pengaduan.idKategori', 'inner');

		$this->db->where($where);
		$this->db->order_by('pengaduan.tanggal', 'desc');

		return $this->db->get('pengaduan')->result();
	}
}

/* End of file MUser.php */
