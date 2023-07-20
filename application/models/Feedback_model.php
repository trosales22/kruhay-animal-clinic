<?php
date_default_timezone_set("Asia/Manila");
include_once APPPATH . 'models/Tables.php';

class Feedback_model extends CI_Model
{
	public function add(array $data)
	{
		$datetime = new DateTime();
		$timezone = new DateTimeZone('Asia/Manila');
		$datetime->setTimezone($timezone);

		$data['created_at'] = $datetime->format('Y-m-d H:i:s');
		$this->db->insert(Tables::$FEEDBACKS, $data);

		$this->sendSuccessFeedbackNotifToClientEmail([
			'email' => $data['email'],
			'fullname' => $data['name'],
			'mobile_number' => $data['mobile_number'],
			'subject' => $data['subject'],
			'message' => $data['message'],
			'date_submitted' => $data['created_at']
		]);
	}

	public function getAll()
	{
		$query = "
			SELECT 
				id, name, mobile_number, email, subject, message, 
				DATE_FORMAT(created_at, '%M %d, %Y %r') as created_at 
			FROM " . Tables::$FEEDBACKS . " ORDER BY created_at DESC";

		$stmt = $this->db->query($query);
		return $stmt->result();
	}


	public function getById($productId)
	{
		$params = array($productId);

		$query = "
			SELECT 
                id, name, mobile_number, email, subject, message
			FROM 
				" . Tables::$FEEDBACKS . " 
			WHERE 
				id = ?
		";

		$stmt = $this->db->query($query, $params);
		return $stmt->result();
	}

	public function sendSuccessFeedbackNotifToClientEmail(array $params)
	{
		try {
			$success = 0;
			$from = "support@kruhayanimalclinic.com";
			$to = $params['email'];
			$message = '';
			$subject = "Kruhay Animal Clinic | Thank you for your feedback!";

			$message = "Hi " . $params['fullname'] . "!\n\n";
			$message .= "Below are your feedback details:\n\n";
			$message .= "Email: " . $params['email'] . "\n";
			$message .= "Contact #: " . $params['mobile_number'] . "\n";
			$message .= "Subject: " . $params['subject'] . "\n";
			$message .= "Message: " . $params['message'] . "\n";
			$message .= "Date Submitted: " . $params['date_submitted'] . "\n\n";
			$message .= "Thank you for supporting Kruhay Animal Clinic.\n";

			$headers = "From:" . $from;
			mail($to, $subject, $message, $headers);
			$success = 1;
		} catch (Exception $e) {
			$msg = $e->getMessage();
		}
	}
}
