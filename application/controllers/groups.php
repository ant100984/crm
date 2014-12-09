<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('groups_model');
		$this->load->helper('url');
		$this->load->helper('date');
		$data['menu_active'] = "customers";
		$this->load->vars($data);		
	}

	public function index($group=FALSE){
		$data['location'] = "Manage Groups";
		$data['groups'] = $this->groups_model->getGroups();
	
		if($group === FALSE && sizeof($data['groups']) > 0)
			$group = $data['groups'][0];
		else
			$group = $this->groups_model->getGroups($group);
		
		if(!empty($group)){
			$data['customers'] = $this->users_model->loadCustomers(FALSE,FALSE,FALSE,FALSE, $group->id);
			$data['group_to_show'] = $group;
		}
		
		$this->load->vars($data);
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/groups');
		
		$this->load->view('templates/footer');
	}
	
	public function saveGroup(){
		$data['location'] = "Manage Groups";
		
		$group_name = $this->input->post('group_name');
		$group_id = $this->input->post('group_id');
		
		$success = $this->groups_model->saveGroup(empty($group_id) ? FALSE : $group_id, $group_name);
		
		if(!$success)
			$data['error_messages'][] = "There is already a group with the name entered";
		else
			$data['success_messages'][] = "Operation successfully completed";
		
		$this->load->vars($data);
		
		$this->index();
		
	}
	
	public function deleteGroup($group=FALSE){
		$data['location'] = "Manage Groups";
		
		if($group == FALSE){
			$data['error_messages'][] = "You must choose the group to delete";
			return;
		}
		
		$this->groups_model->deleteGroup($group);
		
		$this->index();
	}
}