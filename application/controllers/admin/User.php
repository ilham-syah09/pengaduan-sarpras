<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
			'title'  => 'Management User',
			'navbar' => 'admin/navbar',
			'page'   => 'admin/user',
			'user'   => $this->admin->getAllUser(),
			'notif'  => $this->admin->getCountAduan(),
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'nama'     => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'password' => password_hash('user123', PASSWORD_BCRYPT, ['const' => 14]),
			'level'    => $this->input->post('level')
		];

		$insert = $this->db->insert('user', $data);

		if ($insert) {
			$this->session->set_flashdata('toastr-success', 'Data berhasil ditambahkan');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal ditambahkam');
		}

		redirect('admin/user', 'refresh');
	}

	public function edit()
	{
		$data = [
			'level'    => $this->input->post('level'),
			'nama'     => $this->input->post('nama'),
			'username' => $this->input->post('username')
		];

		$this->db->where('id', $this->input->post('idUser'));
		$update = $this->db->update('user', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-success', 'Data berhasil diedit');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal diedit');
		}

		redirect('admin/user', 'refresh');
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('user')->row();

		$this->db->where('id', $id);
		$delete = $this->db->delete('user');

		if ($delete) {
			if ($data->image != 'default.png') {
				unlink(FCPATH . 'uploads/profiles/' . $data->image);
			}

			$this->session->set_flashdata('toastr-success', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal dihapus!!');
		}

		redirect('admin/user', 'refresh');
	}
}

/* End of file User.php */