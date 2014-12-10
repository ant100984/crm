<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('messages_model');
		$this->load->model('users_model');
	}
	
	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$user = $this->checkLogin($username,$password);
		
		if($user === FALSE){
			$result = array();
			$result['result'] = "KO";
			$result['error'] = "Authentication failed";
		}else{
			$result['result'] = "OK";
		}
		
		die(json_encode($result));
	}
	
	public function retrieveMessages(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$user = $this->checkLogin($username,$password);
		$result = array();
		
		if($user === FALSE){
			$result['result'] = "KO";
			$result['error'] = "Authentication failed";
		}else{
			$messages = $this->messages_model->getMessages($user->id, FALSE, FALSE, FALSE, FALSE);
			$result["result"] = "OK";
			$result["messages"] = $messages;
		}
		
		die(json_encode($result));
	}
	
	public function sendMessage(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$message = $this->input->post('message');
		
		$user = $this->checkLogin($username,$password);
		$result = array();
		
		if($user === FALSE){
			$result['result'] = "KO";
			$result['error'] = "Authentication failed";
		}else{
			$this->messages_model->insertMessage($message, $user->id, 1);
			$result["result"] = "OK";
		}
		
		die(json_encode($result));
	}
	
	private function checkLogin($username, $password){
	
		$user = $this->users_model->checkLogin($username,$password);
		
		if($user === FALSE){
			return FALSE;
		}
		
		return $user;
		
	}
	
}