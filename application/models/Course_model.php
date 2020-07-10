<?php

class Course_model extends CI_Model{
    
    function __consturct(){
        parent::__construct();
        
    }
    
    private $table_name = 'training_courses';
    
    public function getAll(){
        $sql    = "select tc.*, des.des_name as designation_name
                    from training_courses tc
                             left join designation as des on tc.course_for = des.id
                    order by tc.id desc;";
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