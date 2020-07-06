<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0">
                                <i class="fa fa-briefcase"></i>
                                Field Visit
                            </h4>
                        </div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Field Authorization Application</a></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-3">
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

                    <!-- START: Card Data-->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Field Visit List</h4>

                                    <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                            id="addNewApplication"
                                            data-target="#appmodel" onclick="emptyInputValue()">
                                        <i class="fa fa-plus"></i>
                                        <span class="d-inline-block pl-1">Add New</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-table" data-page-length='10'
                                               class="display table dataTable table-striped table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Project Name</th>
                                                <th>Location</th>
                                                <th>Employee PIN</th>
                                                <th>Employee Name</th>
                                                <th>start Date</th>
                                                <th>Approx. End Date</th>
                                                <th>Total Days</th>
                                                <th>Actual Return Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php foreach ($application as $value): ?>
                                                <tr style="vertical-align:top">
                                                    <td>
                                                        <?php echo $value->id; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo substr($value->pro_name, 0, 22) . '...'; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value->field_location; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value->em_code; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value->first_name . ' ' . $value->last_name ?>
                                                    </td>
                                                    <td>
                                                        <?php echo date('jS \of F Y', strtotime($value->start_date)); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo date('jS \of F Y', strtotime($value->approx_end_date)); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value->total_days; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value->actual_return_date; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value->status; ?>
                                                    </td>
                                                    <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>
                                                    <?php } else { ?>
                                                        <td class="d-flex justify-content-between">
                                                            <?php if ($value->status == 'Approve') { ?>

                                                            <?php } elseif ($value->status == 'Not Approve') { ?>

                                                                <a href=""
                                                                   class="btn btn-primary btn-sm rounded-btn text-light Status d-inline-block mr-1"
                                                                   data-id="<?php echo $value->id ?>"
                                                                   data-value="Approved"
                                                                   data-duration="<?php echo $value->total_days; ?>">
                                                                    Approved
                                                                </a>
                                                                <a href=""
                                                                   class="btn btn-danger btn-sm rounded-btn text-light Status d-inline-block mr-1"
                                                                   data-id="<?php echo $value->id ?>"
                                                                   data-value="Rejected"
                                                                   data-duration="<?php echo $value->total_days; ?>">
                                                                    Reject
                                                                </a>
                                                            <?php } elseif ($value->status == 'Rejected') { ?>

                                                            <?php } ?>
                                                            <a href=""
                                                               class="btn btn-primary rounded-btn text-light btn-sm fieldAuthEdit d-inline-block mr-1"
                                                               data-id="<?php echo $value->id ?>">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <?php if ($value->attendance_updated !== 'done' AND $value->status == 'Approved'): ?>
                                                                <a href="" id="closeAndUpdateFieldVisit"
                                                                   data-confirm="Are you sure want to close his field visit and update the attendance?"
                                                                   title="Mark as done"
                                                                   class="btn btn-sm btn-primary rounded-btn text-light"
                                                                   data-id="<?php echo $value->id; ?>"
                                                                   data-employeeID="<?php echo $value->em_code; ?>">
                                                                    <i class="fa fa-scissors"></i> Update attendance
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Card DATA-->

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul>
                                        <li>When you edit the applied forms from the edit button, don't forget to
                                            reauthorize approving the info.
                                        </li>
                                        <li>Once you give the final approval and confirm final closing, the attendance
                                            will be permanently updated.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="appmodel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel10">Field Authorization</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="Field_Application" id="fieldAuthForm">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Project Name</label>
                                        <select class="form-control emid" name="projectID" required>
                                            <option value="">Select Project</option>
                                            <?php foreach ($projects as $project): ?>
                                                <option value="<?php echo $project->id; ?>">
                                                    <?php echo substr($project->pro_name, 0, 60) . '...' ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Employee</label>
                                        <select class="form-control emid" name="emid"required>
                                            <option value="">Select Employee</option>
                                            <?php foreach ($employee as $value): ?>
                                                <option value="<?php echo $value->em_id; ?>">
                                                    <?php echo $value->first_name . ' ' . $value->last_name ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fieldLocation" class="control-label">Field Location</label>
                                        <input type="text" class="form-control" placeholder="Field location"
                                               name="fieldLocation">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Approximate Start Date</label>
                                        <input type="text" name="startdate" class="form-control"
                                               id="calendar-month" data-format="yyyy-mm-dd" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="enddate">
                                        <label class="control-label">Approximate End Date</label>
                                        <input type="text" name="enddate" class="form-control mydatetimepickerFull"
                                               id="calendar-month-two" data-format="yyyy-mm-dd">
                                    </div>
                                    <div class="form-group" id="totalDays">
                                        <label class="control-label">Total Days
                                        </label>
                                        <input type="number" name="totalDays" class="form-control" id="recipient-name1"
                                               readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Notes</label>
                                        <textarea name="notes" id="notes" class="form-control" rows="5"></textarea>
                                    </div>
                                    <div class="form-group" id="returnDate">
                                        <label class="control-label">Actual Return Date</label>
                                        <input type="text" name="actualReturnDate" class="form-control"
                                               id="calendar-month-three"
                                               data-format="yyyy-mm-dd">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="fid">
                            <button type="button" class="btn btn-danger rounded-btn" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary rounded-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).on('click', '#closeAndUpdateFieldVisit', function (e) {
            if (!confirm($(this).data('confirm'))) {
                e.stopImmediatePropagation();
                e.preventDefault();
            } else {
                e.stopImmediatePropagation();
                e.preventDefault();
                $.ajax({
                    url: "closeAndUpdateFieldVisit",
                    type: "POST",
                    data:
                        {
                            'fieldApplicationID': $(this).attr('data-id'),
                            'employeeID': $(this).attr('data-employeeid')
                        },
                    success: function () {
                        window.location.reload();
                    }
                    ,
                    error: function () {
                        console.error();
                    }
                });
            }
        });
    </script>
    <script>
        $("#addNewApplication").on("click", function () {
            $('#fieldAuthForm').find('[name="fid"]').val("").end();
            $('#fieldAuthForm').find('[name="projectID"]').val("").end();
            $('#fieldAuthForm').find('[name="emid"]').val("").end();
            $('#fieldAuthForm').find('[name="fieldLocation"]').val("").end();
            $('#fieldAuthForm').find('[name="startdate"]').val("").end();
            $('#fieldAuthForm').find('[name="enddate"]').val("").end();
            $('#fieldAuthForm').find('[name="notes"]').val("").end();


            function getDiffDays() {
                var date1 = new Date($('#fieldAuthForm').find('[name="startdate"]').val());
                var date2 = new Date($('#fieldAuthForm').find('[name="enddate"]').val());
                var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                $('#fieldAuthForm').find('[name="totalDays"]').val(diffDays).end();
            }


            $('#fieldAuthForm').find('[name="enddate"]').on("change", function () {
                getDiffDays();
            });

            $('#fieldAuthForm').find('[name="startdate"]').on("change", function () {
                getDiffDays();
            });

            $('#fieldAuthForm').find('[name="totalDays"]').val("").end();
            $('#fieldAuthForm').find('[name="actualReturnDate"]').val("").end();
            $('#fieldAuthForm').find('[id="returnDate"]').css("display", "none").end();

        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".fieldAuthEdit").click(function (e) {
                e.preventDefault(e);
                // Get the record's ID via attribute
                var fieldAppID = $(this).attr('data-id');
                $('#fieldAuthForm').trigger("reset");
                $('#fieldAuthForm #returnDate').css("display", "block !IMPORTANT");
                $('#appmodel').modal('show');
                $.ajax({
                    url: 'getFieldVisitAppData?id=' + fieldAppID,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function (response) {
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('#fieldAuthForm').find('[name="fid"]').val(response.id).end();
                    $('#fieldAuthForm').find('[name="projectID"]').val(response.project_id).end();
                    $('#fieldAuthForm').find('[name="emid"]').val(response.emp_id).end();
                    $('#fieldAuthForm').find('[name="fieldLocation"]').val(response.field_location
                    ).end();
                    $('#fieldAuthForm').find('[name="startdate"]').val(response.start_date
                    ).end();
                    $('#fieldAuthForm').find('[name="enddate"]').val(response.approx_end_date).end();

                    var date1 = new Date(response.start_date);
                    var date2 = new Date(response.approx_end_date);
                    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                    $('#fieldAuthForm').find('[name="totalDays"]').val(diffDays).end();
                    $('#fieldAuthForm').find('[name="notes"]').val(response.notes).end();

                    $('#fieldAuthForm').find('[id="returnDate"]').css("display", "block").end();
                    $('#fieldAuthForm').find('[name="actualReturnDate"]').val(response.actual_return_date).end();
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
                $(".assignleave").click(function (e) {
                        e.preventDefault(e);
                        // Get the record's ID via attribute
                        var iid = $(this).val();
                        if (iid) {
                            console.log(iid);
                            $.ajax({
                                    url: 'LeaveAssign?id=' + iid,
                                    method: 'GET',
                                    data: '',
                                }
                            ).done(function (response) {
                                    //console.log(response);
                                    $("#total").html(response);
                                }
                            );
                        } else {
                            $("#total").val('');
                        }
                    }
                );
            }
        );
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
                $(".emleavetype").click(function (e) {
                        e.preventDefault(e);
                        // Get the record's ID via attribute
                        var iid = $(this).val();
                        //console.log(iid);
                        $.ajax({
                                url: 'LeaveType?id=' + iid,
                                method: 'GET',
                                data: '',
                            }
                        ).done(function (response) {
                                //console.log(response);
                                $("#leavetype").html(response);
                            }
                        );
                    }
                );
            }
        );
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
                $(".leaveapp").click(function (e) {
                        e.preventDefault(e);
                        // Get the record's ID via attribute
                        var iid = $(this).attr('data-id');
                        $('#leaveapply').trigger("reset");
                        $('#appmodel').modal('show');
                        $.ajax({
                                url: 'LeaveAppbyid?id=' + iid,
                                method: 'GET',
                                data: '',
                                dataType: 'json',
                            }
                        ).done(function (response) {
                                console.log(response);
                                // Populate the form fields with the data returned from server
                                $('#leaveapply').find('[name="id"]').val(response.id).end();
                                $('#leaveapply').find('[name="emid"]').val(response.em_id).end();
                                $('#leaveapply').find('[name="applydate"]').val(response.apply_date).end();
                                $('#leaveapply').find('[name="typeid"]').val(response.typeid).end();
                                $('#leaveapply').find('[name="startdate"]').val(response.start_date).end();
                                $('#leaveapply').find('[name="enddate"]').val(response.end_date).end();
                                $('#leaveapply').find('[name="duration"]').val(response.leave_duration).end();
                                $('#leaveapply').find('[name="reason"]').val(response.reason).end();
                                $('#leaveapply').find('[name="status"]').val(response.leave_status).end();
                                $('#leaveapply').find('[name="type"]').val(response.leave_type).end();
                            }
                        );
                    }
                );
            }
        );
    </script>
    <script>
        $(".Status").on("click", function (event) {
                event.preventDefault();

                $.ajax({
                        url: "authorizeFieldVisit",
                        type: "POST",
                        data:
                            {
                                'fieldApplicationID': $(this).attr('data-id'),
                                'approvalStatus': $(this).attr('data-value')
                            }
                        ,
                        success: function () {
                            window.location.reload();
                        }
                        ,
                        error: function () {
                            console.error();
                        }
                    }
                );
            }
        );
    </script>
<?php $this->load->view('backend/footer'); ?>