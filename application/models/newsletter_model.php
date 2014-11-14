<?php
class Newsletter_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function getTemplates(){
	
		$this->db->select('t.id, t.title, t.body', FALSE);
		$this->db->from('newsletter_templates t');
		
		$query = $this->db->get();
		
		return $query->result();
	
	}
	
	public function getNewsletter($newsletter_id){
		$this->db->select('n.id, n.body, n.template_id, n.dtmsent, n.dtmcreated');
		$this->db->from('newsletters n');
		$this->db->where('id',$newsletter_id);
		
		$query = $this->db->get();
		return $query->row();
	}
	
	public function saveNewsletter($newsletter_id=FALSE, $template_id, $newsletter_body){
		date_default_timezone_set('Asia/Singapore');
		
		$data = array(
			"dtmcreated" => date("Y-m-d H:i:s"),
			"template_id" => $template_id,
			"body" => $newsletter_body,
			"status" => "DRAFT"
		);
		
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
	
}	