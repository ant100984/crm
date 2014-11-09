<?php
class Attachments_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function getAttachments($user=FALSE){
		$this->db->select('a.id, a.user_id, a.attachment_name, a.attachment_path', FALSE);
		$this->db->from('attachments a');
		
		if($user !== FALSE)
			$this->db->where("a.user_id = '{$user}'");
		
		$query = $this->db->get();
		
		return $query->result();
	}

}