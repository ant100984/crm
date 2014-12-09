<?php
class Appointments_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function getAppointments($user=FALSE, $appointment=FALSE){
		$this->db->select('a.id, DATE_FORMAT(a.start_date,"%Y/%m/%d %H:%i") as start_date_full, DATE_FORMAT(a.end_date,"%Y/%m/%d %H:%i") as end_date_full, u.firstname, u.lastname, a.user_id, DATE_FORMAT(a.end_date,"%d/%m/%Y") as end_date, DATE_FORMAT(a.end_date,"%H:%i") as end_time, DATE_FORMAT(a.start_date,"%d/%m/%Y") as start_date, DATE_FORMAT(a.start_date,"%H:%i") as start_time, a.subject, a.message, a.location, a.alert', FALSE);
		$this->db->from('appointments a');
		$this->db->join('users u','u.id = a.user_id');
  
		if($user !== FALSE)
			$this->db->where("a.user_id", $user);
		
		if($appointment !== FALSE){
			$this->db->where("a.id",$appointment);
			$query = $this->db->get();
			return $query->row();
		}
		
		$query = $this->db->get();
		
		return $query->result();
	}
		
	public function saveAppointment($appointment_id=FALSE, $user, $subject, $message, $start_date, $start_time, $end_date, $end_time, $location, $alert){
		$data = array(
			
			'user_id' => $user,
			'subject' => $subject,
			'message' => $message,
			'start_date' => $start_date." ".$start_time.":00",
			'end_date' => $end_date." ".$end_time.":00",
			'location' => $location,
			'alert' => $alert
		
		);
	
		if($appointment_id !== FALSE){
			$this->db->where('id',$appointment_id);
			$this->db->update('appointments',$data);
		}else{
			$this->db->insert('appointments',$data);
			$appointment_id = $this->db->insert_id();
		}
		
		return $appointment_id;
	}
	
	public function deleteAppointment($appointment_id){
		$this->db->delete('appointments', array('id' => $appointment_id)); 
		$this->db->delete('appointments_remarks', array('appointment_id' => $appointment_id)); 
	}
	
	public function deleteRemark($remark_id){
		$this->db->delete('appointments_remarks', array('id' => $remark_id)); 
	}
		
	public function saveRemark($remark_id = FALSE, $appointment_id, $notes){
		$data = array(
			'appointment_id' => $appointment_id,
			'notes' => $notes
		);
		
		if($remark_id !== FALSE){
			$this->db->where('id',$remark_id);
			$this->db->update('appointments_remarks', $data);
		}else{
			$this->db->insert('appointments_remarks', $data);
		}
	}
	
	public function getAppointmentRemarks($appointment_id=FALSE, $remark_id=FALSE){
		$this->db->select('ar.id, ar.notes', FALSE);
		$this->db->from('appointments_remarks ar');
		
		if($appointment_id !== FALSE)
			$this->db->where('ar.appointment_id',$appointment_id);
		
		if($remark_id !== FALSE){
			$this->db->where('ar.id',$remark_id);
			$query = $this->db->get();
		
			return $query->row();
		}	
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function getAppointmentsToAlert(){
		$this->db->select('u.firstname, u.lastname, DATE_FORMAT(a.start_date,"%Y/%m/%d %H:%i") as start_date, DATE_FORMAT(a.end_date,"%Y/%m/%d %H:%i") as end_date, a.subject, a.message, a.location', FALSE);
		$this->db->from("appointments a");
		$this->db->join("users u","u.id = a.user_id");
		$this->db->where("DATE_ADD(a.start_date,INTERVAL -1*a.alert MINUTE) <= SYSDATE()");
		$this->db->where("a.alerted","0");
		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function updateAppointmentAlerted($id){
		$data = array(
			"alerted" => 1
		);
		
		$this->db->where("a.id", $id);
		$this->db->update("appointments a", $data);
	}
	
	public function loadRemarksCustomers(){
		$this->db->select('date_format(a.start_date,"%d/%m/%y %h:%i") as start_date, ar.notes', FALSE);
		$this->db->from('appointments a');
		$this->db->join("appointments_remarks ar", "ar.appointment_id = a.id");
		$this->db->order_by("a.start_date", "asc");
		
		$query = $this->db->get();
		return $query->result();
	}
}