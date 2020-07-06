<?php

class Notice_model extends CI_Model{
    
    public function GetNoticeCustomLimit($limit = null, $date = null){
        
        if($date != null){
            $date_str = " and date(date) = '$date'";
        } else{
            $date_str = '';
        }
        
        $sql = "SELECT * FROM `notice` where 1 $date_str ORDER BY `notice`.`date` DESC ";
        if($limit != null){
            $sql .= " limit $limit";
        }
        
        $query  = $this->db->query($sql);
        $result = $query->result();
        
        return $result;
    }
}