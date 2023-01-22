<?php
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';

class Feedback extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url', 'form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Feedback_model', 'feedback_model');
	}

	public function submit_feedback_post()
	{
		try {
			$success = 0;
			$msg = array();
			$this->feedback_model->add(array(
				'name' => trim($this->input->post('name')),
				'email' => trim($this->input->post('email')),
				'subject' => trim($this->input->post('subject')),
				'message' => trim($this->input->post('message'))
			));

			$success = 1;
		} catch (Exception $e) {
			$success = 0;
			$msg = $e->getMessage();
		}

		if ($success == 1) {
			$response = [
				'msg' => 'Feedback was successfully submitted!',
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
