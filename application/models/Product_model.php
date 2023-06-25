<?php
date_default_timezone_set("Asia/Manila");
include_once APPPATH . 'models/Tables.php';

class Product_model extends CI_Model
{
	public function add(array $data)
	{
		$datetime = new DateTime();
		$timezone = new DateTimeZone('Asia/Manila');
		$datetime->setTimezone($timezone);

		$data['created_at'] = $datetime->format('Y-m-d H:i:s');
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
				DATE_FORMAT(expiration_date, '%M %d, %Y') as expiration_date,
				expiration_date as raw_expiration_date,
				DATE_FORMAT(created_at, '%M %d, %Y %r') as created_at 
			FROM " . Tables::$PRODUCTS . " ORDER BY id ASC";

		$stmt = $this->db->query($query);
		return $stmt->result();
	}


	public function getProductById($productId)
	{
		$params = array($productId);

		$query = "
			SELECT 
				id, name, short_desc, long_desc, amount, quantity,
				IF( ISNULL(file_name) OR file_name='', NULL, CONCAT('" . base_url() . "uploads/products/', file_name) ) as file_name,
				DATE_FORMAT(expiration_date, '%Y-%m-%d') as expiration_date
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

	public function checkout(array $params)
	{
		try {
			$datetime = new DateTime();
			$timezone = new DateTimeZone('Asia/Manila');
			$datetime->setTimezone($timezone);

			$params['created_at'] = $datetime->format('Y-m-d H:i:s');

			$this->db->insert(Tables::$PRODUCT_PURCHASES, $params);
			
			$this->db->set('quantity', 'quantity-1', FALSE);
			$this->db->where('id', $params['product_id']);
			$this->db->update(Tables::$PRODUCTS);

			$productData = $this->getProductById($params['product_id']);

			$product_details_params = [
				'name' => $productData[0]->name,
				'amount' => $productData[0]->amount,
				'date_purchased' => $datetime->format('M d, Y h:i A')
			];

			$sessionData = $this->session->userdata('client_session');

			$this->sendCheckoutProductEmailNotif($product_details_params, [
				'email' => $sessionData['email'],
				'fullname' => $sessionData['first_name'] . ' ' . $sessionData['last_name']
			]);

			return $this->db->insert_id();
		} catch (PDOException $e) {
			$msg = $e->getMessage();
			$this->db->trans_rollback();
		}
	}

	public function sendCheckoutProductEmailNotif(array $product_details_params, array $email_params)
	{
		try {
			$success = 0;
			$from = "support@kruhayanimalclinic.com";
			$to = $email_params['email'];
			$message = '';
			$subject = "Kruhay Animal Clinic | Thankyou for buying our product!";

			$message = "Hi " . $email_params['fullname'] . "!\n\n";
			$message .= "Below are your purchased product details:\n\n";
			$message .= "Name: " . $product_details_params['name'] . "\n";
			$message .= "Amount: ₱" .$product_details_params['amount']  . "\n";
			$message .= "Status: Paid\n";
			$message .= "Date/Time: " . $product_details_params['date_purchased'] . "\n\n";
			$message .= "Thank you for supporting Kruhay Animal Clinic.\n";

			$headers = "From:" . $from;
			mail($to, $subject, $message, $headers);
			$success = 1;
		} catch (Exception $e) {
			$msg = $e->getMessage();
		}
	}
}
