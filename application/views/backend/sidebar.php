        <?php
            $id = $this->session->userdata('user_login_id');
            $basicinfo = $this->employee_model->GetBasic($id);
            $settingsvalue = $this->settings_model->GetSettingsValue();
            $basicinfo = $this->employee_model->GetBasic($id);
        ?>
        <!-- START: Main Menu-->
        <div class="sidebar">
            <a href="#" class="sidebarCollapse float-right h6 dropdown-menu-right mr-2 mt-2 position-absolute d-block d-lg-none">
                <i class="icon-close"></i>
            </a>
            <!-- START: Logo-->
            <a href="<?php echo base_url(); ?>dashboard/Dashboard" class="sidebar-logo d-flex">
                <img src="<?php echo base_url(); ?>assets/images/<?php echo $settingsvalue->sitelogo; ?>" alt="logo" width="25" class="img-fluid mr-2"/>
                <span class="h5 align-self-center mb-0">HRM</span>
            </a>
            <!-- END: Logo-->
            <?php
            $url = current_url(true);
            ?>

            <!-- START: Menu-->
            <ul id="side-menu" class="sidebar-menu">
                <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                    <li class="dropdown"><a href="#" class="text-danger"><i class="icon-cursor-move"></i>Leave</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'leave/Holidays') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>leave/Holidays"><i class="icon-calendar"></i> Holiday</a></li>
                                <li class="<?php echo $url == (base_url() . 'leave/EmApplication') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>leave/EmApplication"><i class="icon-speech"></i> Leave Application</a></li>
                                <li class="<?php echo $url == (base_url() . 'leave/EmLeavesheet') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>leave/EmLeavesheet"><i class="icon-support"></i> Leave Sheet</a></li>
                                <li class="<?php echo $url == (base_url() . 'DelayNotice/index') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>DelayNotice/index"><i class="icon-support"></i> Delay Notice</a></li>
                                <li class="<?php echo $url == (base_url() . 'PlannedLeave/index') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>PlannedLeave/index"><i class="fab fa-delicious"></i> Planned Leave</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="dropdown"><a href="#"><i class="icon-support"></i>Projects</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'Projects/All_Projects') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Projects/All_Projects"><i class="icon-calendar"></i> Projects</a></li>
                                <li class="<?php echo $url == (base_url() . 'Projects/All_Tasks') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Projects/All_Tasks"><i class="icon-speech"></i> Task List</a></li>
                            </ul>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class="dropdown"><a href="#"><i class="fas fa-landmark"></i>Organization</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'organization/department') ? 'active' : '' ?>"><a href="<?php echo base_url();?>organization/department"><i class="fas fa-user-friends"></i> Department</a></li>
                                <li class="<?php echo $url == (base_url() . 'organization/designation') ? 'active' : '' ?>"><a href="<?php echo base_url();?>organization/designation"><i class="fas fa-book-reader"></i> Designation</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="dropdown"><a href="#"><i class="fas fa-users"></i>Employees</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'employee/Employees') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>employee/Employees"><i class="fas fa-user-tie"></i> Employees</a></li>
                                <li class="<?php echo $url == (base_url() . 'employee/Disciplinary') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>employee/Disciplinary"><i class="fas fa-clipboard-list"></i> Disciplinary</a></li>
                                <li class="<?php echo $url == (base_url() . 'employee/Inactive_Employee') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>employee/Inactive_Employee"><i class="fas fa-user-times"></i> Inactive User</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="dropdown"><a href="#"><i class="fas fa-user-clock"></i>Attendance</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'attendance/Attendance') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>attendance/Attendance"><i class="fas fa-calendar-check"></i> Attendance List</a></li>
                                <li class="<?php echo $url == (base_url() . 'attendance/Save_Attendance') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>attendance/Save_Attendance"><i class="fas fa-clipboard-check"></i> Add Attendance</a></li>
                                <li class="<?php echo $url == (base_url() . 'attendance/Attendance_Report') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>attendance/Attendance_Report"><i class="fas fa-clipboard"></i> Attendance Report</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="dropdown"><a href="#"><i class="fas fa-user-tag"></i>Leave</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'leave/Holidays') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>leave/Holidays"><i class="fas fa-calendar-day"></i> Holiday</a></li>
                                <li class="<?php echo $url == (base_url() . 'leave/leavetypes') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>leave/leavetypes"><i class="fas fa-calendar-week"></i> Leave Types</a></li>
                                <li class="<?php echo $url == (base_url() . 'leave/Application') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>leave/Application"><i class="fas fa-calendar-plus"></i> Leave Application</a></li>
                                <li class="<?php echo $url == (base_url() . 'leave/Earnedleave') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>leave/Earnedleave"><i class="fas fa-calculator"></i> Earned Leave</a></li>
                                <li class="<?php echo $url == (base_url() . 'leave/Leave_report') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>leave/Leave_report"><i class="fas fa-clipboard"></i> Report</a></li>
                                <li class="<?php echo $url == (base_url() . 'DelayNotice/index') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>DelayNotice/index"><i class="icon-support"></i> Delay Notice</a></li>
                                <li class="<?php echo $url == (base_url() . 'PlannedLeave/index') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>PlannedLeave/index"><i class="fab fa-delicious"></i> Planned Leave</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="dropdown"><a href="#"><i class="fas fa-ethernet"></i>Project</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'Projects/All_Projects') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Projects/All_Projects"><i class="fas fa-ethernet"></i> Projects</a></li>
                                <li class="<?php echo $url == (base_url() . 'Projects/All_Tasks') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Projects/All_Tasks"><i class="fas fa-clipboard-list"></i> Task List</a></li>
                                <li class="<?php echo $url == (base_url() . 'Projects/Field_visit') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Projects/Field_visit"><i class="fas fa-flag-checkered"></i> Field Visit</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="dropdown"><a href="#"><i class="fas fa-money-bill"></i>Loan</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'Loan/View') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Loan/View"><i class="fab fa-uikit"></i> Grant loan</a></li>
                                <li class="<?php echo $url == (base_url() . 'Loan/installment') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Loan/installment"><i class="far fa-newspaper"></i> Loan Installment</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="dropdown"><a href="#"><i class="fas fa-gifts"></i>Assets</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'Logistice/Assets_Category') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Logistice/Assets_Category"><i class="fas fa-object-ungroup"></i> Assets Category</a></li>
                                <li class="<?php echo $url == (base_url() . 'Logistice/All_Assets') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Logistice/All_Assets"><i class="fas fa-list-ol"></i> Asset List</a></li>
                                <li class="<?php echo $url == (base_url() . 'Logistice/logistic_support') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Logistice/logistic_support"><i class="fas fa-hammer   "></i> Logistic Support</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="dropdown"><a href="#"><i class="fas fa-money-check"></i>Payroll</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'Payroll/Salary_List') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Payroll/Salary_List"><i class="fas fa-list-alt"></i> Payroll List</a></li>
                                <li class="<?php echo $url == (base_url() . 'Payroll/Generate_salary') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Payroll/Generate_salary"><i class="fas fa-file-export"></i> Generate Payslip</a></li>
                                <li class="<?php echo $url == (base_url() . 'Payroll/Payslip_Report') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Payroll/Payslip_Report"><i class="fas fa-file-medical-alt"></i> Payslip Report</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="dropdown"><a href="#"><i class="fas fa-certificate"></i>Training</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'budget/index') ? 'active' : '' ?>"><a href="<?php echo base_url();?>budget/index"><i class="fas fa-money-bill-alt"></i> Budget </a></li>
                                <li class="<?php echo $url == (base_url() . 'course/index') ? 'active' : '' ?>"><a href="<?php echo base_url();?>course/index"><i class="fas fa-dice-d20"></i> Budget </a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="dropdown"><a href="#"><i class="fas fa-sign-language"></i>Appraisal</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'Appraisal/appraisalCategory') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Appraisal/appraisalCategory"><i class="fas fa-sliders-h"></i>Appraisal Category</a></li>
                                <li class="<?php echo $url == (base_url() . 'Appraisal/appraisalEmployee') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>Appraisal/appraisalEmployee"><i class="fas fa-first-aid"></i>Appraisal Employee</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="<?php echo $url == (base_url() . 'notice/All_notice') ? 'active' : '' ?>"><a href="<?php echo base_url()?>notice/All_notice"><i class="fas fa-pager"></i>Notice</a></li>

                    <li class="dropdown"><a href="#"><i class="fas fa-cogs"></i>Setting</a>
                        <div>
                            <ul>
                                <li class="<?php echo $url == (base_url() . 'settings/Settings') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>settings/Settings"><i class="fas fa-dice-d20"></i>Website Content</a></li>
                                <li class="<?php echo $url == (base_url() . 'UserManagement/AssignMenu') ? 'active' : '' ?>"><a href="<?php echo base_url(); ?>UserManagement/AssignMenu"><i class="fas fa-first-aid"></i>Role Management</a></li>
                            </ul>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <!-- END: Menu-->
        </div>
        <!-- END: Main Menu-->