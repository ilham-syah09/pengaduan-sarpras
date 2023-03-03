<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pengaduan extends CI_Controller
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
			'title'   => 'Pengaduan',
			'navbar'  => 'admin/navbar',
			'page'    => 'admin/pengaduan',
			'pengaduan' => $this->admin->getPengaduan()
		];

		$this->load->view('index', $data);
	}
}

/* End of file pengaduan.php */