<?php
class Messages_model extends CI_Model {

	public function __construct(){
	
		$this->load->database();
		
	}
	
	public function get_unreadMessages(){
	
		$this->db->select('customers.firstname, customers.lastname, messages.messagetext, date_format(messages.datereceived,"%d/%m/%Y %H:%i:%s") as datereceived', FALSE);
		$this->db->from('messages');
		$this->db->join('customers', 'customers.id = messages.fromuser');
		$this->db->where('messages.dateread IS NULL');
		
		$query = $this->db->get();
		
		return $query->result();
		
	}
	
}