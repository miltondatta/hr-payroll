<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Leave Types</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Leave</a></li>
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
                                    <h4 class="card-title">Leave Type List</h4>

                                    <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                            data-target="#leavemodel" onclick="emptyInputValue()">
                                        <i class="fa fa-plus"></i>
                                        <span class="d-inline-block pl-1">Add Leave Types</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-table"
                                               class="display table dataTable table-striped table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Leave Type</th>
                                                <th>Number Of Days</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php foreach ($leavetypes as $value): ?>
                                                <tr>
                                                    <td><?php echo $value->type_id; ?></td>
                                                    <td><?php echo $value->name ?></td>
                                                    <td><?php echo $value->leave_day ?></td>
                                                    <td>
                                                        <a href="#"
                                                            <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> hidden <?php } ?>
                                                           class="btn btn-primary rounded-btn leavetype"
                                                           data-id="<?php echo $value->type_id; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a onclick="return confirm('Are you sure to delete this data?')"
                                                           href="LeavetypeDelet?D=<?php echo $value->type_id; ?>"
                                                           class="btn btn-danger rounded-btn">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
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
                </div>
            </div>
        </div>

        <div class="modal" id="leavemodel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel10">Leave</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="Add_leaves_Type" id="leaveform" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label">Leave name</label>
                                <input type="text" name="leavename" class="form-control" id="recipient-name1" minlength="1" maxlength="35" value="" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Day</label>
                                <input type="text" name="leaveday" class="form-control" id="recipient-name1" value="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">status</label>
                                <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="status" required>
                                    <option value="">Select Here</option>
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" value="" class="form-control" id="recipient-name1">
                            <button type="button" class="btn btn-danger rounded-btn" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary rounded-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(".leavetype").click(function (e) {
            e.preventDefault(e);

            var iid = $(this).attr('data-id');
            $('#leaveform').trigger("reset");
            $('#leavemodel').modal('show');

            $.ajax({
                url: 'LeaveTypebYID?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function (response) {
                $('#leaveform').find('[name="id"]').val(response.leavetypevalue.type_id).end();
                $('#leaveform').find('[name="leavename"]').val(response.leavetypevalue.name).end();
                $('#leaveform').find('[name="leaveday"]').val(response.leavetypevalue.leave_day).end();
                $('#leaveform').find('[name="status"]').val(response.leavetypevalue.status).end();
            });
        });

        function emptyInputValue() {
            $('#leaveform').find('[name="id"]').val('').end();
            $('#leaveform').find('[name="leavename"]').val('').end();
            $('#leaveform').find('[name="leaveday"]').val('').end();
            $('#leaveform').find('[name="status"]').val('').end();
        }
    </script>
<?php $this->load->view('backend/footer'); ?>