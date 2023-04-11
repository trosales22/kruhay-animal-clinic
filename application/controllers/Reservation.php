<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url', 'form');
		$this->load->library('session');
        $this->load->database();
        $this->load->model('Reservation_model', 'reservation_model');
	}

	public function index(){
        $clientId = $this->session->userdata('client_session')['user_id'];
        $this->data['reservations'] = $this->reservation_model->getAllByUserId($clientId);
		$this->load->view('reservation_list_page', $this->data);	
	}
}
