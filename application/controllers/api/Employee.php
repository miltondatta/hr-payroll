<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('api/ValidateRequest');
        $this->load->model('api/EmployeeModel');
        $this->load->model('api/DepartmentModel');
        $this->load->model('api/DesignationModel');
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
                
//                $departments  = $this->DepartmentModel->getAllDepartment();
//                $designations = $this->DesignationModel->getAllDesignation();
                $data         = $this->EmployeeModel->getAllActive();
                
                foreach($data as $item){
                    
                    if(empty($item->em_image)){
                        $user_image = 'user.png';
                    }else{
                        $user_image = $item->em_image;
                    }
                    
                    $prep_data = array(
                        'id'              => $item->id,
//                        'em_id'           => $item->em_id,
//                        'em_code'         => $item->em_code,
//                        'des_id'          => $item->des_id,
//                        'des_name'        => $this->DesignationModel->FindDesignationNameWithId($designations,
//                                                                                                $item->des_id),
//                        'dep_id'          => $item->dep_id,
//                        'dep_name'        => $this->DepartmentModel->FindDepartmentNameWithId($departments,
//                                                                                              $item->dep_id),
                        'first_name'      => $item->first_name,
                        'last_name'       => $item->last_name,
                        'em_email'        => $item->em_email,
//                        'em_role'         => $item->em_role,
//                        'em_address'      => $item->em_address,
                        'status'          => $item->status,
//                        'em_gender'       => $item->em_gender,
                        'em_phone'        => $item->em_phone,
//                        'em_birthday'     => $item->em_birthday,
//                        'em_blood_group'  => $item->em_blood_group,
//                        'em_joining_date' => $item->em_joining_date,
//                        'em_contact_end'  => $item->em_contact_end,
                        'em_image'        => base_url('assets/images/users/') . $user_image,
//                        'em_nid'          => $item->em_nid,
                    );
                    array_push($result, $prep_data);
                }
                json_output(200, array( 'status'  => 200,
                                        'message' => 'Get Employee Data',
                                        'data'    => $result ));
            } else{
                json_output(403, array( 'status'  => 403,
                                        'message' => 'Request Unauthorized',
                                        'data'    => array() ));
            }
        }
        
    }
    
    public function details($id){
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
                
                $departments  = $this->DepartmentModel->getAllDepartment();
                $designations = $this->DesignationModel->getAllDesignation();
                $data         = $this->EmployeeModel->getEmployeeByEmId($id);
                
                foreach($data as $item){
                    
                    if(empty($item->em_image)){
                        $user_image = 'user.png';
                    }else{
                        $user_image = $item->em_image;
                    }
                    
                    $prep_data = array(
                        'id'              => $item->id,
                        'em_id'           => $item->em_id,
                        'em_code'         => $item->em_code,
                        'des_id'          => $item->des_id,
                        'des_name'        => $this->DesignationModel->FindDesignationNameWithId($designations,
                                                                                                $item->des_id),
                        'dep_id'          => $item->dep_id,
                        'dep_name'        => $this->DepartmentModel->FindDepartmentNameWithId($departments,
                                                                                              $item->dep_id),
                        'first_name'      => $item->first_name,
                        'last_name'       => $item->last_name,
                        'em_email'        => $item->em_email,
                        'em_role'         => $item->em_role,
                        'em_address'      => $item->em_address,
                        'status'          => $item->status,
                        'em_gender'       => $item->em_gender,
                        'em_phone'        => $item->em_phone,
                        'em_birthday'     => $item->em_birthday,
                        'em_blood_group'  => $item->em_blood_group,
                        'em_joining_date' => $item->em_joining_date,
                        'em_contact_end'  => $item->em_contact_end,
                        'em_image'        => base_url('assets/images/users/') . $user_image,
                        'em_nid'          => $item->em_nid,
                    );
                    array_push($result, $prep_data);
                }
                json_output(200, array( 'status'  => 200,
                                        'message' => 'Get Employee Data',
                                        'data'    => $result ));
            } else{
                json_output(403, array( 'status'  => 403,
                                        'message' => 'Request Unauthorized',
                                        'data'    => array() ));
            }
        }
        
    }
}