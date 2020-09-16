<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers_model extends CI_Model {
	public function addUser()
	{
		$foto = $_FILES['foto']['name'];

		if($foto) {
			$config['allowed_types'] = 'png|jpg';
			$config['max_sizes'] = '2048';
			$config['upload_path'] = './assets/img/user/';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('foto')) {
				$this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = [
			'username' => htmlspecialchars($this->input->post('username', true)),
			'password' => sha1($this->input->post('password', true)),
			'name' => htmlspecialchars($this->input->post('name', true)),
			'address' => htmlspecialchars($this->input->post('address', true)),
			'level' => htmlspecialchars($this->input->post('level', true)),
			'photo' => $foto
		];

		$this->db->insert('users', $data);
	}

	public function EditUser($data)
	{
		$foto = $_FILES['foto']['name'];
		$id_user = $data['id_user'];
		if($foto) {
			$config['allowed_types'] = 'png|jpg';
			$config['max_sizes'] = '2048';
			$config['upload_path'] = './assets/img/user/';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('foto')) {
				$fotoLama = $data['inputHiddenFoto'];
				$result = $this->db->get_where('users', ['id_user' => $id_user])->row_array();
				$rowFoto = $result['photo'];

				if($fotoLama == $rowFoto) {
					unlink(FCPATH . 'assets/img/user/' . $rowFoto);
				}

				$fotoBaru = $this->upload->data('file_name');
				$this->db->set('photo', $fotoBaru);
			} else {
				echo $this->upload->display_errors();
			}
		}
		// var_dump($data); die;
		$arr = [
			'username' => htmlspecialchars($this->input->post('username', true)),
			'password' => sha1($this->input->post('password', true)),
			'name' => htmlspecialchars($this->input->post('name', true)),
			'address' => htmlspecialchars($this->input->post('address', true)),
			'level' => htmlspecialchars($this->input->post('level', true))
		];

		$this->db->where('id_user', $id_user);
		$this->db->update('users', $arr);
	}

	public function getUserById($id)
	{
		return $this->db->get_where('users', ['id_user' => $id])->row_array();
	}

}