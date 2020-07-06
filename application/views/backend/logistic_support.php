<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Logistic Support</h4></div>
                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Logistic Support</a></li>
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
                                    <h4 class="card-title">Logistic Support List</h4>

                                    <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                            data-target="#supportmodelupdate" onclick="emptyInputValue()">
                                        <i class="fa fa-plus"></i>
                                        <span class="d-inline-block pl-1">Add Logistic Support</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-table" data-page-length='10'
                                               class="display table dataTable table-striped table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>Assets</th>
                                                <th>Assign User</th>
                                                <th>Task Name</th>
                                                <th>Qty</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
<!--                                                <th>Back Date</th>-->
<!--                                                <th>Back Qty</th>-->
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php foreach ($supportview as $value): ?>
                                                <tr>
                                                    <td><?php echo $value->ass_name; ?></td>
                                                    <td><?php echo $value->first_name . ' ' . $value->last_name; ?></td>
                                                    <td><?php echo substr($value->task_title, 0, 13) . '...'; ?></td>
                                                    <td><?php echo $value->log_qty; ?></td>
                                                    <td><?php echo $value->start_date; ?></td>
                                                    <td><?php
                                                        $end = $value->end_date;
                                                        $expire = strtotime($end);
                                                        $todaydate = date("m/d/Y");
                                                        $todate = strtotime($todaydate);
                                                        #echo $todate;
                                                        if ($todate >= $expire) {
                                                            echo "<span style='color:red'>" . $value->end_date . "</span>";
                                                        } else {
                                                            echo $value->end_date;
                                                        }
                                                        #echo $value->end_date; ?></td>
<!--                                                    <td>--><?php //echo $value->back_date; ?><!--</td>-->
<!--                                                    <td>--><?php //echo $value->back_qty; ?><!--</td>-->
                                                    <td>
                                                        <a class="btn btn-primary rounded-btn installment text-light logisticessupport"
                                                           data-id="<?php echo $value->ass_id ?>">
                                                            <i class="fa fa-edit"></i>
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

        <div class="modal" id="supportmodelupdate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel10">Logistic Support</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="Add_Logistic_Support" id="logisticsupform"
                          enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Logistic List</label>
                                        <select class="select2 form-control assetsstock"
                                                data-placeholder="Choose a Category" tabindex="1" name="logid"
                                                style="width:100%" required>
                                            <option value="">Select Here</option>
                                            <?php foreach ($assets as $value): ?>
                                                <option value="<?php echo $value->ass_id; ?>"><?php echo $value->ass_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Project</label>
                                        <select class="select2 form-control"
                                                data-placeholder="Choose a Category" tabindex="1" name="proid"
                                                id="OnEmValue" style="width:100%" required>
                                            <option value="">Select Here</option>
                                            <?php foreach ($projects as $value): ?>
                                                <option value="<?php echo $value->id; ?>"><?php echo $value->pro_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Task List</label>
                                        <select class="form-control taskclass"
                                                data-placeholder="Choose a Category" tabindex="1" name="taskid"
                                                id="taskval" required>
                                            <option value="">Select Here</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Employee Name</label>
                                        <select class="select2 form-control"
                                                data-placeholder="Choose a Category" tabindex="1" name="assignid"
                                                id="assignval" style="width: 100%" required>
                                            <option value="">Select here</option>
                                            <?php foreach ($employee as $value): ?>
                                                <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Start Date</label>
                                        <input type="text" name="startdate" class="form-control"
                                               id="calendar-month" data-format="yyyy-mm-dd">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">End Date</label>
                                        <input type="text" name="enddate" class="form-control"
                                               id="calendar-month-two" data-format="yyyy-mm-dd">
                                    </div>
                                    <!--<div class="form-group">
                                        <label class="control-label">Back Date</label>
                                        <input type="date" name="backdate" class="form-control" id="recipient-name1">
                                    </div>-->
                                    <span>In Stock:<div style="color:red" class="qty"> </div></span>
                                    <div class="form-group">
                                        <label class="control-label">Assign Qty</label>
                                        <input type="text" name="assignqty" class="form-control"
                                               id="recipient-name1" value="" min="0" max="">
                                        <div style="color:red" class="qty_error pt-1"></div>
                                    </div>
                                    <!--<div class="form-group">
                                        <label class="control-label">Back Qty</label>
                                        <input type="text" name="backqty" class="form-control" id="recipient-name1">
                                    </div>-->
                                    <div class="form-group">
                                        <label class="control-label">Remarks</label>
                                        <textarea class="form-control" name="remarks"
                                                  id="message-text1"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="assid" value="">
                            <button type="button" class="btn btn-danger rounded-btn" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary rounded-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".assetsstock").change(function (e) {
                e.preventDefault(e);
                // Get the record's ID via attribute
                var iid = +this.value;
                //console.log(this.value);
                //"#taskval option:selected" ).text();
                $("#qty").change();
                //$('#salaryform').trigger("reset");
                $.ajax({
                    url: 'GetInstock?id=' + this.value,
                    method: 'GET',
                    data: 'data',
                }).done(function (response) {
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('.qty').html(response);
                    $('#logisticsform').find('[name="assignqty"]').attr("max", response);
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#OnEmValue").change(function (e) {
                e.preventDefault(e);

                $.ajax({
                    url: 'GetTaskforlogistic?id=' + this.value,
                    method: 'GET',
                    data: 'data'
                }).done(function (response) {
                    $('#taskval').html('<option value="">Select Here</option>' + response);
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".taskclass").change(function (e) {
                e.preventDefault(e);

                $.ajax({
                    url: 'GetAssignforlogistic?id=' + this.value,
                    method: 'GET',
                    data: 'data'
                }).done(function (response) {
                    $('#assignval').html('<option value="">Select Here</option>' + response);
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".logisticessupport").click(function (e) {
                e.preventDefault(e);
                // Get the record's ID via attribute
                var iid = $(this).attr('data-id');
                $('#logisticsupform').trigger("reset");
                $('#supportmodelupdate').modal('show');
                $.ajax({
                    url: 'Logisticesupportbyib?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function (response) {
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('#logisticsupform').find('[name="assid"]').val(response.logisticsupport.ass_id).end();
                    $('#logisticsupform').find('[name="logid"]').val(response.logisticsupport.asset_id).end();
                    $('#logisticsupform').find('[name="assignqty"]').val(response.logisticsupport.log_qty).end();
                    $('#logisticsupform').find('[name="startdate"]').val(response.logisticsupport.start_date).end();
                    $('#logisticsupform').find('[name="enddate"]').val(response.logisticsupport.end_date).end();
                    $('#logisticsupform').find('[name="backdate"]').val(response.logisticsupport.back_date).end();
                    $('#logisticsupform').find('[name="backqty"]').val(response.logisticsupport.back_qty).end();
                    $('#logisticsupform').find('[name="remarks"]').val(response.logisticsupport.remarks).end();
                    $('#logisticsupform').find('[name="proid"]').val(response.logisticsupport.project_id).end();

                    $.ajax({
                        url: 'GetTaskforlogistic?id=' + response.logisticsupport.project_id,
                        method: 'GET',
                        data: 'data'
                    }).done(function (data) {
                        $('#taskval').html('<option value="">Select Here</option>' + data);
                        $("#taskval [value='" + response.logisticsupport.task_id + "']").attr("selected", "selected");
                    });

                    $.ajax({
                        url: 'GetAssignforlogistic?id=' + response.logisticsupport.task_id,
                        method: 'GET',
                        data: 'data'
                    }).done(function (data) {
                        $('#assignval').html('<option value="">Select Here</option>' + data);
                        $("#assignval [value='" + response.logisticsupport.assign_id + "']").attr("selected", "selected");
                    });
                });
            });

            $("#recipient-name1").keyup(function () {
                const stock = parseInt($(".qty").text());
                const val = parseInt($(this).val());
                if (val > stock) {
                    $(".qty_error").text('Please enter a value less than or equal to ' + stock);
                    $(this).val('');
                } else {
                    $(".qty_error").text('');
                }
            });
        });

        function emptyInputValue() {
            $('#logisticsupform').find('[name="assid"]').val('').end();
            $('#logisticsupform').find('[name="logid"]').val('').end();
            $('#logisticsupform').find('[name="proid"]').val('').end();
            $('#logisticsupform').find('[name="taskid"]').val('').end();
            $('#logisticsupform').find('[name="assignid"]').val('').end();
            $('#logisticsupform').find('[name="assignqty"]').val('').end();
            $('#logisticsupform').find('[name="startdate"]').val('').end();
            $('#logisticsupform').find('[name="enddate"]').val('').end();
            $('#logisticsupform').find('[name="backdate"]').val('').end();
            $('#logisticsupform').find('[name="backqty"]').val('').end();
            $('#logisticsupform').find('[name="remarks"]').val('').end();
        }
    </script>
<?php $this->load->view('backend/footer'); ?>