<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		// cekMenu();
		$this->load->library('form_validation');
		$this->load->model('Stock_model');
		$this->load->model('P_Item_model');
		// if($this->session->userdata('level') == 'user') {
		// 	redirect('user/dashboard');
		// }
	}

	public function index()
	{
		$data['title'] = 'Stock In';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['suppliers'] = $this->db->get('suppliers')->result_array();
		$data['item'] = $this->P_Item_model->joinPitemCateUnit();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/transaction/stock_in/index', $data);
		$this->load->view('layout/footer');
	}

	public function process()
	{
		$this->form_validation->set_rules('id_pitem', 'Id Item', 'required|trim');
		$this->form_validation->set_rules('date', 'Date', 'required|trim');
		$this->form_validation->set_rules('barcode', 'Barcode', 'required|trim');
		$this->form_validation->set_rules('name_pitem', 'Name Item', 'required|trim');
		$this->form_validation->set_rules('name_unit', 'Name Unit', 'required|trim');
		$this->form_validation->set_rules('stock', 'Stock', 'required|trim');
		$this->form_validation->set_rules('detail', 'Detail', 'required|trim');
		$this->form_validation->set_rules('supplier', 'Supplier', 'required|trim');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->Stock_model->addStockIn();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Stock In Berhasil Ditambahkan.</div>');
			redirect('stock/in');
		}
	}

	


}
