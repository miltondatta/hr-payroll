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

    public function AssignMenuEdit(){
        if($this->session->userdata('user_login_access') != false){
            $role_id     = $data['role_id']   = base64_decode($this->input->get('id'));
            $assign_menu = $this->settings_model->checkMenuAssign($role_id);
            if($assign_menu) {
               $data['menu_assign_id'] = $assign_menu->id; 
               $data['menu_id']        = explode(',', $assign_menu->menu_id); 
            } else {
                $data['menu_assign_id'] = 0;
                $data['menu_id']        = [];
            }
            $menus    = [];
            $data['mainMenu'] = $this->settings_model->getMenu(0);
            //$subMenu  = $this->settings_model->getMenu($record->id); 
            $this->load->view('backend/role_management_edit', $data);
        } else {
            redirect(base_url(), 'refresh');
        }    
    }


}