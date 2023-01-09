<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url', 'form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Service_model', 'service_model');
	}

	public function index(){
		$this->data['services'] = $this->service_model->getAll();
		$this->load->view('services_page', $this->data);	
	}
}
