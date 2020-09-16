<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Page Login';
		$this->cekLogin();
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');

		if($this->form_validation->run() == FALSE) {
			$this->load->view('auth/login', $data);
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$username = htmlspecialchars($this->input->post('username', true));
		$password = sha1($this->input->post('password', true));

		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if($user != null) {
			if($password == $user['password']) {
			$data = [
				'id_user' => $user['id_user'],
				'username' => $user['username'],
				'level' => $user['level']
			];
			$this->session->set_userdata($data);
			
			if($user['level'] == 'admin') {
				redirect('dashboard');
			} else {
				redirect('user/dashboard');
			}

			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password anda salah!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Username belum didaftar!</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Success logout!</div>');
		redirect('auth');
	}

	public function cekLogin()
	{
		if($this->session->userdata('level') == 'admin') {
			redirect('dashboard');
		} else if($this->session->userdata('level') == 'user') {
			redirect('user/dashboard');
		}
	}


}
