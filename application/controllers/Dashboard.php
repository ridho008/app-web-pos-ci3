<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		if($this->session->userdata('level') == 'user') {
			redirect('user/dashboard');
		}
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['customers'] = $this->db->get('customers')->num_rows();
		$data['suppliers'] = $this->db->get('suppliers')->num_rows();
		$data['pitem'] = $this->db->get('product_item')->num_rows();
		$data['users'] = $this->db->get('users')->num_rows();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('layout/footer');
	}
}
