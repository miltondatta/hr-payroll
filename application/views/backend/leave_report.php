<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Leave Report</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        </li>
                        <li class="breadcrumb-item active">Leave Report</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12  mt-3">
                <div class="card">
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
                    </div>
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title"><i class="fa fa-compass" aria-hidden="true"></i>Leave Report List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="report-table">
                            <table id="data-table" data-page-length='5'
                                   class="display table dataTable table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>PIN</th>
                                    <th>Employee</th>
                                    <th>Type</th>
                                    <th>Duration</th>
                                    <th>Start</th>
                                    <th>End</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

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
                url: "Get_LeaveDetails?date_from=" + date_from + "&date_to=" + date_to + "&emp_id=" + emid,
                type: "GET",
                success: function (data) {
                    $("#report-table").empty();
                    $("#report-table").append(data);
                    $('#data-table').DataTable({
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
