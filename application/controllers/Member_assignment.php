<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Member_assignment extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
        $this->load->model('login_model');
        $this->load->model('course_model');
        $this->load->model('member_assignment_model');
    }
    
    public function index(){
        if($this->session->userdata('user_login_access') != false){
            $data['lists']     = $this->member_assignment_model->getAll();
            $data['courses']   = $this->course_model->getAll();
            $data['employees'] = $this->employee_model->emselect();
            
            $this->load->view('backend/member_assignment', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function save(){
        $course_id = $this->input->post('course_id');
        $from_date = $this->input->post('from_date');
        $to_date   = $this->input->post('to_date');
        
        $course_insert_array = array(
            'course_id' => $course_id,
            'from_date' => $from_date,
            'to_date'   => $to_date,
        );
        
        $insert_id = $this->member_assignment_model->save($course_insert_array);
        
        $course_emp_master_array = array();
        foreach($this->input->post('employees') as $employee){
            $course_emp_array = array(
                'training_ass_id' => $insert_id,
                'course_id'       => $course_id,
                'employee_id'     => $employee,
            );
            array_push($course_emp_master_array, $course_emp_array);
        }
        $this->member_assignment_model->saveBulk($course_emp_master_array);
        
        $this->session->set_flashdata('feedback', 'Successfully Added');
        redirect(base_url('member_assignment/index'));
    }
    
    public function edit($id){
        if($this->session->userdata('user_login_access') != false){
            $data['item']         = $this->member_assignment_model->getById($id);
            $data['item_members'] = $this->member_assignment_model->getMemberById($id);
            
            $data['lists']     = $this->member_assignment_model->getAll();
            $data['courses']   = $this->course_model->getAll();
            $data['employees'] = $this->employee_model->emselect();
            
            $this->load->view('backend/member_assignment', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function update($id){
        
        if($this->session->userdata('user_login_access') != false){
            
            $course_id = $this->input->post('course_id');
            $from_date = $this->input->post('from_date');
            $to_date   = $this->input->post('to_date');
            
            $course_insert_array = array(
                'course_id' => $course_id,
                'from_date' => $from_date,
                'to_date'   => $to_date,
            );
            
            $this->member_assignment_model->update($id, $course_insert_array);
            $this->member_assignment_model->deleteTrainingMembers($id);
            
            $course_emp_master_array = array();
            foreach($this->input->post('employees') as $employee){
                $course_emp_array = array(
                    'training_ass_id' => $id,
                    'course_id'       => $course_id,
                    'employee_id'     => $employee,
                );
                array_push($course_emp_master_array, $course_emp_array);
            }
            $this->member_assignment_model->saveBulk($course_emp_master_array);
            
            $this->session->set_flashdata('feedback', 'Updated Successfully');
            redirect(base_url('member_assignment/index'));
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function delete($id){
        if($this->session->userdata('user_login_access') != false){
            $this->member_assignment_model->delete($id);
            $this->session->set_flashdata('delsuccess', 'Successfully Deleted');
            redirect(base_url('member_assignment/index'));
        } else{
            redirect(base_url(), 'refresh');
        }
    }
}