<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MAdmin extends CI_Model
{
	public function getAllUser()
	{
		$this->db->order_by('level, nama', 'asc');

		return $this->db->get('user')->result();
	}

	public function getAllKategori()
	{
		$this->db->order_by('namaKategori');

		return $this->db->get('kategori')->result();
	}
}

/* End of file MAdmin.php */
