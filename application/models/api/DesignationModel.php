<?php

class DesignationModel extends CI_Model{
    
    public function getAllDesignation(){
        $sql    = "SELECT * FROM `designation`";
        $query  = $this->db->query($sql);
        $result = $query->result();
    
        return $result;
    }
    
    public function FindDesignationNameWithId($designation_list, $des_id){
        foreach($designation_list as $designation){
            if($designation->id == $des_id){
                return $designation->des_name;
            }
        }
        return 'No designation';
    }
}