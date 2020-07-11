<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Candidate extends CI_Controller
{

    /**
     * Index Page for this controller.
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model');
        $this->load->model('employee_model');
        $this->load->model('loan_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
        $this->load->model('Candidate_model');
        $this->load->model('Vacancy_model');
        if ($this->session->userdata('user_type') == 'EMPLOYEE') {
            redirect(base_url(), 'refresh');
        }
    }

    public function index()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['candidate_data'] = $this->Candidate_model->GetCandidate();
            $data['vacancy'] = $this->Vacancy_model->getAllVacancy();

            $this->load->view('backend/candidate-index', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }


    public function addCandidate()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->post('id');
            $full_name = $this->input->post('full_name');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $vacancy_id = $this->input->post('vacancy_id');
            $file_name = $_FILES['resume_file']['name'];
            $comment = $this->input->post('comment');
            $application_date = $this->input->post('application_date');
            $now = new DateTime();
            $candidate = $this->Candidate_model->candidateById($id);

            $resume_file = '';
            $check_image = '';
            if ($file_name) {
                $upPath = "./assets/images/candidate/";
                if (!file_exists($upPath)) {
                    mkdir($upPath, 0777, true);
                }

                if ($candidate) {
                    $check_image = "./assets/images/candidate/$candidate->resume_file";
                }

                $config = array(
                    'file_name' => $file_name,
                    'upload_path' => $upPath,
                    'allowed_types' => "doc|docx|pdf|xlsx",
                    'overwrite' => TRUE,
                    /*'max_size' => "2048000",
                    'max_height' => "768",
                    'max_width' => "1024"*/
                );


                $this->load->library('Upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('resume_file')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect("Candidate/index");
                } else {
                    if(file_exists($check_image)){
                        unlink($check_image);
                    }
                    $path = $this->upload->data();
                    $resume_file = $path['file_name'];
                }
            } else {
                $resume_file = $candidate->resume_file;
            }

            $data = array(
                'full_name' => $full_name,
                'email' => $email,
                'mobile' => $mobile,
                'vacancy_id' => $vacancy_id,
                'resume_file' => $resume_file,
                'comment' => $comment,
                'application_date' => $application_date,
                'created_at' => $id == '' ? $now->format('Y-m-d H:i:s') : $candidate->created_at,
                'updated_at' => $id != '' ? $now->format('Y-m-d H:i:s') : ''
            );

            if ($id) {
                $this->Candidate_model->updateCandidate($id, $data);
                $this->session->set_flashdata('feedback', 'Successfully Updated');
            } else {
                $this->Candidate_model->addCandidate($data);
                $this->session->set_flashdata('feedback', 'Successfully Added');
            }

            redirect("Candidate/index");
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function candidateById()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $data['candidate'] = $this->Candidate_model->candidateById($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function deleteCandidate($id)
    {
        if ($this->session->userdata('user_login_access') != False) {
            $candidate = $this->Candidate_model->candidateById($id);
            $check_image = '';

            if ($candidate) {
                $check_image = "./assets/images/candidate/$candidate->resume_file";
            }

            if(file_exists($check_image)){
                unlink($check_image);
            }

            $this->Candidate_model->deleteCandidate($id);
            $this->session->set_flashdata('feedback', 'Successfully Deleted');
            redirect("Candidate/index");
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}
