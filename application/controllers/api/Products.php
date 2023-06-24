<?php
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';

class Products extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url', 'form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Product_model', 'product_model');
	}

	public function add_product_post()
	{
		try {
			$uploadsPath = 'uploads/products';
			if(!is_dir($uploadsPath)){
				mkdir($uploadsPath, 0777, true);
			}

			$success = 0;
			$msg = array();
			$product_image_output = array();
			$config['upload_path'] = $uploadsPath;
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 5000; //set the maximum file size in kilobytes (5MB)
			$config['max_width'] = 5000;
			$config['max_height'] = 5000;
			$config['file_name'] = time() . '_' . rand(1000, 9999);
			$this->load->library('upload', $config);

			$fileName = null;

			if (!empty($_FILES['product_img']['name'])) {
				if (!$this->upload->do_upload('product_img')) {
					throw new Exception($this->upload->display_errors());
				} else {
					$upload_img_output = array(
						'image_metadata' => $this->upload->data()
					);

					$product_image_output = array(
						'product_img' => $upload_img_output['image_metadata']['file_name']
					);

					$fileName = $product_image_output['product_img'];
				}
			}

			$this->product_model->add(array(
				'name' => trim($this->input->post('name')),
				'short_desc' => trim($this->input->post('short_desc')),
				'long_desc' => trim($this->input->post('long_desc')),
				'file_name' => $fileName,
				'amount' => trim($this->input->post('amount')),
				'quantity' => trim($this->input->post('quantity')),
				'expiration_date' => trim($this->input->post('expiration_date'))
			));

			$success = 1;
		} catch (Exception $e) {
			$success = 0;
			$msg = $e->getMessage();
		}

		if ($success == 1) {
			$response = [
				'msg' => 'Product was successfully added!',
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

	public function update_product_post()
	{
		try {
			$uploadsPath = 'uploads/products';
			if(!is_dir($uploadsPath)){
				mkdir($uploadsPath, 0777, true);
			}

			$success = 0;
			$msg = array();
			$product_image_output = array();
			$does_error_occur = FALSE;
			$validation_error_msg = '';

			$payload = array(
				'id' => trim($this->input->post('product_id')),
				'name' => trim($this->input->post('name')),
				'short_desc' => trim($this->input->post('short_desc')),
				'long_desc' => trim($this->input->post('long_desc')),
				'amount' => trim($this->input->post('amount')),
				'quantity' => trim($this->input->post('quantity')),
				'expiration_date' => trim($this->input->post('expiration_date'))
			);

			//start validation
			if (empty($payload['id'])) {
				$does_error_occur = TRUE;
				$validation_error_msg .= 'Product ID is required.<br/>';
			}

			if (empty($payload['name'])) {
				$does_error_occur = TRUE;
				$validation_error_msg .= 'Product name is required.<br/>';
			}

			if (empty($payload['short_desc'])) {
				$does_error_occur = TRUE;
				$validation_error_msg .= 'Product Short Description is required.<br/>';
			}

			if (empty($payload['long_desc'])) {
				$does_error_occur = TRUE;
				$validation_error_msg .= 'Product Long Description is required.<br/>';
			}

			if (empty($payload['amount'])) {
				$does_error_occur = TRUE;
				$validation_error_msg .= 'Product Amount is required.<br/>';
			}

			if (empty($payload['quantity'])) {
				$does_error_occur = TRUE;
				$validation_error_msg .= 'Product Quantity is required.<br/>';
			}

			if (empty($payload['expiration_date'])) {
				$does_error_occur = TRUE;
				$validation_error_msg .= 'Product Expiration Date is required.<br/>';
			}

			$detect_if_product_img_exist = $this->product_model->detectIfProductImgExist($payload['id']);
			$latest_product_img = '';
			$latest_product_img_raw = '';

			if (!empty($detect_if_product_img_exist)) {
				$latest_product_img = $detect_if_product_img_exist[0]->product_display_photo == 'NO IMAGE' ? '' : $detect_if_product_img_exist[0]->product_display_photo;
				$latest_product_img_raw = $detect_if_product_img_exist[0]->product_display_photo_raw == 'NO IMAGE' ? '' : $detect_if_product_img_exist[0]->product_display_photo_raw;
			}

			//validate file upload
			if (empty($_FILES['product_img']['name'])) {
				$payload['file_name'] = $latest_product_img_raw;
			} else {
				$config['upload_path'] = $uploadsPath;
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = 5000; //set the maximum file size in kilobytes (5MB)
				$config['max_width'] = 5000;
				$config['max_height'] = 5000;
				$config['file_name'] = time() . '_' . rand(1000, 9999);
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('product_img')) {
					$msg = $this->upload->display_errors();
					$does_error_occur = TRUE;
					$validation_error_msg .= $msg;
				} else {
					if (!empty($latest_product_img_raw)) {
						unlink('uploads/products/' . $latest_product_img_raw);
					}

					$upload_img_output = array(
						'image_metadata' => $this->upload->data()
					);

					$product_image_output = array(
						'product_img' => $upload_img_output['image_metadata']['file_name']
					);

					$fileName = $product_image_output['product_img'];

					if (is_null($fileName) || empty($fileName)) {
						$does_error_occur = TRUE;
						$validation_error_msg .= 'Product Image is required.<br/>';
					} else {
						$payload['file_name'] = $fileName;
					}
				}
			}

			if ($does_error_occur) {
				throw new Exception($validation_error_msg);
			}

			$this->product_model->update($payload);
			$success = 1;
		} catch (Exception $e) {
			$success = 0;
			$msg = $e->getMessage();
		}

		if ($success == 1) {
			$response = [
				'msg' => 'Product was successfully updated!',
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

	public function delete_product_delete()
	{
		try {
			$success = 0;
			$productId = trim($this->input->get('product_id'));

			if (empty($productId))
				throw new Exception("Product ID is required.");

			$this->product_model->delete($productId);
			$success = 1;
		} catch (Exception $e) {
			$msg = $e->getMessage();
		}

		if ($success == 1) {
			$response = [
				'msg' => 'Product was successfully deleted.',
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

	public function get_product_by_id_get()
	{
		try {
			$success = 0;
			$productId = trim($this->get('product_id'));
			$data = $this->product_model->getProductById($productId);
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
