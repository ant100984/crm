<?php
class Messages_model extends CI_Model {

	public function __construct(){
	
		$this->load->database();
		
	}
	
	public function getMessages($customer_id = FALSE, $status = FALSE, $direction = FALSE, $group = FALSE){
	
		$this->db->select('users.firstname, users.lastname, messages.messagetext, date_format(messages.datesent,"%d/%m/%Y %H:%i:%s") as datesent', FALSE);
		$this->db->from('messages');
		$this->db->join('users', 'users.id = messages.sender');
		/*$this->db->where('messages.dateread IS NULL');*/
		
		$query = $this->db->get();
		
		return $query->result();
		
	}
	
}