<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
	
		parent::__construct();
		$this->load->model('messages_model');
		$this->load->model('users_model');
		$this->load->helper('url');
		$this->load->library('session');
		
		$messages = $this->messages_model->getMessages(FALSE,FALSE,'R',FALSE,'yes');
		
		$data['messages'] = $messages;
		$data['num_messages'] = sizeof($messages);
		
		$username = $this->session->userdata('username');
		$userid = $this->session->userdata('userid');
		$displayname = $this->session->userdata('display_name');
		$data['user_permissions'] = $this->session->userdata('permissions');
		$data['userid'] = $userid;
		
		$user = $this->users_model->loadUsers($userid,FALSE,FALSE,FALSE,FALSE,FALSE,"crmuser",FALSE);
		
		if(!empty($username)) $data['username'] = $username;
		if(!empty($displayname)) $data['displayname'] = $displayname;
		
		$data['profile_photo'] = $user->profilephoto;
		
		$this->load->vars($data);
		
		if(empty($username)){
			redirect('notlogged');
		}
		
	}

}