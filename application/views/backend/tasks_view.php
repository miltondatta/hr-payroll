<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Tasks</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Tasks</a></li>
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
                                    <h4 class="card-title">Task List</h4>

                                    <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                            data-target="#tasksmodal" onclick="emptyInputValue()">
                                        <i class="fa fa-plus"></i>
                                        <span class="d-inline-block pl-1">Add Task</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-table" data-page-length='10'
                                               class="display table dataTable table-striped table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>Project Title</th>
                                                <th>Tasks Title</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Assigned Employee</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php foreach ($tasks as $value): ?>
                                                <tr>
                                                    <td><?php echo substr($value->pro_name, 0, 25) . '...' ?></td>
                                                    <td><?php echo substr($value->task_title, 0, 25) . '...' ?></td>
                                                    <td><?php echo date('jS \of F Y', strtotime($value->start_date)) ?></td>
                                                    <td><?php echo date('jS \of F Y', strtotime($value->end_date)) ?></td>
                                                    <td>
                                                        <?php
                                                        $id = $value->id;
                                                        $assignvalue = $this->project_model->getTaskAssignUser($id); ?>
                                                        <?php foreach ($assignvalue as $value1): ?>
                                                            <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $value1->em_image ?>"
                                                                 height="40px" width="40px" style="border-radius:50px"
                                                                 alt="" data-toggle="tooltip" data-placement="top"
                                                                 title=""
                                                                 data-original-title="<?php echo $value1->first_name; ?>">
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary rounded-btn installment text-light edit-modal"
                                                           data-id="<?php echo $value->id ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a onclick="return confirm('Are you sure to delete this data?')"
                                                           data-id="<?php echo $value->id ?>"
                                                           class="btn btn-danger rounded-btn TasksDelet text-light">
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

        <div class="modal" id="tasksmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel10">Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="Add_Tasks" id="tasksModalform">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Project List</label>
                                <select class="form-control col-md-8 proid" name="projectid">
                                    <option value="">Select Project</option>
                                    <?php foreach ($projects as $value): ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->pro_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Project Date</label>
                                <input type="text" value="" name="prostart" class="form-control col-md-4"
                                       id="recipient-name1" readonly>
                                <input type="text" value="" name="proend" class="form-control col-md-4"
                                       id="recipient-name1" readonly>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Assign To</label>
                                <select class="select2 form-control col-md-3" data-placeholder="Choose a Category"
                                        style="width:25%" tabindex="1" name="teamhead" id="team_head">
                                    <option value="">Select Here</option>
                                    <?php foreach ($employee as $value): ?>
                                        <option value="<?php echo $value->em_id; ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label class="control-label col-md-2">Collaborators</label>
                                <select class="form-control col-md-3 multiselect" name="assignto[]" id="assign_to"
                                        multiple
                                        data-allow-clear="1" style="width: 25%;">
                                    <option value="">Select Here</option>
                                    <?php foreach ($employee as $value): ?>
                                        <option value="<?php echo $value->em_id; ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Task Title</label>
                                <input type="text" name="tasktitle" class="form-control col-md-8" id="recipient-name1"
                                       minlength="8" maxlength="250" placeholder="Task....">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Task Start Date</label>
                                <input type="text" name="startdate" class="form-control col-md-3" id="calendar-month"
                                       data-format="yyyy-mm-dd">

                                <label class="control-label col-md-2">Task End Date</label>
                                <input type="text" name="enddate" class="form-control col-md-3 calendar-month-global"
                                       id="calendar-month-two" data-format="yyyy-mm-dd">
                            </div>
                            <div class="form-group row">
                                <label for="message-text" class="control-label col-md-3">Details</label>
                                <textarea class="form-control col-md-8" name="details" id="message-text1" minlength="10"
                                          maxlength="1400"></textarea>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Status: </label>
                                <input name="status" type="radio" id="radio_1" data-value="Logistic"
                                       class="input-type-checkbox" value="complete">
                                <label for="radio_1">Complete</label>
                                <input name="status" type="radio" id="radio_2" data-value="Logistic"
                                       class="input-type-checkbox ml-1" value="running">
                                <label for="radio_2">Running</label>
                                <input name="status" type="radio" id="radio_3" data-value="Logistic"
                                       class="input-type-checkbox ml-1" value="cancel">
                                <label for="radio_3">Cancel</label>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Type: </label>
                                <input name="type" type="radio" id="radio_4" data-value="Logistic"
                                       class="input-type-checkbox" value="Office">
                                <label for="radio_4">Office</label>
                                <!-- <input name="type" type="radio" id="radio_5" data-value="Logistic" class="type" value="Field">
                                 <label for="radio_5">Field</label>-->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" class="form-control" id="recipient-name1">
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
                    url: '<?php echo base_url();?>logistice/GetInstock?id=' + this.value,
                    method: 'GET',
                    data: 'data',
                }).done(function (response) {
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('.qty').html(response);
                    $('#tasksModalform').find('[name="qty"]').attr("max", response);
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".proid").change(function (e) {
                e.preventDefault(e);
                // Get the record's ID via attribute
                var iid = $(this).val();
                console.log(iid);
                $.ajax({
                    url: 'projectbyId?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function (response) {
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('#tasksModalform').find('[name="prostart"]').val(response.provalue.pro_start_date).end();
                    $('#tasksModalform').find('[name="proend"]').val(response.provalue.pro_end_date).end();
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".edit-modal").click(function (e) {
                e.preventDefault(e);

                var iid = $(this).attr('data-id');
                $('#tasksModalform').trigger("reset");
                $('#tasksmodal').modal('show');

                $.ajax({
                    url: 'TasksById?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function (response) {
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('#tasksModalform').find('[name="id"]').val(response.tasksvalue.id).end();
                    $('#tasksModalform').find('[name="projectid"]').val(response.tasksvalue.pro_id).end();
                    $('#tasksModalform').find('[name="assignto"]').val(response.tasksvalue.assigned_id).end();
                    $('#tasksModalform').find('[name="tasktitle"]').val(response.tasksvalue.task_title).end();
                    $('#tasksModalform').find('[name="startdate"]').val(response.tasksvalue.start_date).end();
                    $('#tasksModalform').find('[name="enddate"]').val(response.tasksvalue.end_date).end();
                    $('#tasksModalform').find('[name="details"]').val(response.tasksvalue.description).end();
                    $(".proid").change();

                    if (response.tasksvalue.status == 'complete') {
                        $('#radio_1').attr('checked', true);
                    } else if (response.tasksvalue.status == 'running') {
                        $('#radio_2').attr('checked', true);
                    } else if (response.tasksvalue.status == 'cancel') {
                        $('#radio_3').attr('checked', true);
                    }

                    if (response.tasksvalue.task_type == 'Office') {
                        $('#radio_4').attr('checked', true);
                    }


                    $("#assign_to option").each(function (key, item) {
                        $(item).removeAttr('selected');
                        $('.multiselect').each(function () {
                            $(this).select2({
                                theme: 'bootstrap4',
                                width: 'style',
                                placeholder: $(this).attr('placeholder'),
                                allowClear: Boolean($(this).data('allow-clear')),
                            });
                        });
                    });

                    $("#team_head option").each(function (key, item) {
                        $(item).removeAttr('selected');
                    });


                    $.each(response.employesvalue, function (key, item) {
                        if (item.user_type == 'Collaborators') {
                            $("#assign_to [value='" + item.assign_user + "']").attr("selected", "selected");
                            $('.multiselect').each(function () {
                                $(this).select2({
                                    theme: 'bootstrap4',
                                    width: 'style',
                                    placeholder: $(this).attr('placeholder'),
                                    allowClear: Boolean($(this).data('allow-clear')),
                                });
                            });
                        } else {
                            $("#team_head [value='" + item.assign_user + "']").attr("selected", "selected");
                        }
                    });


                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".TasksDelet").click(function (e) {
                e.preventDefault(e);
                // Get the record's ID via attribute
                var iid = $(this).attr('data-id');
                $.ajax({
                    url: 'TasksDeletByid?id=' + iid,
                    method: 'GET',
                    data: 'data',
                }).done(function (response) {
                    window.location.reload();
                });
            });
        });
    </script>
<?php $this->load->view('backend/footer'); ?>