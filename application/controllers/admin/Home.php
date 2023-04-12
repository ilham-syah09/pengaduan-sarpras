<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
            'title'  => 'Dashboard Admin',
            'navbar' => 'admin/navbar',
            'page'   => 'admin/dashboard',
            'user'   => $this->admin->getCount('user'),
            'aduan'  => $this->admin->getCount('pengaduan'),
            'plot'   => $this->admin->getCount('plotPengaduan'),
            'report' => $this->admin->getCount('report'),
            'userGrafik' => $this->admin->getUserGrafik(),
            'aduanGrafik' => $this->admin->getAduanGrafik(),
            'aduanTodayGrafik' => $this->admin->getAduanGrafik([
                'tanggal' => date('Y-m-d')
            ]),
        ];

        $this->load->view('index', $data);
    }

    public function realtimeNotif()
    {
        $data = $this->admin->getCountAduan();

        $data = [
            'notif'  => $data
        ];

        echo json_encode($data);
    }
}

/* End of file Home.php */