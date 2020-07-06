<?php

class LeaveApplicationModel extends CI_Model{
    
    public function ApplicationSave($data){
        $this->db->insert('emp_leave', $data);
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
    }
    
    public function getLeaveList($em_id = null, $start_date = null, $end_date = null){
    
        if($em_id != null){
            $em_id_str = " and em_id = '$em_id'";
        } else{
            $em_id_str = '';
        }
        
        if($start_date != null ){
            if($end_date != null){
                $date_str = " and date(start_date) >= '$start_date' and date (end_date)<= '$end_date'";;
            } else{
                $date_str = " and date(start_date) = '$start_date'";
            }
        } else{
            $date_str = '';
        }
        
        
        
        $sql = "SELECT * FROM `emp_leave` where 1 $em_id_str  $date_str ; ";
        
        
        
        $query  = $this->db->query($sql);
        $result = $query->result();
        
        return $result;
    }
}