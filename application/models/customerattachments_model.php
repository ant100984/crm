<?php
class CustomerAttachments_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function getAttachments($customer=FALSE){
		$this->db->select('ca.id, ca.customer_id, ca.attachment_name, ca.attachment_path', FALSE);
		$this->db->from('customers_attachments ca');
		
		if($customer !== FALSE)
			$this->db->where("ca.customer_id = '{$customer}'");
		
		$query = $this->db->get();
		
		return $query->result();
	}

}