<?php

function cekSession()
{
	$ci = get_instance();
	if(!$ci->session->userdata('level') == 'admin') {
		redirect('auth');
	} else if(!$ci->session->userdata('level') == 'user') {
		redirect('auth');
	}
}

function cekMenu()
{
	$ci = get_instance();
	if($ci->session->userdata('level') == 'user') {
		redirect('user/dashboard');
	}
}
