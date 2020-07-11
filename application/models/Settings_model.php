<?php

	class Settings_model extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}
    public function GetSettingsValue(){
		$settings = $this->db->dbprefix('settings');
        $sql = "SELECT * FROM $settings";
		$query=$this->db->query($sql);
		$result = $query->row();
		return $result;	        
    }
    public function SettingsUpdate($id,$data){
		$this->db->where('id', $id);
		$this->db->update('settings',$data);		
	}        

	public function roleselect(){
		$sql 	= "SELECT * FROM `user_roles`";
		$query	=  $this->db->query($sql);
		$result =  $query->result();
		return $result;	 
	}

	public function checkMenuAssign($role_id){
		$sql 	= "SELECT * FROM `menu_assigns` WHERE role_id = '$role_id'";
		$query	=  $this->db->query($sql);
		$result =  $query->row();
		return $result;	 
	}

	public function getMenu($parent_id){
		$sql 	= "SELECT * FROM `menus` WHERE parent_id = '$parent_id'";
		$query	=  $this->db->query($sql);
		$result =  $query->result();
		return $result;	 
	}


    }