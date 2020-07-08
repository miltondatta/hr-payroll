<?php

class Appraisal_model extends CI_Model{

    function __consturct(){
        parent::__construct();

    }

    public function addAppraisalCategory($data)
    {
        $this->db->insert('appraisal_category', $data);
    }

    public function GetAppraisalCategoryData(){
        $sql    = "SELECT * FROM `appraisal_category` ORDER BY `appraisal_category`.`created_at` DESC;";
        $query  = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function updateAppraisalCategory($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('appraisal_category', $data);
    }

    public function appraisalCategoryById($id)
    {
        $sql = "SELECT * from `appraisal_category` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    public function deleteAppraisalCategory($id)
    {
        $this->db->delete('appraisal_category',array('id' => $id ));
    }

    /* Start Appraisal Employee Table function */

    public function GetAppraisalEmployeeData(){
        $sql    = "SELECT * FROM `appraisal_employee` ORDER BY `appraisal_employee`.`created_at` DESC;";
        $query  = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }
}


