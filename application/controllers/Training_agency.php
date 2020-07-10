<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Training_agency extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
        $this->load->model('login_model');
        $this->load->model('course_model');
        $this->load->model('training_agency_model');
    }
    
    public function index(){
        if($this->session->userdata('user_login_access') != false){
            $data['lists']   = $this->training_agency_model->getAll();
            $data['courses'] = $this->course_model->getAll();
            
            $this->load->view('backend/training_agency', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function save(){
        $success = $this->training_agency_model->save($this->input->post());
        $this->session->set_flashdata('feedback', 'Successfully Added');
        redirect(base_url('training_agency/index'));
    }
    
    public function edit($id){
        if($this->session->userdata('user_login_access') != false){
            $data['item']    = $this->training_agency_model->getById($id);
            $data['lists']   = $this->training_agency_model->getAll();
            $data['courses'] = $this->course_model->getAll();
            
            $this->load->view('backend/training_agency', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function update($id){
        if($this->session->userdata('user_login_access') != false){
            $this->training_agency_model->update($id, $this->input->post());
            $this->session->set_flashdata('feedback', 'Updated Successfully');
            redirect(base_url('training_agency/index'));
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function delete($id){
        if($this->session->userdata('user_login_access') != false){
            $this->training_agency_model->delete($id);
            $this->session->set_flashdata('delsuccess', 'Successfully Deleted');
            redirect(base_url('training_agency/index'));
        } else{
            redirect(base_url(), 'refresh');
        }
    }
}