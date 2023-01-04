<?php
date_default_timezone_set("Asia/Manila");
include_once APPPATH . 'models/Tables.php';

class Feedback_model extends CI_Model
{
	public function add(array $data)
	{
		$this->db->insert(Tables::$FEEDBACKS, $data);
	}

	public function getAll()
	{
		$query = "
			SELECT 
				id, name, email, subject, message, DATE_FORMAT(created_at, '%M %d, %Y %r') as created_at 
			FROM " . Tables::$FEEDBACKS . " ORDER BY created_at DESC";

		$stmt = $this->db->query($query);
		return $stmt->result();
	}


	public function getById($productId)
	{
		$params = array($productId);

		$query = "
			SELECT 
                id, name, email, subject, message
			FROM 
				" . Tables::$FEEDBACKS . " 
			WHERE 
				id = ?
		";

		$stmt = $this->db->query($query, $params);
		return $stmt->result();
	}
}
