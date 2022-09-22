<?php
date_default_timezone_set("Asia/Manila");
include_once APPPATH . 'models/Tables.php';

class Home_model extends CI_Model {
	public function getPersonalInfo($username_or_email){
		$params = array($username_or_email, $username_or_email, 'Y');
		$query = "
			SELECT 
				A.user_id, A.username, A.first_name, A.last_name, A.email, A.role_type 
			FROM 
				" . Tables::$USERS . " A
			WHERE 
				A.username = ? OR A.email = ? AND A.active_flag = ?";

		$stmt = $this->db->query($query, $params);
		return $stmt->result();
	}

	private function _send_client_status_email_notif($email, $status){
		try{
			$success = 0;
			$from = "support@hireusph.com";
			$to = $email;
			
			if($status == 'Y'){
				$subject = "Account Activated!";
				$message = "Congratulations! Your account has been activated. You can now login your account. Thank you.";
			}else{
				$subject = "Account Deactivated!";
				$message = "Whoop. We're sorry! Your account has been deactivated!";
			}

			$headers = "From:" . $from;
			mail($to, $subject, $message, $headers);
			$success  = 1;
		}catch (Exception $e){
			$msg = $e->getMessage();      
		}
	}

	public function update_client_status(array $data){
		try{
			$client_params = array('active_flag' => $data['active_flag']);
			$this->db->where('user_id', $data['user_id']);
			$this->db->update(Tables::$USERS, $client_params);
			
			$client_details = $this->_get_email_of_client($data['user_id']);		
			$this->_send_client_status_email_notif($client_details->email, $data['active_flag']);
		}catch(PDOException $e){
            $msg = $e->getMessage();
            $this->db->trans_rollback();
        }	
	}
}
