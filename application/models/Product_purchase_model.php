<?php
date_default_timezone_set("Asia/Manila");
include_once APPPATH . 'models/Tables.php';

class Product_purchase_model extends CI_Model
{
	public function getAll()
	{
		$query = "
			SELECT 
                B.name as product_name, B.amount as product_amount,
                IF( ISNULL(B.file_name) OR B.file_name='', NULL, CONCAT('" . base_url() . "uploads/products/', B.file_name) ) as product_file_name,
				A.payment_method, A.address, A.status,
				CONCAT(C.first_name, ' ', C.last_name) as customer_name,
				C.email as customer_email,
				C.contact_number as customer_contact_no,
				DATE_FORMAT(A.created_at, '%M %d, %Y %r') as date_purchased 
			FROM 
				" . Tables::$PRODUCT_PURCHASES . " A 
            LEFT JOIN 
                " . Tables::$PRODUCTS . " B ON A.product_id = B.id 
			LEFT JOIN 
			" . Tables::$USERS . " C ON A.user_id = C.user_id 
			ORDER BY A.created_at DESC";

		$stmt = $this->db->query($query);
		return $stmt->result();
    }

	public function getAllByUserId($userId)
	{
		$params = array($userId);
		$query = "
			SELECT 
                B.name as product_name, B.amount as product_amount,
                IF( ISNULL(B.file_name) OR B.file_name='', NULL, CONCAT('" . base_url() . "uploads/products/', B.file_name) ) as product_file_name,
				A.payment_method, A.address, A.status,
				DATE_FORMAT(A.created_at, '%M %d, %Y %r') as date_purchased 
			FROM 
				" . Tables::$PRODUCT_PURCHASES . " A 
            LEFT JOIN 
                " . Tables::$PRODUCTS . " B ON A.product_id = B.id 
			WHERE 
				A.user_id = ?";

		$stmt = $this->db->query($query, $params);
		return $stmt->result();
    }
}
