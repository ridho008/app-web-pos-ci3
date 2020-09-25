<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		// cekMenu();
		$this->load->library('form_validation');
		$this->load->model('Suppliers_model');
		// if($this->session->userdata('level') == 'user') {
		// 	redirect('user/dashboard');
		// }
	}

	public function index()
	{
		$data['title'] = 'Suppliers';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		// Menghilangkan data admin di list table user
		$data['suppliers'] = $this->db->get('suppliers')->result_array();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/suppliers/index', $data);
		$this->load->view('layout/footer');
	}

	public function formSupplier()
	{
		$this->form_validation->set_rules('name', 'Name Supplier', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('phone', 'Phone', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->Suppliers_model->addSupplier();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Supplier Berhasil Ditambahkan.</div>');
			redirect('suppliers');
		}
	}

	public function delete($id)
	{
		$this->db->where('id_supplier', $id);
		$this->db->delete('suppliers');
		$error = $this->db->error();
		// var_dump($error); die;
		if($error['code'] != 0) {
			echo "<script>alert('Tidak Bisa Dihapus');</script>";
		}
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-trash"></i> Data Supplier <strong>Berhasil Dihapus.</strong></div>');
		redirect('suppliers');
	}

	public function getUbahSupplier()
	{
		echo json_encode($this->Suppliers_model->getSupplierById($_POST['id']));
	}

	public function formUbahSupplier()
	{
		$this->Suppliers_model->EditSupplier($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-trash"></i> Data Supplier <strong>Berhasil Diubah.</strong></div>');
		redirect('suppliers');
	}


}
