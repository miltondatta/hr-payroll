<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Grant Loan</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Grant Loan</a></li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-3">
                <?php if($this->session->flashdata('feedback')){ ?>
                    <div class="alert alert-success alert-dismissible show" role="alert">
                        <strong><?php echo $this->session->flashdata('feedback'); ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php } ?>
                <?php if($this->session->flashdata('error')){ ?>
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
                                <h4 class="card-title">Loan List</h4>

                                <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                        data-target="#loanmodal" onclick="emptyInputValue()">
                                    <i class="fa fa-plus"></i>
                                    <span class="d-inline-block pl-1">Add Loan</span>
                                </button>
                            </div>

                            <div class="card-body form-material row ">
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
                                <div class="form-group col-md-3">
                                    <input type="text" name="loan_no" id="loan_no"
                                           class="form-control loan_no" placeholder="Loan No">
                                </div>
                                <div class="col-md-3 form-group">
                                    <button type="button" class="btn btn-primary find_load" id="find_loan"
                                            onclick="getFilterData()">Find Loan
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive" id="loan-table-area">
                                    <table id="data_table_example" data-page-length='10'
                                           class="display table dataTable table-striped table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Employee Code</th>
                                            <th>Loan Number</th>
                                            <th>Amount</th>
                                            <th>Installment</th>
                                            <th>Total Pay</th>
                                            <th>Total Due</th>
                                            <th>Approve Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        <?php foreach($loanview as $value): ?>
                                            <tr>
                                                <td><?php echo $value->first_name . ' ' . $value->last_name ?></td>
                                                <td><?php echo $value->em_code ?></td>
                                                <td><?php echo $value->loan_number ?></td>
                                                <td><?php echo $value->amount ?></td>
                                                <td><?php echo $value->installment ?></td>
                                                <td><?php echo $value->total_pay ?></td>
                                                <td><?php echo $value->total_due ?></td>
                                                <td><?php echo $value->approve_date ?></td>
                                                <td><?php echo $value->status ?></td>
                                                <td>
                                                    <button class="btn btn-primary rounded-btn"
                                                            onclick="editLoanDetails(<?php echo $value->id ?>)">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
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
                    <h5 class="modal-title" id="myLargeModalLabel10">Loan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" method="post" action="add_loan" id="btnSubmit">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Assign To</label>
                            <select class="form-control col-md-8"
                                    data-placeholder="Choose a Category" tabindex="1" name="emid" required>
                                <option value="">Select Here</option>
                                <?php foreach($employee as $value): ?>
                                    <option value="<?php echo $value->em_id; ?>"><?php echo $value->first_name . ' ' .
                                                                                            $value->last_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Amount</label>
                            <input type="number" name="amount" value="" class="form-control col-md-8 amount"
                                   id="recipient-name1" required>
                        </div>
                        <!--<div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Interest Percentage</label>
                            <input type="number" name="interest" value="" class="form-control col-md-8"
                                   id="recipient-name1" required>
                        </div>-->
                        <div class="form-group row">
                            <label class="control-label col-md-3">Approve Date</label>
                            <input type="text" name="appdate" class="form-control col-md-8"
                                   id="calendar-month" value="" data-format="yyyy-mm-dd" required>
                            <!--<div id="datepicker-center">
                                <div id='calendar-month'></div>
                            </div>-->
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Install Period</label>
                            <input type="number" name="install" value="" class="form-control col-md-8 period"
                                   id="recipient-name1" required>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Install Amount</label>
                            <input type="number" name="installment" value=""
                                   class="form-control col-md-8 installment" id="recipient-name1" readonly>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3"> Loan No</label>
                            <input type="text" name="loanno" value="<?php echo rand(100000, 56000000) ?>"
                                   class="form-control col-md-8" id="recipient-name1" readonly>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Status</label>
                            <select class="form-control col-md-8"
                                    data-placeholder="Choose a Category" tabindex="1" name="status" value=""
                                    required>
                                <option value="">Select here</option>
                                <option value="Granted">Granted</option>
                                <option value="Deny">Deny</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Loan Details</label>
                            <textarea class="form-control col-md-8" name="details" value=""
                                      id="message-text1"></textarea>
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
<script type="text/javascript">
    $('.amount, .period').on('input', function (){
        var amount = parseInt($('.amount').val());
        var period = parseFloat($('.period').val());
        $('.installment').val((amount / period ? amount / period : 0).toFixed(2));
    });
</script>
<script type="text/javascript">
    /*$(document).ready(function (){
     $(".loanmodalclass").click(function (e){
     e.preventDefault(e);
     // Get the record's ID via attribute
     var id = $(this).attr('data-id');
     $('#btnSubmit').trigger("reset");
     $('#loanmodal').modal('show');
     $.ajax({
     url     : 'LoanByID?id=' + id,
     method  : 'GET',
     data    : '',
     dataType: 'json',
     }).done(function (response){
     console.log(response);
     // Populate the form fields with the data returned from server
     $('#btnSubmit').find('[name="emid"]').val(response.loanvalue.emp_id).end();
     $('#btnSubmit').find('[name="id"]').val(response.loanvalue.id).end();
     $('#btnSubmit').find('[name="details"]').val(response.loanvalue.loan_details).end();
     $('#btnSubmit').find('[name="appdate"]').val(response.loanvalue.approve_date).end();
     $('#btnSubmit').find('[name="redate"]').val(response.loanvalue.repayment_from).end();
     $('#btnSubmit').find('[name="amount"]').val(response.loanvalue.amount).end();
     /!* $('#btnSubmit').find('[name="interest"]').val(response.loanvalue.interest_percentage).end();*!/
     $('#btnSubmit').find('[name="install"]').val(response.loanvalue.install_period).end();
     $('#btnSubmit').find('[name="installment"]').val(response.loanvalue.installment).end();
     $('#btnSubmit').find('[name="loanno"]').val(response.loanvalue.loan_number).end();
     $('#btnSubmit').find('[name="status"]').val(response.loanvalue.status).end();
     });
     });
     });*/
    
    function editLoanDetails(id){
        $('#btnSubmit').trigger("reset");
        $('#loanmodal').modal('show');
        $.ajax({
            url     : 'LoanByID?id=' + id,
            method  : 'GET',
            data    : '',
            dataType: 'json',
        }).done(function (response){
            console.log(response);
            // Populate the form fields with the data returned from server
            $('#btnSubmit').find('[name="emid"]').val(response.loanvalue.emp_id).end();
            $('#btnSubmit').find('[name="id"]').val(response.loanvalue.id).end();
            $('#btnSubmit').find('[name="details"]').val(response.loanvalue.loan_details).end();
            $('#btnSubmit').find('[name="appdate"]').val(response.loanvalue.approve_date).end();
            $('#btnSubmit').find('[name="redate"]').val(response.loanvalue.repayment_from).end();
            $('#btnSubmit').find('[name="amount"]').val(response.loanvalue.amount).end();
            /!* $('#btnSubmit').find('[name="interest"]').val(response.loanvalue.interest_percentage).end();*!/
            $('#btnSubmit').find('[name="install"]').val(response.loanvalue.install_period).end();
            $('#btnSubmit').find('[name="installment"]').val(response.loanvalue.installment).end();
            $('#btnSubmit').find('[name="loanno"]').val(response.loanvalue.loan_number).end();
            $('#btnSubmit').find('[name="status"]').val(response.loanvalue.status).end();
        });
    }
    
    function emptyInputValue(){
        $('#btnSubmit').find('[name="emid"]').val('').end();
        $('#btnSubmit').find('[name="id"]').val('').end();
        $('#btnSubmit').find('[name="details"]').val('').end();
        $('#btnSubmit').find('[name="appdate"]').val('').end();
        $('#btnSubmit').find('[name="redate"]').val('').end();
        $('#btnSubmit').find('[name="amount"]').val('').end();
        $('#btnSubmit').find('[name="install"]').val('').end();
        $('#btnSubmit').find('[name="installment"]').val('').end();
        $('#btnSubmit').find('[name="status"]').val('').end();
        /* $('#btnSubmit').find('[name="interest"]').val('').end();*/
    }
    
    function getFilterData(){
        var employee_id = $('#employee_id').val();
        var loan_no     = $('#loan_no').val();
        
        $("#loan-table-area").empty();
        $.ajax({
            url   : 'filterView',
            method: 'POST',
            data  : {
                loan_no    : loan_no,
                employee_id: employee_id
            }
        }).done(function (response){
            $("#data_table_example tbody").empty();
            let tableData = JSON.parse(response);
            
            let table = '<table id="data_table_example" class="display table dataTable table-striped table-bordered text-center">';
            let thead = "<thead><tr><th>Name</th>" +
                "<th>Employee Code</th>" +
                "<th>Loan Number</th>" +
                "<th>Amount</th>" +
                "<th>Installment</th>" +
                "<th>Total Pay</th>" +
                "<th>Total Due</th>" +
                "<th>Approve Date</th>" +
                "<th>Status</th>" +
                "<th>Action</th></tr></thead>";
            
            var tbody = "<tbody>";
            $.each(tableData.loan_data, function (index, item){
                let tr = "<tr>";
                tr += "<td>" + item.first_name + ' ' + item.last_name + "</td>";
                tr += "<td>" + item.em_code + "</td>";
                tr += "<td>" + item.loan_number + "</td>";
                tr += "<td>" + item.amount + "</td>";
                tr += "<td>" + item.installment + "</td>";
                tr += "<td>" + item.total_pay + "</td>";
                tr += "<td>" + item.total_due + "</td>";
                tr += "<td>" + item.approve_date + "</td>";
                tr += "<td>" + item.status + "</td>";
                
                tr += "<td>" + '<button class="btn btn-primary rounded-btn" onclick="editLoanDetails(' + item.id + ')">\n' +
                    '                                                        <i class="fa fa-edit"></i>\n' +
                    '                                                    </button>' + "</td>";
                tr += "</tr>";
                tbody += tr;
            });
            
            tbody += "</tbody>";
            table += thead + tbody + "</table>";
            
            $("#loan-table-area").append(table);
            
            $("#data_table_example").DataTable({
                dom       : 'Bfrtip',
                buttons   : [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                responsive: true
            });
        });
    }

</script>
