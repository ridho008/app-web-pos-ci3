<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P_Item_model extends CI_Model {
	public function addPitem()
	{
		$data = [
			'name_pitem' => html_escape($this->input->post('name', true)),
			'id_categori' => html_escape($this->input->post('categori', true)),
			'id_unit' => html_escape($this->input->post('unit', true)),
			'price' => html_escape($this->input->post('price', true)),
			'barcode' => html_escape($this->input->post('barcode', true))
		];

		$this->db->insert('product_item', $data);
	}


}