<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('log_admin'))) {
			$this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
			redirect('auth', 'refresh');
		}

		$this->db->where('id', $this->session->userdata('id'));
		$this->dt_user = $this->db->get('user')->row();

		$this->load->model('MAdmin', 'admin');
	}

	public function index($tanggal_awal = NULL, $tanggal_akhir = NULL)
	{
		if ($tanggal_awal > $tanggal_akhir) {
			$this->session->set_flashdata('toastr-error', 'Tanggal awal tidak boleh melebihi tanggal akhir !');

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}

		if ($tanggal_awal == null && $tanggal_akhir == null) {
			$report = $this->admin->getReportFilter();
		} else {
			$report = $this->admin->getReportFilter([
				'report.tanggal_mulai >=' => $tanggal_awal,
				'report.tanggal_mulai <=' => $tanggal_akhir
			]);
		}

		$data = [
			'title'   => 'Report Pengaduan',
			'navbar'  => 'admin/navbar',
			'page'    => 'admin/report',
			// 'report'    => $this->admin->getReportPengaduan(),
			'notif'  => $this->admin->getCountAduan(),
			'report' => $report,
			'tanggal_awal'  => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir
		];

		$this->load->view('index', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('report')->row();

		$this->db->where('id', $id);
		$delete = $this->db->delete('report');

		if ($delete) {
			if ($data->gambar != null) {
				unlink(FCPATH . 'upload/report/' . $data->gambar);
			}

			$this->db->where('id', $data->idPlot);
			$this->db->update('plotPengaduan', [
				'status' => 0
			]);

			$this->session->set_flashdata('toastr-success', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal dihapus!!');
		}

		redirect('admin/report', 'refresh');
	}
}

/* End of file Report.php */