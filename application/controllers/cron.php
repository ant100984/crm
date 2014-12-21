<?php /*if ( ! defined('BASEPATH')) exit('No direct script access allowed');*/

class Cron extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('newsletter_model');
		$this->load->model('policies_model');
		$this->load->model('appointments_model');
		$this->load->model('users_model');
		$this->load->library('email');
		
        // this controller can only be called from the command line
        //if (!$this->input->is_cli_request()) show_error('Direct access is not allowed');
    }
 
    public function sendNewsletters(){
        $newsletters = $this->newsletter_model->getNewsletter(FALSE, "TO_BE_SENT");
		
		$from_address = "JsetecCRM@jsetec.com.sg";
		$from_name = "JsetecCRM";
		
		foreach($newsletters as $newsletter){
			
			$customers = $this->newsletter_model->getNewsletterCustomers($newsletter->id);
			$attachments = $this->newsletter_model->getAttachments($newsletter->id);
			$subject = $newsletter->subject;
			$message = $newsletter->body;
			
			foreach($customers as $customer){
				foreach($attachments as $attachment)
					$this->email->attach($this->config->item('crm_folder').$attachment->filepath);
				
				$this->email->from($from_address, $from_name);
				$this->email->to($customer->email); 
				$this->email->subject($subject);
				$this->email->message($message);	
				$result = $this->email->send();
				
				$this->newsletter_mdoel->updateNewsletterCustomerStatus($customer->id, $result === TRUE ? "SENT" : "ERROR");
				
			}
			
			$this->newsletter_model->updateNewsletterStatus($newsletter->id, "SENT");
			$this->users_model->insertNotification("Newsletter sent: " . $subject);
		}
    }
	
	public function updatePoliciesStatus(){
		$this->policies_model->updatePoliciesStatus();
	}
	
	public function sendAppointmentsAlerts(){
		$appointments = $this->appointments_model->getAppointmentsToAlert();
		
		$from_address = "JsetecCRM@jsetec.com.sg";
		$from_name = "JsetecCRM";
		
		$admins = $this->users_model->getAdmins();
		
		foreach($appointments as $appointment){
			$subject = "Appointment remainder: " . $appointment->start_date . " to " .$appointment->end_date;
			
			$body  = "This is to remind you for the appointment below: \n\r";
			$body .= "Customer: " . $appointment->firstname. " " .$appointment->lastname . "\n\r";
			$body .= "Start date: ". $appointment->start_date. " End date: ".$appointment->end_date . "\n\r";
			$body .= "Location : ".$appointment->location."\n\r";
			$body .= "Subject: ".$appointment->subject." Message: ".$appointment->message."\n\n";
			
			$this->users_model->insertNotification("Appointment Reminder : " . $appointment->firstname. " " .$appointment->lastname . " " . $appointment->start_date);
			
			$this->email->from($from_address, $from_name);
			
			$this->email->subject($subject);
			$this->email->message($body);	
			
			foreach($admins as $admin){
				$this->email->to($admin->email); 
				$this->email->send();
			}
			
			$this->appointments_model->updateAppointmentAlerted($appointment->id);
			
		}
	}
	
}