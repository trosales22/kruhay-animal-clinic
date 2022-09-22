<?php
date_default_timezone_set("Asia/Manila");
include_once APPPATH . 'models/Tables.php';

class Product_model extends CI_Model {
    public function add(array $data) {
		$this->db->insert(Tables::$PRODUCTS, $data);
	}

	public function getAll(){
		$query = "
			SELECT 
				id, name, short_desc, long_desc, amount, quantity,
				IF( ISNULL(file_name), '', CONCAT('" . base_url() . "uploads/products/', file_name) ) as file_name,
				DATE_FORMAT(created_at, '%M %d, %Y %r') as created_at 
			FROM " . Tables::$PRODUCTS . " ORDER BY id DESC";

		$stmt = $this->db->query($query);
		return $stmt->result();
	}
}