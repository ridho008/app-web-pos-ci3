<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers_model extends CI_Model {
	public function addSupplier()
	{
		$data = [
			'name_sup' => htmlspecialchars($this->input->post('name', true)),
			'phone' => htmlspecialchars($this->input->post('phone', true)),
			'address' => htmlspecialchars($this->input->post('address', true)),
			'description' => htmlspecialchars($this->input->post('description', true))
		];

		$this->db->insert('suppliers', $data);
	}

	public function getSupplierById($id)
	{
		return $this->db->get_where('suppliers', ['id_supplier' => $id])->row_array();
	}

	public function EditSupplier($data)
	{
		$id_supplier = $data['id_supplier'];
		$arr = [
			'name_sup' => $data['name'],
			'phone' => $data['phone'],
			'address' => $data['address'],
			'description' => $data['description'],
			'updated_at' => date('Y-m-d H:i:s')
		];

		$this->db->where('id_supplier', $id_supplier);
		$this->db->update('suppliers', $arr);
	}

}