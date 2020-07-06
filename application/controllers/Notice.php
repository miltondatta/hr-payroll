<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notice extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model');
        $this->load->model('employee_model');
        $this->load->model('notice_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
    }
    
    public function index(){
        #Redirect to Admin dashboard after authentication
        if($this->session->userdata('user_login_access') == 1){
            redirect('dashboard/Dashboard');
        }
        #$data['settingsvalue'] = $this->dashboard_model->GetSettingsValue();
        $this->load->view('login');
    }
    
    public function All_notice(){
        if($this->session->userdata('user_login_access') != false){
            $data['notice'] = $this->notice_model->GetNotice();
            $this->load->view('backend/notice', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function Published_Notice(){
        if($this->session->userdata('user_login_access') != false){
            $filetitle = $this->input->post('title');
            $ndate     = $this->input->post('nodate');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('title', 'title',
                                              'trim|required|min_length[25]|max_length[150]|xss_clean');
            
            if($this->form_validation->run() == false){
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('notice/All_notice'));
            } else{
                if($_FILES['file_url']['name']){
                    $file_name     = $_FILES['file_url']['name'];
                    $fileSize      = $_FILES["file_url"]["size"] / 1024;
                    $fileType      = $_FILES["file_url"]["type"];
                    $new_file_name = '';
                    $new_file_name .= $file_name;
                    
                    $config = array(
                        'file_name'     => $new_file_name,
                        'upload_path'   => "./assets/images/notice",
                        'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
                        'overwrite'     => false,
                        //'max_size'      => "50720000"
                    );
                    
                    $this->load->library('Upload', $config);
                    $this->upload->initialize($config);
                    if( !$this->upload->do_upload('file_url')){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect(base_url('notice/All_notice'));
                    } else{
                        $path    = $this->upload->data();
                        $img_url = $path['file_name'];
                        $data    = array(
                            'title'    => $filetitle,
                            'file_url' => $img_url,
                            'date'     => $ndate
                        );
                        $this->notice_model->Published_Notice($data);
                        $this->session->set_flashdata('feedback', 'Successfully Added');
                        redirect(base_url('notice/All_notice'));
                    }
                }
                
            }
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
}