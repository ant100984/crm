<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NotLogged extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index(){	
		
		$err_msg = $this->session->flashdata('error_message');
		
		$data['error_message'] = $err_msg;
		
		$this->load->vars($data);
		
		$this->load->view('templates/login');
		
	}
}