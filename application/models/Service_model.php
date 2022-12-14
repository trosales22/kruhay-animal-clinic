<?php
date_default_timezone_set("Asia/Manila");
include_once APPPATH . 'models/Tables.php';

class Service_model extends CI_Model
{
	public function add(array $data)
	{
		$this->db->insert(Tables::$SERVICES, $data);
	}

	public function update(array $data)
	{
		try {
			$this->db->where('id', $data['id']);
			$this->db->update(Tables::$SERVICES, $data);
		} catch (PDOException $e) {
			$msg = $e->getMessage();
			$this->db->trans_rollback();
		} catch (Exception $e) {
			$msg = $e->getMessage();
			$this->db->trans_rollback();
		}
	}

	public function delete($serviceId)
	{
		try {
			$this->db->delete(Tables::$SERVICES, [
				'id' => $serviceId
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
				id, name, short_desc, long_desc, amount, DATE_FORMAT(created_at, '%M %d, %Y %r') as created_at 
			FROM " . Tables::$SERVICES . " ORDER BY id DESC";

		$stmt = $this->db->query($query);
		return $stmt->result();
	}


	public function getById($serviceId)
	{
		$params = array($serviceId);

		$query = "
			SELECT 
                id, name, short_desc, long_desc, amount
			FROM 
				" . Tables::$SERVICES . " 
			WHERE 
				id = ?
		";

		$stmt = $this->db->query($query, $params);
		return $stmt->result();
	}
}
