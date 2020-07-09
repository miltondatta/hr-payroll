<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Appraisal extends CI_Controller
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
        $this->load->model('Appraisal_model');
        $this->load->model('FinancialYear_model');
        if ($this->session->userdata('user_type') == 'EMPLOYEE') {
            redirect(base_url(), 'refresh');
        }
    }

    public function appraisalCategory()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['appraisal_category_data'] = $this->Appraisal_model->GetAppraisalCategoryData();

            $this->load->view('backend/appraisal-category', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }


    public function addAppraisalCategory()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->post('id');
            $category_name = $this->input->post('category_name');
            $rating_text = $this->input->post('rating_text');
            $rating_value = $this->input->post('rating_value');
            $now = new DateTime();

            if ($id) {
                $appraisal_category = $this->Appraisal_model->appraisalCategoryById($id);
            }

            $data = array(
                'category_name' => $category_name,
                'rating_text' => $rating_text,
                'rating_value' => $rating_value,
                'created_at' => $id == '' ? $now->format('Y-m-d H:i:s') : $appraisal_category->created_at,
                'updated_at' => $id != '' ? $now->format('Y-m-d H:i:s') : ''
            );

            if ($id) {
                $this->Appraisal_model->updateAppraisalCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Successfully Updated');
            } else {
                $this->Appraisal_model->addAppraisalCategory($data);
                $this->session->set_flashdata('feedback', 'Successfully Added');
            }

            redirect("Appraisal/appraisalCategory");
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function appraisalCategoryById()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $data['appraisal_category'] = $this->Appraisal_model->appraisalCategoryById($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function deleteAppraisalCategory($id)
    {
        if ($this->session->userdata('user_login_access') != False) {
            $this->Appraisal_model->deleteAppraisalCategory($id);
            $this->session->set_flashdata('feedback', 'Successfully Deleted');
            redirect("Appraisal/appraisalCategory");
        } else {
            redirect(base_url(), 'refresh');
        }
    }


    /* Start Appraisal Employee */

    public function appraisalEmployee()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['appraisal_employee_data'] = $this->Appraisal_model->GetAppraisalEmployeeData();
            $data['employee'] = $this->employee_model->emselect();
            $data['financial_years'] = $this->FinancialYear_model->getFinancialYearData();

            $this->load->view('backend/appraisal-employee', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function getAppraisalCategory()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $em_id = $this->input->get('em_id');
            $financial_year = $this->input->get('financial_year');

            $data['appraisal_exists'] = $appraisal_exists = $this->Appraisal_model->getAppraisalByEmployeeAndFinancialYear($em_id, $financial_year);
            if (count($appraisal_exists) == 0) {
                $data['appraisal_category'] = $this->Appraisal_model->GetAppraisalCategoryData();
                $response = $this->load->view('backend/appraisal-category-partial', $data, TRUE);
                echo $response;
            } else {

            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function addAppraisalEmployee()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->post('id');
            $financial_year = $this->input->post('financial_year');
            $em_id = $this->input->post('em_id');
            $category_id = $this->input->post('category_id');
            $now = new DateTime();
            $data = array();


            foreach ($category_id as $key => $value) {
                if ($this->input->post('category_rating_' . $key)) {
                    $data['financial_year'] = $financial_year;
                    $data['em_id'] = $em_id;
                    $data['category_id'] = $value;
                    $data['category_rating'] = $this->input->post('category_rating_' . $key);

                    $index = array_search($this->input->post('category_rating_' . $key), $this->input->post('category_rating_array_' . $key));
                    $data['category_value'] = $this->input->post('category_value_' . $key)[$index];

                    $data['created_at'] = $now->format('Y-m-d H:i:s');
                    $data['updated_at'] = '';

                    $this->Appraisal_model->addAppraisalEmployee($data);
                } else {
                    continue;
                }
            }

            $this->session->set_flashdata('feedback', 'Successfully Added');
            redirect("Appraisal/appraisalEmployee");
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}
