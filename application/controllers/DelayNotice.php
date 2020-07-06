<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DelayNotice extends CI_Controller
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
        $this->load->model('DelayNotice_model');
    }

    public function index()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['delay_notice'] = $this->DelayNotice_model->GetDelayNotice();
            $this->load->view('backend/delay-notice', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }


    public function addDelayNotice()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $description = $this->input->post('description');
            $hour = $this->input->post('hour');
            $now = new DateTime();

            /*
             * Status 1 = Pending
             * Status 2 = Approve
             * Status 3 = Reject
             * */

            $data = array(
                'description' => $description,
                'hour' => $hour,
                'status' => 1,
                'created_at' => $now->format('Y-m-d H:i:s'),
            );

            $this->DelayNotice_model->addDelayNotice($data);

            $this->session->set_flashdata('feedback', 'Successfully Added');
            redirect("DelayNotice/index");
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function updateDelayNotice()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $status = $this->input->get('status');

            $now = new DateTime();

            /*
             * Status 1 = Pending
             * Status 2 = Approve
             * Status 3 = Reject
             * */

            $data = array(
                'status' => $status,
                'updated_at' => $now->format('Y-m-d H:i:s'),
            );

            $this->DelayNotice_model->updateDelayNotice($id, $data);
            $this->session->set_flashdata('feedback', 'Successfully Updated');
            redirect("DelayNotice/index");
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function delayNoticeById()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $data['delay_notice'] = $this->DelayNotice_model->delayNoticeById($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}
