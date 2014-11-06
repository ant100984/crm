<?php
class Customers_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function loadCustomers($customer=FALSE,$firstname=FALSE,$lastname=FALSE,$gender=FALSE,$group=FALSE,$smoker=FALSE){
	
		$this->db->select("c.id, c.firstname, c.lastname, date_format(c.dateofbirth,'%d/%m/%Y') as dateofbirth, c.profilephoto, c.gender, c.occupation, c.smoker, c.email, c.homeaddress, c.businessaddress, c.nric, c.notes, c.enabled, g.group_name, c.`group`", FALSE);
		$this->db->from("customers c");
		$this->db->join("groups g","g.id = c.`group`","left");
		
		if($customer !== FALSE){
			$this->db->where("c.id = {$customer}");
			$query = $this->db->get();
			return $query->row();
		}else{
			
			if($firstname !== FALSE)
				$this->db->where("c.firstname LIKE '%{$firstname}%'");
			
			if($lastname !== FALSE)
				$this->db->where("c.lastname LIKE '%{$lastname}%'");
			
			if($gender !== FALSE)
				$this->db->where("c.gender = '{$gender}'");
			
			if($group !== FALSE)
				$this->db->where("c.group = '{$group}'");
			
			if($smoker !== FALSE)
				$this->db->where("c.smoker = '{$smoker}'");
			
			$query = $this->db->get();
			return $query->result();
		}
		
	}
	
	public function loadUngroupedCustomers(){
	
		$this->db->select("c.id, c.firstname, c.lastname, date_format(c.dateofbirth,'%d/%m/%Y') as dateofbirth, c.profilephoto, c.gender, c.occupation, c.smoker, c.email, c.homeaddress, c.businessaddress, c.nric, c.notes, c.enabled, g.group_name, c.`group`", FALSE);
		$this->db->from("customers c");
		$this->db->join("groups g","g.id = c.`group`");
		
		$this->db->where("c.group == ''");
		$this->db->or_where("c.group IS NULL");
		
		$query = $this->db->get();
		return $query->result();
				
	}
	
	public function setCustomerEnabled($customer, $enabled){
	
		$data = array('enabled' => $enabled);
		$this->db->where('id', $customer);
		$this->db->update('customers', $data); 
	
	}
	
	public function saveCustomer($profile_photo=FALSE, $customer_id,$dob,$firstname,$lastname,$group,$gender,$occupation,$smoker,$email,$home_address,$business_address,$nric,$notes){
		
		$data = array(
			'dateofbirth' => $dob,
			'firstname' => $firstname,
			'lastname' => $lastname,
			'group' => $group,
			'gender' => $gender,
			'occupation' => $occupation,
			'smoker' => $smoker,
			'email' => $email, 
			'homeaddress' => $home_address,
			'businessaddress' => $business_address,
			'nric' => $nric,
			'notes' => $notes
		);
		
		if($profile_photo !== FALSE) $data['profilephoto'] = $profile_photo;
		
		if(!empty($customer_id)){
			$this->db->where('id', $customer_id);
			$this->db->update('customers', $data); 
		}else{
			$this->db->insert('customers', $data); 
		}
	
	}
	
	public function saveAttachment($name, $path, $customer){
		$data = array(
			'attachment_name' => $name,
			'attachment_path' => $path,
			'customer_id' => $customer
		);
		
		$this->db->insert('customers_attachments', $data); 
	}
	
	public function deleteAttachment($id){
		$this->db->delete('customers_attachments', array('id' => $id)); 
	}
}