<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_registration extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url', 'form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('User_model', 'user_model');
	}

	public function index(){
		$this->load->view('client_registration_page');	
	}

	public function store(){
		try{
			$is_success = 0;
			$msg = array();
			$session_data = $this->session->userdata('logged_in');

			$payload = array(
				'first_name' => trim($this->input->post('first_name')),
				'last_name'	=> trim($this->input->post('last_name')),
				'email' => trim($this->input->post('email')),
				'contact_number' => trim($this->input->post('contact_number')),
				'address' => trim($this->input->post('address')),
				'password' => trim($this->input->post('password'))
			);

			if(EMPTY($payload['first_name']))
				throw new Exception("First name is required.");
			
			if(EMPTY($payload['last_name']))
				throw new Exception("Last name is required.");

			if(EMPTY($payload['email']))
				throw new Exception("Email address is required.");

			if(EMPTY($payload['contact_number']))
				throw new Exception("Contact number is required.");

			if(EMPTY($payload['password']))
				throw new Exception("Password is required.");

			if(!EMPTY($this->user_model->getClientInfo($payload['email']))){
				throw new Exception("Email address already exists.");
			}

			$this->user_model->insertClient($payload);
			$is_success = 1;
		}catch (Exception $e){
			$msg = $e->getMessage();      
		}

		if($is_success == 1){
			$response = [
				'msg' => 'Client was successfully registered!',
				'flag' => $is_success
			];
		}else{
			$response = [
				'msg' => $msg,
				'flag' => $is_success
			];
		}

		echo json_encode($response);
	}
}
