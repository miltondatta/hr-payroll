<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Earn Leave</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Earn Leave</li>
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="col-12">
                                <a href="#" type="button" class="btn btn-primary rounded-btn TypeModal"
                                   data-toggle="modal"
                                   data-target="#earnmodel">
                                    <i class="fa fa-plus"></i>
                                    Assign Earned Leave
                                </a>
                            </div>
                        </div>
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="fa fa-compass" aria-hidden="true"></i> Earn Balance
                            </h4>
                        </div>
                        <div class="card-body">
                            <table id="data_table_example"
                                   class="display table dataTable table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Employee PIN</th>
                                    <th>Employee Name</th>
                                    <!--<th>Total Day </th>-->
                                    <th>Total Hour</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($earnleave as $value): ?>
                                    <tr>
                                        <td><?php echo $value->em_code ?></td>
                                        <td><?php echo $value->first_name . ' ' . $value->last_name; ?></td>
                                        <!--<td><?php echo $value->present_date; ?></td>-->
                                        <td><?php echo $value->hour . ' Hours' ?></td>
                                        <?php if ($value->present_date > 0) { ?>
                                            <td>
                                                <a href="#" class="btn btn-primary rounded-btn deductionmodel"
                                                   data-id="<?php echo $value->em_id; ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
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
        <div class="modal" id="earnmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Earn Leave</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" action="Update_Earn_Leave" id="earnform">
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Employee </label>
                                <select name="emid" class="form-control select2 custom-select" style="width:100%"
                                        required>
                                    <option value="">Select Employee</option>
                                    <?php foreach ($employee as $value): ?>
                                        <option value="<?php echo $value->em_code ?>"><?php echo $value->first_name . ' ' .
                                                $value->last_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <label>Start Date </label>
                            <div class="input-group mb-3">
                                <input name="startdate"
                                       class="form-control mydatetimepickerFull"
                                       id="calendar-month" style="z-index:99999 !important;"
                                       value="" required>
                                <div class="input-group-append">
                                                        <span class="input-group-text bg-transparent border-left-0"
                                                              id="basic-email"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>

                            <label class="control-label">End Date</label>
                            <div class="input-group mb-3">
                                <input name="enddate" class="form-control mydatetimepickerFull"
                                       id="calendar-month_enddate" style="z-index:99999 !important;"
                                       value="" required>
                                <div class="input-group-append">
                                                        <span class="input-group-text bg-transparent border-left-0"
                                                              id="basic-email"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>

                            <!--<div class="form-group">
                            <label>Number Of Days </label>
                            <input type="text" name="days" class="form-control" value="" placeholder="number of days..." readonly>
                            </div> -->

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="eid" value="" class="form-control" id="recipient-name1">
                            <button type="button" class="btn btn-danger rounded-btn"
                                    data-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-primary rounded-btn">Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal" id="earndeductionmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Earn Leave</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" action="Update_Earn_Leave_Only" id="deductionform"
                          enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Employee </label>
                                <input type="text" name="emname" class="form-control" value="" readonly>
                                <input type="hidden" name="employee" class="form-control" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label>Number Of Days </label>
                                <input type="number" min="0" name="day" class="form-control day" value="" required>
                            </div>
                            <div class="form-group">
                                <label>Hour </label>
                                <input type="text" name="hour" class="form-control hour" value="" readonly>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="eid" value="" class="form-control" id="recipient-name1">
                            <button type="button" class="btn btn-danger rounded-btn"
                                    data-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-primary rounded-btn">Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".deductionmodel").click(function (e) {
                e.preventDefault(e);
                // Get the record's ID via attribute
                var iid = $(this).attr('data-id');
                console.log(iid);
                $('#deductionform').trigger("reset");
                $('#earndeductionmodel').modal('show');
                $.ajax({
                    url: 'GetEarneBalanceByEmCode?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function (response) {
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('#deductionform').find('[name="employee"]').val(response.earnval.em_id).end();
                    $('#deductionform').find('[name="emname"]').val(response.earnval.emname).end();
                    $('#deductionform').find('[name="day"]').val(response.earnval.present_date).end();
                    $('#deductionform').find('[name="hour"]').val(response.earnval.hour).end();
                    /*                                                     if (response.assetsByid.Assets_type == 'Logistic')
                     $('#btnSubmit').find(':checkbox[name=type][value="Logistic"]').prop('checked', true);*/

                });
            });
        });
    </script>
    <script type="text/javascript">
        $('.day').on('input', function () {
            var day = parseInt($('.day').val());
            console.log(hour);
            var hour = 8;
            $('.hour').val((day * hour ? day * hour : 0).toFixed(2));

        });
    </script>

    <script>
        $('#earnform').find('[name="enddate"]').on("change", function () {
            console.log('Yes');
            var date1 = new Date($('#earnform').find('[name="startdate"]').val());
            var date2 = new Date($('#earnform').find('[name="enddate"]').val());
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            $('#earnform').find('[name="days"]').val(diffDays).end();
        });
    </script>
<?php $this->load->view('backend/footer'); ?>