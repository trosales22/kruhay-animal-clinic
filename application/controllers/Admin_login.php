<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url', 'form');
		$this->load->library('session');
		$this->load->model('User_model', 'user_model');
	}

	public function index(){
		//use password_hash("password", PASSWORD_BCRYPT) for password encryption/hashing
		//use password_verify("password", $hash) for password verification

		$data['error_message'] = '';
		$this->load->view('admin_login_page', $data);	
	}

	public function process_login() {
		$inputs = array(
			'username_or_email' => $this->input->post('username_or_email'),
			'password' => $this->input->post('password')
		);
		
		$res = array();
		$result = $this->user_model->getUserInformation($inputs['username_or_email']);

		if(empty($result)){
			$res = array(
				'status' 	=> 'UNKNOWN_USER',
				'msg'		=> 'Unknown user. Please try again!'
			);
		}else{
			if(password_verify($inputs['password'], $result[0]->password)){
				$fields = array(
					'username_or_email' 	=> $inputs['username_or_email'],
					'password' 				=> $result[0]->password
				);
				
				$count = $this->user_model->loginUser($fields);
				
				if($count == 1){
					$user_role_res = $this->user_model->getUserRole($result[0]->user_id);
	
					if($user_role_res[0]->role_type == 'SUPER_ADMIN'){
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
							'msg' => 'Only Super Admin have access to the system!'
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

	public function user_logout(){    
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
		
        redirect('admin_login');
	}
}
