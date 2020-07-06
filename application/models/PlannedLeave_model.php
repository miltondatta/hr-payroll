<?php

class PlannedLeave_model extends CI_Model{

    function __consturct(){
        parent::__construct();

    }

    public function addPlannedLeave($data)
    {
        $this->db->insert('planned_leave', $data);
    }

    public function GetPlannedLeave(){
        $sql    = "SELECT planned_leave.*, leave_types.name as leave_type_name
                    FROM `planned_leave`
                             left join leave_types on planned_leave.leave_type_id = leave_types.type_id
                    ORDER BY `planned_leave`.`created_at` DESC";
        $query  = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function GetPlannedLeaveByUser($em_id){
        $sql    = "SELECT planned_leave.*, leave_types.name as leave_type_name
                    FROM `planned_leave`
                             left join leave_types on planned_leave.leave_type_id = leave_types.type_id
                    where em_id = 32
                    ORDER BY `planned_leave`.`created_at` DESC";
        $query  = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function updatePlannedLeave($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('planned_leave', $data);
    }

    public function plannedLeaveById($id)
    {
        $sql = "SELECT * from `planned_leave` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
}


