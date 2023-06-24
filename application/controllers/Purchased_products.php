<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchased_products extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url', 'form');
		$this->load->library('session');
        $this->load->database();
        $this->load->model('Reservation_model', 'reservation_model');
		$this->load->model('Product_purchase_model', 'product_purchase_model');
	}

	public function index(){
        $clientId = $this->session->userdata('client_session')['user_id'];
		$this->data['purchased_products'] = $this->product_purchase_model->getAllByUserId($clientId);
		$this->load->view('purchased_products_page', $this->data);	
	}
}
