<?php
date_default_timezone_set("Asia/Manila");
include_once APPPATH . 'models/Tables.php';

class Reservation_model extends CI_Model
{
	public function submitReservation(array $params)
	{
		try {
			$datetime = new DateTime();
			$timezone = new DateTimeZone('Asia/Manila');
			$datetime->setTimezone($timezone);

			$params['created_at'] = $datetime->format('Y-m-d H:i:s');

			$this->db->insert(Tables::$RESERVATIONS, $params);

			$booking_params = [
				'pet_name' => $params['pet_name'],
				'schedule_date' => $params['schedule_date'],
				'schedule_time' => $params['schedule_time'],
				'service_type' => $params['service_type'],
				'address' => $params['address']
			];

			$sessionData = $this->session->userdata('client_session');

			$this->sendSuccessfulReservationNotifToClientEmail($booking_params, [
				'email' => $sessionData['email'],
				'fullname' => $sessionData['first_name'] . ' ' . $sessionData['last_name']
			]);

			return $this->db->insert_id();
		} catch (PDOException $e) {
			$msg = $e->getMessage();
			$this->db->trans_rollback();
		}
	}

	public function getAllReservation()
	{
		$query = "
			SELECT 
				A.id, A.user_id, CONCAT(B.first_name, ' ', B.last_name) as client_name, 
				B.email AS client_email, B.contact_number as client_contact_number, 
				A.pet_name, A.schedule_date, A.schedule_time,
				A.payment_method, A.service_type, A.address, A.status,
				DATE_FORMAT(A.created_at, '%M %d, %Y %r') as created_at 
			FROM 
				" . Tables::$RESERVATIONS . " A 
			LEFT JOIN 
				" . Tables::$USERS . " B ON A.user_id = B.user_id 
			ORDER BY created_at DESC";

		$stmt = $this->db->query($query);
		return $stmt->result();
	}

	public function getReservationById($id)
	{
		$params = array($id);
		$query = "
			SELECT 
				id
			FROM 
				" . Tables::$RESERVATIONS . " 
			WHERE 
				id = ?";

		$stmt = $this->db->query($query, $params);
		return $stmt->result();
	}

	public function getAllByUserId($userId)
	{
		$params = array($userId);
		$query = "
			SELECT 
				id, user_id, pet_name, schedule_date, schedule_time,
				payment_method, service_type, address, status,
				DATE_FORMAT(created_at, '%M %d, %Y %r') as created_at 
			FROM 
				" . Tables::$RESERVATIONS . " 
			WHERE 
				user_id = ?";

		$stmt = $this->db->query($query, $params);
		return $stmt->result();
	}

	public function sendSuccessfulReservationNotifToClientEmail(array $booking_params, array $email_params)
	{
		try {
			$success = 0;
			$from = "support@kruhayanimalclinic.com";
			$to = $email_params['email'];
			$message = '';
			$subject = "Kruhay Animal Clinic | Congratulations for a successful reservation!";

			$message = "Hi " . $email_params['fullname'] . "!\n\n";
			$message .= "Below are your reservation details:\n\n";
			$message .= "Pet Name:\n" . $booking_params['pet_name'] . "\n";
			$message .= "Schedule:\n" . $booking_params['schedule_date'] . " " . $booking_params['schedule_time'] . "\n";
			$message .= "Service Type: " . $booking_params['service_type'] . "\n";
			$message .= "Address: " . $booking_params['address'] . "\n";
			$message .= "Reservation Fee: ₱200.00\n";
			$message .= "Thank you for supporting Kruhay Animal Clinic.\n";

			$headers = "From:" . $from;
			mail($to, $subject, $message, $headers);
			$success = 1;
		} catch (Exception $e) {
			$msg = $e->getMessage();
		}
	}
}
