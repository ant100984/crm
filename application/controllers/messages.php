<?php
class Messages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('messages_model');
		$this->load->helper('url');
	}

	public function index(){	
		
		$data['num_messages'] = $this->messages_model->get_unreadMessagesTo();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/footer');
	}

}