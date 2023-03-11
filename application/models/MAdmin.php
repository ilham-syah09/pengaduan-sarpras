<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MAdmin extends CI_Model
{
	public function getAllUser()
	{
		$this->db->order_by('level, nama', 'asc');

		return $this->db->get('user')->result();
	}

	public function getCount($tabel)
	{
		return $this->db->get($tabel)->num_rows();
	}

	public function getUserGrafik()
	{
		$this->db->select('COUNT(id) as total, level');
		$this->db->group_by('level');

		return $this->db->get('user')->result();
	}

	public function getAduanGrafik()
	{
		$this->db->select('COUNT(pengaduan.id) as total, plotPengaduan.status as status');
		$this->db->join('plotPengaduan', 'plotPengaduan.idPengaduan = pengaduan.id', 'left');

		$this->db->group_by('plotPengaduan.status');

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

		$this->db->order_by('plotPengaduan.status', 'asc');

		return $this->db->get('plotPengaduan')->result();
	}

	public function getReportPengaduan()
	{
		$this->db->select('pengaduan.judulAduan, pengaduan.kendala, report.*, user.nama');
		$this->db->join('pengaduan', 'pengaduan.id = report.idPengaduan', 'inner');
		$this->db->join('user', 'user.id = report.idUser', 'inner');

		$this->db->order_by('report.id', 'desc');

		return $this->db->get('report')->result();
	}
}

/* End of file MAdmin.php */
