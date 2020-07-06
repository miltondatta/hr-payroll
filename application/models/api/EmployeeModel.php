<?php

class EmployeeModel extends CI_Model{
    
    public function getAllActive(){
        $sql    = "SELECT * FROM `employee` WHERE `status`='ACTIVE'";
        $query  = $this->db->query($sql);
        $result = $query->result();
        
        return $result;
    }
    
    public function getEmployeeByEmId($id){
        $sql    = "SELECT * FROM `employee` WHERE id = $id";
        $query  = $this->db->query($sql);
        $result = $query->result();
        
        return $result;
    }
}