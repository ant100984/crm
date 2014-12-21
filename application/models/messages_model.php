<?php
class Messages_model extends CI_Model {

	public function __construct(){
	
		$this->load->database();
		
	}
	
	public function getMessages($user_id = FALSE, $status = FALSE, $direction = FALSE, $group = FALSE, $unread = FALSE, $dateOrder = "asc"){
	
		$this->db->select('IF(m.dateread IS NULL,0,1) AS msg_read, m.id, us.firstname as sender_firstname, us.lastname as sender_lastname, us.type as sender_type, us.profilephoto as sender_photo, ur.firstname as receiver_firstname, ur.lastname as receiver_lastname, ur.profilephoto as receiver_photo, ur.type as receiver_type, m.messagetext, date_format(m.datesent,"%d/%m/%Y %H:%i:%s") as datesent', FALSE);
		$this->db->from('messages m');
		$this->db->join('users us', 'us.id = m.sender');
		$this->db->join('users ur', 'ur.id = m.receiver');
		
		if($user_id !== FALSE){
			$this->db->where("m.sender = {$user_id}");
			$this->db->or_where("m.receiver = {$user_id}");
		}	
		
		if($direction !== FALSE){
			if($direction == 'S')
				$this->db->where("us.type = 'crmuser'");
			else if($direction == 'R')
				$this->db->where("us.type = 'customer'");
		}
		
		if($group !== FALSE){
			$this->db->where("us.group = {$group}");
			$this->db->or_where("ur.group = {$group}");
		}
			
		if($unread !== FALSE && $unread == 'yes')
			$this->db->where('m.dateread IS NULL');
		
		$this->db->order_by("m.datesent",$dateOrder);
		
		$query = $this->db->get();
		
		return $query->result();
		
	}
	
	public function insertMessage($message_text, $sender, $receiver){
		date_default_timezone_set('Asia/Singapore');
		
		$data = array(
					'messagetext' => $message_text,
					'sender' => $sender,
					'receiver' => $receiver,
					'datesent' => date("Y-m-d H:i:s")
		);
		
		$this->db->insert('messages', $data); 

	}
	
	public function setMessageRead($message_id){
		date_default_timezone_set('Asia/Singapore');
		
		$data = array('dateread' => date("Y-m-d H:i:s"));
		
		$this->db->where('id', $message_id);
		$this->db->update('messages', $data); 
		
	}
}