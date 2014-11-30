<?php /*if ( ! defined('BASEPATH')) exit('No direct script access allowed');*/

class Cron extends MY_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('newsletter_model');
		$this->load->library('email');
		
        // this controller can only be called from the command line
        //if (!$this->input->is_cli_request()) show_error('Direct access is not allowed');
    }
 
    public function sendNewsletters(){
        $newsletters = $this->newsletter_model->getNewsletter(81, "TO_BE_SENT");
		
		$from_address = "JsetecCRM@jsetec.com.sg";
		$from_name = "JsetecCRM";
		
		foreach($newsletters as $newsletter){
			
			$customers = $this->newsletter_model->getNewsletterCustomers($newsletter["id"]);
			$attachments = $this->newsletter_model->getAttachments($newsletter["id"]);
			$subject = "TODO";
			$message = $newsletter["body"];
			
			foreach($customers as $customer){
				foreach($attachments as $attachment)
					$this->email->attach($this->config->item('crm_folder').$attachment->filepath);
				
				$this->email->from($from_address, $from_name);
				$this->email->to($customer->email); 
				$this->email->subject($subject);
				$this->email->message($message);	
				$this->email->send();
			}
		}
    }
	
	public function updatePoliciesStatus(){
	
	}
	
	public function sendAppointmentsAlerts(){
	
	}
	
}