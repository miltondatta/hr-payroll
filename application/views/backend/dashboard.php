<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

<!-- START: Main Content-->
<main>
    <div class="container-fluid">
        <!-- START: Breadcrumbs-->
        <div class="row">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto">
                        <h4 class="mb-0">Dashboard</h4> <b>Explore Dashboard Item</b>
                    </div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->

        <div class="row mt-3">
            <div class="col-md-12">
                <?php
                if ($this->session->flashdata('feedback')) { ?>
                <div class="alert alert-success alert-dismissible show" role="alert">
                    <strong><?php echo $this->session->flashdata('feedback'); ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible show" role="alert">
                    <strong><?php echo $this->session->flashdata('error'); ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- View Planned Leave -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="javascript:void(0);" style="color: blue !important;" data-toggle="modal" data-target="#planned-leave-modal">View Your Planned Leave Calendar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="planned-leave-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel10">Planned Leave Calendar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" method="post" action="addPlannedLeave" id="btnSubmit">
                        <div class="modal-body">
                            <div id='calendar' class="h-100"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger rounded-btn" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- START: Card Data-->
        <div class="row mt-3">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <img src="<?= base_url(); ?>assets/dist/images/employee.png" alt="traffic"
                            class="float-right" />
                        <h6 class="card-title font-weight-bold">Employees</h6>
                        <h2><?php 
                                        $this->db->where('status','ACTIVE');
                                        $this->db->from("employee");
                                        echo $this->db->count_all_results();
                                    ?></h2>
                        <h6 class="card-subtitle mb-2 text-muted"><a href="<?php echo base_url(); ?>employee/Employees"
                                class="text-muted m-b-0">View Employee</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <img src="<?= base_url(); ?>assets/dist/images/employee_leave.png" alt="cart"
                            class="float-right" />
                        <h6 class="card-title font-weight-bold">Leaves</h6>
                        <h2> <?php 
                                                    $this->db->where('leave_status','Approve');
                                                    $this->db->from("emp_leave");
                                                    echo $this->db->count_all_results();
                                                ?></h2>
                        <h6 class="card-subtitle mb-2 text-muted"><a href="<?php echo base_url(); ?>leave/Application"
                                class="text-muted m-b-0">View Leave</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <img src="<?= base_url(); ?>assets/dist/images/projects.png" alt="money" class="float-right" />
                        <h6 class="card-title font-weight-bold">Projects</h6>
                        <h2><?php 
                                                $this->db->where('pro_status','running');
                                                $this->db->from("project");
                                                echo $this->db->count_all_results();
                                            ?></h2>
                        <h6 class="card-subtitle mb-2 text-muted"><a
                                href="<?php echo base_url(); ?>Projects/All_Projects" class="text-muted m-b-0">View
                                Project</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <img src="<?= base_url(); ?>assets/dist/images/loan.png" alt="wallet" class="float-right" />
                        <h6 class="card-title font-weight-bold">Loan</h6>
                        <h2> <?php 
                                                $this->db->where('status','Granted');
                                                $this->db->from("loan");
                                                echo $this->db->count_all_results();
                                            ?>
                        </h2>
                        <h6 class="card-subtitle mb-2 text-muted"><a href="<?php echo base_url(); ?>Loan/View"
                                class="text-muted m-b-0">View Loan</a></h6>
                    </div>
                </div>
            </div>


            <?php 
                        $notice = $this->notice_model->GetNoticelimit(); 
                        $noticeslide = $this->notice_model->GetNoticelimit(5); 
                        $running = $this->dashboard_model->GetRunningProject(); 
                        $userid = $this->session->userdata('user_login_id');
                        $todolist = $this->dashboard_model->GettodoInfo($userid);                 
                        $holiday = $this->dashboard_model->GetHolidayInfo();                 
                    ?>


            <div class="col-12  col-lg-6 col-xl-6 mt-3">
                <div class="card" style="height:350px;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Attendance Statistics</h4>
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-week-tab" data-toggle="pill" href="#pills-week"
                                    role="tab" aria-controls="pills-week" aria-selected="true">7 days</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-month-tab" data-toggle="pill" href="#pills-month"
                                    role="tab" aria-controls="pills-month" aria-selected="false">30 days</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-content">
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-week" role="tabpanel"
                                            aria-labelledby="pills-week-tab">
                                            <div id="week_statistics"></div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-month" role="tabpanel"
                                            aria-labelledby="pills-month-tab">
                                            <div id="month_statistics"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12  col-lg-6 col-xl-6 mt-3">
                <div class="twitter-gradient p-5 text-center" style="height:350px;">
                    <div id="demo" class="carousel slide" data-ride="carousel">
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                        <?php $active = false; foreach($notice AS $value): ?>
                            <div class="carousel-item py-3 <?php if(!$active) { echo 'active'; $active = true; } ?>">                    
                                <?php echo $value->title ?>
                                <br/><small><?php echo $value->date ?></small><br /><br/>
                            </div>
                        <?php endforeach; ?>    
                        </div>
                        <!-- Indicators -->
                        <ul class="carousel-indicators position-relative mb-0">
                        <?php $noticei = 0; $active = false;
                         foreach($notice AS $value): ?>
                                <li data-target="#demo" data-slide-to="<?php echo $noticei; ?>"  class="<?php if(!$active) { echo 'active'; $active = true; } ?>"></li>
                        <?php
                        $noticei++;
                     endforeach; ?>   
                        </ul>
                    </div>
                </div>
            </div>
          
        

            <div class="col-12  col-lg-6 mt-3">
                <div class="card overflow-auto" style="height:500px;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Tasks List</h4>
                        <ul class="nav nav-tabs" id="tabs-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" id="tabs-day-tab" data-toggle="tab"
                                    href="#tabs-day" role="tab" aria-controls="tabs-day" aria-selected="true">Daily</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-content">
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <br>
                                    <div class="new-todo">
                                        <form method="post" action="add_todo">
                                            <div class="input-group">
                                                <input type="text" name="todo_data" class="form-control"
                                                    style="border: 1px solid #fff !IMPORTANT;"
                                                    placeholder="Add new task" required>
                                                <span class="input-group-btn">
                                                    <input type="hidden" name="userid"
                                                        value="<?php echo $this->session->userdata('user_login_id'); ?>">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fa fa-plus"></i></button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tabs-day" role="tabpanel"
                                            aria-labelledby="tabs-day-tab">
                                            <ul class="tasks mt-3">
                                                <?php foreach($todolist as $value): ?>
                                                <li class="task d-flex py-3 px-2 border-left border-primary">
                                                    <label class="chkbox"><b><?php echo $value->to_dodata; ?></b>
                                                        <br /><span
                                                            class="text-muted"><?php echo $value->date; ?></span>
                                                        <?php if($value->value == '1'){ ?>
                                                        <input class="to-do" data-id="<?php echo $value->id?>"
                                                            data-value="0" type="checkbox" id="<?php echo $value->id?>">
                                                        <?php } else { ?>
                                                        <input class="to-do" data-id="<?php echo $value->id?>"
                                                            data-value="1" type="checkbox" id="<?php echo $value->id?>"
                                                            checked>
                                                        <?php } ?>
                                                        <span class="checkmark mt-2"></span>
                                                    </label>

                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12  col-lg-6 mt-3">
                <div class="card overflow-auto" style="height:500px;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Notice Board</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="activities mt-4 mb-2">
                                        <?php foreach($notice AS $value): ?>
                                        <li class="activity py-2 px-2 border-left">
                                            <label class="bg-primary"></label>
                                            <span><?php echo $value->date ?></span><br />
                                            <p class="mt-3"> <b><?php echo $value->title ?></b><br /><a
                                                    href="<?php echo base_url(); ?>assets/images/notice/<?php echo $value->file_url ?>"
                                                    target="_blank"><?php echo $value->file_url ?></a></p>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 col-xl-6 mt-3">
                <div class="card overflow-auto" style="height:500px;">
                    <div class="card-content">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Holidays</h4>
                        </div>
                        <div class="card-body">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-top-0" scope="col">Holiday Name</th>
                                        <th class="border-top-0" scope="col">Start At</th>
                                        <th class="border-top-0" scope="col">End At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($holiday as $value): ?>
                                    <tr>
                                        <td class="border-top-0"><span
                                                class="social-dot google"></span><b><?php echo $value->holiday_name ?></b>
                                        </td>
                                        <td class="border-top-0"><?php echo $value->from_date; ?></td>
                                        <td class="border-top-0"><?php echo $value->to_date; ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 col-xl-6 mt-3">
                <div class="card overflow-auto" style="height:500px;">
                    <div class="card-content">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Project Progress</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0" scope="col">Project/Work</th>
                                            <th class="border-top-0" scope="col">Start Date</th>
                                            <th class="border-top-0" scope="col">End Date</th>
                                            <th class="border-top-0" scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($running AS $value): ?>
                                        <tr>
                                            <th scope="row"><?php echo substr("$value->pro_name",0,70); ?></th>
                                            <td><?php echo $value->pro_start_date; ?></td>
                                            <td><?php echo $value->pro_end_date; ?></td>
                                            <td><?php echo $value->pro_status; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Card DATA-->
    </div>
</main>
<!-- END: Content-->

<script>
$(".to-do").on("click", function() {
    $.ajax({
        url: "Update_Todo",
        type: "POST",
        data: {
            'toid': $(this).attr('data-id'),
            'tovalue': $(this).attr('data-value'),
        },
        success: function(response) {
            location.reload();
        },
        error: function(response) {
            console.error();
        }
    });
});
</script>

<?php $this->load->view('backend/footer'); ?>