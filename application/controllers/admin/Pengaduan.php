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

	public function index($tanggal_awal = NULL, $tanggal_akhir = NULL)
	{
		if ($tanggal_awal > $tanggal_akhir) {
			$this->session->set_flashdata('toastr-error', 'Tanggal awal tidak boleh melebihi tanggal akhir !');

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}

		if ($tanggal_awal == null && $tanggal_akhir == null) {
			$pengaduan = $this->admin->getPengaduan();
		} else {
			$pengaduan = $this->admin->getPengaduan([
				'pengaduan.tanggal >=' => $tanggal_awal,
				'pengaduan.tanggal <=' => $tanggal_akhir
			]);
		}

		$data = [
			'title'         => 'Pengaduan',
			'navbar'        => 'admin/navbar',
			'page'          => 'admin/pengaduan',
			'pengaduan'     => $pengaduan,
			'teknisi'       => $this->admin->getTeknisi(),
			'notif'         => $this->admin->getCountAduan(),
			'tanggal_awal'  => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir
		];

		$this->load->view('index', $data);
	}

	public function status()
	{
		$data = [
			'status' => $this->input->post('status'),
			'ditanggapi' => date('Y-m-d')
		];

		$this->db->where('id', $this->input->post('idPengaduan'));
		$update = $this->db->update('pengaduan', $data);

		if ($update) {
			if ($data['status'] != 1) {
				$this->db->where('idPengaduan', $this->input->post('idPengaduan'));
				$this->db->delete('report');
				$this->db->where('idPengaduan', $this->input->post('idPengaduan'));
				$this->db->delete('plotPengaduan');
			}

			$this->session->set_flashdata('toastr-success', 'Data berhasil diedit');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal diedit');
		}

		redirect('admin/pengaduan', 'refresh');
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

		redirect('admin/pengaduan', 'refresh');
	}

	public function plot()
	{
		$data = [
			'idPengaduan' => $this->input->post('idPengaduan'),
			'idUser'      => $this->input->post('idUser'),
			'urgensi'     => $this->input->post('urgensi')
		];

		$this->db->where([
			'idPengaduan' => $this->input->post('idPengaduan'),
			'idUser'      => $this->input->post('idUser'),
		]);
		$cek = $this->db->get('plotPengaduan')->row();

		if (!$cek) {
			$insert = $this->db->insert('plotPengaduan', $data);

			if ($insert) {
				$this->session->set_flashdata('toastr-success', 'Data berhasil ditambahkan');
			} else {
				$this->session->set_flashdata('toastr-error', 'Data gagal ditambahkan');
			}
		} else {
			$this->session->set_flashdata('toastr-error', 'Data sudah ditambahkan');
		}

		redirect('admin/pengaduan', 'refresh');
	}
}

/* End of file pengaduan.php */