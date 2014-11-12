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
	
	public function getNewId(){
		$this->db->select_max('newsletter_id');
		$query = $this->db->get('tmp_newsletter_attachments');
		$row = $query->row();
		return $row->newsletter_id + 1;
	}
	
}