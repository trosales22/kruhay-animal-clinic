<?php
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';

class Products extends REST_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url', 'form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Product_model', 'product_model');
	}

	public function add_product_post(){
		try{
			$success = 0;
			$msg = array();
			$product_image_output = array();
			$config['upload_path'] = 'uploads/products/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 5000; //set the maximum file size in kilobytes (5MB)
			$config['max_width'] = 5000;
			$config['max_height'] = 5000;
			$config['file_name'] = time() . '_' . rand(1000,9999);
			$this->load->library('upload', $config);

			$fileName = null;
			
			if(!$this->upload->do_upload('product_img')) {
				throw new Exception($this->upload->display_errors());
			}else{
				$upload_img_output = array(
					'image_metadata' => $this->upload->data()
				);

				$product_image_output = array(
					'product_img' => $upload_img_output['image_metadata']['file_name']
				);

				$fileName = $product_image_output['product_img'];
			}

			if(is_null($fileName) || empty($fileName)){
				throw new Exception('Product image is required.');
			}

			$this->product_model->add(array(
				'name' => trim($this->input->post('name')),
				'short_desc' => trim($this->input->post('short_desc')),
				'long_desc' => trim($this->input->post('long_desc')),
				'file_name' => $fileName,
				'amount' => trim($this->input->post('amount')),
				'quantity' => trim($this->input->post('quantity'))
			));

			$success  = 1;
		}catch (Exception $e){
			$msg = $e->getMessage();      
		}

		if($success == 1){
			$response = [
				'msg' => 'Product was successfully added!',
				'flag' => $success
			];
		}else{
			$response = [
				'msg' => $msg,
				'flag' => $success
			];
		}

		echo json_encode($response);
	}
}
