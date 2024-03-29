<?php
error_reporting(0);
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
			$uploadsPath = 'uploads/services';
			if(!is_dir($uploadsPath)){
				mkdir($uploadsPath, 0777, true);
			}

			$success = 0;
			$msg = array();
			$service_image_output = array();
			$config['upload_path'] = $uploadsPath;
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 5000; //set the maximum file size in kilobytes (5MB)
			$config['max_width'] = 5000;
			$config['max_height'] = 5000;
			$config['file_name'] = time() . '_' . rand(1000, 9999);
			$this->load->library('upload', $config);

			$fileName = null;

			if (!empty($_FILES['service_img']['name'])) {
				if (!$this->upload->do_upload('service_img')) {
					throw new Exception($this->upload->display_errors());
				} else {
					$upload_img_output = array(
						'image_metadata' => $this->upload->data()
					);

					$service_image_output = array(
						'service_img' => $upload_img_output['image_metadata']['file_name']
					);

					$fileName = $service_image_output['service_img'];
				}
			}

			$this->service_model->add(array(
				'name' => trim($this->input->post('name')),
				'short_desc' => trim($this->input->post('short_desc')),
				'file_name' => $fileName,
				'amount' => trim($this->input->post('amount'))
			));

			$success = 1;
		} catch (Exception $e) {
			$success = 0;
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
			$uploadsPath = 'uploads/services';
			if(!is_dir($uploadsPath)){
				mkdir($uploadsPath, 0777, true);
			}

			$success = 0;
			$msg = array();
			$service_image_output = array();
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

			$detect_if_service_img_exist = $this->service_model->detectIfServiceImgExist($payload['id']);
			$latest_service_img = '';
			$latest_service_img_raw = '';

			if (!empty($detect_if_service_img_exist)) {
				$latest_service_img = $detect_if_service_img_exist[0]->service_display_photo == 'NO IMAGE' ? '' : $detect_if_service_img_exist[0]->service_display_photo;
				$latest_service_img_raw = $detect_if_service_img_exist[0]->service_display_photo_raw == 'NO IMAGE' ? '' : $detect_if_service_img_exist[0]->service_display_photo_raw;
			}

			//validate file upload
			if (empty($_FILES['service_img']['name'])) {
				$payload['file_name'] = $latest_service_img_raw;
			} else {
				$config['upload_path'] = $uploadsPath;
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = 5000; //set the maximum file size in kilobytes (5MB)
				$config['max_width'] = 5000;
				$config['max_height'] = 5000;
				$config['file_name'] = time() . '_' . rand(1000, 9999);
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('service_img')) {
					$msg = $this->upload->display_errors();
					$does_error_occur = TRUE;
					$validation_error_msg .= $msg;
				} else {
					if (!empty($latest_service_img_raw)) {
						unlink('uploads/services/' . $latest_service_img_raw);
					}

					$upload_img_output = array(
						'image_metadata' => $this->upload->data()
					);

					$service_image_output = array(
						'service_img' => $upload_img_output['image_metadata']['file_name']
					);

					$fileName = $service_image_output['service_img'];

					if (is_null($fileName) || empty($fileName)) {
						$does_error_occur = TRUE;
						$validation_error_msg .= 'Service Image is required.<br/>';
					} else {
						$payload['file_name'] = $fileName;
					}
				}
			}

			$this->service_model->update($payload);
			$success = 1;
		} catch (Exception $e) {
			$success = 0;
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
