<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url', 'form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('User_model', 'user_model');
	}

	public function index(){
		$data['error_message'] = '';
		$this->load->view('client_login_page', $data);	
	}

	public function login() {
		$payload = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
		);
		
		$res = array();
		$result = $this->user_model->getClientInfo($payload['email']);

		if(empty($result)){
			$res = array(
				'status' => 'UNKNOWN_USER',
				'msg' => 'Unknown user. Please try again!'
			);
		}else{
			if(password_verify($payload['password'], $result[0]->password)){
				$count = $this->user_model->loginClient(array(
					'email' => $payload['email'],
					'password' => $result[0]->password
				));
				
				if($count == 1){
					$user_role_res = $this->user_model->getUserRole($result[0]->user_id);
	
					if($user_role_res[0]->role_type == 'CLIENT'){
						$session_data = array(
							'status' => 'OK',
							'user_id' => $result[0]->user_id,
							'username' => $result[0]->username,
							'first_name' => $result[0]->first_name,
							'last_name' => $result[0]->last_name,
							'email' => $result[0]->email,
							'role_code' => $result[0]->role_type
						);
						
						$res = $session_data;
						$this->session->set_userdata('logged_in', $session_data);
					}else{
						$res = array(
							'status' => 'INVALID_ROLE', 
							'msg' => 'Only Client have access to the system!'
						);
					}
				}else{
					$res = array(
						'status' => 'INVALID_LOGIN',
						'msg' => 'Invalid email/username or password!'
					);
				}
			}else{
				$res = array(
					'status' => 'PASSWORD_MISMATCH',
					'msg' => 'Password does not match!'
				);
			}
		}

		echo json_encode($res);
	}

	public function logout(){    
        if ($this->session->userdata('logged_in')) {
			$this->session->unset_userdata('status');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('first_name');
			$this->session->unset_userdata('last_name');
			$this->session->unset_userdata('role_code');
            $this->session->unset_userdata('logged_in');
		}
		
        redirect('landing');
	}
}
