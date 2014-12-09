<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointments extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('groups_model');
		$this->load->model('appointments_model');
		$this->load->helper('url');
		$this->load->helper('date');
		$data['menu_active'] = "appointments";
		$this->load->vars($data);		
	}

	public function getAppointment($appointment=FALSE, $customer=FALSE, $remark_id=FALSE){
		$data['location'] = "Manage Appointments";
		
		$data['appointments'] = $this->appointments_model->getAppointments($customer);
		
		$data['customers'] = $this->users_model->loadCustomers();
		
		if($appointment !== FALSE){
			$data['loaded_appointment'] = $this->appointments_model->getAppointments($customer, $appointment);
			$data['remarks'] = $this->appointments_model->getAppointmentRemarks($appointment);
		}
		
		if($remark_id !== FALSE)
			$data['loaded_remark'] = $this->appointments_model->loadRemark($remark_id);
		
		$this->load->vars($data);
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/appointmentDetails');
		$this->load->view('init_calendar.php');
		$this->load->view('templates/footer');
	}
	
	public function newAppointment(){
		
		$loaded_appointment = new stdClass();
		
		$loaded_appointment->start_date = $this->input->post('selected_date');
		$loaded_appointment->end_date = $this->input->post('selected_date');
		
		$data['loaded_appointment'] = $loaded_appointment;
		$this->load->vars($data);
		
		$this->getAppointment();
	}
	
	public function saveAppointment(){
		$appointment_id = $this->input->post('appointment_id');
		$customer = $this->input->post('customer_id');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		$start_date = explode("/", $this->input->post('start_date'));
		$end_date = explode("/", $this->input->post('end_date'));
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post('end_time');
		$location = $this->input->post('location');
		$alert = $this->input->post('alert');
	
		$customer_appointments = $this->appointments_model->getAppointments($customer);
	
		if(sizeof($customer_appointments) >= $this->config->item('max_appointments_number')){
			$data['error_messages'][] = "The customer already have " . $this->config->item('max_appointments_number') . " appointments set";
		}else{
			$appointment_id = $this->appointments_model->saveAppointment(empty($appointment_id) ? FALSE : $appointment_id , $customer, $subject, $message, $start_date[2]."-".$start_date[1]."-".$start_date[0], $start_time, $end_date[2]."-".$end_date[1]."-".$end_date[0], $end_time, $location, $alert);
			$data['success_messages'][] = "Operation successfully completed";
		}
		
		$this->load->vars($data);
		$this->getAppointment($appointment_id);
	}
	
	public function deleteAppointment($appointment_id){
		
		$this->appointments_model->deleteAppointment($appointment_id);
		
		$data['success_messages'][] = "Operation successfully completed";
		$this->load->vars($data);
		
		$this->getAppointment();
	}
	
	public function deleteRemark($remark_id, $appointment_id){
		
		$this->appointments_model->deleteRemark($remark_id);
		
		$data['success_messages'][] = "Operation successfully completed";
		$this->load->vars($data);
		
		$this->getAppointment($appointment_id);
	}
	
	public function saveRemark(){
		$notes = $this->input->post('notes');
		$appointment_id = $this->input->post('appointment_id');
		$remark_id = $this->input->post('remark_id');
		
		$remarks = $this->appointments_model->getAppointmentRemarks($appointment_id);
		
		if(sizeof($remarks) >= $this->config->item('max_remarks_appointment')){
			$data['error_messages'][] = "The appointment already have " . $this->config->item('max_remarks_appointment') . " remarks";
		}else{
			$this->appointments_model->saveRemark(empty($remark_id) ? FALSE : $remark_id, $appointment_id, $notes);
			$data['success_messages'][] = "Operation successfully completed";
		}
		
		$this->load->vars($data);
		$this->getAppointment($appointment_id);
	}
	
	public function loadRemark($appointment_id, $remark_id){
		$data['loaded_remark'] = $this->appointments_model->getAppointmentRemarks($appointment_id, $remark_id);
		$this->load->vars($data);
		
		$this->getAppointment($appointment_id);
	}
	
	public function getRemarksCustomers($group=FALSE){
		$data['location'] = "Remarks List";
		$data['max_appointments'] = $this->config->item('max_appointments_number');
		$data['groups'] = $this->groups_model->getGroups();
		
		if($group === FALSE && sizeof($data['groups']) > 0)
			$group = $data['groups'][0];
		else
			$group = $this->groups_model->getGroups($group);
		
		if(!empty($group)){
			$customers = $this->users_model->loadCustomers(FALSE,FALSE,FALSE,FALSE, $group->id);
			$data['group_to_show'] = $group;
		
			$result = array();
			$i = 0;
			foreach($customers as $customer){
				$result[$i]['firstname'] = $customer->firstname;
				$result[$i]['lastname'] = $customer->lastname;
				$result[$i]['profilephoto'] = $customer->profilephoto;
				$result[$i]['remarks'] = $this->appointments_model->loadRemarksCustomers($customer->id);
				$i++;
			}
		
			$data['customers_remarks'] = $result;
		}
		
		$this->load->vars($data);
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/remarksCustomer');
		$this->load->view('templates/footer');
	}
}