<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers_model extends CI_Model {
	public function addCustomer()
	{
		$data = [
			'name_cus' => htmlspecialchars($this->input->post('name', true)),
			'gender' => htmlspecialchars($this->input->post('gender', true)),
			'phone' => htmlspecialchars($this->input->post('phone', true)),
			'address' => htmlspecialchars($this->input->post('address', true))
		];

		$this->db->insert('customers', $data);
	}

	public function getCustomerById($id)
	{
		return $this->db->get_where('customers', ['id_customer' => $id])->row_array();
	}

	public function EditCustomer($data)
	{
		$id_customer = $data['id_customer'];
		$arr = [
			'name_cus' => $data['name'],
			'gender' => $data['gender'],
			'phone' => $data['phone'],
			'address' => $data['address']
		];
		$this->db->where('id_customer', $id_customer);
		$this->db->update('customers', $arr);
	}

}