<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PlannedLeave extends CI_Controller
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
        $this->load->model('PlannedLeave_model');
    }

    public function index()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['user_type'] = $user_type = $this->session->userdata('user_type');
            $data['leave_types'] = $this->leave_model->GetleavetypeInfo();
            $data['employee'] = $this->employee_model->emselect();

            if ($user_type == 'EMPLOYEE') {
                $data['planned_leave_data'] = $this->PlannedLeave_model->GetPlannedLeaveByUser($this->session->userdata('user_login_id'));
            } else {
                $data['planned_leave_data'] = $this->PlannedLeave_model->GetPlannedLeave();
            }

            $this->load->view('backend/planned-leave', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }


    public function addPlannedLeave()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->post('id');
            $leave_type_id = $this->input->post('leave_type_id');
            $leave_from = $this->input->post('leave_from');
            $leave_to = $this->input->post('leave_to');
            $remarks = $this->input->post('remarks');
            $now = new DateTime();
            $line_manager = $this->PlannedLeave_model->plannedLeaveById($id);

            $data = array(
                'leave_type_id' => $leave_type_id,
                'leave_from' => $leave_from,
                'leave_to' => $leave_to,
                'remarks' => $remarks,
                'em_id' => $this->session->userdata('user_login_id'),
                'added_by' => $this->session->userdata('name'),
                'created_at' => $id == '' ? $now->format('Y-m-d H:i:s') : $line_manager->created_at,
                'updated_at' => $id != '' ? $now->format('Y-m-d H:i:s') : ''
            );

            if ($id) {
                $this->PlannedLeave_model->updatePlannedLeave($id, $data);
                $this->session->set_flashdata('feedback', 'Successfully Updated');
            } else {
                $this->PlannedLeave_model->addPlannedLeave($data);
                $this->session->set_flashdata('feedback', 'Successfully Added');
            }

            redirect("PlannedLeave/index");
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function plannedLeaveById()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $data['planned_leave'] = $this->PlannedLeave_model->plannedLeaveById($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function getPlannedLeaveByEmployee()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $em_id = $this->input->post('em_id');
            if ($em_id == 'all') {
                $data['planned_leave_data'] = $this->PlannedLeave_model->GetPlannedLeave();
            } else {
                $data['planned_leave_data'] = $this->PlannedLeave_model->GetPlannedLeaveByUser($em_id);
            }
            $response = $this->load->view('backend/planned-leave-partial', $data, TRUE);
            echo $response;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function getPlannedLeaveByEmployeeId()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['planned_leave'] = $this->PlannedLeave_model->GetPlannedLeaveByUser($this->session->userdata('user_login_id'));
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}
