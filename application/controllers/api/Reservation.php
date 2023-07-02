<?php
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';

class Reservation extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url', 'form');
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
}
