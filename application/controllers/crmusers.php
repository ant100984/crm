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

	public function index($userid=FALSE){	
		$data['location'] = 'CRM Users';
		
		$data['users'] = $this->users_model->loadUsers(FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,"crmuser");
		
		$this->load->vars($data);
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/crmUsers');
		
		$this->load->view('templates/footer');
	}
	
	public function saveUser(){
		
		$userId = $this->input->post('user_id');
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$manage_newsletters = $this->input->post('manage_newsletters');
		$manage_customers = $this->input->post('manage_customers');
		$manage_crmusers = $this->input->post('manage_crmusers');
		$manage_messages = $this->input->post('manage_messages');
		
		$profile_photo = FALSE;
		
		if(!empty($_FILES['profile_photo']['name'])) {
		
			$config['upload_path'] = $this->config->item('attachments_full_path');
			$config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF';
			$config['max_size']	= '1000000';
			$config['max_width']  = '100000';
			$config['max_height']  = '100000';
			$config['overwrite']  = TRUE;
			
			$this->load->library('upload', $config);
		   
			if(!$this->upload->do_upload("profile_photo")){
				$error = array('error' => $this->upload->display_errors());
				$data['error_messages'][] = "An error has occurred during the operation";
							
			}else{
				$upload_data = array('upload_data' => $this->upload->data());
				$profile_photo = $this->config->item('attachments_folder')."/".$upload_data['upload_data']['file_name'];
			}
	
		}
		
		$userId = $this->users_model->saveUser($profile_photo, $userId,'1970-01-01',$firstname,$lastname,0,"","","",$email,"","","","","crmuser",$username,$password);
		
		$this->index($userId);
	}
}