<?php
defined('BASEPATH') or exit('No direct script access allowed');

class To_do extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('api/ValidateRequest');
        $this->load->model('api/To_do_model');
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
                $user_id = $params['em_id'] ?? null;
                $value   = $params['value'] ?? null;
                $date    = $params['date'] ?? null;
                if($user_id == null || $user_id == ''){
                    json_output(400, array( 'status'  => 400,
                                            'message' => 'Invalid request Parameter',
                                            'data'    => array() ));
                    
                    return;
                }
                
                $todos = $this->To_do_model->GettodoInfoWithValue($user_id, $value, $date);
                foreach($todos as $todo){
                    $prep_data = array(
                        'id'        => $todo->id,
                        'to_dodata' => $todo->to_dodata,
                        'date'      => $todo->date,
                        'value'     => $todo->value,
                        'value_def' => ($todo->value == 1) ? 'To-Do' : 'Done',
                    );
                    array_push($result, $prep_data);
                }
                json_output(200, array( 'status'  => 200,
                                        'message' => 'Get To-Do Data',
                                        'data'    => $result ));
            } else{
                json_output(403, array( 'status'  => 403,
                                        'message' => 'Request Unauthorized',
                                        'data'    => array() ));
            }
        }
    }
    
    public function addToDo(){
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
                $date   = date("Y-m-d h:i:sa");
                
                $to_dodata = $this->input->post('to_dodata');
                $user_id   = $this->input->post('user_id');
                
                if($to_dodata != null && $user_id != null){
                    $data      = array(
                        'user_id'   => $user_id,
                        'to_dodata' => $to_dodata,
                        'value'     => 1,
                        'date'      => $date
                    );
                    $insert_id = $this->To_do_model->insert_todo($data);
                    
                    $data['id'] = $insert_id;
                    $result     = $data;
                    json_output(201, array( 'status'  => 201,
                                            'message' => 'To Do Saved Successfully',
                                            'data'    => $result ));
                } else{
                    json_output(400, array( 'status'  => 400,
                                            'message' => 'Wrong Parameter. Check Please',
                                            'data'    => $result ));
                }
            } else{
                json_output(403, array( 'status'  => 403,
                                        'message' => 'Request Unauthorized',
                                        'data'    => array() ));
            }
        }
    }
    
    public function updateToDo(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'PUT'){
            json_output(400,
                        array( 'status'  => 400,
                               'message' => 'Bad request, Check Request Type',
                               'data'    => array() ));
        } else{
            $valid = $this->ValidateRequest->validate();
            if($valid){
                $result    = array();
                $params    = $_REQUEST;
                $todo_id   = $params['todo_id'];
                $value     = isset($params['value']) ? $params['value'] : null;
                $to_dodata = isset($params['to_dodata']) ? str_replace("\"", "", $params['to_dodata']) : null;;
                
                if($to_dodata != null && $value != null){
                    $data = array(
                        'value'     => $value,
                        'to_dodata' => $to_dodata
                    );
                } else{
                    if($to_dodata != null){
                        $data = array(
                            'to_dodata' => $to_dodata,
                        );
                    } else if($value != null){
                        $data = array(
                            'value' => $value,
                        );
                    } else{
                        $data = array(
                            'value' => 1,
                        );
                    }
                }
                
                $todos = $this->To_do_model->UpdateTododata($todo_id, $data);
                
                $result['affacted_row'] = $todos;
                
                json_output(200, array( 'status'  => 200,
                                        'message' => 'Update Successful',
                                        'data'    => $result ));
                
            } else{
                json_output(403, array( 'status'  => 403,
                                        'message' => 'Request Unauthorized',
                                        'data'    => array() ));
            }
        }
    }
    
    public function delete(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'DELETE'){
            json_output(400,
                        array( 'status'  => 400,
                               'message' => 'Bad request, Check Request Type',
                               'data'    => array() ));
        } else{
            $valid = $this->ValidateRequest->validate();
            if($valid){
                $result  = array();
                $params  = $_REQUEST;
                $todo_id = $params['todo_id'];
                
                if($todo_id == null){
                    json_output(403, array( 'status'  => 402,
                                            'message' => 'To do id will not be null',
                                            'data'    => array() ));
                }
                $data  = array( 'id' => $todo_id );
                $deleted = $this->To_do_model->delete($data);
                
                json_output(200, array( 'status'  => 200,
                                        'message' => 'Deleted Successfully',
                                        'data'    => $result ));
                
            } else{
                json_output(403, array( 'status'  => 403,
                                        'message' => 'Request Unauthorized',
                                        'data'    => array() ));
            }
        }
    }
    
}