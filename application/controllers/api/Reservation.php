<?php
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';

class Reservation extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url', 'form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Reservation_model', 'reservation_model');
	}

	public function get_sched_time_by_date_get()
	{
		$schedule_date = $this->get('schedule_date');
		$list = $this->reservation_model->getReservationTimeByDate($schedule_date);

		echo json_encode([
			'list' => $list
		]);
	}

	public function reserve_booking_post(){
		$clientId = $this->session->userdata('client_session')['user_id'];

		try{
			$success = 0;
			$msg = '';

			$this->reservation_model->submitReservation(array(
				'user_id' => $clientId,
				'pet_name' => $this->post('pet_name'),
				'schedule_date' => $this->post('schedule_date'),
				'schedule_time' => $this->post('schedule_time'),
				'service_type' => $this->post('service_type'),
				'address' => $this->post('address'),
				'status' => 'RESERVED'
			));

			$success = 1;
		} catch (Exception $e) {
			$success = 0;
			$msg = $e->getMessage();
		}
		
		if ($success == 1) {
			$response = [
				'msg' => 'You have successfully reserved slot. Thank you.',
				'flag' => $success
			];
		} else {
			$response = [
				'msg' => $msg,
				'flag' => $success
			];
		}

		echo json_encode($response);
	}
}
