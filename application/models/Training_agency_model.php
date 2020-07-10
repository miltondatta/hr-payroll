<?php

class Training_agency_model extends CI_Model{
    
    function __consturct(){
        parent::__construct();
        
    }
    
    private $table_name = 'training_budget';
    
    public function getTrainingBudget(){
        $sql    = "select id, financial_year, amount,
                        CASE
                            WHEN budget_period = 1
                                THEN 'Monthly'
                            WHEN budget_period = 2
                                THEN 'Quarterly'
                            WHEN budget_period = 3
                                THEN 'Half Yearly'
                            WHEN budget_period = 4
                                THEN 'Yearly'
                            END as budget_period_name
                    from training_budget
                    order by id desc;";
        $query  = $this->db->query($sql);
        $result = $query->result();
        
        return $result;
    }
    
    public function save($data){
        $this->db->insert($this->table_name, $data);
    }
    
    public function getById($id){
        return $this->db->get_where($this->table_name, array( 'id' => $id ))->row();
    }
    
    public function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
    }
    
    public function delete($id){
        $this->db->delete($this->table_name, array( 'id' => $id ));
    }
}