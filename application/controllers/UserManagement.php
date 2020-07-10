<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserManagement extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('employee_model');
        $this->load->model('leave_model');
        $this->load->model('settings_model');
    }

    public function AssignMenu(){
        if($this->session->userdata('user_login_access') != false){
            $data['roles'] = $this->settings_model->roleselect();
            $this->load->view('backend/role_management', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }


}