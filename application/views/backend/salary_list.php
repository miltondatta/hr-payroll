<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Payroll</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Payroll</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-3">
                    <?php if($this->session->flashdata('error')){ ?>
                        <div class="alert alert-danger alert-dismissible show" role="alert">
                            <strong><?php echo $this->session->flashdata('error'); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?php } ?>
                    
                    <?php if($this->session->flashdata('success')){ ?>
                        <div class="alert alert-error alert-dismissible show" role="alert">
                            <strong><?php echo $this->session->flashdata('success'); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?php } ?>

                    <div class="pb-2">
                        <a class="btn btn-primary text-white"
                           href="<?php echo base_url(); ?>Payroll/Generate_salary">
                            <i class="fa fa-bars"></i>
                            Generate Payroll
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="fa fa-compass" aria-hidden="true"></i>Payroll List</h4>
                        </div>
                        <div class="form-material ml-2 mt-3 row ">
                            <div class="form-group col-md-3">
                                <select class="form-control custom-select" tabindex="1" name="emid"
                                        id="emid" required>
                                    <option value="">Employee</option>
                                    <?php foreach($employee as $value): ?>
                                        <option value="<?php echo $value->em_id; ?>">
                                            <?php echo $value->first_name ?>
                                            <?php echo $value->last_name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
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
                                <button type="button" class="btn btn-primary find_load" id="find_loan"
                                        onclick="getFilterData()">Find
                                </button>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive" id="table_data">
                                <table id="data_table_example"
                                       class="display table dataTable table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="hide">SL</th>
                                        <th>PIN</th>
                                        <th>Employee</th>
                                        <th>Month</th>
                                        <th>Salary</th>
                                        <th>Loan</th>
                                        <th>Over Time</th>
                                        <th>Deduction</th>
                                        <th>Total Paid</th>
                                        <th>Pay Date</th>
                                        <th>Status</th>
                                        <th class="jsgrid-align-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0;
                                    foreach($salary_info as $individual_info): ?>
                                        <tr>
                                            <td class="hide"><?php $i ++;
                                                echo $i; ?></td>
                                            <td><?php echo $individual_info->em_code; ?></td>
                                            <td><?php echo $individual_info->first_name . ' ' .
                                                           $individual_info->last_name; ?></td>
                                            <td><?php echo $individual_info->month . ' ' .
                                                           $individual_info->year; ?></td>
                                            <td><?php echo $individual_info->total_salary; ?></td>
                                            <td><?php echo $individual_info->loan; ?></td>
                                            <td><?php echo $individual_info->hourly_rate *
                                                           $individual_info->hours_worked; ?></td>
                                            <!--<td><?php echo $individual_info->addition; ?></td>-->
                                            <td><?php echo $individual_info->diduction; ?></td>
                                            <td><?php echo $individual_info->total_pay; ?></td>
                                            <td><?php echo $individual_info->paid_date; ?></td>
                                            <td><?php echo $individual_info->status; ?></td>
                                            <td class="jsgrid-align-center ">
                                                <a href="<?php echo base_url(); ?>payroll/invoice?Id=<?php echo $individual_info->pay_id; ?>&em=<?php echo $individual_info->emp_id; ?>"
                                                   title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i
                                                            class="fa fa-print"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- sample modal content -->
                                <div class="modal" id="Salarymodel" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Salary Form</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form method="post" action="Add_Salary" id="salaryform"
                                                  enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="control-label">Employee Id</label>
                                                        <input type="text" name="emid" class="form-control"
                                                               id="recipient-name1" value=""
                                                               readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Basic</label>
                                                        <input type="text" name="basic" class="form-control"
                                                               id="recipient-name1" value="">
                                                    </div>
                                                    <h4>Addition</h4>
                                                    <div class="form-group">
                                                        <label class="control-label">Medical</label>
                                                        <input type="text" name="medical" class="form-control"
                                                               id="recipient-name1" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">House Rent</label>
                                                        <input type="text" name="houserent" class="form-control"
                                                               id="recipient-name1" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Bonus</label>
                                                        <input type="text" name="bonus" class="form-control"
                                                               id="recipient-name1" value="">
                                                    </div>
                                                    <h4>Deduction</h4>
                                                    <div class="form-group">
                                                        <label class="control-label">Provident Fund</label>
                                                        <input type="text" name="provident" class="form-control"
                                                               id="recipient-name1" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Bima</label>
                                                        <input type="text" name="bima" class="form-control"
                                                               id="recipient-name1" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Tax</label>
                                                        <input type="text" name="tax" class="form-control"
                                                               id="recipient-name1" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Others</label>
                                                        <input type="text" name="others" class="form-control"
                                                               id="recipient-name1" value="">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="sid" value="" class="form-control"
                                                           id="recipient-name1">
                                                    <input type="hidden" name="aid" value="" class="form-control"
                                                           id="recipient-name1">
                                                    <input type="hidden" name="did" value="" class="form-control"
                                                           id="recipient-name1">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    <script type="text/javascript">
        $(document).ready(function (){
            /*var today = new Date();
             var dd = today.getDate();
             var mm = today.getMonth()+1; //January is 0!
             var yyyy = today.getFullYear();

             if(dd<10) {
             dd = '0'+dd
             }

             if(mm<10) {
             mm = '0'+mm
             }

             today = mm + '/' + dd + '/' + yyyy;*/
            var d      = new Date();
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var m      = months[d.getMonth()];
            var y      = d.getFullYear();
//document.write(today);
            var table  = $('#example123').DataTable({
                "aaSorting": [[9, 'desc']],
                dom        : 'Bfrtip',
                buttons    : [
                    {
                        extend   : 'print',
                        title    : 'Salary List' + '<br>' + m + ' ' + y,
                        customize: function (win){
                            $(win.document.body)
                                .css('font-size', '50pt')
                                .prepend(
                                    '<img src="<?php echo base_url()?>assets/images/dRi_watermark.png" style="position:absolute;background-size:300px 300px; top:35%; left:27%;" />'
                                );
                            $(win.document.body)
                                //.css( 'border', 'inherit' )
                                .prepend(
                                    '<footer class="footer" style="border:inherit"><img src="<?php echo base_url();?>assets/images/signature_vice.png" style="position:absolute; top:0; left:0;" /><img src="<?php echo base_url();?>assets/images/signature_ceo.png" style="position:absolute; top:0; right:0;height:30px;" /></footer>'
                                );
                            $(win.document.body).find('h1')
                                                .addClass('header')
                                                .css('display', 'inharit')
                                                .css('position', 'relative')
                                                .css('float', 'right')
                                                .css('font-size', '24px')
                                                .css('font-weight', '700')
                                                .css('margin-right', '15px');
                            $(win.document.body).find('div')
                                                .addClass('header-top')
                                                .css('background-position', 'left top')
                                                .css('height', '100px')
                                                .prepend(
                                                    '<img src="<?php echo base_url()?>assets/images/dri_Logo.png" style="position:absolute;background-size:30%; top:0; left:0;" />'
                                                );
                            $(win.document.body).find('div img')
                                                .addClass('header-img')
                                                .css('width', '300px');
                            $(win.document.body).find('h1')
                                                .addClass('header')
                                                .css('font-size', '25px');
                            
                            $(win.document.body).find('table thead')
                                                .addClass('compact')
                                                .css({
                                                    color     : '#000',
                                                    margin    : '20px',
                                                    background: '#e8e8e8',
                                
                                                });
                            
                            $(win.document.body).find('table thead th')
                                                .addClass('compact')
                                                .css({
                                                    color  : '#000',
                                                    border : '1px solid #000',
                                                    padding: '15px 12px',
                                                    width  : '8%'
                                                });
                            
                            $(win.document.body).find('table tr td')
                                                .addClass('compact')
                                                .css({
                                                    color : '#000',
                                                    margin: '20px',
                                                    border: '1px solid #000'
                                
                                                });
                            
                            $(win.document.body).find('table thead th:nth-child(3)')
                                                .addClass('compact')
                                                .css({
                                                    width: '15%',
                                                });
                            
                            $(win.document.body).find('table thead th:nth-child(1)')
                                                .addClass('compact')
                                                .css({
                                                    width: '1%',
                                                });
                            
                            $(win.document.body).find('table thead th:nth-child(2)')
                                                .addClass('compact')
                                                .css({
                                                    width: '5%',
                                                });
                            
                            $(win.document.body).find('table thead th:last-child')
                                                .addClass('compact')
                                                .css({
                                                    display: 'none',
                                
                                                });
                            
                            $(win.document.body).find('table tr td:last-child')
                                                .addClass('compact')
                                                .css({
                                                    display: 'none',
                                
                                                });
                        }
                    }
                ]
            });
            /*$("#example123 tfoot th").each( function ( i ) {

             if ($(this).text() !== '') {
             var isStatusColumn = (($(this).text() == 'Status') ? true : false);
             var select = $('<select><option value=""></option></select>')
             .appendTo( $(this).empty() )
             .on( 'change', function () {
             var val = $(this).val();

             table.column( i )
             .search( val ? '^'+$(this).val()+'$' : val, true, false )
             .draw();
             } );

             // Get the Status values a specific way since the status is a anchor/image
             if (isStatusColumn) {
             var statusItems = [];

             /* ### IS THERE A BETTER/SIMPLER WAY TO GET A UNIQUE ARRAY OF <TD> data-filter ATTRIBUTES? ###
             table.column( i ).nodes().to$().each( function(d, j){
             var thisStatus = $(j).attr("data-filter");
             if($.inArray(thisStatus, statusItems) === -1) statusItems.push(thisStatus);
             } );

             statusItems.sort();

             $.each( statusItems, function(i, item){
             select.append( '<option value="'+item+'">'+item+'</option>' );
             });

             }
             // All other non-Status columns (like the example)
             else {
             table.column( i ).data().unique().sort().each( function ( d, j ) {
             select.append( '<option value="'+d+'">'+d+'</option>' );
             } );
             }

             }
             } );*/
            
        });
        
        function getFilterData(){
            var employee_id = $('#emid').val();
            
            let month_date        = String($('#calendar-month_moth_view').val());
            let year_month_splite = month_date.split("-");
            let year              = year_month_splite[1];
            let month             = year_month_splite[0];
            
            $("#table_data").empty();
            $.ajax({
                url     : 'FilteredSalaryList',
                method  : 'POST',
                dataType: 'html',
                data    : {
                    employee_id: employee_id,
                    year       : year,
                    month      : month
                }
            }).done(function (response){
                console.log(response, " :441");
                $("#data-table tbody").empty();
                
                $("#table_data").append(response);
                
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

<?php $this->load->view('backend/footer'); ?>