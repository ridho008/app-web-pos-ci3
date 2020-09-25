<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		// cekMenu();
		$this->load->library('form_validation');
		$this->load->model('Sale_model');
		// if($this->session->userdata('level') == 'user') {
		// 	redirect('user/dashboard');
		// }
	}

	public function index()
	{
		$data['title'] = 'Sale';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['customers'] = $this->db->get('customers')->result_array();
		$data['invoice'] = $this->Sale_model->invoice_nomor();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/sale/index', $data);
		$this->load->view('layout/footer');
	}

	


}
