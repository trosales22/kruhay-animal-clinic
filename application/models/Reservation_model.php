<?php
date_default_timezone_set("Asia/Manila");
include_once APPPATH . 'models/Tables.php';

class Reservation_model extends CI_Model {
	public function submitReservation(array $params){
		try{	
			$this->db->insert(Tables::$RESERVATIONS, $params);
			return $this->db->insert_id();
			//$this->_sendSuccessfulReservationNotifToClientEmail($booking_params, $email_params);
		}catch(PDOException $e){
			$msg = $e->getMessage();
			$this->db->trans_rollback();
		}
	}

	public function getAllReservation(){
		$query = "
			SELECT 
				id, user_id, schedule_date, payment_method, service_type, address, status,
				DATE_FORMAT(created_at, '%M %d, %Y %r') as created_at 
			FROM " . Tables::$RESERVATIONS . " ORDER BY created_at DESC";

		$stmt = $this->db->query($query);
		return $stmt->result();
	}

	public function getReservationById($id){
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

	private function _sendSuccessfulReservationNotifToClientEmail(array $booking_params, array $email_params){
		try{
			$success = 0;
			$from = "support@hireusph.com";
			$to = $email_params['client_details']->email;
			$message = '';
			$subject = "Hire Us | Congratulations for a successful booking!";
			
			$message = "Hi " . $email_params['client_details']->fullname . "!\n\n";
			$message .= "Below are your booking details:\n\n";
			
			$message .= "Booking ID: " . $booking_params['booking_generated_id'] . "\n";
			$message .= "Talent Fullname: " . $email_params['talent_details']->fullname . "\n";
			$message .= "Talent Category: " . $email_params['talent_details']->category_names . "\n";
			$message .= "Schedule:\n" . $booking_params['booking_date'] . '\n' . $booking_params['booking_date']  . "\n";
			$message .= "Event Title: " . $booking_params['booking_event_title'] . "\n";
			$message .= "Venue: " . $booking_params['booking_venue_location'] . "\n";
			$message .= "Talent Fee: ₱" . $booking_params['booking_talent_fee'] . "\n";
			$message .= "Other Details: " . $booking_params['booking_other_details'] . "\n\n";
			$message .= "Thank you for supporting Hire Us PH.\n";
			
			$headers = "From:" . $from;
			mail($to, $subject, $message, $headers);
			$success  = 1;
		}catch (Exception $e){
			$msg = $e->getMessage();      
		}
	}
}
