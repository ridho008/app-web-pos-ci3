<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P_Item_model extends CI_Model {
	public function addPitem()
	{
		$photo = $_FILES['photo']['name'];

		if($photo) {
			$config['allowed_types'] = 'png|jpg';
			$config['max_sizes'] = '2048';
			$config['upload_path'] = './assets/img/product/';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('photo')) {
				$this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = [
			'name_pitem' => html_escape($this->input->post('name', true)),
			'id_categori' => html_escape($this->input->post('categori', true)),
			'id_unit' => html_escape($this->input->post('unit', true)),
			'price' => html_escape($this->input->post('price', true)),
			'barcode' => html_escape($this->input->post('barcode', true)),
			'photo_product' => $photo
		];

		$this->db->insert('product_item', $data);
	}

	public function EditPitem($data)
	{
		$id_pitem = $data['id_pitem'];
		$photo = $_FILES['photo']['name'];
		if($photo) {
			$config['allowed_types'] = 'png|jpg';
			$config['max_sizes'] = '2048';
			$config['upload_path'] = './assets/img/product/';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('photo')) {
				$fotoLama = $data['inputUbahFoto'];
				$result = $this->db->get_where('product_item', ['id_pitem' => $id_pitem])->row_array();
				$rowPhoto = $result['photo_product'];
				if($rowPhoto == $fotoLama) {
					unlink(FCPATH . 'assets/img/product/' . $rowPhoto);
				}

				$photoBaru = $this->upload->data('file_name');
				$this->db->set('photo_product', $photoBaru);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$arr = [
			'name_pitem' => html_escape($data['name']),
			'id_categori' => html_escape($data['categori']),
			'id_unit' => html_escape($data['unit']),
			'price' => html_escape($data['price']),
			'barcode' => html_escape($data['barcode'])
		];

		$this->db->where('id_pitem', $id_pitem);
		$this->db->update('product_item', $arr);
	}

	public function getPitemById($id)
	{
		return $this->db->get_where('product_item', ['id_pitem' => $id])->row_array();
	}

	public function cekBarcode()
	{
		$query = $this->db->query("SELECT MAX(barcode) as bc FROM product_item")->row_array();
		return $query['bc'];
	}


}