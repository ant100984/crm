<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('users_model');
		$this->load->library('session');
	}

	public function index(){	
		
		$username = $this->input->post('userid');
		$password = $this->input->post('password');
		
		$result = $this->users_model->checkLogin($username, $password);
		
		if($result === FALSE){
		
			$this->session->set_flashdata('error_message', 'wrong username or password!');
			redirect('notlogged');
			
		}else{
		
			$this->session->set_userdata('permissions', $this->users_model->getUserPermissions($result->id)); 
			$this->session->set_userdata('username',$result->username);
			$this->session->set_userdata('display_name',$result->firstname);
			$this->session->set_userdata('userid',$result->id);
			redirect('welcome');
			
		}
	}
}