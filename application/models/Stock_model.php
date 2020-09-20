<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {
	public function addStockIn()
	{
		$data = [
			'id_item' => html_escape($this->input->post('id_pitem', true)),
			'type' => 'in',
			'detail' => html_escape($this->input->post('detail', true)),
			'id_supplier' => html_escape($this->input->post('supplier', true)),
			'quantity' => html_escape($this->input->post('quantity', true)),
			'date' => $this->input->post('date', true),
			'id_user' => $this->session->userdata('id_user')
		];

		$quantity = $this->input->post('quantity');
		$id_pitem = $this->input->post('id_pitem');
		$sql = "UPDATE product_item SET stock = stock + '$quantity' WHERE id_pitem = '$id_pitem'";
		$this->db->query($sql);
		$this->db->insert('t_stock', $data);
	}


}