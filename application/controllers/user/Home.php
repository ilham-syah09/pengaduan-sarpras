<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
			'title'   => 'Dashboard User',
			'navbar'  => 'user/navbar',
			'page'    => 'user/dashboard',
			'aduan'  => $this->user->getCountPengaduan(['idUser' => $this->dt_user->id]),
			'report' => $this->user->getCountReport(['pengaduan.idUser' => $this->dt_user->id]),
			'aduanGrafik' => $this->user->getAduanGrafik([
				'pengaduan.idUser' => $this->dt_user->id
			]),
		];

		$this->load->view('index', $data);
	}
}

/* End of file Home.php */