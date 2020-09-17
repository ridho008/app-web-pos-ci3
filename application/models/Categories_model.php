<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {
	public function addCategori()
	{
		$data = [
			'name_cate' => htmlspecialchars($this->input->post('name', true))
		];

		$this->db->insert('categories', $data);
	}

	public function EditCategori($data)
	{
		$id_categori = $data['id_categori'];
		$arr = [
			'name_cate' => $data['name']
		];

		$this->db->where('id_categori', $id_categori);
		$this->db->update('categories', $arr);
	}

	public function getCategoriById($id)
	{
		return $this->db->get_where('categories', ['id_categori' => $id])->row_array();
	}


}