<?php
class Appointments_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function getAppointments($customer=FALSE, $appointment=FALSE){
		$this->db->select('a.id, c.firstname, c.lastname, a.customer_id, DATE_FORMAT(a.end_date,"%Y/%m/%d") as end_date, DATE_FORMAT(a.end_date,"%H:%i:%s") as end_time, DATE_FORMAT(a.start_date,"%Y/%m/%d") as start_date, DATE_FORMAT(a.start_date,"%H:%i:%s") as start_time, a.subject, a.message', FALSE);
		$this->db->from('appointments a');
		$this->db->join('customers c','c.id = a.customer_id');
  
		if($customer !== FALSE)
			$this->db->where("a.customer_id = '{$customer}'");
		
		if($appointment !== FALSE){
			$this->db->where("a.id = {$appointment}");
			$query = $this->db->get();
			return $query->row();
		}
		
		$query = $this->db->get();
		
		return $query->result();
	}
		
	public function saveAppointment($appointment_id=FALSE, $customer, $subject, $message, $start_date, $start_time, $end_date, $end_time, $location, $reminder){
		error_log($appointment_id ." ". $customer . " " . $subject . " " . $message . " " . $start_date . " " . $start_time . " " . $end_date . " " . $end_time . " " . $location . " " . $reminder);
		$data = array(
			
			'customer_id' => $customer,
			'subject' => $subject,
			'message' => $message,
			'start_date' => $start_date." ".$start_time.":00",
			'end_date' => $end_date." ".$end_time.":00",
			'location' => $location
		
		);
	
		if($appointment_id !== FALSE){
			$this->db->where('id',$appointment_id);
			$this->db->update('appointments',$data);
			error_log("update");
		}else{
			$this->db->insert('appointments',$data);
			error_log("update");
		}
	}
}