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

	public function formUser()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');
		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->User_model->addUser();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data User Berhasil Ditambahkan.</div>');
			redirect('users');
		}
	}

	public function delete($id)
	{
		$this->db->where('id_supplier', $id);
		$this->db->delete('suppliers');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-trash"></i> Data Supplier <strong>Berhasil Dihapus.</strong></div>');
		redirect('suppliers');
	}

	public function getUbahUser()
	{
		echo json_encode($this->User_model->getUserById($_POST['id']));
	}

	public function formUbah()
	{
		$this->User_model->EditUser($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-trash"></i> Data User <strong>Berhasil Diubah.</strong></div>');
		redirect('users');
	}


}
