<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('newsletter_model');
		$this->load->helper('url');
		$this->load->helper('date');
		$data['menu_active'] = "messaging";
		$this->load->vars($data);		
	}

	public function index($newsletter_id=FALSE){
		$data['location'] = "Newsletters";
		
		if($newsletter_id !== FALSE){
			$data['loaded_newsletter'] = $this->newsletter_model->getNewsletter($newsletter_id);
			$data['attachments'] = $this->newsletter_model->getAttachments($newsletter_id);
		}
		
		$data['templates'] = $this->newsletter_model->getTemplates();
		
		$this->load->vars($data);
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('templates/newsletter');
		$this->load->view('templates/footer');
		
	}
	
	public function saveNewsletter(){
		$newsletter_id = $this->input->post('newsletter_id');
		$template_id = $this->input->post('template');
		$newsletter_body = $this->input->post('newsletter_body');
		
		$upload = $this->input->post('upload');
		
		$newsletter_id = $this->newsletter_model->saveNewsletter(empty($newsletter_id) ? FALSE : $newsletter_id, $template_id, $newsletter_body);
		
		if(!empty($upload)){
			if(!empty($_FILES['attachment']['name'])) {
		
				$config['upload_path'] = $this->config->item('attachments_full_path');
				$config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF|doc|DOC|docx|DOCX|pdf|PDF|txt|TXT|xls|XLS|xlsx|XLSX|bmp|BMP|html|HTML';
				$config['max_size']	= '1000000';
				$config['max_width'] = '100000';
				$config['max_height'] = '100000';
				$config['overwrite'] = TRUE;
				
				$this->load->library('upload', $config);
			   
				if(!$this->upload->do_upload("attachment")){
					$error = array('error' => $this->upload->display_errors());
					$data['error_messages'][] = "An error has occurred during the operation";
				}else{
					$upload_data = array('upload_data' => $this->upload->data());
					$attachment = $this->config->item('attachments_folder')."/".$upload_data['upload_data']['file_name'];
					$this->newsletter_model->saveAttachment($newsletter_id,$upload_data['upload_data']['file_name'],$this->config->item('attachments_folder')."/".$upload_data['upload_data']['file_name']);
				}
			}
		}
		
		$data['success_messages'][] = "Newsletter saved. Status: DRAFT";
		$this->load->vars($data);
		$this->index($newsletter_id);
	}
	
	public function deleteAttachment($attachment_id, $newsletter_id){
		$this->newsletter_model->deleteAttachment($attachment_id);
		$data['success_messages'][] = "Operation successfully completed";
		$this->load->vars($data);
		$this->index($newsletter_id);
	}
}