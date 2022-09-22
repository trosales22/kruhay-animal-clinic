<?php
date_default_timezone_set("Asia/Manila");
include_once APPPATH . 'models/Tables.php';

class User_model extends CI_Model
{
	public function loginUser(array $data)
	{
		$params = array(
			$data['username_or_email'],
			$data['username_or_email'],
			$data['password'],
			true
		);
		$query = "
			SELECT 
				username
			FROM 
				" . Tables::$USERS . " 
			WHERE 
				username = ? OR email = ? AND password = ? AND is_active = ?";

		$stmt = $this->db->query($query, $params);
		return $stmt->num_rows();
	}

	public function loginClient(array $data)
	{
		$params = array($data['email'], $data['password'], true, 'CLIENT');
		$query = "
			SELECT 
				username
			FROM 
				" . Tables::$USERS . " 
			WHERE 
				email = ? AND password = ? AND is_active = ? AND role_type=?";

		$stmt = $this->db->query($query, $params);
		return $stmt->num_rows();
	}

	public function getUserInformation($usernameOrEmail)
	{
		$params = array($usernameOrEmail, $usernameOrEmail, true);
		$query = "
			SELECT 
				A.user_id, A.username, A.first_name, A.last_name, 
				A.email, A.password, A.role_type
			FROM 
				" . Tables::$USERS . " A
			WHERE 
				A.username = ? OR A.email = ? AND A.is_active = ?";

		$stmt = $this->db->query($query, $params);
		return $stmt->result();
	}

	public function getClientInfo($email)
	{
		$params = array($email, true);
		$query = "
			SELECT 
				A.user_id, A.username, A.first_name, A.last_name, 
				A.email, A.password, A.role_type
			FROM 
				" . Tables::$USERS . " A
			WHERE 
				A.email = ? AND A.is_active = ?";

		$stmt = $this->db->query($query, $params);
		return $stmt->result();
	}

	public function getUserRole($user_id)
	{
		$params = array($user_id);
		$query = "
			SELECT 
				user_id, role_type
			FROM 
				" . Tables::$USERS . " 
			WHERE 
				user_id = ?";

		$stmt = $this->db->query($query, $params);
		return $stmt->result();
	}

	public function insertClient(array $data)
	{
		$this->db->insert(Tables::$USERS, array(
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'email' => $data['email'],
			'contact_number' => $data['contact_number'],
			'password' => password_hash($data['password'], PASSWORD_BCRYPT),
			'role_type' => 'CLIENT',
			'address' => $data['address'],
			'is_active' => true
		));
	}
}
