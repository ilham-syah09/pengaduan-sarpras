<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
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
        $this->form_validation->set_rules('tentang', 'Tentanf', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $data = [
                'title'   => 'Setting',
                'navbar'  => 'admin/navbar',
                'page'    => 'admin/setting',
                'setting' => $this->admin->getSetting()
            ];

            $this->load->view('index', $data);
        } else {
            $data = [
                'tentang'   => $this->input->post('tentang'),
            ];

            $this->db->where('id', $this->input->post('id'));
            $update = $this->db->update('setting', $data);
            if ($update) {
                $this->session->flashdata('toastr-success', 'setting berhasil di edit');
                redirect('admin/setting');
            } else {
                $this->session->flashdata('toastr-error', 'setting gagal di edit');
                redirect('admin/setting');
            }
        }
    }
}

/* End of file Setting.php */
