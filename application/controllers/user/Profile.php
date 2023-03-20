<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
            'title'   => 'Profile',
            'navbar'  => 'user/navbar',
            'page'    => 'user/profile',
            'notif'  => $this->user->getCountAduan(),
        ];

        $this->load->view('index', $data);
    }

    public function updateProfile()
    {
        $foto = $_FILES['foto']['name'];

        if ($foto) {

            $config['upload_path']   = 'upload/profile';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 5000;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('toastr-eror', $this->upload->display_errors());
                redirect('user/profile', 'refresh');
            } else {
                $upload_data = $this->upload->data();
                $data = [
                    'foto'     => $upload_data['file_name'],
                ];

                $this->db->where('id', $this->dt_user->id);
                $update = $this->db->update('user', $data);

                if ($update) {
                    if ($this->dt_user->foto != 'default.png') {
                        unlink(FCPATH . 'upload/profile/' . $this->dt_user->foto);
                    }
                    echo 'sukses';
                    redirect('user/profile', 'refresh');
                } else {
                    echo 'failed';
                    redirect('user/profile', 'refresh');
                }
            }
        }
    }

    public function changePassword()
    {
        $old = $this->input->post('current_password');
        $hash = $this->dt_user->password;

        if (password_verify('user123', $hash)) {

            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('retype_password', 'Retype Password', 'trim|required|matches[password]');


            if ($this->form_validation->run() == FALSE) {
                echo 'isi semua data';
            } else {

                $data = [
                    'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
                ];

                $this->db->where('id', $this->dt_user->id);
                $update = $this->db->update('user', $data);

                if ($update) {
                    echo 'sukses';
                    redirect('user/profile', 'refresh');
                } else {
                    echo 'failed';
                    redirect('user/profile', 'refresh');
                }
            }
        } else if (password_verify($old, $this->dt_user->password)) {
            $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('retype_password', 'Retype Password', 'trim|required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                echo 'isi semua data';
            } else {

                $data = [
                    'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
                ];

                $this->db->where('id', $this->dt_user->id);
                $update = $this->db->update('user', $data);

                if ($update) {
                    echo 'sukses';
                    redirect('user/profile', 'refresh');
                } else {
                    echo 'failed';
                    redirect('user/profile', 'refresh');
                }
            }
        } else {
            echo 'failed current pass salah';
            redirect('user/profile', 'refresh');
        }
    }
}

/* End of file Profile.php */
