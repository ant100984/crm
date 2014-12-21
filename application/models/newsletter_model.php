<?php
class Newsletter_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function getTemplates($id=FALSE){
	
		$this->db->select('t.id, t.title, t.body', FALSE);
		$this->db->from('newsletter_templates t');
		
		if($id !== FALSE)
			$this->db->where("t.id = {$id}");
			
		$query = $this->db->get();
		
		if($id !== FALSE)
			return $query->row();
		else
			return $query->result();

	}
	
	public function getNewsletter($newsletter_id=FALSE,$status=FALSE){
		
		$this->db->select("n.id, n.subject, n.body, n.template_id, IF(t.title IS NULL, '', t.title) AS template_name, if(n.status='DRAFT' or n.status = 'SENT',n.status,if(n.status='TO_BE_SENT','TO BE SENT','')) as status, date_format(n.dtmsent,'%d/%m/%Y %h:%i:%s') as dtmsent, us.username as usersent, date_format(n.dtmcreated,'%d/%m/%Y %h:%i:%s') as dtmcreated, uc.username as usercreated, SUM(IF(nc.customer IS NULL, 0, 1)) AS customers",FALSE);
		$this->db->from("newsletters n");
		$this->db->join("newsletter_customer nc","nc.newsletter = n.id","left");
		$this->db->join("newsletter_templates t","t.id = n.template_id","left");
		$this->db->join("users uc","uc.id = n.usercreated","left");
		$this->db->join("users us","us.id = n.usersent","left");
		$this->db->order_by("n.dtmcreated","desc");
		$this->db->group_by(array("id", "body", "template_id", "template_name", "status", "dtmsent", "dtmcreated","usersent","usercreated"));
		
		if($newsletter_id !== FALSE)
			$this->db->where('n.id',$newsletter_id);
		
		if($status !== FALSE)
			$this->db->where('n.status',$status);
		
		$query = $this->db->get();
		
		if($newsletter_id !== FALSE)
			return $query->row();
		else
			return $query->result();
	}
	
	public function saveNewsletter($newsletter_id=FALSE, $template_id, $newsletter_subject, $newsletter_body, $status="DRAFT", $user){
		date_default_timezone_set('Asia/Singapore');
		
		$data = array(
			"dtmcreated" => date("Y-m-d H:i:s"),
			"template_id" => $template_id === FALSE ? null : $template_id,
			"subject"=>$newsletter_subject,
			"body" => $newsletter_body,
			"status" => $status
		);
		
		if($status == "DRAFT")
			$data["usercreated"] = $user;
		else if($status == "TO_BE_SENT"){
			$data["usersent"] = $user;
			$data["usercreated"] = $user;
			$data["dtmsent"] = date("Y-m-d H:i:s");
		}
		
		if($newsletter_id !== FALSE){
			$this->db->where("id", $newsletter_id);
			$this->db->update("newsletters", $data);
		}else{
			$this->db->insert("newsletters", $data);
			$newsletter_id = $this->db->insert_id();
		}
		
		return $newsletter_id;
	}
	
	public function getAttachments($newsletter_id){
		$this->db->select('na.id, na.newsletter_id, na.filename, na.filepath', FALSE);
		$this->db->from('newsletter_attachments na');
		$this->db->where('na.newsletter_id', $newsletter_id);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function saveAttachment($newsletter_id, $filename, $filefullpath){
		$data = array(
			"newsletter_id"=>$newsletter_id,
			"filepath"=>$filefullpath,
			"filename"=>$filename
		);
		
		$this->db->insert("newsletter_attachments", $data);
	}
	
	public function deleteAttachment($attachment_id){
		$this->db->delete('newsletter_attachments', array('id' => $attachment_id)); 
	}
	
	public function addCustomers($newsletter_id, $customers){
		
		foreach($customers as $customer_id){
			
			$this->db->where('customer', $customer_id);
			$this->db->where('newsletter', $newsletter_id);
			$this->db->from('newsletter_customer');
			$count = $this->db->count_all_results();
			
			if($count == 0){
				$data = array(
					'customer' => $customer_id,
					'newsletter' => $newsletter_id,
					'status' => 'NOT_SENT'
				);
				
				$this->db->insert('newsletter_customer',$data);
			}	
			
		}
	}
	
	public function getNewsletterCustomers($newsletter_id){
		$this->db->select('nc.id, nc.newsletter, nc.customer, nc.status, u.firstname, u.lastname, u.email', FALSE);
		$this->db->join('users u','u.id=nc.customer');
		$this->db->from('newsletter_customer nc');
		$this->db->where('nc.newsletter', $newsletter_id);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function deleteCustomerNewsletter($id){
		$this->db->delete('newsletter_customer', array('id' => $id)); 
	}
	
	public function deleteAllNewsletterCustomers($newsletterid){
		$this->db->delete('newsletter_customer', array('newsletter' => $newsletterid)); 
	}
	
	public function saveBodyAsTemplate($template_title,$newsletter_body){
		$data = array(
			'title' => $template_title,
			'body' => $newsletter_body);
			
		$this->db->insert("newsletter_templates", $data);
	}
	
	public function deleteNewsletter($newsletterid){
		$this->db->delete('newsletters', array('id' => $newsletterid)); 
		$this->deleteAllNewsletterCustomers($newsletterid);
	}
	
	public function updateNewsletterCustomerStatus($id,$status){
		$data = array(
			"status" => $status
		);
		
		$this->db->where("id",$id);
		$this->db->update("newsletter_customer", $data);
	}
	
	public function updateNewsletterStatus($newsletterid, $status){
		$data = array(
			"status" => $status
		);
		
		$this->db->where("id",$newsletterid);
		$this->db->update("newsletters", $data);
	}
}	