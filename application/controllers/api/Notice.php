<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notice extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('api/ValidateRequest');
        $this->load->model('api/Notice_model');
    }
    
    public function all(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            json_output(400,
                        array( 'status'  => 400,
                               'message' => 'Bad request, Check Request Type',
                               'data'    => array() ));
        } else{
            $valid = $this->ValidateRequest->validate();
            if($valid){
                $result  = array();
                $params  = $_REQUEST;
                $limit   = $params['limit'] ?? null;
                $date    = $params['date'] ?? null;
                $notices = $this->Notice_model->GetNoticeCustomLimit($limit, $date);
                foreach($notices as $notice){
                    $prep_data = array(
                        'id'       => $notice->id,
                        'title'    => $notice->title,
                        'file_url' => base_url('/assets/images/notice/') . $notice->file_url,
                        'date'     => $notice->date,
                    );
                    array_push($result, $prep_data);
                }
                json_output(200, array( 'status'  => 200,
                                        'message' => 'Get Notice Data',
                                        'data'    => $result ));
            } else{
                json_output(403, array( 'status'  => 403,
                                        'message' => 'Request Unauthorized',
                                        'data'    => array() ));
            }
        }
        
    }
}