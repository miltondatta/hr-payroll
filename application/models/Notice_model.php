<?php

class Notice_model extends CI_Model{
    
    function __consturct(){
        parent::__construct();
        
    }
    
    public function GetNotice(){
        $sql    = "SELECT * FROM `notice` ORDER BY `notice`.`date` DESC;";
        $query  = $this->db->query($sql);
        $result = $query->result();
        
        return $result;
    }
    
    public function Published_Notice($data){
        $this->db->insert('notice', $data);
    }
    
    public function GetNoticelimit($limit = null){
        $this->db->order_by('date', 'DESC');
        if(!is_null($limit)){
            $this->db->limit($limit);
        }
        $query  = $this->db->get('notice');
        $result = $query->result();
        
        return $result;
    }
    
}

?>