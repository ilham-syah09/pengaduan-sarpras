<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MAdmin extends CI_Model
{
	public function getAllUser()
	{
		$this->db->order_by('level, nama', 'asc');

		return $this->db->get('user')->result();
	}

	public function getCount($tabel, $where = null)
	{
		if ($where) {
			$this->db->where($where);
		}

		return $this->db->get($tabel)->num_rows();
	}

	public function getUserGrafik()
	{
		$this->db->select('COUNT(id) as total, level');
		$this->db->group_by('level');

		return $this->db->get('user')->result();
	}

	public function getAduanGrafik($where = null)
	{
		$this->db->select('COUNT(id) as total, status');

		if ($where) {
			$this->db->where($where);
		}

		$this->db->group_by('status');

		return $this->db->get('pengaduan')->result();
	}

	public function getAllKategori()
	{
		$this->db->order_by('namaKategori');

		return $this->db->get('kategori')->result();
	}

	public function getTeknisi()
	{
		$this->db->where('level', 2);
		$this->db->order_by('nama', 'asc');

		return $this->db->get('user')->result();
	}

	public function getPengaduan()
	{
		$this->db->select('pengaduan.*, kategori.namaKategori, user.nama');
		$this->db->join('kategori', 'kategori.id = pengaduan.idKategori', 'inner');
		$this->db->join('user', 'user.id = pengaduan.idUser', 'inner');

		$this->db->order_by('pengaduan.tanggal', 'desc');

		return $this->db->get('pengaduan')->result();
	}

	public function getPlotPengaduan()
	{
		$this->db->select('plotPengaduan.*, pengaduan.judulAduan, pengaduan.idUser as userId');
		$this->db->join('pengaduan', 'pengaduan.id = plotPengaduan.idPengaduan', 'inner');

		$this->db->order_by('plotPengaduan.id', 'asc');

		return $this->db->get('plotPengaduan')->result();
	}

	public function getReportPengaduan($where)
	{
		$this->db->select('pengaduan.judulAduan, pengaduan.kendala, report.*, user.nama');
		$this->db->join('pengaduan', 'pengaduan.id = report.idPengaduan', 'inner');
		$this->db->join('user', 'user.id = report.idUser', 'inner');
		$this->db->where($where);

		$this->db->order_by('report.id', 'desc');

		return $this->db->get('report')->result();
	}

	public function getReportFilter($where)
	{
		$this->db->select('pengaduan.judulAduan, pengaduan.kendala, report.*, user.nama');
		$this->db->join('pengaduan', 'pengaduan.id = report.idPengaduan', 'inner');
		$this->db->join('user', 'user.id = report.idUser', 'inner');
		$this->db->where($where);
		$this->db->order_by('report.id', 'desc');

		return $this->db->get('report')->result();
	}

	public function getSetting()
	{
		return $this->db->get('setting', 1)->row();
	}

	public function getCountAduan()
	{
		$this->db->where('status', 0);
		return $this->db->get('pengaduan')->num_rows();
	}
}

/* End of file MAdmin.php */
