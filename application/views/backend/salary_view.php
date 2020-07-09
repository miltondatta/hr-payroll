<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Payroll View</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>Payroll/Salary_List">Payroll</a></li>
                            <li class="breadcrumb-item active">Payroll View</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  mt-3">
                    <div class="pb-2">
                        <a class="btn btn-primary text-white"
                           href="<?php echo base_url(); ?>Payroll/Salary_Type">
                            <i class="fa fa-bars"></i>
                            Payroll List
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="fa fa-compass" aria-hidden="true"></i>Monthly Payroll List
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form method="post" action="" id="salaryform" class="form-material row">
                                                <div class="form-group col-md-4">
                                                    <select class="form-control custom-select"
                                                            data-placeholder="Choose a Category" tabindex="1" id="depid"
                                                            name="depid" style="margin-top: 21px;" required>
                                                        <option value="">Department
                                                        </option>
                                                        <?php foreach($department as $value): ?>
                                                            <option value="<?php echo $value->id; ?>">
                                                                <?php echo $value->dep_name; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb-3">
                                                            <input name="datetime"
                                                                   class="form-control mydatetimepickerFull"
                                                                   id="calendar-month_moth_view" value=""
                                                                   placeholder="Month" autocomplete="off" required />
                                                            <div class="input-group-append">
                                                        <span class="input-group-text bg-transparent border-left-0"
                                                              id="basic-email"><i class="fa fa-calendar"></i>
                                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <button style="float:left;margin-top:23px" type="submit"
                                                            id="BtnSubmit"
                                                            class="btn btn-primary">Submit
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive mt-3">
                                <table id="data_table_example"
                                       class="display table dataTable table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>PIN</th>
                                        <th>Full name</th>
                                        <th>Total salary</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="payroll">

                                    </tbody>
                                </table>

                                <script>
                                    // Populate the payroll table to generate the payroll for each individual
                                    $("#BtnSubmit").on("click", function (event){
                                        event.preventDefault();
                                        var depid    = $('#depid').val();
                                        var datetime = $('#calendar-month_moth_view').val();
                                        if (depid != '' && datetime != ''){
                                            $.ajax({
                                                url     : "load_employee_by_deptID_for_pay?date_time=" + datetime + "&dep_id=" + depid,
                                                type    : "GET",
                                                dataType: '',
                                                data    : 'data',
                                                success : function (response){
                                                    // console.log(response);
                                                    $('.payroll').html(response);
                                                },
                                                error   : function (response){
                                                
                                                }
                                            });
                                        } else{
                                            console.log("jkj", " :133");
                                            alert("Department and Month is required");
                                        }
                                        
                                    });
                                </script>

                                <!-- sample modal content -->
                                <div class="modal" id="generatePayrollModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="">Salary Setup
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                          <span aria-hidden="true">&times;
                                                          </span>
                                                </button>
                                            </div>
                                            <form method="post" action="pay_salary_add_record" id="generatePayrollForm"
                                                  enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label class="control-label text-left col-md-3">Employee</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control custom-select"
                                                                    data-placeholder="Choose a Category"
                                                                    id="emid" tabindex="1" name="emid" id="OnEmValue"
                                                                    required>
                                                                <option value="#">Select Here
                                                                </option>
                                                                <?php foreach($employee as $value): ?>
                                                                    <option value="<?php echo $value->em_id; ?>">
                                                                        <?php echo $value->first_name . ' ' .
                                                                                   $value->last_name; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label text-left col-md-3">Month
                                                        </label>
                                                        <div class="col-md-9">
                                                            <input type="hidden" name="year">
                                                            <select class="form-control custom-select"
                                                                    data-placeholder="Choose a Category"
                                                                    tabindex="1" name="month" id="salaryMonth" required>
                                                                <option value="#">Select Here
                                                                </option>
                                                                <option value="1">January
                                                                </option>
                                                                <option value="2">February
                                                                </option>
                                                                <option value="3">March
                                                                </option>
                                                                <option value="4">April
                                                                </option>
                                                                <option value="5">May
                                                                </option>
                                                                <option value="6">June
                                                                </option>
                                                                <option value="7">July
                                                                </option>
                                                                <option value="8">August
                                                                </option>
                                                                <option value="9">September
                                                                </option>
                                                                <option value="10">October
                                                                </option>
                                                                <option value="11">November
                                                                </option>
                                                                <option value="12">December
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row well">
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Total Salary
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="text" name="total_salary"
                                                                           class="form-control total_salary"
                                                                           id="total_salary" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    House Rent
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="text" name="house_rent"
                                                                           class="form-control house_rent" value=""
                                                                           readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Medical
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="text" name="medical"
                                                                           class="form-control medical" value=""
                                                                           readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Hourly Rate
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="number" name="hourly_rate"
                                                                           class="form-control hourly_rate" value=0>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Bima
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="number" name="bima"
                                                                           class="form-control bima" value=0>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Tax
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="number" name="tax"
                                                                           class="form-control tax" value=0>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">Final
                                                                                                                Salary
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="text" name="total_paid"
                                                                           class="form-control total_paid" id=""
                                                                           value="" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Pay Date</label>
                                                                <div class="input-group col-md-7 ">
                                                                    <input name="paydate"
                                                                           class="form-control mydatetimepickerFull"
                                                                           style="z-index:999999 !important;"
                                                                           id="calendar-month"
                                                                           value="" required autocomplete="off">
                                                                    <div class="input-group-append">
                                                            <span class="input-group-text bg-transparent border-left-0"
                                                                  id="basic-email"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row" style="margin-top: 25px;">
                                                                <label class="control-label text-left col-md-3">
                                                                    Paid Type</label><br>
                                                                <div class="col-md-9">
                                                                    <input name="paid_type" type="radio" id="radio_3"
                                                                           data-value="Hand Cash" class=""
                                                                           value="Hand Cash" checked="checked">
                                                                    <label for="radio_3"
                                                                           style="margin-left: 5px;margin-right: 5px">Hand
                                                                                                                      Cash</label>
                                                                    <input name="paid_type" type="radio" id="radio_4"
                                                                           data-value="Bank" class="type"
                                                                           value="Bank">
                                                                    <label for="radio_4"
                                                                           style="margin-left: 5px">Bank</label>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-3">Status</label><br>
                                                                <div class="col-md-7">
                                                                    <input name="status" type="radio" id="radio_1"
                                                                           data-value="Paid"
                                                                           class="duration" value="Paid"
                                                                           checked="checked">
                                                                    <label for="radio_1"
                                                                           style="margin-left: 5px;margin-right: 5px">Paid</label>
                                                                    <input name="status" type="radio" id="radio_2"
                                                                           data-value="Process" class="type"
                                                                           value="Process">
                                                                    <label for="radio_2" style="margin-left: 5px">Process</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Basic Salary
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="text" name="basic" class="form-control"
                                                                           id="" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Conveyance
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="text" name="conveyance"
                                                                           class="form-control"
                                                                           id="" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="loan">
                                                                <label class="control-label text-left col-md-5">Loan
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="text" name="loan"
                                                                           class="form-control loan" id="" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Hours Workd
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="number" name="hours_worked"
                                                                           class="form-control hours_worked" value=0>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Provident Fund
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="number" name="provident_fund"
                                                                           class="form-control provident_fund" value=0>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Others
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="number" name="others"
                                                                           class="form-control others" value=0>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Diduction
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <input type="number" name="diduction"
                                                                           class="form-control diduction" value=0>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="control-label text-left col-md-5">
                                                                    Comments
                                                                </label>
                                                                <div class="col-md-7">
                                                                    <textarea name="comments" id="comments" cols="25"
                                                                              rows="5"></textarea>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="action" value="add" class="form-control"
                                                           id="formAction">
                                                    <input type="hidden" name="loan_id" value="" class="form-control"
                                                           id="loanID">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Submit
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
        $(document).ready(function (){
            $(document).on('change', '.hours_worked', function (){
                calculateTotalSalary();
            });
            $(document).on('change', '.hourly_rate', function (){
                calculateTotalSalary();
            });
            
            $(document).on('change', '.diduction', function (){
                calculateTotalSalary();
            });
            
            function calculateTotalSalary(){
                var total_salary   = parseFloat($('.total_salary').val());
                var loan           = parseFloat($('.loan').val());
                var hrate          = parseFloat($('.hourly_rate').val());
                var hwork          = parseFloat($('.hours_worked').val());
                var diduction      = parseFloat($('.diduction').val());
                var bima           = parseFloat($('.bima').val());
                var provident_fund = parseFloat($('.provident_fund').val());
                var tax            = parseFloat($('.tax').val());
                var others         = parseFloat($('.others').val());
                
                var over_time_tk = (hrate * hwork);
                var final_salary = total_salary + over_time_tk - (diduction + loan + bima + provident_fund + tax + others);
                
                $(".total_paid").val(final_salary.toFixed(2));
            }
        });
    </script>
    <script type="text/javascript">
        // Populate salary data on generate salary click
        $(document).ready(function (){
            
            $(document).on('click', ".salaryGenerateModal", function (e){
                e.preventDefault(e);
                
                $('#generatePayrollModal').modal('show');
                
                var emid     = $(this).data('id');
                var month    = $(this).data('month');
                var year     = $(this).data('year');
                var has_loan = $(this).data('has_loan');
                
                $('#generatePayrollForm').find('[name="emid"]').val(emid).attr('readonly', true).end();
                $('#generatePayrollForm').find('[name="month"]').val(Math.abs(month)).attr('readonly', true).end();
                
                $.ajax({
                    url     : 'generate_payroll_for_each_employee?month=' + month + '&year=' + year + '&employeeID=' + emid,
                    method  : 'GET',
                    data    : '',
                    dataType: 'json',
                }).done(function (response){
                    
                    let loan_in           = parseFloat(isNaN(response.loan_amount) || response.loan_amount == '' ? 0 : response.loan_amount);
                    let bima_in           = parseFloat(isNaN(response.bima) || response.bima == '' ? 0 : response.bima);
                    let tax_in            = parseFloat(isNaN(response.tax) || response.tax == '' ? 0 : response.tax);
                    let provident_fund_in = parseFloat(isNaN(response.provident_fund) || response.provident_fund == '' ?
                                                       0 : response.provident_fund);
                    let others_in         = parseFloat(isNaN(response.others) || response.others == '' ? 0 : response.others);
                    let total_in          = parseFloat(isNaN(response.total) ? 0 : response.total);
                    
                    $('#generatePayrollForm').find('[name="basic"]').val(response.basic).attr('readonly', true).end();
                    $('#generatePayrollForm').find('[name="total_salary"]').val(response.total).attr('readonly', true).end();
                    $('#generatePayrollForm').find('[name="medical"]').val(response.medical).attr('readonly', true).end();
                    $('#generatePayrollForm').find('[name="house_rent"]').val(response.house_rent).attr('readonly', true).end();
                    $('#generatePayrollForm').find('[name="paydate"]').val(response.pay_date).attr('readonly', true).end();
                    $('#generatePayrollForm').find('[name="conveyance"]').val(response.conveyance).attr('readonly', true).end();
                    $('#generatePayrollForm').find('[name="loan"]').val(loan_in).prop('readonly', true).end();
                    $('#generatePayrollForm').find('[name="bima"]').val(bima_in).prop('readonly', true).end();
                    $('#generatePayrollForm').find('[name="tax"]').val(tax_in).prop('readonly', true).end();
                    $('#generatePayrollForm').find('[name="provident_fund"]').val(provident_fund_in).prop('readonly', true).end();
                    $('#generatePayrollForm').find('[name="others"]').val(others_in).prop('readonly', true).end();
                    $('#generatePayrollForm').find('[name="total_paid"]').val(total_in - (loan_in + bima_in + tax_in
                        + provident_fund_in + others_in)).prop('readonly', true).end();
                    $('#generatePayrollForm').find('[name="loan_id"]').val(response.loan_id).end();
                    $('#generatePayrollForm').find('[name="year"]').val(year).end();
                });
            });
        });
    </script>

<?php $this->load->view('backend/footer'); ?>