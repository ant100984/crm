<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends MY_Controller {

	public function __construct(){
	
		parent::__construct();
		$this->load->model('users_model');
		$data['menu_active'] = "notifications";
		$this->load->vars($data);
		$this->load->helper('url');
		
	}

	public function index($userid=FALSE){	
		$data['location'] = "Notifications";
		
		$this->users_model->setReadNotifications();
		
		$notifications = $this->users_model->getUserNotifications(FALSE, FALSE);
		
		$data['all_notifications'] = $notifications;
		
		$this->load->vars($data);
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/allNotifications');
		$this->load->view('templates/footer');
		
	}
	
}