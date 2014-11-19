<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
	
		parent::__construct();
		$this->load->model('messages_model');
		$this->load->helper('url');
		$this->load->library('session');
		
		$messages = $this->messages_model->getMessages(FALSE,FALSE,'R',FALSE,'yes');
		
		$data['messages'] = $messages;
		$data['num_messages'] = sizeof($messages);
		
		$username = $this->session->userdata('username');
		
		if(!empty($username)) $data['username'] = 'Admin';
		
		$this->load->vars($data);
		
		if(empty($username)){
			redirect('notlogged');
		}
		
	}

}