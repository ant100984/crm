<?php
class Users_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function loadCustomers($user=FALSE,$firstname=FALSE,$lastname=FALSE,$gender=FALSE,$group=FALSE,$smoker=FALSE){
		return $this->loadUsers($user,$firstname,$lastname,$gender,$group,$smoker, "customer");
	}
	
	public function loadUsers($user=FALSE,$firstname=FALSE,$lastname=FALSE,$gender=FALSE,$group=FALSE,$smoker=FALSE,$type,$admin=FALSE){
	
		$this->db->select("u.id, u.firstname, u.lastname, u.username, date_format(u.dateofbirth,'%d/%m/%Y') as dateofbirth, u.profilephoto, u.gender, u.occupation, u.smoker, u.email, u.homeaddress, u.businessaddress, u.nric, u.notes, u.enabled, g.group_name, u.`group`", FALSE);
		$this->db->from("users u");
		$this->db->join("groups g","g.id = u.`group`","left");
		
		if($user !== FALSE){
			$this->db->where("u.id = {$user}");
			$query = $this->db->get();
			return $query->row();
		}else{
			
			if($admin === FALSE || $admin == 0)
				$this->db->where("u.isAdmin = 0");
			
			if($firstname !== FALSE)
				$this->db->where("u.firstname LIKE '%{$firstname}%'");
			
			if($lastname !== FALSE)
				$this->db->where("u.lastname LIKE '%{$lastname}%'");
			
			if($gender !== FALSE)
				$this->db->where("u.gender = '{$gender}'");
			
			if($group !== FALSE)
				$this->db->where("u.group = '{$group}'");
			
			if($smoker !== FALSE)
				$this->db->where("u.smoker = '{$smoker}'");
			
			$this->db->where("u.type = '{$type}'");
			
			$query = $this->db->get();
			return $query->result();
		}
		
	}
	
	public function filterCustomers($filter_string){
		return $this->filterUsers($filter_string, "customer");
	}
	
	public function filterCrmUsers($filter_string){
		return $this->filterUsers($filter_string, "crmuser");
	}
	
	public function filterUsers($filter_string, $type){
		$keys = explode(' ', $filter_string);
		
		$this->db->select("DISTINCT(u.id), u.firstname, u.lastname, u.profilephoto, date_format(u.dateofbirth,'%d/%m/%Y') as dateofbirth", FALSE);
		$this->db->from("users u");
		$this->db->where("u.type",$type);
		
		foreach($keys as $key){	
			if($key != ''){
				$this->db->or_like('u.firstname', $key);
				$this->db->or_like('u.lastname', $key);
				$this->db->or_like('u.nric', $key);
				$this->db->or_like('u.homeaddress', $key);
				$this->db->or_like('u.businessaddress', $key);
				$this->db->or_like('u.email', $key);
				$this->db->or_like('u.username', $key);
			}
		}
		
		$query = $this->db->get();
		return $query->result();
			
	}
	
	public function setUserEnabled($customer, $enabled){
	
		$data = array('enabled' => $enabled);
		$this->db->where('id', $customer);
		$this->db->update('users', $data); 
	
	}
	
	public function saveCustomer($profile_photo=FALSE, $customer_id,$dob,$firstname,$lastname,$group,$gender,$occupation,$smoker,$email,$home_address,$business_address,$nric,$notes,$username,$password){
		return $this->saveUser($profile_photo,$customer_id,$dob,$firstname,$lastname,$group,$gender,$occupation,$smoker,$email,$home_address,$business_address,$nric,$notes,"customer");
	}
	
	public function saveUser($profile_photo=FALSE, $customer_id,$dob,$firstname,$lastname,$group,$gender,$occupation,$smoker,$email,$home_address,$business_address,$nric,$notes,$type,$username,$password){
		
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
			'notes' => $notes,
			'type' => $type,
			'username' => $username
		);
		
		if(!empty($password))
			$data['password'] = md5($password);
		
		if($profile_photo !== FALSE) $data['profilephoto'] = $profile_photo;
		
		if(!empty($customer_id)){
			$this->db->where('id', $customer_id);
			$this->db->update('users', $data); 
			return $customer_id;
		}else{
			$this->db->insert('users', $data); 
			return $this->db->insert_id();
		}
	
	}
	
	public function saveAttachment($name, $path, $user){
		$data = array(
			'attachment_name' => $name,
			'attachment_path' => $path,
			'user_id' => $customer
		);
		
		$this->db->insert('attachments', $data); 
	}
	
	public function deleteAttachment($id){
		$this->db->delete('attachments', array('id' => $id)); 
	}
	
	public function deleteUser($userid){
		$this->db->delete('users', array('id' => $userid)); 
	}
	
	public function checkLogin($username,$password){
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->where('u.username',$username);
		$this->db->where('u.password',md5($password));
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->row();
		else
			return FALSE;
	}
	
	public function manageUserPermission($userId, $permission, $value){
	
		if(!empty($value) && $value == "on"){
		
			$this->db->select('*');
			$this->db->from('user_permissions u');
			$this->db->where("u.user = {$userId}");
			$this->db->where("u.permission = '{$permission}'");
			$query = $this->db->get();
			
			if($query->num_rows() == 0){
				$data = array(
					'user' => $userId,
					'permission' => $permission
				);
				
				$this->db->insert('user_permissions', $data);
			}
			
		}else{
			
			$this->db->delete('user_permissions', array('user' => $userId, 'permission' => $permission)); 
			
		}
	
	}
	
	public function loadPermissionType(){
		$this->db->select('permission_name, permission_code');
		$this->db->from('permission_type');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getUserPermissions($userId){
		$this->db->select('*');
		$this->db->from('user_permissions u');
		$this->db->where("u.user = {$userId}");
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function getUserPermissionsArray($userId){
		$permissions = $this->getUserPermissions($userId);
		
		$result = array();
		
		foreach($permissions as $perm){
			$result[] = $perm->permission;
		}
		
		return $result;
	}
	
	public function getAdmins(){
		$this->db->select("*");
		$this->db->from("users u");
		$this->db->where("u.isAdmin","1");
		
		$query = $this->db->get();
		return $query->result();
	}
}