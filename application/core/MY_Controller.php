<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
	
		parent::__construct();
		$this->load->model('messages_model');
		$this->load->helper('url');
		
		$messages = $this->messages_model->get_unreadMessages();
		
		$data['messages'] = $messages;
		$data['num_messages'] = sizeof($messages);
		
		/* To be removed */
		
		$data['username'] = 'Admin';
		
		/* end */
		
		$this->load->vars($data);
		
	}

}