<?php

class DelayNotice_model extends CI_Model{

    function __consturct(){
        parent::__construct();
    }

    public function addDelayNotice($data)
    {
        $this->db->insert('delay_notice', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function GetDelayNotice(){
        $sql    = "SELECT * FROM `delay_notice` ORDER BY `delay_notice`.`created_at` DESC;";
        $query  = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function GetDelayNoticeByUser($user_name){
        $sql    = "SELECT * FROM `delay_notice` where added_by = '$user_name' ORDER BY `delay_notice`.`created_at` DESC;";
        $query  = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function updateDelayNotice($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('delay_notice', $data);
        return $this->db->affected_rows();
    }

    public function delayNoticeById($id)
    {
        $sql = "SELECT * from `delay_notice` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
}


