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
            $data['mainMenu']  = $this->settings_model->getMenu(0);
            $data['role_name'] = $this->settings_model->getRoleInfo($role_id)->role_name;
            //$subMenu  = $this->settings_model->getMenu($record->id); 
            $this->load->view('backend/role_management_edit', $data);
        } else {
            redirect(base_url(), 'refresh');
        }    
    }


    public function AssignMenuSave(){
        if($this->session->userdata('user_login_access') != false){
            $id         = $this->input->post('menu_assign_id');
            $role_id    = $this->input->post('role_id');
            $menu_ids   = $this->input->post('menu_ids');
            if($menu_ids) {
                $menu_ids_str = implode(',', $menu_ids);
            }

            $dataarr = array(
                'role_id' => $role_id,
                'menu_id' => $menu_ids_str,
                'updated_at' => date('Y-m-d H:i:s')
            );

            if($id) {
                $this->db->where('id', $id);
                $this->db->update('menu_assigns', $dataarr);
            } else {
                $this->db->insert('menu_assigns', $dataarr);
            }

            $this->session->set_flashdata('feedback', 'Successfully Updated');
            redirect("UserManagement/AssignMenu");
        } else {
            redirect(base_url(), 'refresh');
        }    
    }

   
    public function addNewRoleSave(){
        if($this->session->userdata('user_login_access') != false){
            $dataarr = array(
                'role_type' => $this->input->post('role_type'),
                'role_name' => $this->input->post('role_name'),
                'role_desc' => $this->input->post('role_desc')
            );
            $this->db->insert('user_roles', $dataarr);
            $this->session->set_flashdata('feedback', 'Successfully Added');
            redirect("UserManagement/AssignMenu");
        } else {
            redirect(base_url(), 'refresh');
        }      
    }
    



}