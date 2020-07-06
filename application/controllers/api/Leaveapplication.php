<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leaveapplication extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('api/ValidateRequest');
        $this->load->model('api/LeaveApplicationModel');
        
    }
    
    public function add(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output(400,
                        array( 'status'  => 400,
                               'message' => 'Bad request, Check Request Type',
                               'data'    => array() ));
        } else{
            $valid = $this->ValidateRequest->validate();
            if($valid){
                $result = array();
                
                $emid         = $this->input->post('emid');
                $typeid       = $this->input->post('typeid');
                $applydate    = date('Y-m-d');
                $appstartdate = $this->input->post('startdate');
                $appenddate   = $this->input->post('enddate');
                $hourAmount   = $this->input->post('hourAmount');
                $reason       = $this->input->post('reason');
                $type         = $this->input->post('type');
                
                if($appstartdate == null){
                    json_output(400, array( 'status'  => 400,
                                            'message' => 'Wrong Parameter. Start date have the value..',
                                            'data'    => $result ));
                    
                    return;
                }
                if($type == 'Half Day'){
                    $duration = $hourAmount;
                } else if($type == 'Full Day'){
                    $duration = 8;
                } else{
                    if($appenddate == null){
                        json_output(400, array( 'status'  => 400,
                                                'message' => 'Wrong Parameter. End date have the value..',
                                                'data'    => $result ));
                        
                        return;
                    }
                    if($appstartdate > $appenddate){
                        json_output(400, array( 'status'  => 400,
                                                'message' => 'Wrong Parameter. Start date is getter than End date.',
                                                'data'    => $result ));
                        
                        return;
                    }
                    
                    $formattedStart = new DateTime($appstartdate);
                    $formattedEnd   = new DateTime($appenddate);
                    
                    $duration = $formattedStart->diff($formattedEnd)->format("%d");
                    $duration = $duration * 8;
                }
                
                $data = array(
                    'em_id'          => $emid,
                    'typeid'         => $typeid,
                    'apply_date'     => $applydate,
                    'start_date'     => $appstartdate,
                    'end_date'       => $appenddate,
                    'reason'         => $reason,
                    'leave_type'     => $type,
                    'leave_duration' => $duration,
                    'leave_status'   => 'Not Approve'
                );
                
                $insert_id = $this->LeaveApplicationModel->ApplicationSave($data);
                if($insert_id){
                    $data['id'] = $insert_id;
                    $result     = $data;
                    json_output(201, array( 'status'  => 201,
                                            'message' => 'Leave Saved Successfully',
                                            'data'    => $result ));
                } else{
                    json_output(500, array( 'status'  => 500,
                                            'message' => 'Try Again',
                                            'data'    => $result ));
                }
            } else{
                json_output(403, array( 'status'  => 403,
                                        'message' => 'Request Unauthorized',
                                        'data'    => array() ));
            }
        }
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
                $result     = array();
                $params     = $_REQUEST;
                $em_id      = $params['em_id'] ?? null;
                $start_date = $params['start_date'] ?? null;
                $end_date   = $params['end_date'] ?? null;
                
                if($start_date == null && $end_date != null){
                    json_output(400, array( 'status'  => 400,
                                            'message' => 'Wrong Parameter. Start Date Should have value if end date has value.',
                                            'data'    => $result ));
                    
                    return;
                }
                if(($start_date != null && $end_date != null) && $start_date > $end_date){
                    json_output(400, array( 'status'  => 400,
                                            'message' => 'Wrong Parameter. Start date is getter than End date.',
                                            'data'    => $result ));
                    
                    return;
                }
                
                $result = $this->LeaveApplicationModel->getLeaveList($em_id, $start_date, $end_date);
                
                json_output(200, array( 'status'  => 200,
                                        'message' => 'Get Leave Data',
                                        'data'    => $result ));
            } else{
                json_output(403, array( 'status'  => 403,
                                        'message' => 'Request Unauthorized',
                                        'data'    => array() ));
            }
        }
        
    }
    
}