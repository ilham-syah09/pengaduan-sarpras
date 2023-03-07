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

	public function index()
	{
		$data = [
			'title'   => 'Report Pengaduan',
			'navbar'  => 'admin/navbar',
			'page'    => 'admin/report',
			'report'    => $this->admin->getReportPengaduan()
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