<?php

class To_do_model extends CI_Model{
    
    public function GettodoInfoWithValue($userid, $value = null, $date = null){
        if($value != null){
            $value_str = " and value = $value";
        } else{
            $value_str = '';
        }
        
        if($date != null){
            $date_str = " and date(date)='$date'";
        } else{
            $date_str = '';
        }
        $sql = "SELECT * FROM `to-do_list` WHERE `user_id`='$userid' $value_str $date_str ORDER BY `date` DESC";
        
        $query  = $this->db->query($sql);
        $result = $query->result();
        
        return $result;
    }
    
    public function UpdateTododata($id, $data){
        $this->db->where('id', $id);
        $this->db->update('to-do_list', $data);
        
        return $this->db->affected_rows();
    }
    
    public function insert_todo($data){
        $this->db->insert('to-do_list', $data);
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
    }
    
    public function delete($data){
        $this->db->delete('to-do_list', $data);
        return true;
    }
}