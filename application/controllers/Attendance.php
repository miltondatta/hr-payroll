<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model');
        $this->load->model('employee_model');
        $this->load->model('loan_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
        $this->load->model('attendance_model');
        $this->load->model('project_model');
        $this->load->library('csvimport');
    }
    
    public function Attendance(){
        if($this->session->userdata('user_login_access') != false){
            $data['employee'] = $this->employee_model->emselect();
            $data['attendancelist'] = $this->attendance_model->getAllAttendance();
            
            $this->load->view('backend/attendance', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function Save_Attendance(){
        if($this->session->userdata('user_login_access') != false){
            $data['employee'] = $this->employee_model->emselect();
            $id               = $this->input->get('A');
            if( !empty($id)){
                $data['attval'] = $this->attendance_model->em_attendanceFor($id);
            }
            #$data['attendancelist'] = $this->attendance_model->em_attendance();
            $this->load->view('backend/add_attendance', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function Attendance_Report(){
        if($this->session->userdata('user_login_access') != false){
            
            $data['employee'] = $this->employee_model->emselect();
            $id               = $this->input->get('A');
            if( !empty($id)){
                    $data['attval'] = $this->attendance_model->em_attendanceFor($id);
            }
            
            $this->load->view('backend/attendance_report', $data);
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function getPINFromID($employee_ID){
        return $this->attendance_model->getPINFromID($employee_ID);
    }

    public function getAttendanceByDate()
    {
        if($this->session->userdata('user_login_access') != false){
            $date_from   = $this->input->post('date_from');
            $date_to     = $this->input->post('date_to');
            $employee_id = $this->input->post('employee_id');

            if($employee_id){
                $employee_PIN = $this->getPINFromID($employee_id)->em_code;
            }

            if(isset($employee_PIN)){
                $data['attendance']    = $this->attendance_model->getAttendanceDataByID($employee_PIN, $date_from, $date_to);
                echo json_encode($data);
            } else{
                $data['attendance'] = $this->attendance_model->getAttendanceByDate($date_from, $date_to);
                echo json_encode($data);
            }
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function Get_attendance_data_for_report(){
        if($this->session->userdata('user_login_access') != false){
            $date_from   = $this->input->post('date_from');
            $date_to     = $this->input->post('date_to');
            $employee_id = $this->input->post('employee_id');
            
            if($employee_id){
                $employee_PIN = $this->getPINFromID($employee_id)->em_code;
            }
            
            if(isset($employee_PIN)){
                $attendance_data    =
                    $this->attendance_model->getAttendanceDataByID($employee_PIN, $date_from, $date_to);
                $data['attendance'] = $attendance_data;
                $attendance_hours   =
                    $this->attendance_model->getTotalAttendanceDataByID($employee_PIN, $date_from, $date_to);
                if( !empty($attendance_data)){
                    $data['name']  = $attendance_data[0]->name;
                    $data['days']  = count($attendance_data);
                    $data['hours'] = $attendance_hours;
                }
                echo json_encode($data);
            } else{
                $data['attendance'] = array();
                $data['name']       = '';
                $data['days']       = '';
                $data['hours']      = array();
                echo json_encode($data);
            }
            
            /*foreach ($attendance_data as $row) {
                $row =  
                    "<tr>
                        <td>$numbering</td>
                        <td>$row->first_name $row->first_name</td>
                        <td>$row->atten_date</td>
                        <td>$row->signin_time</td>
                        <td>$row->signout_time</td>
                        <td>$row->working_hour</td>
                        <td>Type</td>
                    </tr>";
            }*/
            
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    public function Add_Attendance(){
        if($this->session->userdata('user_login_access') != false){
            $id      = $this->input->post('id');
            $em_id   = $this->input->post('emid');
            $attdate = $this->input->post('attdate');
            $signin  = $this->input->post('signin');
            $signout = $this->input->post('signout');
            $place   = $this->input->post('place');
            
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('attdate', 'Date details', 'trim|required|xss_clean');
            $this->form_validation->set_rules('emid', 'Employee', 'trim|required|xss_clean');
            $old_date           = $attdate; // returns Saturday, January 30 10 02:06:34
            $old_date_timestamp = strtotime($old_date);
            $new_date           = date('m/d/Y', $old_date_timestamp);
            
            // CHANGING THE DATE FORMAT FOR DB UTILITY
            $new_date_changed = date('Y-m-d', strtotime(str_replace('-', '/', $new_date)));
            
            if($this->form_validation->run() == false){
                $this->session->set_flashdata('error', validation_errors());
                redirect("attendance/Save_Attendance");
            } else{
                $sin  = new DateTime($new_date . $signin);
                $sout = new DateTime($new_date . $signout);
                $hour = $sin->diff($sout);
                $work = $hour->format('%H h %i m');
                
                //                die($id);
                if(empty($id)){
                    $day = date("D", strtotime($new_date_changed));
                    if($day == "Fri"){
                        $duplicate = $this->attendance_model->getDuplicateVal($em_id, $new_date_changed);
                        //print_r($duplicate);
                        if( !empty($duplicate)){
                            $this->session->set_flashdata('error', 'Already exist');
                            redirect("attendance/Save_Attendance");
                        } else{
                            $emcode  = $this->employee_model->emselectByCode($em_id);
                            $emid    = $emcode->em_id;
                            $earnval = $this->leave_model->emEarnselectByLeave($emid);
                            $data    = array(
                                'present_date' => $earnval->present_date + 1,
                                'hour'         => $earnval->hour + 480,
                                'status'       => '1'
                            );
                            $success = $this->leave_model->UpdteEarnValue($emid, $data);
                            $data    = array(
                                'emp_id'       => $em_id,
                                'atten_date'   => $new_date_changed,
                                'signin_time'  => $signin,
                                'signout_time' => $signout,
                                'working_hour' => $work,
                                'place'        => $place,
                                'status'       => 'E'
                            );
                            $success = $this->attendance_model->Add_AttendanceData($data);
                            $this->session->set_flashdata('feedback', 'Successfully updated');
                            redirect("attendance/Attendance");
                        }
                    } else if($day != "Fri"){
                        $holiday = $this->leave_model->get_holiday_between_dates($new_date_changed);
                        if($holiday){
                            $duplicate = $this->attendance_model->getDuplicateVal($em_id, $new_date_changed);
                            //print_r($duplicate);
                            if( !empty($duplicate)){
                                $this->session->set_flashdata('error', 'Already exist');
                                redirect("attendance/Save_Attendance");
                            } else{
                                $emcode  = $this->employee_model->emselectByCode($em_id);
                                $emid    = $emcode->em_id;
                                $earnval = $this->leave_model->emEarnselectByLeave($emid);
                                $data    = array(
                                    'present_date' => $earnval->present_date + 1,
                                    'hour'         => $earnval->hour + 480,
                                    'status'       => '1'
                                );
                                $success = $this->leave_model->UpdteEarnValue($emid, $data);
                                $data    = array(
                                    'emp_id'       => $em_id,
                                    'atten_date'   => $new_date_changed,
                                    'signin_time'  => $signin,
                                    'signout_time' => $signout,
                                    'working_hour' => $work,
                                    'place'        => $place,
                                    'status'       => 'E'
                                );
                                $this->attendance_model->Add_AttendanceData($data);
                                $this->session->set_flashdata('feedback', 'Successfully added');
                                redirect("attendance/Attendance");
                            }
                        } else{
                            $duplicate = $this->attendance_model->getDuplicateVal($em_id, $new_date_changed);
                            //print_r($duplicate);
                            if( !empty($duplicate)){
                                $this->session->set_flashdata('error', 'Already exist');
                                redirect("attendance/Save_Attendance");
                            } else{
                                //$date = date('Y-m-d', $i);
                                $data = array(
                                    'emp_id'       => $em_id,
                                    'atten_date'   => $new_date_changed,
                                    'signin_time'  => $signin,
                                    'signout_time' => $signout,
                                    'working_hour' => $work,
                                    'place'        => $place,
                                    'status'       => 'A'
                                );
                                $this->attendance_model->Add_AttendanceData($data);
                                $this->session->set_flashdata('feedback', 'Successfully added');
                                redirect("attendance/Attendance");
                            }
                        }
                    }
                } else{
                    $data = array(
                        'signin_time'  => $signin,
                        'signout_time' => $signout,
                        'working_hour' => $work,
                        'place'        => $place,
                        'status'       => 'A'
                    );
                    $this->attendance_model->Update_AttendanceData($id, $data);
                    $this->session->set_flashdata('feedback', 'Successfully updated');
                    redirect("attendance/Attendance");
                }
            }
        } else{
            redirect(base_url(), 'refresh');
        }
    }
    
    function import(){
        $this->load->library('csvimport');
        $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
        
        foreach($file_data as $row){
            $emp_no = $row["Employee No."];
            $date   = date('Y-m-d', strtotime($row["Date"]));
            if($emp_no > 1){
                if($row['Clock In'] > '00:00:00'){
                    $sign_in_time  = date_format(new DateTime($row["Clock In"]), 'H:i:s');
                    $sign_out_time = ($row["Clock Out"]) ? date_format(new DateTime($row["Clock Out"]), 'H:i:s')
                        : date_format(new DateTime('18:30:00'), 'H:i:s');
                    $status        = ($row["Absent"] == "False") ? 'E' : 'A';
                    $work_duration = round((strtotime($sign_out_time) - strtotime($sign_in_time)) / 60, 2) . " min";
                    $over_time     = $this->time_to_min_conv($row["OverTime"]);
                } else{
                    $sign_in_time  = null;
                    $sign_out_time = null;
                    $status        = ($row["Absent"] == "False") ? 'E' : 'A';
                    $work_duration = 0 . " min";
                    $over_time     = 0 . " min";
                }
                $duplicate = $this->attendance_model->getDuplicateVal($emp_no, $date);
                if( !empty($duplicate)){
                    $data = array(
                        'signin_time'           => $sign_in_time,
                        'signout_time'          => $sign_out_time,
                        'working_hour'          => $work_duration,
                        'absence'               => null,
                        'overtime'              => $over_time,
                        'status'                => $status,
                        'late'                  => $row["Late"],
                        'early'                 => $row["Early"],
                        'exception_description' => $row["Exception Description"],
                        'place'                 => 'office'
                    );
                    $this->attendance_model->bulk_Update($emp_no, $date, $data);
                } else{
                    $data = array(
                        'emp_id'                => $emp_no,
                        'atten_date'            => $date,
                        'signin_time'           => $sign_in_time,
                        'signout_time'          => $sign_out_time,
                        'working_hour'          => $work_duration,
                        'absence'               => null,
                        'overtime'              => $over_time,
                        'status'                => $status,
                        'late'                  => $row["Late"],
                        'early'                 => $row["Early"],
                        'exception_description' => $row["Exception Description"],
                        'place'                 => 'office'
                    );
                    $this->attendance_model->Add_AttendanceData($data);
                }
            }
        }
        
        /*foreach($file_data as $row){
            if($row["Check-in at"] > '0:00:00'){
                $date      = date('Y-m-d', strtotime($row["Date"]));
                $duplicate = $this->attendance_model->getDuplicateVal($row["Employee No"], $date);
                if( !empty($duplicate)){
                    $data = array(
                        'signin_time'  => $row["Check-in at"],
                        'signout_time' => $row["Check-out at"],
                        'working_hour' => $row["Work Duration"],
                        'absence'      => $row["Absence Duration"],
                        'overtime'     => $row["Overtime Duration"],
                        'status'       => 'A',
                        'place'        => 'office'
                    );
                    $this->attendance_model->bulk_Update($row["Employee No"], $date, $data);
                } else{
                    $data = array(
                        'emp_id'       => $row["Employee No"],
                        'atten_date'   => date('Y-m-d', strtotime($row["Date"])),
                        'signin_time'  => $row["Check-in at"],
                        'signout_time' => $row["Check-out at"],
                        'working_hour' => $row["Work Duration"],
                        'absence'      => $row["Absence Duration"],
                        'overtime'     => $row["Overtime Duration"],
                        'status'       => 'A',
                        'place'        => 'office'
                    );
                    //echo count($data); 
                    $this->attendance_model->Add_AttendanceData($data);
                }
            }
        }*/
        echo "successfully Updated";
        redirect("attendance/Attendance");
    }
    
    public function time_to_min_conv($time){
        if($time){
            $time_array = explode(":", $time);
            
            return $time_array[0] * 60 + $time_array[1] . " min";
        }
        
        return 0 . " min";
        
    }
}

?>