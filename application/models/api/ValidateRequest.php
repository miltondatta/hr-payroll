<?php

class ValidateRequest extends CI_Model{
    
    var $client_service = "frontend-client";
    var $api_key        = "nJYNWGume3BQrTW2xXbH";
    
    public function check_auth_client(){
        $client_service = $this->input->get_request_header('Client-Service', true);
        $auth_key       = $this->input->get_request_header('api-key', true);
        
        if($client_service == $this->client_service && $auth_key == $this->api_key){
            return true;
        } else{
            json_output(401, array( 'status' => 401, 'message' => 'Unauthorized Request', 'data' => array() ));
        }
    }
    
    public function insertAuthorization($user_id, $token){
        $last_login = date('Y-m-d H:i:s');
        $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
        
        $result = $this->db->get_where('users_authorization', array( 'users_id' => $user_id ));
        if($result->num_rows() > 0){
            $this->db->where('users_id', $user_id);
            $this->db->update('users_authorization', array( 'token'      => $token,
                                                            'expired_at' => $expired_at,
                                                            'updated_at' => $last_login ));
        } else{
            $this->db->insert('users_authorization', array( 'users_id'   => $user_id,
                                                            'token'      => $token,
                                                            'expired_at' => $expired_at,
                                                            'updated_at' => $last_login ));
        }
    }
    
    public function checkAuthorization(){
        
        $users_id = $this->input->get_request_header('user_id', true);
        $token    = $this->input->get_request_header('token', true);
        
        $result = $this->db->select('expired_at')->from('users_authorization')->where('users_id', $users_id)
                           ->where('token', $token)->get()->row();
        
        if($result == ""){
            json_output(403, array( 'status'  => 403,
                                    'message' => 'Request Unauthorized',
                                    'data'    => array() ));
        } else{
            if($result->expired_at < date('Y-m-d H:i:s')){
                json_output(401,
                            array( 'status'  => 401,
                                   'message' => 'Your session has been expired',
                                   'data'    => array() ));
            } else{
                $updated_at = date('Y-m-d H:i:s');
                $this->db->where('users_id', $users_id)->where('token', $token)->update('users_authorization',
                                                                                        array( 'updated_at' => $updated_at ));
                
                return true;
            }
        }
        
    }
    
    public function validate(){
        
        if($this->check_auth_client()){
            if($this->checkAuthorization()){
                return true;
            }
        }
        
        return false;
    }
    
}