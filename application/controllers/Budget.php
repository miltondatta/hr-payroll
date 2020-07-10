<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Budget extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
        $this->load->model('login_model');
        
        $this->load->model('budget_model');
    }
    
    public function index(){
        if($this->session->userdata('user_login_access') != false){
            $data['lists'] = $this->budget_model->getTrainingBudget();
            
            $this->load->view('backend/budget', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function save(){
        $success = $this->budget_model->save($this->input->post());
        $this->session->set_flashdata('feedback', 'Successfully Added');
        redirect(base_url('budget/index'));
    }
    
    public function edit($id){
        if($this->session->userdata('user_login_access') != false){
            $data['lists'] = $this->budget_model->getTrainingBudget();
            $data['item']  = $this->budget_model->getById($id);
            
            $this->load->view('backend/budget', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function update($id){
        if($this->session->userdata('user_login_access') != false){
            $this->budget_model->update($id, $this->input->post());
            $this->session->set_flashdata('feedback', 'Updated Successfully');
            redirect(base_url('budget/index'));
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function delete($id){
        if($this->session->userdata('user_login_access') != false){
            $this->budget_model->delete($id);
            $this->session->set_flashdata('delsuccess', 'Successfully Deleted');
            redirect(base_url('budget/index'));
        } else{
            redirect(base_url(), 'refresh');
        }
    }
}