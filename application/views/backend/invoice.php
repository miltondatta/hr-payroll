<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<?php $settingsvalue = $this->settings_model->GetSettingsValue(); ?>
    <script src="<?php echo base_url(); ?>assets/js/jquery.PrintArea.js" type="text/JavaScript"></script>
    <style type="text/css">
        table.table.table-hover thead {
            background-color: #e8e8e8;
            }
    </style>

    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Invoice</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12  mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a
                                            href="<?php echo base_url(); ?>Payroll/Salary_List" class="text-white"><i
                                                class=""
                                                aria-hidden="true"></i>
                                        Back</a></button>
                                <button type="button" class="btn btn-primary print_payslip_btn"><i
                                            class="fa fa-print"></i><i class=""
                                                                       aria-hidden="true"
                                                                       onclick="printDiv()"></i>
                                    Print
                                </button>
                            </div>
                        </div>
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Invoice</h4>
                        </div>
                        <div class="card-body payslip_print" id="payslip_print">
                            <div class="row">
                                <div class="col-md-4 col-xs-6 col-sm-6">
                                    <img src="<?php echo base_url(); ?>assets/images/<?php echo $settingsvalue->sitelogo; ?>"
                                         style=" width:180px; margin-right: 10px;" />
                                </div>
                                <div class="col-md-8 col-xs-6 col-sm-6 text-left payslip_address">
                                    <p>
                                        <?php echo $settingsvalue->address; ?>
                                    </p>
                                    <p>
                                        <?php echo $settingsvalue->address2; ?>
                                    </p>
                                    <p>
                                        Phone: <?php echo $settingsvalue->contact; ?>,
                                        Email: <?php echo $settingsvalue->system_email; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <h5 style="margin-top: 15px;">Payslip for the period
                                                                  of <?php echo $salary_info->month .
                                                                                ' ' .
                                                                                $salary_info->year ?></h5>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-md-12">
                                    <?php $obj_merged =
                                        (object)array_merge((array)$employee_info, (array)$salaryvaluebyid,
                                                            (array)$salarypaybyid, (array)$salaryvalue,
                                                            (array)$loanvaluebyid); ?>

                                    <table class="table table-condensed borderless payslip_info">
                                        <tr>
                                            <td>Employee PIN</td>
                                            <td>: <?php echo $obj_merged->em_code; ?></td>
                                            <td>Employee Name</td>
                                            <td>
                                                : <?php echo $obj_merged->first_name; ?> <?php echo $obj_merged->last_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Department</td>
                                            <td>: <?php echo $otherInfo[0]->dep_name; ?></td>
                                            <td>Designation</td>
                                            <td>: <?php echo $otherInfo[0]->name; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pay Date</td>
                                            <td>: <?php echo date('j F Y', strtotime($salary_info->paid_date)); ?></td>
                                            <td>Date of Joining</td>
                                            <td>: <?php echo $obj_merged->em_joining_date; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Days Worked</td>
                                            <td>:
                                                <?php
                                                $t_days = $salary_info->total_days ?? 0;
                                                $days = ceil( $t_days / 8);
                                                echo $days;
                                                ?>
                                            </td>
                                            <?php if( !empty($bankinfo->bank_name)){ ?>
                                                <td>Bank Name</td>
                                                <td>: <?php echo $bankinfo->bank_name; ?></td>
                                            <?php } else{ ?>
                                                <td>Pay Type</td>
                                                <td>: <?php echo 'Hand Cash'; ?></td>
                                            <?php } ?>
                                        </tr>
                                        <?php if( !empty($bankinfo->bank_name)){ ?>
                                            <tr>
                                                <td>Account Name</td>
                                                <td>: <?php echo $bankinfo->holder_name; ?></td>
                                                <td>Account Number</td>
                                                <td>: <?php echo $bankinfo->account_number; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                            <style>
                                .table-condensed > thead > tr > th, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > tbody > tr > td, .table-condensed > tfoot > tr > td { padding: 2px 5px; }
                            </style>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-condensed borderless"
                                           style="border-left: 1px solid #ececec;">
                                        <thead class="thead-light" style="border: 1px solid #ececec;">
                                        <tr>
                                            <th>Description</th>
                                            <th class="text-right">Earnings</th>
                                            <th class="text-right">Deductions</th>
                                        </tr>
                                        </thead>
                                        <tbody style="border: 1px solid #ececec;">
                                        <tr>
                                            <td>Basic Salary</td>
                                            <td class="text-right"><?php echo $addition[0]->basic ?? 0; ?> BDT</td>
                                            <td class="text-right"></td>
                                        </tr>
                                        <tr>
                                            <td>Madical Allowance</td>
                                            <td class="text-right"> <?php echo $addition[0]->medical ?? 0; ?> BDT</td>
                                            <td class="text-right"></td>
                                        </tr>
                                        <tr>
                                            <td>House Rent</td>
                                            <td class="text-right"><?php echo $addition[0]->house_rent ?? 0; ?> BDT</td>
                                            <td class="text-right"></td>
                                        </tr>
                                        <tr>
                                            <td>Conveyance Allowance</td>
                                            <td class="text-right"><?php echo $addition[0]->conveyance ?? 0; ?> BDT</td>
                                            <td class="text-right"></td>
                                        </tr>
                                        <tr>
                                            <td>Bonus</td>
                                            <td class="text-right"><?php echo $salary_info->bonus ?? 0; ?></td>
                                            <td class="text-right"></td>
                                        </tr>
                                        <tr>
                                            <td>Loan</td>
                                            <td class="text-right"></td>
                                            <td class="text-right"><?php if( !empty($salary_info->loan)){
                                                    echo $salary_info->loan . " BDT";
                                                } ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Working Hour (<?php echo $salary_info->total_days ?? 0; ?> hrs)</td>
                                            <td class="text-right">
                                                <?php
                                                if($a > 0){
                                                    echo round($a, 2) . ' BDT';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-right">
                                                <?php
                                                if($d > 0){
                                                    echo round($d, 2) . ' BDT';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tax</td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                        </tr>
                                        </tbody>
                                        <tfoot class="tfoot-light">
                                        <tr>
                                            <th>Total</th>
                                            <th class="text-right"><?php $total_add =
                                                    $salary_info->basic + $salary_info->medical +
                                                    $salary_info->house_rent +
                                                    $salary_info->bonus + $a;
                                                echo round($total_add, 2); ?> BDT
                                            </th>
                                            <th class="text-right"><?php $total_did =
                                                    $salary_info->loan + $salary_info->diduction;
                                                echo round($total_did, 2); ?> BDT
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th class="text-right">Net Pay</th>
                                            <th class="text-right"><?php echo $salary_info->total_pay ?? 0 ; ?> BDT
                                            </th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="Salarymodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel1">Salary Form</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="post" action="Add_Salary" id="salaryform" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="control-label">Employee Id</label>
                                    <input type="text" name="emid" class="form-control" id="recipient-name1" value=""
                                           readonly>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Basic</label>
                                    <input type="text" name="basic" class="form-control" id="recipient-name1" value="">
                                </div>
                                <h4>Addition</h4>
                                <div class="form-group">
                                    <label class="control-label">Medical</label>
                                    <input type="text" name="medical" class="form-control" id="recipient-name1"
                                           value="">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">House Rent</label>
                                    <input type="text" name="houserent" class="form-control" id="recipient-name1"
                                           value="">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Bonus</label>
                                    <input type="text" name="bonus" class="form-control" id="recipient-name1" value="">
                                </div>
                                <h4>Deduction</h4>
                                <div class="form-group">
                                    <label class="control-label">Provident Fund</label>
                                    <input type="text" name="provident" class="form-control" id="recipient-name1"
                                           value="">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Bima</label>
                                    <input type="text" name="bima" class="form-control" id="recipient-name1" value="">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Tax</label>
                                    <input type="text" name="tax" class="form-control" id="recipient-name1" value="">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Others</label>
                                    <input type="text" name="others" class="form-control" id="recipient-name1" value="">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="sid" value="" class="form-control" id="recipient-name1">
                                <input type="hidden" name="aid" value="" class="form-control" id="recipient-name1">
                                <input type="hidden" name="did" value="" class="form-control" id="recipient-name1">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(document).ready(function (){
            $(".SalarylistModal").click(function (e){
                e.preventDefault(e);
                // Get the record's ID via attribute
                var iid = $(this).attr('data-id');
                $('#salaryform').trigger("reset");
                $('#Salarymodel').modal('show');
                $.ajax({
                    url     : 'GetSallaryById?id=' + iid,
                    method  : 'GET',
                    data    : '',
                    dataType: 'json',
                }).done(function (response){
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('#salaryform').find('[name="sid"]').val(response.salaryvalue.id).end();
                    $('#salaryform').find('[name="aid"]').val(response.salaryvalue.addi_id).end();
                    $('#salaryform').find('[name="did"]').val(response.salaryvalue.de_id).end();
                    /* $('#salaryform').find('[name="typeid"]').val(response.salaryvalue.type_id).end();*/
                    $('#salaryform').find('[name="emid"]').val(response.salaryvalue.emp_id).end();
                    $('#salaryform').find('[name="basic"]').val(response.salaryvalue.basic).end();
                    $('#salaryform').find('[name="medical"]').val(response.salaryvalue.medical).end();
                    $('#salaryform').find('[name="houserent"]').val(response.salaryvalue.house_rent).end();
                    $('#salaryform').find('[name="bonus"]').val(response.salaryvalue.bonus).end();
                    $('#salaryform').find('[name="provident"]').val(response.salaryvalue.provident_fund).end();
                    $('#salaryform').find('[name="bima"]').val(response.salaryvalue.bima).end();
                    $('#salaryform').find('[name="tax"]').val(response.salaryvalue.tax).end();
                    $('#salaryform').find('[name="others"]').val(response.salaryvalue.others).end();
                });
            });
        });
    </script>
    <script>
        $(document).ready(function (){
            $("#print").click(function (){
                var mode    = 'iframe'; //popup
                var close   = mode == "popup";
                var options = {
                    mode    : mode,
                    popClose: close
                };
                $("div.printableArea").printArea(options);
            });
        });
    </script>
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