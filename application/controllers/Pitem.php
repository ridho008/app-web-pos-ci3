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

	// Datatable Server Side
	function get_ajax() {
        $list = $this->P_Item_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->photo_product != null ? '<img src="'.base_url('assets/img/product/'.$item->photo_product).'" class="img" style="width:100px">' : null;
            $row[] = $item->barcode.'<br><a href="'.site_url('pitem/barcode/'.$item->id_pitem).'" class="btn btn-default btn-xs">Generate <i class="fa fa-barcode"></i></a>';
            $row[] = $item->name_pitem;
            $row[] = $item->name_cate;
            $row[] = $item->name_unit;
            $row[] = number_format($item->price, 0, ',', '.');
            $row[] = $item->stock;
            // add html for action
            $row[] = '<button type="button" class="btn btn-info tombolUbahPitem" data-toggle="modal" data-target="#formmodalPitem" data-id="'.$item->id_pitem.'"><i class="fas fa-user-edit"></i></button>
                    <a href="'.base_url('pitem/delete/'.$item->id_pitem).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            // $row[] = '<a href="'.site_url('pitem/formUbahPitem/'.$item->id_pitem).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
            //         <a href="'.site_url('item/del/'.$item->id_pitem).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->P_Item_model->count_all(),
                    "recordsFiltered" => $this->P_Item_model->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }
    // End Datatable Server Side

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


		$data['pitem'] = $this->P_Item_model->joinPitemCateUnit();
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

	public function barcode($id)
	{
		$data['title'] = 'Barcode';
		$data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['barcodeview'] = $this->P_Item_model->getPitemById($id);
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('admin/pitem/barcode', $data);
		$this->load->view('layout/footer');
	}

	


}
