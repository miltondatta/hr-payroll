<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Loan Installment</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Loan Installment</a></li>
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
                                <h4 class="card-title">Loan Installment List</h4>

                                <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                        data-target="#loanmodal" onclick="emptyInputValue()">
                                    <i class="fa fa-plus"></i>
                                    <span class="d-inline-block pl-1">Add Loan Installment</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="data-table" data-page-length='10'
                                           class="display table dataTable table-striped table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th>Employee PIN</th>
                                            <th>Loan Id</th>
                                            <th>Loan Number</th>
                                            <th>Install Amount</th>
                                            <!--<th>Pay Amount</th>-->
                                            <th>Approve Date</th>
                                            <th>Receiver</th>
                                            <th>Install No</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        <?php foreach ($installment as $value): ?>
                                            <tr>
                                                <td><?php echo $value->em_code ?></td>
                                                <td><?php echo $value->loan_id ?></td>
                                                <td><?php echo $value->loan_number ?></td>
                                                <td><?php echo $value->install_amount ?></td>
                                                <!--<td><?php #echo $value->pay_amount ?></td>-->
                                                <td><?php echo date('jS \of F Y', strtotime($value->app_date)); ?></td>
                                                <td><?php echo $value->receiver ?></td>
                                                <td><?php echo $value->install_no ?></td>
                                                <td>
                                                    <a class="btn btn-primary rounded-btn installment text-light"
                                                       data-id="<?php echo $value->id ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure to delete this data?')"
                                                       href="<?php echo base_url(); ?>loan/delete_installment/<?php echo $value->id; ?>"
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

    <div class="modal" id="loanmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel10">Loan Installment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" method="post" action="Add_Loan_Installment" id="loanvalueform"
                      enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Assign To</label>
                            <select class="form-control" data-placeholder="Choose a Category" tabindex="1"
                                    name="emid" id="employee" required>
                                <option value="">Select Here</option>
                                <?php foreach ($employee as $value): ?>
                                    <option value="<?php echo $value->em_id; ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Loan Number</label>
                            <input type="text" name="loanno" class="form-control" id="recipient-name1" readonly
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Install Amount</label>
                            <input type="text" name="amount" class="form-control" id="recipient-name1" readonly>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Date</label>
                            <input type="text" name="appdate" class="form-control" id="calendar-month"
                                   data-format="yyyy-mm-dd" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Receiver</label>
                            <input type="text" name="receiver" class="form-control" id="recipient-name1" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label"> Install No</label>
                            <input type="text" name="installno" class="form-control" id="recipient-name1" readonly
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label"> Notes</label>
                            <textarea class="form-control" name="notes" id="message-text1"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="loanid" value="">
                        <input type="hidden" name="id" value="">
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
        $(".installment").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute
            var id = $(this).attr('data-id');
            $('#loanvalueform').trigger("reset");
            $('#loanmodal').modal('show');
            $.ajax({
                url: 'LoanByID?id=' + id,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function (response) {
                console.log(response);
                // Populate the form fields with the data returned from server
                $('#loanvalueform').find('[name="id"]').val(response.loanvalueinstallment.id).end();
                $('#loanvalueform').find('[name="loanid"]').val(response.loanvalueinstallment.loan_id).end();
                $('#loanvalueform').find('[name="emid"]').val(response.loanvalueinstallment.emp_id).end();
                $('#loanvalueform').find('[name="loanno"]').val(response.loanvalueinstallment.loan_number).end();
                $('#loanvalueform').find('[name="amount"]').val(response.loanvalueinstallment.install_amount).end();
                $('#loanvalueform').find('[name="appdate"]').val(response.loanvalueinstallment.app_date).end();
                $('#loanvalueform').find('[name="receiver"]').val(response.loanvalueinstallment.receiver).end();
                $('#loanvalueform').find('[name="installno"]').val(response.loanvalueinstallment.install_no).end();
                $('#loanvalueform').find('[name="notes"]').val(response.loanvalueinstallment.notes).end();
            });
        });
    });

    function emptyInputValue() {
        $('#loanvalueform').find('[name="id"]').val('').end();
        $('#loanvalueform').find('[name="loanid"]').val('').end();
        $('#loanvalueform').find('[name="emid"]').val('').end();
        $('#loanvalueform').find('[name="amount"]').val('').end();
        $('#loanvalueform').find('[name="appdate"]').val('').end();
        $('#loanvalueform').find('[name="receiver"]').val('').end();
        $('#loanvalueform').find('[name="installno"]').val('').end();
        $('#loanvalueform').find('[name="notes"]').val('').end();
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#employee").change(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute
            var iid = +this.value;
            //console.log(this.value);
            $("#loanvalueform").change();
            //$('#salaryform').trigger("reset");
            $.ajax({
                url: 'LoanByID?id=' + this.value,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function (response) {
                console.log(response);
                // Populate the form fields with the data returned from server
                if (response.loanvalueem == null) {
                    $('#loanvalueform').find('[class="form-control"]').val("", "true").end();
                }
                $('#loanvalueform').find('[name="loanid"]').val(response.loanvalueem.id).end();
                $('#loanvalueform').find('[name="amount"]').val(response.loanvalueem.installment).end();
                $('#loanvalueform').find('[name="loanno"]').val(response.loanvalueem.loan_number).end();
                $('#loanvalueform').find('[name="installno"]').val(response.loanvalueem.install_period).end();
            });
        });
    });
</script>
<?php $this->load->view('backend/footer'); ?>
