<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crmusers extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('users_model');
		$this->load->library('session');
		$data['menu_active'] = "";
		$this->load->vars($data);
	}

	public function index(){	
		$data['location'] = 'CRM Users';
		
		$data['users'] = $this->users_model->loadUsers(FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,"crmuser");
		
		$this->load->vars($data);
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/crmUsers');
		
		$this->load->view('templates/footer');
	}
}