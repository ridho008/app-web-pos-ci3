<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale_model extends CI_Model {
	public function invoice_nomor()
	{
		$sql = "SELECT MAX(MID(invoice,9, 4)) AS invoice_no FROM t_sale WHERE MID(invoice, 3,6) = DATETIME(CURDATE(), '%y%m%d')";
		$result = $this->db->query($sql);
		if($result->num_rows > 0) {
			$r = $result->row();
			$n = ((int)$r->invoice_no) + 1;
			$no = sprintf("%'.04d", $n);
		} else {
			$no = "0001";
		}
		$invoice = "MP".date('ymd').$no;
		return $invoice;
	}

	


}