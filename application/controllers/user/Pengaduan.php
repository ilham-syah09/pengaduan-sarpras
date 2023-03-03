<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('log_user'))) {
			$this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
			redirect('auth', 'refresh');
		}

		$this->db->where('id', $this->session->userdata('id'));
		$this->dt_user = $this->db->get('user')->row();

		$this->load->model('MUser', 'user');
	}

	public function index()
	{
		$data = [
			'title'     => 'Pengaduan',
			'navbar'    => 'user/navbar',
			'page'      => 'user/pengaduan',
			'pengaduan' => $this->user->getPengaduan([
				'idUser' => $this->dt_user->id
			])
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$gambar = $_FILES['gambar']['name'];

		if ($gambar) {
			$this->load->library('upload');
			$config['upload_path']   = './upload/pengaduan';
			$config['allowed_types'] = 'jpg|jpeg|png';
			// $config['max_size']             = 3072; // 3 mb
			$config['remove_spaces'] = TRUE;
			$config['detect_mime']   = TRUE;
			$config['encrypt_name']  = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('gambar')) {
				$this->session->set_flashdata('toastr-error', $this->upload->display_errors());

				redirect('user/pengaduan', 'refresh');
			} else {
				$upload_data = $this->upload->data();

				$data = [
					'idUser'     => $this->dt_user->id,
					'judulAduan' => $this->input->post('judulAduan'),
					'kendala'    => $this->input->post('kendala'),
					'tanggal'    => date('Y-m-d'),
					'gambar'     => $upload_data['file_name']
				];

				$insert = $this->db->insert('pengaduan', $data);
			}
		} else {
			$data = [
				'idUser'     => $this->dt_user->id,
				'judulAduan' => $this->input->post('judulAduan'),
				'kendala'    => $this->input->post('kendala'),
				'tanggal'    => date('Y-m-d')
			];

			$insert = $this->db->insert('pengaduan', $data);
		}

		if ($insert) {
			$this->session->set_flashdata('toastr-success', 'Data berhasil ditambahkan');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal ditambahkan');
		}

		redirect('user/pengaduan', 'refresh');
	}

	public function edit()
	{
		$id = $this->input->post('idPengaduan');

		$gambar = $_FILES['gambar']['name'];

		if ($gambar) {
			$this->load->library('upload');
			$config['upload_path']   = './upload/pengaduan';
			$config['allowed_types'] = 'jpg|jpeg|png';
			// $config['max_size']             = 3072; // 3 mb
			$config['remove_spaces'] = TRUE;
			$config['detect_mime']   = TRUE;
			$config['encrypt_name']  = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('gambar')) {
				$this->session->set_flashdata('toastr-error', $this->upload->display_errors());

				redirect('user/pengaduan', 'refresh');
			} else {
				$upload_data = $this->upload->data();

				$this->db->where('id', $id);
				$data = $this->db->get('pengaduan')->row();

				if ($data->gambar != null) {
					unlink(FCPATH . 'upload/pengaduan/' . $data->gambar);
				}

				$data = [
					'judulAduan' => $this->input->post('judulAduan'),
					'kendala'    => $this->input->post('kendala'),
					'gambar'     => $upload_data['file_name']
				];

				$this->db->where('id', $id);
				$update = $this->db->update('pengaduan', $data);
			}
		} else {
			$data = [
				'judulAduan' => $this->input->post('judulAduan'),
				'kendala'    => $this->input->post('kendala')
			];

			$this->db->where('id', $id);
			$update = $this->db->update('pengaduan', $data);
		}

		if ($update) {
			$this->session->set_flashdata('toastr-success', 'Data berhasil diedit');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal diedit');
		}

		redirect('user/pengaduan', 'refresh');
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

		redirect('user/pengaduan', 'refresh');
	}
}

/* End of file Pengaduan.php */