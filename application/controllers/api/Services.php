<?php
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';

class Services extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url', 'form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Service_model', 'service_model');
	}

	public function add_service_post()
	{
		try {
			$success = 0;
			$msg = array();

			$this->service_model->add(array(
				'name' => trim($this->input->post('name')),
				'short_desc' => trim($this->input->post('short_desc')),
				'amount' => trim($this->input->post('amount'))
			));

			$success = 1;
		} catch (Exception $e) {
			$msg = $e->getMessage();
		}

		if ($success == 1) {
			$response = [
				'msg' => 'Service was successfully added!',
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

	public function update_service_post()
	{
		try {
			$success = 0;
			$msg = array();
			$does_error_occur = FALSE;
			$validation_error_msg = '';

			$payload = array(
				'id' => trim($this->input->post('service_id')),
				'name' => trim($this->input->post('name')),
				'short_desc' => trim($this->input->post('short_desc')),
				'amount' => trim($this->input->post('amount'))
			);

			//start validation
			if (empty($payload['id'])) {
				$does_error_occur = TRUE;
				$validation_error_msg .= 'ID is required.<br/>';
			}

			if (empty($payload['name'])) {
				$does_error_occur = TRUE;
				$validation_error_msg .= 'Name is required.<br/>';
			}

			if (empty($payload['short_desc'])) {
				$does_error_occur = TRUE;
				$validation_error_msg .= 'Short Description is required.<br/>';
            }

			if (empty($payload['amount'])) {
				$does_error_occur = TRUE;
				$validation_error_msg .= 'Amount is required.<br/>';
			}
			if ($does_error_occur) {
				throw new Exception($validation_error_msg);
			}

			$this->service_model->update($payload);
			$success = 1;
		} catch (Exception $e) {
			$msg = $e->getMessage();
		}

		if ($success == 1) {
			$response = [
				'msg' => 'Service was successfully updated!',
				'flag' => $success
			];
		} else {
			$response = [
				'msg' => $msg,
				'flag' => $success
			];
		}

		$this->response($response);
	}

	public function delete_service_delete()
	{
		try {
			$success = 0;
			$serviceId = trim($this->input->get('service_id'));

			if (empty($serviceId))
				throw new Exception("Service ID is required.");

			$this->service_model->delete($serviceId);
			$success = 1;
		} catch (Exception $e) {
			$msg = $e->getMessage();
		}

		if ($success == 1) {
			$response = [
				'msg' => 'Service was successfully deleted.',
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

	public function get_service_by_id_get()
	{
		try {
			$success = 0;
			$serviceId = trim($this->get('service_id'));
			$data = $this->service_model->getById($serviceId);
			$success = 1;
		} catch (Exception $e) {
			$msg = $e->getMessage();
		}

		if ($success == 1) {
			$response = $data[0];
		} else {
			$response = [
				'msg' => $msg,
				'flag' => $success
			];
		}

		$this->response($response);
	}
}
