<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave extends CI_Controller
{

    /**
     * Index Page for this controller.
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model');
        $this->load->model('employee_model');
        $this->load->model('leave_model');
        $this->load->model('settings_model');
        $this->load->model('project_model');
    }

    public function index()
    {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('user_login_access') == 1) {
            redirect('dashboard/Dashboard');
        }
        #$data['settingsvalue'] = $this->dashboard_model->GetSettingsValue();
        $this->load->view('login');
    }

    public function Holidays()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['holidays'] = $this->leave_model->GetAllHoliInfo();
            $this->load->view('backend/holiday', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Holidays_for_calendar()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $result = $this->leave_model->GetAllHoliInfoForCalendar();
            print_r($result);
            die();
            echo jason_encode($result);

        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Add_Holidays()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->post('id');
            $name = $this->input->post('holiname');
            $sdate = $this->input->post('startdate');
            $edate = $this->input->post('enddate');

            if (empty($edate)) {
                $nofdate = '1';
            } else {
                $date1 = new DateTime($sdate);
                $date2 = new DateTime($edate);
                $diff = date_diff($date1, $date2);
                $nofdate = $diff->format("%a");
            }
            $year = date('m-Y', strtotime($sdate));
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('holiname', 'Holidays name',
                'trim|required|min_length[5]|max_length[120]|xss_clean');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('leave/Holidays'));
            } else {
                $data = array(
                    'holiday_name' => $name,
                    'from_date' => $sdate,
                    'to_date' => $edate,
                    'number_of_days' => $nofdate,
                    'year' => $year
                );
                if (empty($id)) {
                    $this->leave_model->Add_HolidayInfo($data);

                    $this->session->set_flashdata('feedback', 'Successfully Added');
                    redirect("leave/Holidays");
                } else {
                    $this->leave_model->Update_HolidayInfo($id, $data);

                    $this->session->set_flashdata('feedback', 'Successfully Updated');
                    redirect("leave/Holidays");
                }

            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Add_leaves_Type()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->post('id');
            $name = $this->input->post('leavename');
            $nodays = $this->input->post('leaveday');
            $status = $this->input->post('status');

            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('leavename', 'leave name',
                'trim|required|min_length[1]|max_length[220]|xss_clean');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('leave/leavetypes'));
            } else {
                $data = array(
                    'name' => $name,
                    'leave_day' => $nodays,
                    'status' => $status
                );
                if (empty($id)) {
                    $this->leave_model->Add_leave_Info($data);

                    $this->session->set_flashdata('feedback', 'Successfully Added');
                    redirect("leave/leavetypes");
                } else {
                    $this->leave_model->Update_leave_Info($id, $data);

                    $this->session->set_flashdata('feedback', 'Successfully Updated');
                    redirect("leave/leavetypes");
                }

            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Application()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['employee'] = $this->employee_model->emselect(); // gets active employee details
            $data['leavetypes'] = $this->leave_model->GetleavetypeInfo();
            $data['application'] = $this->leave_model->AllLeaveAPPlication();
            $this->load->view('backend/leave_approve', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function EmApplication()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $emid = $this->session->userdata('user_login_id');
            $data['employee'] = $this->employee_model->emselectByID($emid);
            $data['leavetypes'] = $this->leave_model->GetleavetypeInfo();
            $data['application'] = $this->leave_model->GetallApplication($emid);
            $this->load->view('backend/leave_apply', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Update_Applications()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->post('id');
            $emid = $this->input->post('emid');
            $typeid = $this->input->post('typeid');
            $appstartdate = $this->input->post('startdate');
            $appenddate = $this->input->post('enddate');
            $reason = $this->input->post('reason');
            /*      $type = $this->input->post('type');*/
            $duration = $this->input->post('duration');
            $hour = $this->input->post('hour');
            $datetime = $this->input->post('datetime');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('reason', 'reason',
                'trim|required|min_length[5]|max_length[512]|xss_clean');
            if ($this->form_validation->run() == false) {
                echo validation_errors();
                #redirect("employee/view?I=" .base64_encode($eid));
            } else {
                $data = array(
                    'em_id' => $emid,
                    'typeid' => $typeid,
                    'start_date' => $appstartdate,
                    'end_date' => $appenddate,
                    'reason' => $reason,
                    /*'leave_type'=>$type,*/
                    'leave_duration' => $duration,
                    'leave_status' => 'Approve'
                );
                $success = $this->leave_model->Application_Apply_Update($id, $data);
                #$this->session->set_flashdata('feedback','Successfully Updated');
                #redirect("leave/Application");

                if ($this->db->affected_rows()) {
                    $data = array(
                        'emp_id' => $emid,
                        'app_id' => $id,
                        'type_id' => $typeid,
                        'day' => $duration,
                        'hour' => $hour,
                        'dateyear' => $datetime
                    );
                    $success = $this->leave_model->Application_Apply_Approve($data);
                    echo "Successfully Approved";
                }
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Add_Applications()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->post('id');
            $emid = $this->input->post('emid');
            $typeid = $this->input->post('typeid');
            $applydate = date('Y-m-d');
            $appstartdate = $this->input->post('startdate');
            $appenddate = $this->input->post('enddate');
            $hourAmount = $this->input->post('hourAmount');
            $reason = $this->input->post('reason');
            $type = $this->input->post('type');
            // $duration     = $this->input->post('duration');

            if ($type == 'Half Day') {
                $duration = $hourAmount;
            } else if ($type == 'Full Day') {
                $duration = 8;
            } else {
                $formattedStart = new DateTime($appstartdate);
                $formattedEnd = new DateTime($appenddate);

                $duration = $formattedStart->diff($formattedEnd)->format("%d");
                $duration = $duration * 8;
            }

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('startdate', 'Start Date', 'trim|required|xss_clean');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('leave/Application'));
            } else {
                $data = array(
                    'em_id' => $emid,
                    'typeid' => $typeid,
                    'apply_date' => $applydate,
                    'start_date' => $appstartdate,
                    'end_date' => $appenddate,
                    'reason' => $reason,
                    'leave_type' => $type,
                    'leave_duration' => $duration,
                    'leave_status' => 'Not Approve'
                );
                if (empty($id)) {
                    $success = $this->leave_model->Application_Apply($data);

                    $this->session->set_flashdata('feedback','Successfully Added');
                    redirect("leave/Application");
                } else {
                    $success = $this->leave_model->Application_Apply_Update($id, $data);

                    $this->session->set_flashdata('feedback','Successfully Updated');
                    redirect("leave/Application");
                }

            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Add_L_Status()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->post('lid');
            $value = $this->input->post('lvalue');
            $duration = $this->input->post('duration');
            $type = $this->input->post('type');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            $data = array(
                'leave_status' => $value
            );
            $success = $this->leave_model->Application_Apply_Update($id, $data);
            if ($value == 'Approve') {
                $totalday = $this->leave_model->GetTotalDay($type);
                $total = $totalday->total_day + $duration;
                $data = array(
                    'total_day' => $total
                );
                $success = $this->leave_model->Assign_Duration_Update($type, $data);
                echo "Successfully Updated";
            } else {
                echo "Successfully Updated";
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Holidaybyib()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $data['holidayvalue'] = $this->leave_model->GetLeaveValue($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function LeaveAppbyid()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $emid = $this->input->get('emid');
            $data['leaveapplyvalue'] = $this->leave_model->GetLeaveApply($id);
            /*$leaveapplyvalue = $this->leave_model->GetEmLeaveApply($emid);*/
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function LeaveTypebYID()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $data['leavetypevalue'] = $this->leave_model->GetLeaveType($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function GetEarneBalanceByEmCode()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $data['earnval'] = $this->leave_model->GetEarneBalanceByEmCode($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function HOLIvalueDelet()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $this->leave_model->DeletHoliday($id);

            $this->session->set_flashdata('feedback', 'Successfully Deleted');
            return;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function APPvalueDelet()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $success = $this->leave_model->DeletApply($id);
            redirect('leave/Application');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function LeavetypeDelet()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('D');
            $this->leave_model->DeletType($id);

            $this->session->set_flashdata('feedback', 'Successfully Deleted');
            redirect('leave/leavetypes');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function leavetypes()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['leavetypes'] = $this->leave_model->GetleavetypeInfo();
            $this->load->view('backend/leavetypes', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function LeaveType()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $year = date('Y');
            $leavetype = $this->leave_model->GetemLeaveType($id, $year);
            $assignleave = $this->leave_model->GetemassignLeaveType($id, $year);
            foreach ($leavetype as $value) {
                echo "<option value='$value->type_id'>$value->name</option>";
            }
            $totalday = $assignleave->total_day . '/' . $assignleave->day;
            echo $totalday;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function EmLeavesheet()
    {
        $emid = $this->session->userdata('user_login_id');
        $data['embalance'] = $this->leave_model->EmLeavesheet($emid);
        $this->load->view('backend/leavebalance', $data);
    }

    public function GetemployeeGmLeave()
    {
        $year = $this->input->get('year');
        $id = $this->input->get('typeid');
        $emid = $this->input->get('emid');
        $assignleave = $this->leave_model->GetemassignLeaveType($emid, $id, $year);
        $totaldays = 0;
        foreach ($assignleave as $value) {
            $totaldays = $totaldays + $value->day;
        }
        $day = $totaldays;
        $leavetypes = $this->leave_model->GetleavetypeInfoid($id);
        $totalday = $day . '/' . $leavetypes->leave_day;
        echo $totalday;
    }

    public function Leave_report()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['employee'] = $this->employee_model->emselect();
            $this->load->view('backend/leave_report', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    // Get leave details hourly
    public function Get_LeaveDetails()
    {
        $emid = $this->input->get('emp_id');
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('date_from', 'Date Time', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_to', 'Date Time', 'trim|required|xss_clean');
        $this->form_validation->set_rules('emp_id', 'Employee', 'trim|required|xss_clean');

        $report = $this->leave_model->GetEmLEaveReport($emid, $date_from, $date_to);
        $tbody = "<tbody>";

        if (is_array($report) || is_object($report)) {
            foreach ($report as $value) {
                if ($value->leave_duration > 8) {
                    $originalDays = $value->leave_duration;
                    $days = $originalDays / 8;
                    $hour = 0;
                    // 120 / 8 = 15 // 15 day
                    // 13 - (1*8) = 5 hour

                    if (is_float($days)) {

                        $days = floor($days); // 1
                        $hour = $value->leave_duration - ($days * 8); // 5
                    }
                } else {
                    $days = 0;
                    $hour = $value->leave_duration;
                }

                $daysDenom = ($days == 1) ? " day " : " days ";
                $hourDenom = ($hour == 1) ? " hour " : " hours ";

                if ($days > 0) {
                    $days_td = $days . $daysDenom;
                } else {
                    $days_td = $hour . $hourDenom;
                }

                $tbody .= "<tr>
                        <td>$value->em_code</td>
                        <td>$value->first_name $value->last_name</td>
                        <td>$value->name</td>
                        <td>$days_td</td>
                        <td>$value->start_date</td>
                        <td>$value->end_date</td>
                    </tr>";
            }
        }

        $thead = '<table id="data-table" data-page-length="5"
                                   class="display table dataTable table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>PIN</th>
                                    <th>Employee</th>
                                    <th>Type</th>
                                    <th>Duration</th>
                                    <th>Start</th>
                                    <th>End</th>
                                </tr>
                                </thead>';
        $tfooter = '</table>';

        $table = $thead . $tbody . '</tbody>' . $tfooter;
        echo $table;
    }

    public function Get_LeaveData()
    {
        $emid = $this->input->get('emp_id');
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('date_from', 'Date Time', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_to', 'Date Time', 'trim|required|xss_clean');
        $this->form_validation->set_rules('emp_id', 'Employee', 'trim|required|xss_clean');

        $report = $this->leave_model->getEmployeeLeaveData($emid, $date_from, $date_to);
        $tbody = "<tbody>";

        if (is_array($report) || is_object($report)) {
            foreach ($report as $value) {
                if ($value->leave_duration > 8) {
                    $originalDays = $value->leave_duration;
                    $days = $originalDays / 8;
                    $hour = 0;
                    // 120 / 8 = 15 // 15 day
                    // 13 - (1*8) = 5 hour

                    if (is_float($days)) {

                        $days = floor($days); // 1
                        $hour = $value->leave_duration - ($days * 8); // 5
                    }
                } else {
                    $days = 0;
                    $hour = $value->leave_duration;
                }

                $daysDenom = ($days == 1) ? " day " : " days ";
                $hourDenom = ($hour == 1) ? " hour " : " hours ";

                if ($days > 0) {
                    $days_td = $days . $daysDenom;
                } else {
                    $days_td = $hour . $hourDenom;
                }

                $td_button = "";
                $arr = array(
                    'id' => $value->id,
                    'em_id' => $value->em_id,
                    'status' => 'Approve',
                    'leave_duration' => $value->leave_duration,
                    'leave_type' => $value->typeid
                );
                if ($this->session->userdata('user_type') != 'EMPLOYEE') {
                    if ($value->leave_status == 'Not Approve') {
                        $td_button .= '<a href="javascript:void(0)" type="button" class="btn btn-primary btn-sm rounded-btn text-light Status d-inline-block mr-1" data-id="'.$value->id.'"
                                                           data-employeeId="'.$value->em_id.'" data-value="Approve" data-duration="'.$value->leave_duration.'"
                                                           data-type="'.$value->typeid.'" onclick="approveOrRejectEmployee('.'\''.$value->em_id.'\','.'\''.$value->id.'\','.'\''.'Approve'.'\','.'\''.$value->leave_duration.'\','.'\''.$value->typeid.'\''.')"> Approve 
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-danger btn-sm rounded-btn text-light Status d-inline-block mr-1"
                                                           data-id="'.$value->id.'" data-value="Rejected" onclick="approveOrRejectEmployee('.'\''.$value->em_id.'\','.'\''.$value->id.'\','.'\''.'Rejected'.'\','.'\''.$value->leave_duration.'\','.'\''.$value->typeid.'\''.')"> Reject
                                                        </a>';
                    }

                    $td_button .= '<a href="javascript:void(0)" class="btn btn-primary rounded-btn text-light btn-sm d-inline-block mr-1"
                                                       data-id="'.$value->id.'" onclick="getLeaveByID('.$value->id.')"><i class="fa fa-edit"></i></a>';
                }

                $apply_date = date('jS \of F Y', strtotime($value->apply_date));
                $tbody .= "<tr>
                        <td>$value->first_name $value->last_name</td>
                        <td>$value->em_code</td>
                        <td>$value->leave_type</td>
                        <td>$apply_date</td>
                        <td>$value->start_date</td>
                        <td>$value->end_date</td>
                        <td>$days_td</td>
                        <td>$value->leave_status</td>
                        <td>$td_button</td>
                    </tr>";
            }
        }

        $thead = '<table id="data_table_example" class="display table dataTable table-striped table-bordered">
                                <thead>
                                <tr>
                                     <th>Employee Name</th>
                                     <th>PIN</th>
                                     <th>Leave Type</th>
                                     <th>Apply Date</th>
                                     <th>Start Date</th>
                                     <th>End Date</th>
                                     <th>Duration</th>
                                     <th>Leave Status</th>
                                     <th>Action</th>
                                </tr>
                                </thead>';
        $tfooter = '</table>';

        $table = $thead . $tbody . '</tbody>' . $tfooter;
        echo $table;
    }

    /*Approve and update leave status*/
    public function approveLeaveStatus()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $employeeId = $this->input->post('employeeId');
            $id = $this->input->post('lid');
            $value = $this->input->post('lvalue');
            $duration = $this->input->post('duration');
            $type = $this->input->post('type');

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();

            $data = array(
                'leave_status' => $value
            );
            $this->leave_model->updateAplicationAsResolved($id, $data);

            if ($value == 'Approve') {
                $determineIfNew = $this->leave_model->determineIfNewLeaveAssign($employeeId, $type);
                //How much taken
                $totalHour = $this->leave_model->getLeaveTypeTotal($employeeId, $type);
                //If already taken some
                if ($determineIfNew > 0) {
                    $total = $totalHour[0]->totalTaken + $duration;
                    $data = array(
                        'hour' => $total
                    );
                    $success = $this->leave_model->updateLeaveAssignedInfo($employeeId, $type, $data);
                    $earnval = $this->leave_model->emEarnselectByLeave($employeeId);

                    $data = array(
                        'present_date' => $earnval->present_date - ($duration / 8),
                        'hour' => $earnval->hour - $duration
                    );
                    $this->leave_model->UpdteEarnValue($employeeId, $data);

                    $this->session->set_flashdata('feedback', 'Successfully Updated');
                    return;
                } else {
                    $data = array(
                        'emp_id' => $employeeId,
                        'type_id' => $type,
                        'hour' => $duration,
                        'dateyear' => date('Y')
                    );
                    $this->leave_model->insertLeaveAssignedInfo($data);

                    $this->session->set_flashdata('feedback', 'Successfully Updated');
                    return;
                }
            } else {
                $this->session->set_flashdata('feedback', 'Successfully Updated');
                return;
            }
        }
    }

    public function LeaveAssign()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $employeeID = $this->input->get('employeeID');
            $leaveID = $this->input->get('leaveID');

            if (!empty($leaveID)) {
                $year = date('Y');
                $daysTaken = $this->leave_model->GetemassignLeaveType($employeeID, $leaveID, $year);

                $leavetypes = $this->leave_model->GetleavetypeInfoid($leaveID);

                if (empty($daysTaken->hour)) {
                    $daysTakenval = 0;
                } else {
                    $daysTakenval = $daysTaken->hour / 8;
                }

                if ($leaveID == '5') {
                    $earnTaken = $this->leave_model->emEarnselectByLeave($employeeID);
                    $totalday = 'Earned Balance: ' . ($earnTaken->hour / 8) . ' Days';
                    echo $totalday;
                } else {
                    if ($leavetypes->leave_day) {
                        $totalday = 'Leave Balance: ' . ($leavetypes->leave_day - $daysTakenval) .
                            ' Days Of ' . $leavetypes->leave_day;
                    } else {
                        $totalday = 'Leave Balance: 0 Days of 0';
                    }

                    echo $totalday;
                }

                /* $daysTaken = $this->leave_model->GetemassignLeaveType('Sah1804', 2, 2018);
                 $leavetypes = $this->leave_model->GetleavetypeInfoid($leaveID);
                 // $totalday   = $leavetypes->leave_day . '/' . $daysTaken['0']->day;
                 echo $daysTaken['0']->day;
                 echo $leavetypes->leave_day;*/
            } else {
                echo "Something wrong.";
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Earnedleave()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['employee'] = $this->employee_model->emselect();
            $data['earnleave'] = $this->leave_model->GetEarnedleaveBalance();
            $this->load->view('backend/earnleave', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Update_Earn_Leave()
    {
        $employee = $this->input->post('emid');
        $start = $this->input->post('startdate');
        $end = $this->input->post('enddate');
        if (empty($end)) {
            $days = '1';
            //die($nofdate);
        } else {
            $date1 = new DateTime($start);
            $date2 = new DateTime($end);
            $diff = date_diff($date1, $date2);
            $days = $diff->format("%a");
            //die($nofdate);
        }
        $hour = $days * 8;
        $emcode = $this->employee_model->emselectByCode($employee);
        $emid = $emcode->em_id;
        $earnval = $this->leave_model->emEarnselectByLeave($emid);
        if (!empty($earnval)) {
            $data = array(
                'present_date' => $earnval->present_date + $days,
                'hour' => $earnval->hour + $hour,
                'status' => '1'
            );
            $success = $this->leave_model->UpdteEarnValue($emid, $data);
        } else {
            $data = array(
                'em_id' => $emid,
                'present_date' => $days,
                'hour' => $hour,
                'status' => '1'
            );
            $success = $this->leave_model->Add_Earn_Leave($data);
        }

        if ($this->db->affected_rows()) {
            $startdate = strtotime($start);
            $enddate = strtotime($end);
            for ($i = $startdate; $i <= $enddate; $i = strtotime('+1 day', $i)) {
                $date = date('Y-m-d', $i);
                $data = array(
                    'emp_id' => $employee,
                    'atten_date' => $date,
                    'working_hour' => '480',
                    'signin_time' => '09:00:00',
                    'signout_time' => '17:00:00',
                    'status' => 'E'
                );
                $this->project_model->insertAttendanceByFieldVisitReturn($data);

            }

            $this->session->set_flashdata('feedback', 'Successfully Added');
            redirect("leave/Earnedleave");
        }
    }

    public function Update_Earn_Leave_Only()
    {
        $emid = $this->input->post('employee');
        $days = $this->input->post('day');
        $hour = $this->input->post('hour');
        $data = array(
            'present_date' => $days,
            'hour' => $hour
        );
        $success = $this->leave_model->UpdteEarnValue($emid, $data);

        $this->session->set_flashdata('feedback', 'Successfully Updated');
        redirect("leave/Earnedleave");
    }
}
