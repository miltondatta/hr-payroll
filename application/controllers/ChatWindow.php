<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChatWindow extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('employee_model');
        $this->load->model('leave_model');
    }

    public function index(){
        if($this->session->userdata('user_login_access') != false){
            
            $this->load->view('backend/chat_window');
        } else{
            redirect(base_url(), 'refresh');
        }
    }
}