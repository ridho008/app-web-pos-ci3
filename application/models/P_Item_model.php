<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P_Item_model extends CI_Model {
	public function joinPitemCateUnit()
	{
		$this->db->select('*');
		$this->db->from('product_item');
		$this->db->join('categories', 'categories.id_categori = product_item.id_categori');
		$this->db->join('units', 'units.id_unit = product_item.id_unit');
		return $this->db->get()->result_array();
	}


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
				if($fotoLama == $rowPhoto) {
					unlink(FCPATH . 'assets/img/product/' . $rowPhoto);
				}

				$photoBaru = $this->upload->data('file_name');
				$this->db->set('photo_product', $photoBaru);
			} else {
				echo $this->upload->display_errors();
			}
		}

		// var_dump($data); die;
		$arr = [
			'name_pitem' => $data['name'],
			'id_categori' => $data['categori'],
			'id_unit' => $data['unit'],
			'price' => $data['price']
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


	// start datatables
    var $column_order = array(null, 'barcode', 'product_item.name_pitem', 'name_cate', 'name_unit', 'price', 'stock'); //set column field database for datatable orderable
    var $column_search = array('barcode', 'product_item.name_pitem', 'price'); //set column field database for datatable searchable
    var $order = array('id_pitem' => 'asc'); // default order 
 
    private function _get_datatables_query() {
        $this->db->select('product_item.*, categories.name_cate, units.name_unit');
        $this->db->from('product_item');
        $this->db->join('categories', 'product_item.id_categori = categories.id_categori');
        $this->db->join('units', 'product_item.id_unit = units.id_unit');
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('product_item');
        return $this->db->count_all_results();
    }
    // end datatables




}