<?php

class Member_assignment_model extends CI_Model{
    
    function __consturct(){
        parent::__construct();
        
    }
    
    private $table_name     = 'training_assignment';
    private $table_mem_name = 'training_members';
    
    public function getAll(){
        $sql    = "select tr_as.id,tr_as.course_name, tr_mem.employee_name
                    from (select ta.*, tc.course_name
                          from training_assignment as ta
                                   left join training_courses as tc on ta.course_id = tc.id) as tr_as
                             left join (select tm.*, group_concat(concat(em.first_name, ' ', em.last_name)) as employee_name
                                        from training_members as tm
                                                 left join employee as em on tm.employee_id = em.id
                                        group by tm.training_ass_id) as tr_mem
                    on tr_as.id = tr_mem.training_ass_id ;";
        $query  = $this->db->query($sql);
        $result = $query->result();
        
        return $result;
    }
    
    public function save($data){
        $this->db->insert($this->table_name, $data);
        
        return $this->db->insert_id();
    }
    
    public function saveBulk($data){
        $this->db->insert_batch($this->table_mem_name, $data);
    }
    
    public function getById($id){
        return $this->db->get_where($this->table_name, array( 'id' => $id ))->row();
    }
    
    public function getMemberById($id){
        return $this->db->get_where($this->table_mem_name, array( 'training_ass_id' => $id ))->result();
    }
    
    public function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
    }
    
    public function delete($id){
        $this->db->delete($this->table_name, array( 'id' => $id ));
    }
    
    public function deleteTrainingMembers($id){
        $this->db->delete($this->table_mem_name, array( 'training_ass_id' => $id ));
    }
}