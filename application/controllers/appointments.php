<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointments extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('customers_model');
		$this->load->model('appointments_model');
		$this->load->helper('url');
		$this->load->helper('date');
		$data['menu_active'] = "appointments";
		$this->load->vars($data);		
	}

	public function getAppointment($appointment=FALSE, $customer=FALSE){
		$data['location'] = "Manage Appointments";
		
		$data['appointments'] = $this->appointments_model->getAppointments($customer);
		
		$data['customers'] = $this->customers_model->loadCustomers();
		
		if($appointment !== FALSE)
			$data['loaded_appointment'] = $this->appointments_model->getAppointments($customer, $appointment);
		
		$this->load->vars($data);
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/appointmentDetails');
		
		$this->load->view('templates/footer');
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
		$reminder = $this->input->post('reminder');
	
		$this->appointments_model->saveAppointment(empty($appointment_id) ? FALSE : $appointment_id , $customer, $subject, $message, $start_date[2]."-".$start_date[1]."-".$start_date[0], $start_time, $end_date[2]."-".$end_date[1]."-".$end_date[0], $end_time, $location, $reminder);
		
		$data['success_messages'][] = "Operation successfully completed";
		
		$this->getAppointment();
	}
	
}