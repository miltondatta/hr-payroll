<?php

class Holiday_model extends CI_Model{
    
    public function getAllHolidays($year = null){
        
        if($year == null){
            $year = date("Y");
        }
        
        $sql = "select * from holiday where DATE_FORMAT(from_date,'%Y') = '$year' ";
        
        $query  = $this->db->query($sql);
        $result = $query->result();
        
        return $result;
    }
}