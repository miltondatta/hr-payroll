<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Vacancy extends CI_Controller
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
        $this->load->model('Vacancy_model');
        if ($this->session->userdata('user_type') == 'EMPLOYEE') {
            redirect(base_url(), 'refresh');
        }
    }

    public function index()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['vacancy_data'] = $this->Vacancy_model->GetVacancy();
            $data['designations'] = $this->employee_model->getdesignation();
            $data['employee'] = $this->employee_model->emselect();

            $this->load->view('backend/vacancy-home', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }


    public function addVacancy()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->post('id');
            $job_title = $this->input->post('job_title');
            $vacancy_name = $this->input->post('vacancy_name');
            $hiring_manager = $this->input->post('hiring_manager');
            $number_of_position = $this->input->post('number_of_position');
            $description = $this->input->post('description');
            $status = $this->input->post('status');
            $now = new DateTime();
            $vacancy = $this->Vacancy_model->vacancyById($id);

            $data = array(
                'job_title' => $job_title,
                'vacancy_name' => $vacancy_name,
                'hiring_manager' => $hiring_manager,
                'number_of_position' => $number_of_position,
                'description' => $description,
                'status' => $status,
                'created_at' => $id == '' ? $now->format('Y-m-d H:i:s') : $vacancy->created_at,
                'updated_at' => $id != '' ? $now->format('Y-m-d H:i:s') : ''
            );

            if ($id) {
                $this->Vacancy_model->updateVacancy($id, $data);
                $this->session->set_flashdata('feedback', 'Successfully Updated');
            } else {
                $this->Vacancy_model->addVacancy($data);
                $this->session->set_flashdata('feedback', 'Successfully Added');
            }

            redirect("Vacancy/index");
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function vacancyById()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $data['vacancy'] = $this->Vacancy_model->vacancyById($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function deleteVacancy($id)
    {
        if ($this->session->userdata('user_login_access') != False) {
            $this->Vacancy_model->deleteVacancy($id);
            $this->session->set_flashdata('feedback', 'Successfully Deleted');
            redirect("Vacancy/index");
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}
