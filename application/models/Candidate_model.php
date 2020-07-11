<?php

class Candidate_model extends CI_Model
{

    function __consturct()
    {
        parent::__construct();
    }

    public function addCandidate($data)
    {
        $this->db->insert('recruitment_candidates', $data);
    }

    public function GetCandidate()
    {
        $sql = "select recruitment_candidates.*,
                    recruitment_vacancies.vacancy_name
                    from recruitment_candidates
                    left join recruitment_vacancies on recruitment_candidates.vacancy_id = recruitment_vacancies.id
                    ORDER BY `recruitment_candidates`.`created_at` DESC";
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function updateCandidate($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('recruitment_candidates', $data);
    }

    public function candidateById($id)
    {
        $sql = "SELECT * from `recruitment_candidates` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }

    public function deleteCandidate($id)
    {
        $this->db->delete('recruitment_candidates', array('id' => $id));
    }
}


