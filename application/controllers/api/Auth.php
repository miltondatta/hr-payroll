<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('api/Auth_model');
        $this->load->model('api/ValidateRequest');
        $this->load->model('login_model');
    }
    
    public function login(){
        $response = array(
            'status'  => '',
            'message' => '',
            'data'    => array(),
        );
        $method   = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output(405,
                        array( 'status' => 405, 'message' => 'Bad request, Method not allowed', 'data' => array() ));
        } else{
            $check_auth_client = $this->ValidateRequest->check_auth_client();
            
            if($check_auth_client == true){
                $params = $_REQUEST;
                
                $email    = $params['email'];
                $password = sha1($params['password']);
                
                $login_status = $this->validate_login($email, $password);
                if($login_status){
                    $token = crypt(sha1(substr(md5(rand()), 0, 9)), '');
                    $this->ValidateRequest->insertAuthorization($login_status['id'], $token);
                    
                    $response['status']               = 200;
                    $response['message']              = 'Successfully logged in.';
                    $response['token']                = $token;
                    $response['data']['user_profile'] = $login_status;
                } else{
                    $response['status']  = 403;
                    $response['message'] = 'User Name or Password Error';
                }
                json_output($response['status'], $response);
            }
            
        }
    }
    
    function validate_login($email = '', $password = ''){
        $credential = array( 'em_email' => $email, 'em_password' => $password, 'status' => 'ACTIVE' );
        $query      = $this->login_model->getUserForLogin($credential);
        
        if($query->num_rows() > 0){
            $row       = $query->row();
            $user_data = array(
                'id'              => $row->id,
                'em_id'           => $row->em_id,
                'em_code'         => $row->em_code,
                'des_id'          => $row->des_id,
                'dep_id'          => $row->dep_id,
                'first_name'      => $row->first_name,
                'last_name'       => $row->last_name,
                'em_email'        => $row->em_email,
                'em_role'         => $row->em_role,
                'em_address'      => $row->em_address,
                'status'          => $row->status,
                'em_gender'       => $row->em_gender,
                'em_phone'        => $row->em_phone,
                'em_birthday'     => $row->em_birthday,
                'em_blood_group'  => $row->em_blood_group,
                'em_joining_date' => $row->em_joining_date,
                'em_contact_end'  => $row->em_contact_end,
                'em_image'        => base_url('assets/images/users/') . $row->em_image,
                'em_nid'          => $row->em_nid,
            );
            
            return $user_data;
        } else{
            return false;
        }
    }
    
    public function logout(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output(400,
                        array( 'status'  => 400,
                               'message' => 'Bad request, Check Request Type',
                               'data'    => array() ));
        } else{
            $valid = $this->ValidateRequest->validate();
            if($valid){
                $users_id = $this->input->get_request_header('user_Id', true);
                $result   = $this->Auth_model->logout($users_id);
                json_output($result['status'], $result);
            } else{
                json_output(403, array( 'status'  => 403,
                                        'message' => 'Request Unauthorized',
                                        'data'    => array() ));
            }
        }
    }
}