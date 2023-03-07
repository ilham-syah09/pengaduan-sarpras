<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MTeknisi extends CI_Model
{
	public function getPlotPengaduan($where)
	{
		$this->db->select('plotPengaduan.*, pengaduan.judulAduan, pengaduan.kendala, pengaduan.gambar');
		$this->db->join('pengaduan', 'pengaduan.id = plotPengaduan.idPengaduan', 'inner');

		$this->db->where($where);

		$this->db->order_by('plotPengaduan.status', 'asc');

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
}

/* End of file MTeknisi.php */
