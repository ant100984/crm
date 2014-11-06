<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('policies_model');
		$this->load->model('appointments_model');
		$this->load->helper('url');
	}

	public function index(){	
		$paid_policies = $this->policies_model->getPolicies('PD');
		$unPaid_policies = $this->policies_model->getPolicies('UPD');
		$paid_policies_per_month = $this->policies_model->getPaidPoliciesPerMonth();
		
		$data['num_paid_policies'] = sizeof($paid_policies);
		$data['num_unPaid_policies'] = sizeof($unPaid_policies);
		$data['paid_policies'] = $paid_policies;
		$data['paid_policies_per_month'] = $paid_policies_per_month;
		
		$appointments = $this->appointments_model->getAppointments();
		
		$data['appointments'] = $appointments;
		
		$data['location'] = 'Dashboard';
		
		$this->load->vars($data);
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/dashboard');
		
		$this->load->view('templates/footer');
	}
}