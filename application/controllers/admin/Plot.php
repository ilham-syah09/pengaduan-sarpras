<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plot extends CI_Controller
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
			'title'   => 'Plot Pengaduan',
			'navbar'  => 'admin/navbar',
			'page'    => 'admin/plot',
			'plot'    => $this->admin->getPlotPengaduan(),
			'teknisi' => $this->admin->getTeknisi()
		];

		$this->load->view('index', $data);
	}

	public function edit()
	{
		$data = [
			'idUser' => $this->input->post('idUser'),
			'urgensi' => $this->input->post('urgensi'),
		];

		$this->db->where('id', $this->input->post('idPlot'));
		$update = $this->db->update('plotPengaduan', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-success', 'Data berhasil diedit');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal diedit');
		}

		redirect('admin/plot', 'refresh');
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('pengaduan')->row();

		$this->db->where('id', $id);
		$delete = $this->db->delete('pengaduan');

		if ($delete) {
			if ($data->gambar != null) {
				unlink(FCPATH . 'upload/pengaduan/' . $data->gambar);
			}

			$this->session->set_flashdata('toastr-success', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal dihapus!!');
		}

		redirect('admin/pengaduan', 'refresh');
	}
}

/* End of file Plot.php */