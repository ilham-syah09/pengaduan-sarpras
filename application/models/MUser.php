<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MUser extends CI_Model
{
	public function getPengaduan($where)
	{
		$this->db->where($where);
		$this->db->order_by('tanggal', 'desc');

		return $this->db->get('pengaduan')->result();
	}
}

/* End of file MUser.php */
