<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';

class Payment extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url', 'form');
		$this->load->database();
		$this->load->model('Reservation_model', 'reservation_model');
	}

	public function validate_sched_post()
	{
		$schedule_date = $this->post('schedule_date');
		$schedule_time = $this->post('schedule_time');

		$validateSched = $this->reservation_model->checkExistingReservationSched($schedule_date, $schedule_time);

		echo json_encode([
			'schedule_date' => $schedule_date,
			'schedule_time' => $schedule_time,
			'is_sched_taken' => !empty($validateSched)
		]);
	}
}
