<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Holiday extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('api/ValidateRequest');
        $this->load->model('api/Holiday_model');
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
                $result = array();
                $params = $_REQUEST;
                $year   = $params['year'] ?? null;
                $data   = $this->Holiday_model->getAllHolidays($year);
                foreach($data as $item){
                    $prep_data = array(
                        'holiday_name'   => $item->holiday_name,
                        'from_date'      => $item->from_date,
                        'to_date'        => $item->to_date,
                        'number_of_days' => $item->number_of_days,
                    );
                    array_push($result, $prep_data);
                }
                json_output(200, array( 'status'  => 200,
                                        'message' => 'Get Holidays Data',
                                        'data'    => $result ));
            } else{
                json_output(403, array( 'status'  => 403,
                                        'message' => 'Request Unauthorized',
                                        'data'    => array() ));
            }
        }
    }
}