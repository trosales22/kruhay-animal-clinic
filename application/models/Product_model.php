<?php
date_default_timezone_set("Asia/Manila");
include_once APPPATH . 'models/Tables.php';

class Product_model extends CI_Model
{
	public function add(array $data)
	{
		$this->db->insert(Tables::$PRODUCTS, $data);
	}

	public function update(array $data)
	{
		try {
			$productId = $data['id'];
			$this->db->where('id', $productId);
			$this->db->update(Tables::$PRODUCTS, $data);
		} catch (PDOException $e) {
			$msg = $e->getMessage();
			$this->db->trans_rollback();
		} catch (Exception $e) {
			$msg = $e->getMessage();
			$this->db->trans_rollback();
		}
	}

	public function delete($productId)
	{
		try {
			$this->db->delete(Tables::$PRODUCTS, [
				'id' => $productId
			]);
		} catch (PDOException $e) {
			$msg = $e->getMessage();
			$this->db->trans_rollback();
		}
	}

	public function getAll()
	{
		$query = "
			SELECT 
				id, name, short_desc, long_desc, amount, quantity,
				IF( ISNULL(file_name) OR file_name='', NULL, CONCAT('" . base_url() . "uploads/products/', file_name) ) as file_name,
				DATE_FORMAT(created_at, '%M %d, %Y %r') as created_at 
			FROM " . Tables::$PRODUCTS . " ORDER BY created_at DESC";

		$stmt = $this->db->query($query);
		return $stmt->result();
	}


	public function getProductById($productId)
	{
		$params = array($productId);

		$query = "
			SELECT 
				id, name, short_desc, long_desc, amount, quantity 
			FROM 
				" . Tables::$PRODUCTS . " 
			WHERE 
				id = ?
		";

		$stmt = $this->db->query($query, $params);
		return $stmt->result();
	}

	public function detectIfProductImgExist($productId)
	{
		$params = array($productId);

		$query = "
			SELECT 
				IF( ISNULL(file_name) OR file_name='', 'NO IMAGE', CONCAT('" . base_url() . "uploads/products/', file_name) ) as product_display_photo,
				IF( ISNULL(file_name) OR file_name='', 'NO IMAGE', file_name) as product_display_photo_raw 
			FROM
				" . Tables::$PRODUCTS . " 
			WHERE 
				id = ?
		";

		$stmt = $this->db->query($query, $params);
		return $stmt->result();
	}

}
