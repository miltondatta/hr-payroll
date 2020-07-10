<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
        $this->load->model('login_model');
        
        $this->load->model('employee_model');
        $this->load->model('Course_model');
    }
    
    public function index(){
        if($this->session->userdata('user_login_access') != false){
            $data['lists']        = $this->Course_model->getAll();
            $data['designations'] = $this->employee_model->getdesignation();
            
            $this->load->view('backend/course', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function save(){
        $success = $this->Course_model->save($this->input->post());
        $this->session->set_flashdata('feedback', 'Successfully Added');
        redirect(base_url('course/index'));
    }
    
    public function edit($id){
        if($this->session->userdata('user_login_access') != false){
            $data['lists'] = $this->Course_model->getAll();
            $data['item']  = $this->Course_model->getById($id);
            $data['designations'] = $this->employee_model->getdesignation();
            
            $this->load->view('backend/course', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function update($id){
        if($this->session->userdata('user_login_access') != false){
            $this->Course_model->update($id, $this->input->post());
            $this->session->set_flashdata('feedback', 'Updated Successfully');
            redirect(base_url('course/index'));
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function delete($id){
        if($this->session->userdata('user_login_access') != false){
            $this->Course_model->delete($id);
            $this->session->set_flashdata('delsuccess', 'Successfully Deleted');
            redirect(base_url('course/index'));
        } else{
            redirect(base_url(), 'refresh');
        }
    }
}