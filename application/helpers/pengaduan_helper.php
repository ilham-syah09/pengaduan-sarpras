<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

function cekReport($id)
{
	$CI = &get_instance();

	$CI->db->where('idPengaduan', $id);
	$report = $CI->db->get('report')->row();

	if ($report) {
		return $report;
	} else {
		return false;
	}
}
