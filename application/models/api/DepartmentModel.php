<?php

class DepartmentModel extends CI_Model{
    
    public function getAllDepartment(){
        $sql    = "SELECT * FROM `department`";
        $query  = $this->db->query($sql);
        $result = $query->result();
    
        return $result;
    }
    
    public function FindDepartmentNameWithId($department_list, $dept_id){
        foreach($department_list as $department){
            if($department->id == $dept_id){
                return $department->dep_name;
            }
        }
        return 'No department';
    }
}