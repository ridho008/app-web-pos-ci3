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
		// Membuat barcode acak
		$dbPitem = $this->P_Item_model->cekBarcode();
		$noUrut = substr($dbPitem, 2, 4);
		$data['kodeBarcodeSekarang'] = $noUrut + 1;

		// $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
		// echo $generator->getBarcode('123456', $generator::TYPE_CODE_128);


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

	public function getUbahPitem()
	{
		echo json_encode($this->P_Item_model->getPitemById($_POST['id']));
	}

	public function formUbahPitem()
	{
		$this->P_Item_model->EditPitem($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-info-circle"></i> Data Product Item <strong>Berhasil Diubah.</strong></div>');
		redirect('pitem');
	}

	public function delete($id)
	{
		$result = $this->db->get_where('product_item', ['id_pitem' => $id])->row_array();
		$rowFoto = $result['photo_product'];
		unlink('./assets/img/product/' . $rowFoto);
		$this->db->where('id_pitem', $id);
		$this->db->delete('product_item');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-trash"></i> Data Product <strong>Berhasil Dihapus.</strong></div>');
		redirect('pitem');
	}

	public function barcode_qrcode($id)
	{
		$data['barcodeview'] = $this->P_Item_model->getPitemById($id);
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/pitem/index', $data);
		$this->load->view('layout/footer');
	}

	


}
