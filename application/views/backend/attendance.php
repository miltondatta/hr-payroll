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
                        </li>
                        <li class="breadcrumb-item active">Attendance</li>
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
                            <a href="<?php echo base_url(); ?>attendance/Save_Attendance"
                               class="btn btn-primary rounded-btn">
                                <i class="fa fa-plus"></i>
                                Add Attendance
                            </a>
                            <a href="#" class="btn btn-success rounded-btn" data-toggle="modal"
                               data-target="#Bulkmodal">
                                <i class="fa fa-bars"></i>
                                Add Bulk Attendance
                            </a>
                        </div>
                    </div>
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title"><i class="fa fa-compass" aria-hidden="true"></i> Attendance List</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="Get_attendance_data_for_report" class="form-material row">
                            <div class="form-group col-md-3">
                                <input type="text" name="date_from" id="calendar-month" data-format="yyyy-mm-dd"
                                       class="form-control mydatetimepickerFull" placeholder="From" autocomplete="off">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="date_to" id="calendar-month-two" data-format="yyyy-mm-dd"
                                       class="form-control mydatetimepickerFull"
                                       placeholder="To" autocomplete="off">
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control custom-select"
                                        data-placeholder="Choose a Category" tabindex="1" id="depid"
                                        name="depid" onchange="getEmployeeDeptWise()">
                                    <option value="">Department</option>
                                    <option value="0" selected >All Department</option>
                                    <?php foreach($department as $value): ?>
                                        <option value="<?php echo $value->id; ?>">
                                            <?php echo $value->dep_name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control" tabindex="1" name="emid" id="employee_id"
                                        required>
                                    <option value="">Select Employee</option>
                                    <?php foreach ($employee as $value): ?>
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
                        <div class="table-responsive" id="table-area">
                            <table id="data_table_example"
                                   class="display table dataTable table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Department Name</th>
                                    <th>Date</th>
                                    <th>Sign In</th>
                                    <th>Sign Out</th>
                                    <th>Working Hour</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($attendancelist as $value): ?>
                                    <tr>
                                        <td><?php echo $value->emp_id; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo $value->dept_name; ?></td>
                                        <td><?php echo $value->atten_date; ?></td>
                                        <td><?php echo $value->signin_time; ?></td>
                                        <td><?php echo $value->signout_time; ?></td>
                                        <td><?php echo $value->Hours; ?></td>
                                        <td>
                                            <?php if ($value->signout_time == '00:00:00') { ?>
                                                <a href="Save_Attendance?A=<?php echo $value->id; ?>" title="Edit"
                                                   class="btn btn-sm btn-info waves-effect waves-light"
                                                   data-value="Approve">Sign Out</a><br>
                                            <?php } ?>
                                            <a href="Save_Attendance?A=<?php echo $value->id; ?>"
                                               class="btn btn-primary rounded-btn" data-value="Approve">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- sample modal content -->
                            <div id="Bulkmodal" class="modal" tabindex="-1" role="document"
                                 aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post" action="import" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Add Attendance</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Import Attendance<span><img
                                                                src="<?php echo base_url(); ?>assets/images/finger.jpg"
                                                                height="100px" width="100px"></span>Upload only CSV file
                                                </h4>

                                                <input type="file" name="csv_file" id="csv_file" accept=".csv"><br><br>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger rounded-btn"
                                                        data-dismiss="modal">Close
                                                </button>
                                                <button type="submit" class="btn btn-primary rounded-btn">Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view('backend/footer'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#getAtdReport").click(function (e) {
            e.preventDefault(e);

            var date_from = $("input[name='date_from']").val();
            var date_to = $("input[name='date_to']").val();
            var employee_id = $('#employee_id').val();

            if (!date_from) {
                alert('Please select From Date!');
                return;
            }
            if (!date_to) {
                alert('Please select Date To!');
                return;
            }


            $("#table-area").empty();
            $.ajax({
                url: 'getAttendanceByDate',
                method: 'POST',
                data: {
                    date_from: date_from,
                    date_to: date_to,
                    employee_id: employee_id
                }
            }).done(function (response) {
                $("#data_table_example tbody").empty();
                let tableData = JSON.parse(response);

                let table = '<table id="data_table_example" class="display table dataTable table-striped table-bordered">';
                let thead = "<thead><tr>" +
                            "<th>Employee ID</th>" +
                            "<th>Employee Name</th>" +
                            "<th>Department Name</th>" +
                            "<th>Date</th>" +
                            "<th>Sign In</th>" +
                            "<th>Sign Out</th>" +
                            "<th>Working Hour</th>" +
                            "<th>Action</th>" +
                            "</tr></thead>";
                var tbody = "<tbody>";
                $.each(tableData.attendance, function (index, item) {
                    let tr = "<tr>";
                    tr += "<td>" + item.emp_id + "</td>";
                    tr += "<td>" + item.name + "</td>";
                    tr += "<td>" + item.dept_name + "</td>";
                    tr += "<td>" + item.atten_date + "</td>";
                    tr += "<td>" + item.signin_time + "</td>";
                    tr += "<td>" + item.signout_time + "</td>";
                    tr += "<td>" + item.Hours + "</td>";

                    var td = "<td>";
                    if (item.signout_time == '00:00:00') {
                        td += "<a href='Save_Attendance?A="+ item.id +"' title='Edit' " +
                            "class='btn btn-sm btn-info waves-effect waves-light' data-value='Approve'></a>";
                    }

                    td += "<a href='Save_Attendance?A="+ item.id +"' title='Edit' " +
                        "class='btn btn-primary rounded-btn' data-value='Approve'><i class='fa fa-edit'></i></a>";
                    td += "</td>";

                    tr += td;
                    tr += "</tr>";
                    tbody += tr;
                });

                tbody += "</tbody>";
                table += thead + tbody + "</table>";

                $("#table-area").append(table);
                $('#data_table_example').DataTable({
                    dom       : 'Bfrtip',
                    buttons   : [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    responsive: true
                });
            });
        });
    });

    function getEmployeeDeptWise(){
        let dept_id = $("#depid").val();
        
        $.ajax({
            url     : "<?php echo base_url();?>Employee/getEmployeeByDeptId",
            type    : "POST",
            dataType: 'json',
            data    : {
                "dept_id": dept_id,
            },
            success : function (response){
                console.log(response, " :276");
                $("select[name='emid'] option")
                    .not(":eq(0)")
                    .remove();
                $.each(response.employee, function (key, value){
                    $('select[name="emid"]')
                        .append($("<option></option>")
                            .attr("value", value.em_id)
                            .text(value.first_name + " " + value.last_name));
                });
            },
            error   : function (response){
            
            }
        });
    }
</script>
