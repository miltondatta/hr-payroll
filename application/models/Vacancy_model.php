<?php

class Vacancy_model extends CI_Model{

    function __consturct(){
        parent::__construct();
    }

    public function addVacancy($data)
    {
        $this->db->insert('recruitment_vacancies', $data);
    }

    public function GetVacancy(){
        $sql    = "select recruitment_vacancies.*, designation.des_name, employee.first_name, employee.last_name
                    from recruitment_vacancies
                        left join designation on recruitment_vacancies.job_title = designation.id
                        left join employee on recruitment_vacancies.hiring_manager = employee.em_id
                    ORDER BY `recruitment_vacancies`.`created_at` DESC";
        $query  = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function getAllVacancy()
    {
        $sql    = "select * from recruitment_vacancies ORDER BY `recruitment_vacancies`.`created_at` DESC";
        $query  = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function updateVacancy($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('recruitment_vacancies', $data);
    }

    public function vacancyById($id)
    {
        $sql = "SELECT * from `recruitment_vacancies` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    public function deleteVacancy($id)
    {
        $this->db->delete('recruitment_vacancies', array( 'id' => $id ));
    }
}


