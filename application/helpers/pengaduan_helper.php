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

function cekPlot($id)
{
	$CI = &get_instance();

	$CI->db->where('idPengaduan', $id);
	$report = $CI->db->get('plotPengaduan')->row();

	if ($report) {
		return true;
	} else {
		return false;
	}
}

function nama($id)
{
	$CI = &get_instance();

	$CI->db->where('id', $id);
	$data = $CI->db->get('user')->row();

	if ($data->nama) {
		return $data->nama;
	} else {
		return false;
	}
}
