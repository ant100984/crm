<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('policies_model');
		$this->load->model('users_model');
		$this->load->model('attachments_model');
		$this->load->model('groups_model');
		$this->load->helper('url');
		$this->load->helper('date');
		$data['menu_active'] = "customers";
		$this->load->vars($data);
	}

	public function getCustomer($customer=FALSE,$policy=FALSE){	
		if($customer !== FALSE)
			$data['location'] = 'Edit Customer';
		else
			$data['location'] = 'New Customer';
		
		$data['groups'] = $this->groups_model->getGroups();
		$data['policies_status'] = $this->policies_model->getPoliciesStatus();
		$data['policies_reminders'] = $this->policies_model->getReminders();
		
		if($customer !== FALSE){
			$data['policies'] = $this->policies_model->getPolicies(FALSE,$customer,FALSE);
			$data['customer'] = $this->users_model->loadCustomers($customer);
			$data['attachments'] = $this->attachments_model->getAttachments($customer);
			
			if($policy !== FALSE)
				$data['loaded_policy'] = $this->policies_model->getPolicies(FALSE,$customer,$policy); 
				
		}
		
		$this->load->vars($data);
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/customerDetails');
		
		$this->load->view('templates/footer');
	}
	
	public function filterCustomers(){
		
		$filter_string = $this->input->post('filter_string');
	
		$data['customers'] = $this->users_model->filterCustomers($filter_string);
		$this->load->vars($data);
		$this->load->view('templates/customersTableContent');
	
	}
	
	public function index(){	
		$data['location'] = 'Customers List';
		
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname'); 
		$gender = $this->input->post('gender');
		$group = $this->input->post('group');
		$smoker = $this->input->post('smoker');
		
		$data['customers'] = $this->users_model->loadCustomers(FALSE, empty($firstname) ? FALSE : $firstname, empty($lastname) ? FALSE : $lastname, empty($gender) ? FALSE : $gender, empty($group) ? FALSE : $group, empty($smoker) ? FALSE : $smoker);
		$data['groups'] = $this->groups_model->getGroups();
		$data['filter_firstname'] = $firstname;
		$data['filter_lastname'] = $lastname;
		$data['filter_gender'] = $gender;
		$data['filter_group'] = $group;
		$data['filter_smoker'] = $smoker;
		
		$data['ACTION_BUTTONS'] = true;
		$data['CUSTOMERS_SELECTABLE'] = false;
		$data['AJAX_FILTER'] = false;
		
		$this->load->vars($data);
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/customersList');
		
		$this->load->view('templates/footer');
	}
	
	public function ajaxList(){	
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname'); 
		$gender = $this->input->post('gender');
		$group = $this->input->post('group');
		$smoker = $this->input->post('smoker');
		
		error_log($firstname." ".$lastname." ".$gender." ".$group." ".$smoker);
		
		$data['customers'] = $this->users_model->loadCustomers(FALSE, empty($firstname) ? FALSE : $firstname, empty($lastname) ? FALSE : $lastname, empty($gender) ? FALSE : $gender, empty($group) ? FALSE : $group, empty($smoker) ? FALSE : $smoker);
		$data['groups'] = $this->groups_model->getGroups();
		$data['filter_firstname'] = $firstname;
		$data['filter_lastname'] = $lastname;
		$data['filter_gender'] = $gender;
		$data['filter_group'] = $group;
		$data['filter_smoker'] = $smoker;
		
		$data['ACTION_BUTTONS'] = false;
		$data['CUSTOMERS_SELECTABLE'] = true;
		$data['AJAX_FILTER'] = true;
		
		$this->load->vars($data);
		
		$this->load->view('templates/customersList');
	}
	
	public function setCustomerEnabled($customer, $enabled){
		
		$this->users_model->setUserEnabled($customer, $enabled);
		
		$data['success_messages'][] = "Operation successfully completed";
		$this->load->vars($data);
		$this->index();
		
	}
	
	public function savePolicy(){
	
		$id = $this->input->post('policy_id');
		$customer_id = $this->input->post('customer_id');
		$name = $this->input->post('policy_name');
		$reminder = $this->input->post('policy_reminder');
		$status = $this->input->post('policy_status');
		$notes = $this->input->post('policy_notes');
		
		$date = explode("/", $this->input->post('policy_date'));
		
		$this->policies_model->savePolicy($name,$date[2]."-".$date[1]."-".$date[0],$reminder,$status,$notes,$id,$customer_id);
		
		$data['success_messages'][] = "Operation successfully completed";
		
		$this->load->vars($data);
		
		$this->getCustomer($customer_id);
	
	}
	
	public function deletePolicy($customer, $id){
		$this->policies_model->deletePolicy($id);
		$data['success_messages'][] = "Operation successfully completed";
		$this->load->vars($data);
		$this->getCustomer($customer);
	}
	
	public function saveCustomer(){
	
		$customer_id = $this->input->post('customer_id');
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$group = $this->input->post('group');
		$dob = explode("/", $this->input->post('dob'));
		$gender = $this->input->post('gender');
		$occupation = $this->input->post('occupation');
		$smoker = $this->input->post('smoker');
		$email = $this->input->post('email');
		$home_address = $this->input->post('home_address');
		$business_address = $this->input->post('business_address');
		$nric = $this->input->post('NRIC');
		$notes = $this->input->post('note');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
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
		
		$this->users_model->saveCustomer($profile_photo,$customer_id,$dob[2]."-".$dob[1]."-".$dob[0],$firstname,$lastname,$group,$gender,$occupation,$smoker,$email,$home_address,$business_address,$nric,$notes,$username,$password);
		
		$data['success_messages'][] = "Operation successfully completed";
		
		$this->load->vars($data);
		
		if(!empty($customer_id))
			$this->getCustomer($customer_id);
		else
			$this->index();
	}
	
	public function uploadAttachment(){
		$customer_id = $this->input->post('customer_id');
		
		$config['upload_path'] = $this->config->item('attachments_full_path');
		$config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|pdf|PDF|doc|DOC|docx|DOCX|xls|XLS|xlsx|XLSX';
		$config['max_size']	= '1000000';
		$config['max_width']  = '100000';
		$config['max_height']  = '100000';
		$config['overwrite']  = TRUE;
		
		$this->load->library('upload', $config);
	   
		if(!$this->upload->do_upload("attachment")){
			$error = array('error' => $this->upload->display_errors());
			$data['error_messages'][] = "An error has occurred during the operation";
		}else{
			$upload_data = array('upload_data' => $this->upload->data());
			$data['success_messages'][] = "Operation successfully completed";
			$this->users_model->saveAttachment($upload_data['upload_data']['file_name'],$this->config->item('attachments_folder')."/".$upload_data['upload_data']['file_name'],$customer_id);
		}
		$this->load->vars($data);
		$this->getCustomer($customer_id);
	}
	
	public function deleteAttachment($customer, $id){
		$this->users_model->deleteAttachment($id);
		$data['success_messages'][] = "Operation successfully completed";
		$this->getCustomer($customer);
	}
}