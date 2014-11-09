<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends MY_Controller {

	public function __construct(){
	
		parent::__construct();
		$this->load->model('messages_model');
		$this->load->model('groups_model');
		$this->load->helper('url');
		
	}

	public function index(){	
		$data['location'] = "Instant messages";
		
		$group = $this->input->post('group');
		$direction = $this->input->post('direction');
		
		$data['groups'] = $this->groups_model->getGroups();
		
		$data['filter_group'] = $group;
		$data['filter_direction'] = $direction;
		
		$this->load->vars($data);
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/instantMessages');
		$this->load->view('templates/footer');
		
	}

}