<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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
			'title'    => 'Kategori Pengaduan',
			'navbar'   => 'admin/navbar',
			'page'     => 'admin/kategori',
			'kategori' => $this->admin->getAllKategori()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'namaKategori'     => $this->input->post('namaKategori')
		];

		$insert = $this->db->insert('kategori', $data);

		if ($insert) {
			$this->session->set_flashdata('toastr-success', 'Data berhasil ditambahkan');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal ditambahkam');
		}

		redirect('admin/kategori', 'refresh');
	}

	public function edit()
	{
		$data = [
			'namaKategori'     => $this->input->post('namaKategori')
		];

		$this->db->where('id', $this->input->post('idKategori'));
		$update = $this->db->update('kategori', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-success', 'Data berhasil diedit');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal diedit');
		}

		redirect('admin/kategori', 'refresh');
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('kategori');

		if ($delete) {
			$this->session->set_flashdata('toastr-success', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal dihapus!!');
		}

		redirect('admin/kategori', 'refresh');
	}
}

/* End of file Kategori.php */