<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MUser extends CI_Model
{
	public function getCountPengaduan($where)
	{
		$this->db->where($where);

		return $this->db->get('pengaduan')->num_rows();
	}

	public function getCountReport($where)
	{
		$this->db->join('plotPengaduan', 'plotPengaduan.idpengaduan = pengaduan.id', 'inner');
		$this->db->join('report', 'report.idPlot = plotPengaduan.id', 'inner');

		$this->db->where($where);

		return $this->db->get('pengaduan')->num_rows();
	}

	public function getAduanGrafik($where)
	{
		$this->db->select('COUNT(pengaduan.id) as total, plotPengaduan.status as status');
		$this->db->join('plotPengaduan', 'plotPengaduan.idPengaduan = pengaduan.id', 'left');

		$this->db->where($where);

		$this->db->group_by('plotPengaduan.status');

		return $this->db->get('pengaduan')->result();
	}

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
