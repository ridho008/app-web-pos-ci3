<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		// cekMenu();
		$this->load->library('form_validation');
		$this->load->model('Categories_model');
		// if($this->session->userdata('level') == 'user') {
		// 	redirect('user/dashboard');
		// }
	}

	public function index()
	{
		$data['title'] = 'Categories';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['categories'] = $this->db->get('categories')->result_array();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/categories/index', $data);
		$this->load->view('layout/footer');
	}

	public function formCategori()
	{
		$this->form_validation->set_rules('name', 'Name Categori', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->Categories_model->addCategori();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Categori Berhasil Ditambahkan.</div>');
			redirect('categories');
		}
	}

	public function delete($id)
	{
		$this->db->where('id_categori', $id);
		$this->db->delete('categories');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-trash"></i> Data Categori <strong>Berhasil Dihapus.</strong></div>');
		redirect('categories');
	}

	public function getUbahCategori()
	{
		echo json_encode($this->Categories_model->getCategoriById($_POST['id']));
	}

	public function formUbahCategori()
	{
		$this->Categories_model->EditCategori($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-info-circle"></i> Data Categori <strong>Berhasil Diubah.</strong></div>');
		redirect('categories');
	}


}
