<?php
class Policies_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function getPolicies($status=FALSE, $user=FALSE, $policy=FALSE){
		$this->db->select('p.id, p.user_id, p.description, date_format(p.date,"%d/%m/%Y") as policy_date, p.status as status_code, ps.description as status, p.reminder as reminder_code, pr.description as reminder, p.notes', FALSE);
		$this->db->from('policies p');
		$this->db->join('policies_reminder pr','p.reminder = pr.code');
		$this->db->join('policies_status ps','p.status = ps.code');
		
		if($status !== FALSE)
			$this->db->where("p.status = '{$status}'");
		
		if($user !== FALSE)
			$this->db->where("p.user_id = '{$user}'");
		
		if($policy !== FALSE){
			$this->db->where("p.id = '{$policy}'");
			$query = $this->db->get();
			return $query->row();
		}
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function getPaidPoliciesPerMonth(){
		$this->db->select('DATE_FORMAT(p.date, "%Y-%m") AS month_paid, SUM(IF(p.date IS NULL,0,1)) AS num_policies, DATE_FORMAT(p.date, "1-%m-%Y") AS order_date', FALSE);
		$this->db->from('policies p');
		$this->db->where('p.status = "PD"');
		$this->db->group_by('month_paid');
		$this->db->group_by('order_date');
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function getPoliciesStatus(){
		$this->db->select('*', FALSE);
		$this->db->from('policies_status ps');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getReminders(){
		$this->db->select('*', FALSE);
		$this->db->from('policies_reminder pr');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function savePolicy($name,$date,$reminder,$status,$notes,$id,$user){
	
		$data = array(
					'description' => $name,
					'date' => $date,
					'reminder' => $reminder,
					'status' => $status,
					'notes' => $notes,
					'user_id' => $user
		);
		
		if(!empty($id)){
			$this->db->where('id', $id);
			$this->db->update('policies', $data); 
		}else{
			$this->db->insert('policies', $data); 
		}
		
	}
	
	public function deletePolicy($id){
		$this->db->delete('policies', array('id' => $id)); 
	}
	
	public function updatePoliciesStatus(){
			
		$this->db->query('UPDATE policies p 
						    JOIN policies_reminder pr ON pr.code = p.reminder
							 SET p.status = "UPD", p.date = DATE_ADD(p.date,INTERVAL pr.duration_entity MONTH)
						   WHERE p.status = "PD"
							 AND DATE_ADD(p.date,INTERVAL pr.duration_entity MONTH) <= DATE(SYSDATE())');
	}
}