<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('newsletter_model');
		$this->load->helper('url');
		$this->load->helper('date');
		$data['menu_active'] = "messaging";
		$this->load->vars($data);		
	}

	public function index(){
		$data['location'] = "Newsletter";
		
		$data['newsletter_id'] = $this->newsletter_model->getNewId();
		$data['templates'] = $this->newsletter_model->getTemplates();
		
		$this->load->vars($data);
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/newsletter');
		$this->load->view('templates/footer');
		
	}
	
}