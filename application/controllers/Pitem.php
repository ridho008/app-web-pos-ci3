<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Product Item
class Pitem extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		// cekMenu();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->model('P_Item_model');
		// if($this->session->userdata('level') == 'user') {
		// 	redirect('user/dashboard');
		// }
	}

	public function index()
	{
		$data['title'] = 'Product Items';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['pitem'] = $this->db->get('product_item')->result_array();
		$data['categories'] = $this->db->get('categories')->result_array();
		$data['units'] = $this->db->get('units')->result_array();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/pitem/index', $data);
		$this->load->view('layout/footer');
	}

	public function formPitem()
	{
		$this->form_validation->set_rules('name', 'Name Customer', 'required|trim');
		$this->form_validation->set_rules('barcode', 'Barcode', 'required|trim|is_unique[product_item.barcode]');
		$this->form_validation->set_rules('price', 'Price', 'required|trim');
		$this->form_validation->set_rules('categori', 'Categori', 'required|trim');
		$this->form_validation->set_rules('unit', 'Unit', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->P_Item_model->addPitem();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Product Item Berhasil Ditambahkan.</div>');
			redirect('pitem');
		}
	}

	


}
