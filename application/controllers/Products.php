<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url', 'form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Product_model', 'product_model');
	}

	public function index(){
		$this->data['products'] = $this->product_model->getAll();
		$this->load->view('products_page', $this->data);	
	}
}
