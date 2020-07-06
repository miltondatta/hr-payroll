<?php

class Auth_model extends CI_Model{
    
    public function logout($users_id){
        $this->db->where('users_id', $users_id)->delete('users_authorization');
    
        return array( 'status' => 200, 'message' => 'Successfully logout.','data'    => array() );
    }
}