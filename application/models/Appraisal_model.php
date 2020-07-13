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
        $sql    = "select appraisal_employee.*,
                           employee.first_name,
                           employee.last_name,
                           designation.des_name,
                           appraisal_category.category_name
                    from appraisal_employee
                             left join employee on appraisal_employee.em_id = employee.em_id
                             left join designation on employee.des_id = designation.id
                             left join appraisal_category on appraisal_employee.category_id = appraisal_category.id";
        $query  = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }
    
    public function filterAppraisalEmployeeData($emp_id = '', $fin_year = ''){
    
        $employee_id_filter = '';
        $fin_year_filter       = '';
    
        if($emp_id != ''){
            $employee_id_filter = " and appraisal_employee.em_id = '$emp_id' ";
        }
        if($fin_year != ''){
            $fin_year_filter = " and appraisal_employee.financial_year = '$fin_year' ";
        }
        
        $sql    = "select appraisal_employee.*,
                           employee.first_name,
                           employee.last_name,
                           designation.des_name,
                           appraisal_category.category_name
                    from appraisal_employee
                             left join employee on appraisal_employee.em_id = employee.em_id
                             left join designation on employee.des_id = designation.id
                             left join appraisal_category on appraisal_employee.category_id = appraisal_category.id
                    where 1  $employee_id_filter $fin_year_filter";
        $query  = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function getAppraisalByEmployeeAndFinancialYear($em_id, $financial_year)
    {
        $sql    = "select *from appraisal_employee where financial_year = '$financial_year' and em_id = '$em_id'";
        $query  = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }

    public function addAppraisalEmployee($data)
    {
        $this->db->insert('appraisal_employee', $data);
    }

    public function deleteAppraisalEmployee($em_id, $category_id)
    {
        $sql = "delete from appraisal_employee where category_id = '$category_id' and em_id = '$em_id'";
        return $this->db->query($sql);
    }
}


