<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_home extends CI_Controller {
	public function __construct() {
		parent::__construct();
			
		$this->load->helper('url', 'form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Product_model', 'product_model');
		$this->load->model('Reservation_model', 'reservation_model');
	}

  	public function index() {
		$this->data['products'] = $this->product_model->getAll();
		$this->data['reservations'] = $this->reservation_model->getAllReservation();
		$this->load->view('admin_home_page', $this->data);
	}
}
