<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Attendance</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>attendance/Attendance">Attendance</a>
                        </li>
                        <li class="breadcrumb-item active">Attendance Report</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12  mt-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title"><i class="fa fa-compass" aria-hidden="true"></i> Attendance Report</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="Get_attendance_data_for_report" class="form-material row">
                            <div class="form-group col-md-3">
                                <input type="text" name="date_from" id="calendar-month" data-format="yyyy-mm-dd"
                                       class="form-control mydatetimepickerFull" placeholder="From" autocomplete="off">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="date_to" id="calendar-month-two" data-format="yyyy-mm-dd" class="form-control mydatetimepickerFull"
                                       placeholder="To" autocomplete="off">
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control" tabindex="1" name="emid" id="employee_id"
                                        required>
                                    <option value="">Select Employee</option>
                                    <?php foreach($employee as $value): ?>
                                        <option value="<?php echo $value->em_id; ?>">
                                            <?php echo $value->first_name ?>
                                            <?php echo $value->last_name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <input type="submit" class="btn btn-primary rounded-btn" value="Submit" name="submit"
                                       id="getAtdReport">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12  mt-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title"><i class="fa fa-compass" aria-hidden="true"></i>Employee</h4>
                    </div>
                    <div class="card-body EmployeeInfo">
                        <h3 class="employee_name">Employee Name</h3>
                        Worked <span class="hours"></span> Hours in <span class="days"></span> days
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12  mt-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title"><i class="fa fa-compass" aria-hidden="true"></i> Full attendance</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data_table_example"
                                   class="display table dataTable table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>PIN</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>In</th>
                                    <th>Out</th>
                                    <th>Hour</th>
                                    <th>Place</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view('backend/footer'); ?>
<script type="text/javascript">
    $(document).ready(function (){
        $("#getAtdReport").click(function (e){
            e.preventDefault(e);

            var date_from   = $("input[name='date_from']").val();
            var date_to     = $("input[name='date_to']").val();
            var employee_id = $('#employee_id').val();

            if (!date_from) {alert('Please select From Date!'); return;}
            if (!date_to) {alert('Please select Date To!'); return;}
            if (!employee_id) {alert('Please select Employee!'); return;}

            $.ajax({
                url   : 'Get_attendance_data_for_report',
                method: 'POST',
                data  : {
                    date_from  : date_from,
                    date_to    : date_to,
                    employee_id: employee_id
                }
            }).done(function (response){
                
                var data = JSON.parse(response);
                
                var infoContainer = $('.EmployeeInfo'),
                    name          = $('.EmployeeInfo .employee_name'),
                    hours         = $('.EmployeeInfo .hours'),
                    days          = $('.EmployeeInfo .days');
                
                name.text(data.name);
                hours.text(Math.abs(data.hours[0].Hours));
                days.text(data.days);
                
                var tableData = data.attendance;
                $('#data_table_example').dataTable({
                    "bDestroy": true,
                    "aaData"  : tableData,
                    "columns" : [
                        {"data": "em_code"},
                        {"data": "name"},
                        {"data": "atten_date"},
                        {"data": "signin_time"},
                        {"data": "signout_time"},
                        {"data": "Hours"},
                        {"data": "place"}
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    responsive: true
                });
            });
        });
    });
</script>
