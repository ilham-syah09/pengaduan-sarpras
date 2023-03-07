<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('log_teknisi'))) {
			$this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
			redirect('auth', 'refresh');
		}

		$this->db->where('id', $this->session->userdata('id'));
		$this->dt_user = $this->db->get('user')->row();

		$this->load->model('MTeknisi', 'teknisi');
	}

	public function index()
	{
		$data = [
			'title'   => 'Report Pengaduan',
			'navbar'  => 'teknisi/navbar',
			'page'    => 'teknisi/report',
			'report'    => $this->teknisi->getReportPengaduan(['report.idUser' => $this->dt_user->id])
		];

		$this->load->view('index', $data);
	}

	public function edit()
	{
		$id = $this->input->post('idReport');

		$gambar = $_FILES['gambar']['name'];

		if ($gambar) {
			$this->load->library('upload');
			$config['upload_path']   = './upload/report';
			$config['allowed_types'] = 'jpg|jpeg|png';
			// $config['max_size']             = 3072; // 3 mb
			$config['remove_spaces'] = TRUE;
			$config['detect_mime']   = TRUE;
			$config['encrypt_name']  = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('gambar')) {
				$this->session->set_flashdata('toastr-error', $this->upload->display_errors());

				redirect('teknisi/plot', 'refresh');
			} else {
				$upload_data = $this->upload->data();

				$this->db->where('id', $id);
				$data = $this->db->get('report')->row();

				if ($data->gambar != null) {
					unlink(FCPATH . 'upload/report/' . $data->gambar);
				}

				$data = [
					'solusi'          => $this->input->post('solusi'),
					'rincian'         => $this->input->post('rincian'),
					'tanggal_mulai'   => $this->input->post('tanggal_mulai'),
					'jam_mulai'       => $this->input->post('jam_mulai'),
					'tanggal_selesai' => $this->input->post('tanggal_selesai'),
					'jam_selesai'     => $this->input->post('jam_selesai'),
					'gambar'          => $upload_data['file_name']
				];

				$this->db->where('id', $id);
				$update = $this->db->update('report', $data);
			}
		} else {
			$data = [
				'solusi'          => $this->input->post('solusi'),
				'rincian'         => $this->input->post('rincian'),
				'tanggal_mulai'   => $this->input->post('tanggal_mulai'),
				'jam_mulai'       => $this->input->post('jam_mulai'),
				'tanggal_selesai' => $this->input->post('tanggal_selesai'),
				'jam_selesai'     => $this->input->post('jam_selesai'),
			];

			$this->db->where('id', $id);
			$update = $this->db->update('report', $data);
		}

		if ($update) {
			$this->session->set_flashdata('toastr-success', 'Data berhasil diedit');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal diedit');
		}

		redirect('teknisi/report', 'refresh');
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

		redirect('teknisi/report', 'refresh');
	}
}

/* End of file Report.php */