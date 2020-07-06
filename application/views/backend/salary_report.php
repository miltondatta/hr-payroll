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
                            </li>
                            <li class="breadcrumb-item active">Payroll View</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3">
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
                            <form method="post" action="" id="salaryform" class="form-material row">
                                <div class="form-group col-md-3">
                                    <select class="form-control custom-select" tabindex="1" name="emid"
                                            id="emid" style="margin-top: 23px" required>
                                        <option>Employee</option>
                                        <?php foreach($employee as $value): ?>
                                            <option value="<?php echo $value->em_id; ?>">
                                                <?php echo $value->first_name ?>
                                                <?php echo $value->last_name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>
                                    </label>
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <input name="date_time"
                                                   class="form-control mydatetimepickerFull"
                                                   id="calendar-month_moth_view" value=""
                                                   placeholder="Month" />
                                            <div class="input-group-append">
                                                        <span class="input-group-text bg-transparent border-left-0"
                                                              id="basic-email"><i class="fa fa-calendar"></i>
                                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <button style="float:left;margin-top:23px" type="submit" id="BtnSubmit"
                                            class="btn btn-primary">Submit
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <div class="salaryr">

                            </div>
                            <div class="col-md-2">
                                <button type='button' class='btn btn-primary print_payslip_btn' id='print_payslip_btn'>
                                    <i
                                            class='fa fa-print'></i><i class='' aria-hidden='true'
                                                                       onclick='printDiv()'></i>
                                    Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $('.print_payslip_btn').hide();
        $("#BtnSubmit").on("click", function (event){
            event.preventDefault();
            var emid     = $('#emid').val();
            var datetime = $('.mydatetimepickerFull').val();
            
            $.ajax({
                url     : "load_employee_Invoice_by_EmId_for_pay?date_time=" + datetime + "&emid=" + emid,
                type    : "GET",
                dataType: '',
                data    : 'data',
                success : function (response){
                    // console.log(response);
                    $('.salaryr').html(response);
                    $('.print_payslip_btn').show();
                },
                error   : function (response){
                
                }
            });
        });
    </script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.PrintArea.js" type="text/JavaScript"></script>
    <script>

        (function ($){
            $(".print_payslip_btn").click(function (){
                var mode    = 'iframe'; //popup
                var close   = mode == "popup";
                var options = {
                    mode    : mode,
                    popClose: close
                };
                $("#payslip_print").printArea(options);
            });
        })(jQuery);
    </script>
<?php $this->load->view('backend/footer'); ?>