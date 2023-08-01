<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookings extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url', 'form');
		$this->load->library('session');
	}

	public function index(){
		$data['error_message'] = '';
		$this->load->view('bookings_page', $data);	
	}
}
