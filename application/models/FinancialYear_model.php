<?php

class FinancialYear_model extends CI_Model{

    function __consturct(){
        parent::__construct();

    }

    public function getFinancialYearData(){
        $sql    = "SELECT * FROM `financial_years`";
        $query  = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }
}


