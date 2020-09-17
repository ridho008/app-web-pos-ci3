<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Units extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		// cekMenu();
		$this->load->library('form_validation');
		$this->load->model('Units_model');
		// if($this->session->userdata('level') == 'user') {
		// 	redirect('user/dashboard');
		// }
	}

	public function index()
	{
		$data['title'] = 'Units';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['units'] = $this->db->get('units')->result_array();
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/units/index', $data);
		$this->load->view('layout/footer');
	}

	public function formUnit()
	{
		$this->form_validation->set_rules('name', 'Name Unit', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$this->Units_model->addUnit();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Unit Berhasil Ditambahkan.</div>');
			redirect('units');
		}
	}

	public function delete($id)
	{
		$this->db->where('id_unit', $id);
		$this->db->delete('units');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-trash"></i> Data Unit <strong>Berhasil Dihapus.</strong></div>');
		redirect('units');
	}

	public function getUbahUnit()
	{
		echo json_encode($this->Units_model->getUnitById($_POST['id']));
	}

	public function formUbahUnit()
	{
		$this->Units_model->EditUnit($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-info-circle"></i> Data Categori <strong>Berhasil Diubah.</strong></div>');
		redirect('units');
	}


}
