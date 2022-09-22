<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservations extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->helper('url', 'form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Home_model', 'home_model');
		$this->load->model('api/Talents_model', 'talents_model');
		$this->load->model('Bookings_model', 'bookings_model');
  	}
	
  	public function index() {
		$this->_get_bookings();
		$this->load->view('bookings_page', $this->data);
	}

	private function _get_reservations(){
		try{
			$success = 0;

			$reservation_list = $this->bookings_model->get_all_bookings();

			foreach($reservation_list as $booking){
				$talent_details 	= $this->talents_model->get_talent_details($booking->talent_id);
				$client_details		= $this->home_model->getAllClients($booking->client_id);
				
				$booking->talent_id = $talent_details[0];
				$booking->client_id = $client_details[0];
			}
			
			$success  = 1;
		}catch (Exception $e){
			$msg = $e->getMessage();
		}

		if($success == 1){
			$response = [
			  'reservation_list' => $reservation_list
			];
		}else{
			$response = [
				'msg' => $msg,
				'flag' => $success
			];
		}
		
		$this->data['reservation_list'] = $response['reservation_list'];
	}
}
