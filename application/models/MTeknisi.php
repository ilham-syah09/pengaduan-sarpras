<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MTeknisi extends CI_Model
{
	public function getCountPengaduan($where)
	{
		$this->db->join('pengaduan', 'pengaduan.id = plotPengaduan.idPengaduan', 'inner');

		$this->db->where($where);

		return $this->db->get('plotPengaduan')->num_rows();
	}

	public function getCountReport($where)
	{
		$this->db->where($where);

		return $this->db->get('report')->num_rows();
	}

	public function getAduanGrafik($where)
	{
		$this->db->select('COUNT(pengaduan.id) as total, pengaduan.status as status');
		$this->db->join('plotPengaduan', 'plotPengaduan.idPengaduan = pengaduan.id', 'inner');

		$this->db->where($where);

		$this->db->group_by('plotPengaduan.status');

		return $this->db->get('pengaduan')->result();
	}

	public function getPlotPengaduan($where)
	{
		$this->db->select('plotPengaduan.*, pengaduan.judulAduan, pengaduan.kendala, pengaduan.gambar');
		$this->db->join('pengaduan', 'pengaduan.id = plotPengaduan.idPengaduan', 'inner');

		$this->db->where($where);

		$this->db->order_by('plotPengaduan.id', 'desc');

		return $this->db->get('plotPengaduan')->result();
	}

	public function getReportPengaduan($where)
	{
		$this->db->select('pengaduan.judulAduan, pengaduan.kendala, report.*');
		$this->db->join('pengaduan', 'pengaduan.id = report.idPengaduan', 'inner');

		$this->db->where($where);

		$this->db->order_by('report.id', 'desc');

		return $this->db->get('report')->result();
	}

	public function getCountAduan($where)
	{
		$this->db->join('plotPengaduan', 'plotPengaduan.idPengaduan = pengaduan.id', 'left');

		$this->db->where($where);
		$this->db->where('pengaduan.status', 0);

		return $this->db->get('pengaduan')->num_rows();
	}
}

/* End of file MTeknisi.php */
