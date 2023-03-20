<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
			'title'   => 'Dashboard Teknisi',
			'navbar'  => 'teknisi/navbar',
			'page'    => 'teknisi/dashboard',
			'notif'  => $this->teknisi->getCountAduan(['plotPengaduan.idUser' => $this->dt_user->id]),
			'aduan'  => $this->teknisi->getCountPengaduan(['plotPengaduan.idUser' => $this->dt_user->id]),
			'report' => $this->teknisi->getCountReport(['idUser' => $this->dt_user->id]),
			'aduanGrafik' => $this->teknisi->getAduanGrafik([
				'plotPengaduan.idUser' => $this->dt_user->id
			]),
		];

		$this->load->view('index', $data);
	}
}

/* End of file Home.php */