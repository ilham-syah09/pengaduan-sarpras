<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plot extends CI_Controller
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
			'title'  => 'Plot Pengaduan',
			'navbar' => 'teknisi/navbar',
			'page'   => 'teknisi/plot',
			'notif'  => $this->teknisi->getCountAduan(['plotPengaduan.idUser' => $this->dt_user->id]),
			'plot'   => $this->teknisi->getPlotPengaduan(['plotPengaduan.idUser' => $this->dt_user->id])
		];

		$this->load->view('index', $data);
	}

	public function status()
	{
		$data = [
			'status' => $this->input->post('status')
		];

		$this->db->where('id', $this->input->post('idPlot'));
		$update = $this->db->update('plotPengaduan', $data);

		if ($update) {
			if ($data['status'] == 2) {
				$this->db->where('idPlot', $this->input->post('idPlot'));
				$this->db->delete('report');
			}

			$this->db->select('idPengaduan');
			$this->db->where('id', $this->input->post('idPlot'));

			$plot = $this->db->get('plotPengaduan')->row();

			$this->db->where('id', $plot->idPengaduan);
			$this->db->update('pengaduan', $data);

			$this->session->set_flashdata('toastr-success', 'Data berhasil diedit');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal diedit');
		}

		redirect('teknisi/plot', 'refresh');
	}

	public function report()
	{
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

				$data = [
					'idUser'          => $this->dt_user->id,
					'idPlot'          => $this->input->post('idPlot'),
					'idPengaduan'     => $this->input->post('idPengaduan'),
					'solusi'          => $this->input->post('solusi'),
					'rincian'         => $this->input->post('rincian'),
					'tanggal_mulai'   => $this->input->post('tanggal_mulai'),
					'jam_mulai'       => $this->input->post('jam_mulai'),
					'tanggal_selesai' => $this->input->post('tanggal_selesai'),
					'jam_selesai'     => $this->input->post('jam_selesai'),
					'gambar'          => $upload_data['file_name']
				];

				$insert = $this->db->insert('report', $data);
			}
		} else {
			$data = [
				'idUser'          => $this->dt_user->id,
				'idPlot'          => $this->input->post('idPlot'),
				'idPengaduan'     => $this->input->post('idPengaduan'),
				'solusi'          => $this->input->post('solusi'),
				'rincian'         => $this->input->post('rincian'),
				'tanggal_mulai'   => $this->input->post('tanggal_mulai'),
				'jam_mulai'       => $this->input->post('jam_mulai'),
				'tanggal_selesai' => $this->input->post('tanggal_selesai'),
				'jam_selesai'     => $this->input->post('jam_selesai'),
			];

			$insert = $this->db->insert('report', $data);
		}

		if ($insert) {
			$this->db->where('id', $this->input->post('idPlot'));
			$this->db->update('plotPengaduan', [
				'status' => 1
			]);

			$this->db->select('idPengaduan');
			$this->db->where('id', $this->input->post('idPlot'));

			$plot = $this->db->get('plotPengaduan')->row();

			$this->db->where('id', $plot->idPengaduan);
			$this->db->update('pengaduan', [
				'status' => 1
			]);

			$this->session->set_flashdata('toastr-success', 'Data berhasil ditambahkan');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal ditambahkan');
		}

		redirect('teknisi/plot', 'refresh');
	}
}

/* End of file Plot.php */