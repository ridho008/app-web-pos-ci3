<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		// cekMenu();
		$this->load->library('form_validation');
		$this->load->model('Customers_model');
		// if($this->session->userdata('level') == 'user') {
		// 	redirect('user/dashboard');
		// }
	}

	public function index()
	{
		$data['title'] = 'Customers';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['customers'] = $this->db->get('customers')->result_array();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/customers/index', $data);
		$this->load->view('layout/footer');
	}

	public function formCustomer()
	{
		$this->form_validation->set_rules('name', 'Name Customer', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('phone', 'Phone', 'required|trim');
		$this->form_validation->set_rules('gender', 'Gender', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->Customers_model->addCustomer();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Customer Berhasil Ditambahkan.</div>');
			redirect('customers');
		}
	}

	public function delete($id)
	{
		$this->db->where('id_customer', $id);
		$this->db->delete('customers');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-trash"></i> Data Customer <strong>Berhasil Dihapus.</strong></div>');
		redirect('customers');
	}

	public function getUbahCustomer()
	{
		echo json_encode($this->Customers_model->getCustomerById($_POST['id']));
	}

	public function formUbahCustomer()
	{
		$this->Customers_model->EditCustomer($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-trash"></i> Data Customer <strong>Berhasil Diubah.</strong></div>');
		redirect('customers');
	}


}
