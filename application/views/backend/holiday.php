<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Holiday</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                            </li>
                            <li class="breadcrumb-item active">Holiday</li>
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

                    <div class="row pb-2">
                        <div class="col-md-12">
                            <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>

                            <?php } else { ?>
                                <a href="#" type="button" class="btn btn-primary rounded-btn text-light"
                                   data-toggle="modal" data-target="#holysmodel">
                                    <i class="fa fa-plus"></i>
                                    Add Holiyday
                                </a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex">
                            <h4 class="card-title m-0 p-0"><i class="fa fa-compass mr-2" aria-hidden="true"></i>Holidays List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data_table_example"
                                       class="display table dataTable table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Number of days</th>
                                        <th>Year</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($holidays as $value): ?>
                                        <tr>
                                            <td><?php echo $value->holiday_name ?></td>
                                            <td><?php echo date('jS \of F Y', strtotime($value->from_date)); ?></td>
                                            <td><?php if (!empty($value->to_date)) {
                                                    echo date('jS \of F Y', strtotime($value->to_date));
                                                } ?></td>
                                            <td><?php echo $value->number_of_days; ?></td>
                                            <td><?php echo $value->year; ?></td>
                                            <td class="jsgrid-align-center ">
                                                <a href="#" class="btn btn-primary rounded-btn holiday"
                                                    <?php if ($this->session->userdata('user_type') ==
                                                        'EMPLOYEE') { ?> hidden <?php } ?>
                                                   data-id="<?php echo $value->id; ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" <?php if ($this->session->userdata('user_type') ==
                                                    'EMPLOYEE') { ?> hidden <?php } ?>
                                                   data-id="<?php echo $value->id; ?>"
                                                   class="btn btn-danger rounded-btn holidelet">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- sample modal content -->
                                <div class="modal" id="holysmodel" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Holidays</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form method="post" action="Add_Holidays" id="holidayform"
                                                  enctype="multipart/form-data">
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label class="control-label">Holidays name</label>
                                                        <input type="text" name="holiname" class="form-control"
                                                               id="recipient-name1" minlength="4"
                                                               maxlength="25" value="" required>
                                                    </div>
                                                    <label class="control-label">Holidays Start Date</label>
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

                                                    <label class="control-label">Holidays End Date</label>
                                                    <div class="input-group mb-3">
                                                        <input name="enddate" class="form-control mydatetimepickerFull"
                                                               id="calendar-month_enddate"
                                                               style="z-index:99999 !important;"
                                                               value="" required>
                                                        <div class="input-group-append">
                                                        <span class="input-group-text bg-transparent border-left-0"
                                                              id="basic-email"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="id" value="" class="form-control"
                                                           id="recipient-name1">
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
                                <!-- /.modal -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".holiday").click(function (e) {
                e.preventDefault(e);
                // Get the record's ID via attribute
                var iid = $(this).attr('data-id');
                $('#holidayform').trigger("reset");
                $('#holysmodel').modal('show');
                $.ajax({
                    url: 'Holidaybyib?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function (response) {
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('#holidayform').find('[name="id"]').val(response.holidayvalue.id).end();
                    $('#holidayform').find('[name="holiname"]').val(response.holidayvalue.holiday_name).end();
                    $('#holidayform').find('[name="startdate"]').val(response.holidayvalue.from_date).end();
                    $('#holidayform').find('[name="enddate"]').val(response.holidayvalue.to_date).end();
                    $('#holidayform').find('[name="nofdate"]').val(response.holidayvalue.number_of_days).end();
                    $('#holidayform').find('[name="year"]').val(response.holidayvalue.year).end();
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".holidelet").click(function (e) {
                e.preventDefault(e);

                if (!confirm('Are you sure to delete this data?')) return false;

                var iid = $(this).attr('data-id');
                $.ajax({
                    url: 'HOLIvalueDelet?id=' + iid,
                    method: 'GET',
                    data: 'data',
                }).done(function () {
                    window.location.reload();
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#calendar-month_enddate').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                beforeShowDay: function (date) {

                    // add leading zero to single digit date
                    var day = date.getDate();
                    console.log(day);
                    return [true, (day < 10 ? 'zero' : '')];
                },
                dateFormat: 'yy-mm-dd'
            });
        });

    </script>
<?php $this->load->view('backend/footer'); ?>