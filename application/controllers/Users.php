<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		$this->load->library('form_validation');
		$this->load->model('User_model');
		if($this->session->userdata('level') == 'user') {
			redirect('user/dashboard');
		}
	}

	public function index()
	{
		$data['title'] = 'Users';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		// Menghilangkan data admin di list table user
		$this->db->where('id_user >', '1');
		$data['users'] = $this->db->get('users')->result_array();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/index', $data);
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
		$result = $this->db->get_where('users', ['id_user' => $id])->row_array();
		$foto = $result['photo'];
		unlink('./assets/img/user/' . $foto);
		$this->db->where('id_user', $id);
		$this->db->delete('users');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-trash"></i> Data User <strong>Berhasil Dihapus.</strong></div>');
		redirect('users');
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
