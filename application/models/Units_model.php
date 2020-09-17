<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Units_model extends CI_Model {
	public function addUnit()
	{
		$data = [
			'name_unit' => htmlspecialchars($this->input->post('name', true))
		];

		$this->db->insert('units', $data);
	}

	public function EditUnit($data)
	{
		$id_unit = $data['id_unit'];
		$arr = [
			'name_unit' => $data['name']
		];

		$this->db->where('id_unit', $id_unit);
		$this->db->update('units', $arr);
	}

	public function getUnitById($id)
	{
		return $this->db->get_where('units', ['id_unit' => $id])->row_array();
	}


}