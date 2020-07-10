<?php

class Training_agency_model extends CI_Model{
    
    function __consturct(){
        parent::__construct();
        
    }
    
    private $table_name = 'training_agency';
    
    public function getAll(){
        $sql    = "select ta.*, tc.course_name as course_name
                    from training_agency as ta
                             left join training_courses as tc on ta.course_id = tc.id
                    order by ta.id desc ;";
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