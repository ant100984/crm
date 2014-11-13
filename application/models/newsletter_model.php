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
	
	public function createDraftNewsletter(){
		$data = array("status" => "draft");
		$this->db->insert("newsletters",$data);
		return $this->db->insert_id();
	}
	
}