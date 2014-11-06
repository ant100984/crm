<?php
class Groups_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function getGroups($group_id=FALSE, $group_name=FALSE){
		$this->db->select('g.id, g.group_name', FALSE);
		$this->db->from('groups g');
		
		if($group_id !== FALSE)
			$this->db->where('g.id', $group_id);
		
		if($group_name !== FALSE)
			$this->db->where('g.group_name', $group_name);
		
		$this->db->order_by('g.id', 'asc');
		
		$query = $this->db->get();
		
		if($group_id === FALSE)
			return $query->result();
		else
			return $query->row();
	}
	
	public function saveGroup($group_id=FALSE, $group_name){
		if($group_id === FALSE)
			$oldGroup = $this->getGroups(FALSE, $group_name);
		else
			$oldGroup = $this->checkGroupNameExists($group_id, $group_name);
		
		if(!empty($oldGroup))
			return FALSE;
		
		$data = array(
			'group_name' => $group_name,
		);
		
		if($group_id !== FALSE){
			$this->db->where('id', $group_id);
			$this->db->update('groups', $data); 
		}else{
			$this->db->insert('groups', $data); 
		}
		
		return TRUE;
	}
	
	public function deleteGroup($group){
	
		$this->db->delete('groups', array('id' => $group));
		$data = array(
			'group' => null
		);
		
		$this->db->where('group', $group);
		$this->db->update('customers', $data);
	
	}
	
	public function checkGroupNameExists($group_id,$group_name){
		
		$this->db->select('g.id, g.group_name', FALSE);
		$this->db->from('groups g');
		$this->db->where('g.group_name', $group_name);
		$this->db->where("g.id != {$group_id}");
		
		$query = $this->db->get();
		
		return $query->result();
				
	}
}