<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointments extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
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
	
		$appointment_id = $this->appointments_model->saveAppointment(empty($appointment_id) ? FALSE : $appointment_id , $customer, $subject, $message, $start_date[2]."-".$start_date[1]."-".$start_date[0], $start_time, $end_date[2]."-".$end_date[1]."-".$end_date[0], $end_time, $location, $alert);
		
		$data['success_messages'][] = "Operation successfully completed";
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
		
		$this->appointments_model->saveRemark(empty($remark_id) ? FALSE : $remark_id, $appointment_id, $notes);
		
		$data['success_messages'][] = "Operation successfully completed";
		$this->load->vars($data);
		
		$this->getAppointment($appointment_id);
	}
	
	public function loadRemark($appointment_id, $remark_id){
		$data['loaded_remark'] = $this->appointments_model->getAppointmentRemarks($appointment_id, $remark_id);
		$this->load->vars($data);
		
		$this->getAppointment($appointment_id);
	}
}