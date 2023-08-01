<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
require APPPATH . 'libraries/REST_Controller.php';

class Product_payment extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Product_model', 'product_model');
	}

	public function purchase_post(){
		$clientId = $this->session->userdata('client_session')['user_id'];

		try{
			$success = 0;
			$msg = '';

			$this->product_model->checkout(array(
				'user_id' => $clientId,
				'product_id' => $this->post('checkout_product_id'),
				'status' => 'RESERVED',
				'amount' => $this->post('checkout_product_amount')
			));

			$success = 1;
		} catch (Exception $e) {
			$success = 0;
			$msg = $e->getMessage();
		}
		
		if ($success == 1) {
			$response = [
				'msg' => 'You have successfully purchased this product. Thank you.',
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
