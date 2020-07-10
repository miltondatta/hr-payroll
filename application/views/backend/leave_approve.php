<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Application</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Leave Application</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  mt-3">
                    <?php if ($this->session->flashdata('feedback')) { ?>
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

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">
                                <i class="fa fa-compass" aria-hidden="true"></i>
                                Application List
                            </h4>

                            <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                    data-target="#appmodel" onclick="emptyInputValue()">
                                <i class="fa fa-plus"></i>
                                <span class="d-inline-block pl-1">Add Application</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <input type="text" name="date_from" id="calendar-month" data-format="yyyy-mm-dd"
                                               class="form-control mydatetimepickerFull" placeholder="From" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" name="date_to" id="calendar-month-two" data-format="yyyy-mm-dd"
                                               class="form-control mydatetimepickerFull"
                                               placeholder="To" autocomplete="off">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control" id="emid" name="emid" required>
                                                <option value="">Select Employee</option>
                                                <option value="all">All Employee</option>
                                                <?php foreach ($employee as $value): ?>
                                                    <option value="<?php echo $value->em_id ?>">
                                                        <?php echo $value->first_name . ' ' . $value->last_name; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary rounded-btn" value="Submit"
                                                   name="submit" id="BtnSubmit">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive" id="leave-table">
                                <table id="data_table_example"
                                       class="display table dataTable table-striped table-bordered">
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
                                    </thead>
                                    <tbody>
                                    <?php foreach ($application as $value): ?>
                                        <tr style="vertical-align:top">
                                            <td><span><?php echo $value->first_name . ' ' . $value->last_name ?></span>
                                            </td>
                                            <td><?php echo $value->em_code; ?></td>
                                            <td><?php echo $value->name; ?></td>
                                            <td><?php echo date('jS \of F Y', strtotime($value->apply_date)); ?></td>
                                            <td><?php echo $value->start_date; ?></td>
                                            <td><?php echo $value->end_date; ?></td>
                                            <td>

                                                <!-- Duration filtering -->
                                                <?php
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
                                                    echo $days . $daysDenom;
                                                } else {
                                                    echo $hour . $hourDenom;
                                                }
                                                ?>

                                            </td>
                                            <td><?php echo $value->leave_status; ?></td>
                                            <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>

                                            <?php } else { ?>
                                                <td class="d-flex">

                                                    <?php if ($value->leave_status == 'Approve') { ?>

                                                    <?php } else if ($value->leave_status == 'Not Approve') { ?>
                                                        <a href="javascript:void();"
                                                           class="btn btn-primary btn-sm rounded-btn text-light Status d-inline-block mr-1"
                                                           data-id="<?php echo $value->id ?>"
                                                           data-employeeId="<?php echo $value->em_id; ?>"
                                                           data-value="Approve"
                                                           data-duration="<?php echo $value->leave_duration; ?>"
                                                           data-type="<?php echo $value->typeid; ?>">
                                                            Approve
                                                        </a>
                                                        <a href="javascript:void();"
                                                           class="btn btn-danger btn-sm rounded-btn text-light Status d-inline-block mr-1"
                                                           data-id="<?php echo $value->id ?>"
                                                           data-value="Rejected">
                                                            Reject
                                                        </a>
                                                    <?php } else if ($value->leave_status == 'Rejected') { ?>
                                                    <?php } ?>
                                                    <a href="javascript:void();"
                                                       class="btn btn-primary rounded-btn text-light btn-sm d-inline-block mr-1"
                                                       onclick="getLeaveByID(<?php echo $value->id; ?>)">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- sample modal content -->
                            <div class="modal" id="appmodel" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content ">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel1">Leave Application</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <form method="post" action="Add_Applications" id="leaveapply"
                                              enctype="multipart/form-data">
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label>Employee</label>
                                                    <select class=" form-control selectedEmployeeID"
                                                            tabindex="1" name="emid" required>
                                                        <option value="">Select Employee</option>
                                                        <?php foreach ($employee as $value): ?>
                                                            <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name .
                                                                    ' ' .
                                                                    $value->last_name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-0 pb-0">
                                                    <label>Leave Type</label>
                                                    <select class="form-control assignleave"
                                                            tabindex="1" name="typeid"
                                                            id="leavetype" required>
                                                        <option value="">Select Here..</option>
                                                        <?php foreach ($leavetypes as $value): ?>

                                                            <option value="<?php echo $value->type_id ?>"><?php echo $value->name ?></option>

                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <span style="color:green" class="d-inline-block py-2" id="total"></span>
                                                    <div class="span pull-right">
                                                        <button class="btn btn-primary rounded-btn fetchLeaveTotal">Fetch Total Leave</button>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Leave Duration</label><br>
                                                    <input name="type" type="radio" id="radio_1" data-value="Half"
                                                           class="duration"
                                                           value="Half Day" checked="">
                                                    <label for="radio_1">Hourly</label>
                                                    <input name="type" type="radio" id="radio_2" data-value="Full"
                                                           class="type"
                                                           value="Full Day">
                                                    <label for="radio_2">Full Day</label>
                                                    <input name="type" type="radio" class="with-gap duration"
                                                           id="radio_3" data-value="More"
                                                           value="More than One day">
                                                    <label for="radio_3">Above a Day</label>
                                                </div>

                                                <label id="hourlyFix">Date</label>
                                                <div class="input-group mb-3">
                                                    <input name="startdate"
                                                           class="form-control"
                                                           id="calendar-month-three"
                                                           data-format="yyyy-mm-dd"
                                                           style="z-index:999999 !important;"
                                                           value="" autocomplete="off" required>
                                                    <div class="input-group-append">
                                                            <span class="input-group-text bg-transparent border-left-0"
                                                                  id="basic-email"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                                <div id="enddate" style="display:none">
                                                    <label>End Date</label>
                                                    <div class="input-group mb-3">
                                                        <input name="enddate"
                                                               class="form-control"
                                                               style="z-index:999999 !important;"
                                                               id="calendar-month_enddate"
                                                               value="" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text bg-transparent border-left-0"
                                                                  id="basic-email"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group" id="hourAmount">
                                                    <label>Length</label>
                                                    <select id="hourAmountVal" class=" form-control"
                                                            tabindex="1"
                                                            name="hourAmount">
                                                        <option value="">Select Hour</option>
                                                        <option value="1">One hour</option>
                                                        <option value="2">Two hour</option>
                                                        <option value="3">Three hour</option>
                                                        <option value="4">Four hour</option>
                                                        <option value="5">Five hour</option>
                                                        <option value="6">Six hour</option>
                                                        <option value="7">Seven hour</option>
                                                        <option value="8">Eight hour</option>
                                                    </select>
                                                </div>

                                                <!--  <div class="form-group" >
                                                     <label class="control-label">Duration</label>
                                                     <input type="number" name="duration" class="form-control" id="leaveDuration">
                                                 </div> -->
                                                <div class="form-group">
                                                    <label class="control-label">Reason</label>
                                                    <textarea class="form-control" name="reason"
                                                              id="message-text1"></textarea>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name="" id="leave_email">
                                                        <label for="leave_email">Send Email</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name="" id="leave_sms">
                                                        <label for="leave_sms">Send Sms</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" class="form-control"
                                                       id="recipient-name1" required>
                                                <button type="button" class="btn btn-danger rounded-btn" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary rounded-btn">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            $('.fetchLeaveTotal').on('click', function (e) {
                e.preventDefault();

                var selectedEmployeeID = $('.selectedEmployeeID').val();
                var leaveTypeID = $('.assignleave').val();

                if (!selectedEmployeeID) {alert('Please select Employee name!'); return false;}
                if (!leaveTypeID) {alert('Please select Leave type!'); return false;}

                $.ajax({
                    url: 'LeaveAssign?leaveID=' + leaveTypeID + '&employeeID=' + selectedEmployeeID,
                    method: 'GET',
                    data: '',
                }).done(function (response) {
                    //console.log(response);
                    $("#total").html(response);
                });
            });

            $('#leaveapply input').on('change', function (e) {
                e.preventDefault(e);

                var duration = $('input[name=type]:checked', '#leaveapply').attr('data-value');

                $("select[name='hourAmount']").removeAttr('required');
                $("input[name='enddate']").removeAttr('required');

                if (duration == 'Half') {
                    $('#enddate').hide();
                    $('#hourlyFix').text('Date');
                    $('#hourAmount').show();
                    $("select[name='hourAmount']").attr('required', true);
                } else if (duration == 'Full') {
                    $('#enddate').hide();
                    $('#hourAmount').hide();
                    $('#hourlyFix').text('Date');
                } else if (duration == 'More') {
                    $('#enddate').show();
                    $('#hourAmount').hide();
                    $("input[name='enddate']").attr('required', true);
                }
            });
        });
    </script>
    <script>
        /*DATETIME PICKER*/
        $("#bbbSubmit").on("click", function (event) {
            event.preventDefault();
            var typeid = $('.typeid').val();
            var datetime = $('.mydatetimepicker').val();
            var emid = $('.emid').val();
            //console.log(datetime);
            $.ajax({
                url: "GetemployeeGmLeave?year=" + datetime + "&typeid=" + typeid + "&emid=" + emid,
                type: "GET",
                dataType: '',
                data: 'data',
                success: function (response) {
                    // console.log(response);
                    $('.leaveval').html(response);
                },
                error: function (response) {
                    // console.log(response);
                }
            });
        });
    </script>
    <script type="text/javascript">
        /*PARSE DURATION DATA*/
        $('.duration').on('input', function () {
            var day = parseInt($('.duration').val());
            var hour = 8;
            $('.totalhour').val((day * hour ? day * hour : 0).toFixed(2));
        });
    </script>
    <script>
        $(".Status").on("click", function (event) {
            event.preventDefault();

            $.ajax({
                url: "approveLeaveStatus",
                type: "POST",
                data:
                    {
                        'employeeId': $(this).attr('data-employeeId'),
                        'lid': $(this).attr('data-id'),
                        'lvalue': $(this).attr('data-value'),
                        'duration': $(this).attr('data-duration'),
                        'type': $(this).attr('data-type')
                    },
                success: function () {
                    window.location.reload();
                },
                error: function (response) {
                    console.error(response);
                }
            });
        });

        function approveOrRejectEmployee(em_id, id, status, leave_duration, leave_type) {
            $.ajax({
                url: "approveLeaveStatus",
                type: "POST",
                data:
                    {
                        'employeeId': em_id,
                        'lid': id,
                        'lvalue': status,
                        'duration': leave_duration,
                        'type': leave_type
                    },
                success: function () {
                    window.location.reload();
                },
                error: function (response) {
                    console.error(response);
                }
            });
        }
    </script>
    <script>
        function emptyInputValue() {
            $('#leaveapply').trigger("reset");
        }

        function getLeaveByID(id) {
            $('#leaveapply').trigger("reset");
            $('#appmodel').modal('show');
            $.ajax({
                url: 'LeaveAppbyid?id=' + id,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function (response) {
                // console.log(response);
                // Populate the form fields with the data returned from server
                $('#leaveapply').find('[name="id"]').val(response.leaveapplyvalue.id).end();
                $('#leaveapply').find('[name="emid"]').val(response.leaveapplyvalue.em_id).end();
                $('#leaveapply').find('[name="applydate"]').val(response.leaveapplyvalue.apply_date).end();
                $('#leaveapply').find('[name="typeid"]').val(response.leaveapplyvalue.typeid).end();
                $('#leaveapply').find('[name="startdate"]').val(response.leaveapplyvalue.start_date).end();
                $('#leaveapply').find('[name="enddate"]').val(response.leaveapplyvalue.end_date).end();
                $('#leaveapply').find('[name="reason"]').val(response.leaveapplyvalue.reason).end();
                $('#leaveapply').find('[name="status"]').val(response.leaveapplyvalue.leave_status).end();

                if (response.leaveapplyvalue.leave_type == 'Half day') {
                    $('#appmodel').find(':radio[name=type][value="Half Day"]').prop('checked', true).end();
                    $('#hourAmount').show().end();
                    $('#enddate').hide().end();
                } else if (response.leaveapplyvalue.leave_type == 'Full Day') {
                    $('#appmodel').find(':radio[name=type][value="Full Day"]').prop('checked', true).end();
                    $('#hourAmount').hide().end();
                } else if (response.leaveapplyvalue.leave_type == 'More than One day') {
                    $('#appmodel').find(':radio[name=type][value="More than One day"]').prop('checked', true).end();
                    $('#hourAmount').hide().end();
                    $('#enddate').show().end();
                }

                $('#hourAmountVal').val(response.leaveapplyvalue.leave_duration).show().end();
            });
        }
    </script>
    <script>
        $(document).ready(function () {
            $("#BtnSubmit").on("click", function (event) {
                event.preventDefault();

                var date_from = $("input[name='date_from']").val();
                var date_to = $("input[name='date_to']").val();
                var emid = $('#emid').val();

                if (!date_from) {alert('Please select From Date!');return;}
                if (!emid) {alert('Please select Employee!'); return false;}

                $.ajax({
                    url: "Get_LeaveData?date_from=" + date_from + "&date_to=" + date_to + "&emp_id=" + emid,
                    type: "GET",
                    success: function (data) {
                        $("#leave-table").empty();
                        $("#leave-table").append(data);
                        $('#data_table_example').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ],
                            responsive: true
                        });
                    }
                });
            });
        });

    </script>

<?php $this->load->view('backend/footer'); ?>