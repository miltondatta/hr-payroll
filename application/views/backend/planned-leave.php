<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Planned Leave</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Planned Leave</a></li>
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
                                <h4 class="card-title">Planned Leave List</h4>

                                <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                        data-target="#planned-leave-modal" onclick="emptyInputValue()">
                                    <i class="fa fa-plus"></i>
                                    <span class="d-inline-block pl-1">Add Planned Leave</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <?php
                                if ($user_type != 'EMPLOYEE') {
                                    ?>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <select class="form-control" name="em_id" id="em_id" required>
                                                <option value="">Select Employee</option>
                                                <option value="all">Select All</option>
                                                <?php foreach ($employee as $value): ?>
                                                    <option value="<?php echo $value->em_id; ?>">
                                                        <?php echo $value->first_name; echo ' '; echo $value->last_name; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-primary rounded-btn"
                                                    onclick="getPlannedLeaveData()">Search
                                            </button>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="table-responsive" id="planned-leave-table-area">
                                    <table id="data-table" data-page-length='10'
                                           class="display table dataTable table-striped table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th>Leave Type</th>
                                            <th>Leave From</th>
                                            <th>Leave To</th>
                                            <th>Remarks</th>
                                            <th>Added By</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        <?php foreach ($planned_leave_data as $value): ?>
                                            <tr>
                                                <td><?php echo $value->leave_type_name ?></td>
                                                <td><?php echo $value->leave_from ?></td>
                                                <td><?php echo $value->leave_to ?></td>
                                                <td><?php echo substr($value->remarks, 0, 50);
                                                    echo strlen($value->remarks) > 50 ? '...' : ''; ?></td>
                                                <td><?php echo $value->added_by ?></td>
                                                <td><?php echo date('jS \of F Y', strtotime($value->created_at)) ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-info rounded-btn"
                                                       onclick="getPlannedLeaveInfoById(<?php echo $value->id; ?>)">
                                                        Edit
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

    <div class="modal" id="planned-leave-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel10">Planned Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" method="post" action="addPlannedLeave" id="btnSubmit">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="leave_type_id" class="control-label col-md-3">Leave Types</label>
                            <select name="leave_type_id" id="leave_type_id" class="form-control col-md-8" required>
                                <option value="">Select Leave Type</option>
                                <?php
                                foreach ($leave_types as $record) {
                                    ?>
                                    <option value="<?php echo $record->type_id; ?>"><?php echo $record->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="leave_from" class="control-label col-md-3">Leave From</label>
                            <input type="date" name="leave_from" id="leave_from" class="form-control col-md-8" required>
                        </div>
                        <div class="form-group row">
                            <label for="leave_to" class="control-label col-md-3">Leave To</label>
                            <input type="date" name="leave_to" id="leave_to" class="form-control col-md-8" required>
                        </div>
                        <div class="form-group row">
                            <label for="remarks" class="control-label col-md-3">Remarks</label>
                            <textarea class="form-control col-md-8" name="remarks" id="remarks" rows="4"
                                      required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="">
                        <button type="button" class="btn btn-danger rounded-btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary rounded-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php $this->load->view('backend/footer'); ?>
<script>
    function getPlannedLeaveInfoById(id) {
        $('#btnSubmit').trigger("reset");
        $('#planned-leave-modal').modal('show');

        $.ajax({
            url: 'plannedLeaveById?id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).done(function (response) {
            $('#btnSubmit').find('[name="id"]').val(response.planned_leave.id).end();
            $('#btnSubmit').find('[name="leave_type_id"]').val(response.planned_leave.leave_type_id).end();
            $('#btnSubmit').find('[name="leave_from"]').val(response.planned_leave.leave_from).end();
            $('#btnSubmit').find('[name="leave_to"]').val(response.planned_leave.leave_to).end();
            $('#btnSubmit').find('[name="remarks"]').val(response.planned_leave.remarks).end();
        });
    }

    function emptyInputValue() {
        $('#btnSubmit').trigger("reset");
    }

    function getPlannedLeaveData() {
        let em_id = $("#em_id").val();
        if (!em_id) {
            alert('Please select employee!');
            return;
        }

        $.ajax({
            url: 'getPlannedLeaveByEmployee',
            method: 'POST',
            data: {
                em_id: em_id,
            }
        }).done(function (data) {
            $("#planned-leave-table-area").empty();
            $("#planned-leave-table-area").append(data);
            $('#data-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                responsive: true
            });
        });
    }
</script>
