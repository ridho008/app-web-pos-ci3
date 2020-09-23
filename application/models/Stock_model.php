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

	public function joinTStock()
	{
		$this->db->select('*');
		$this->db->from('t_stock');
		$this->db->join('product_item', 'product_item.id_pitem = t_stock.id_item');
		$this->db->join('suppliers', 'suppliers.id_supplier = t_stock.id_supplier');
		$this->db->where('type', 'in');
		$this->db->order_by('t_stock.id_stock', 'desc');
		return $this->db->get()->result_array();
	}

	public function get($id = null)
	{
		$this->db->from('t_stock');
		if($id != null)
		{
			$this->db->where('id_stock', $id);
		}
		return $this->db->get();
	}

	public function delStockIn($stockId, $pitemId, $data)
	{
		$qty = $data['quantity'];
		$sql = "UPDATE product_item SET stock = stock - '$qty' WHERE id_pitem = '$pitemId'";
		$this->db->query($sql);
		$this->db->where('id_stock', $stockId);
		$this->db->delete('t_stock');
	}

	// public function updateStockIn($data)
	// {
	// 	$qty = $data['qty'];
	// 	$idItem = $data['id_item'];
	// 	$sql = "UPDATE product_item SET stock = stock - '$qty' WHERE id_pitem = '$idItem'";
	// 	$this->db->query($sql);
	// }

	public function getStockInById($id)
	{
		$this->db->from('t_stock');
		$this->db->join('product_item', 'product_item.id_pitem = t_stock.id_item');
		$this->db->join('suppliers', 'suppliers.id_supplier = t_stock.id_supplier');
		$this->db->where('t_stock.id_stock', $id);
		return $this->db->get()->row_array();
	}

}