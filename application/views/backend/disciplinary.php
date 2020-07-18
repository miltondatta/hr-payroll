<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <div class="message"></div>
    <div class="page-wrapper">
<?php
$allemployees = $this->employee_model->GetAllEmployee();
?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Disciplinary</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>employee/Employees">Employees</a>
                            </li>
                            <li class="breadcrumb-item active">Disciplinary</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  mt-3">
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

                    <div class="row pb-2">
                        <div class="col-md-12">
                            <a data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"
                               class="btn btn-info text-white" onclick="emptyInputValue()">
                                <i class="fa fa-plus"></i>
                                Add Disciplinary
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="fa fa-compass" aria-hidden="true"></i> Disciplinary Action
                                                                                                    List</h4>
                        </div>
                        <div class="form-material ml-2 mt-3 row ">
                            <div class="form-group col-md-3">
                                <select class="form-control custom-select" tabindex="1" name="emid"
                                        id="emid" required>
                                    <option value="">Employee</option>
                                    <?php foreach($allemployees as $value): ?>
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
                                        <input name="from_date"
                                               class="form-control mydatetimepickerFull"
                                               id="calendar-month" value=""
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
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <input name="to_date"
                                               class="form-control mydatetimepickerFull"
                                               id="calendar-month-two" value=""
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
                            <div class="table-responsive" id="data_div">
                                <table id="data_table_example"
                                       class="display table dataTable table-striped table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Department</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Notice Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($desciplinary as $value): ?>
                                        <tr>
                                            <td><?php echo $value->em_code; ?></td>
                                            <td><?php echo $value->first_name . ' ' . $value->last_name; ?></td>
                                            <td><?php echo $value->dep_name; ?></td>
                                            <td><?php echo substr("$value->title", 0, 15) . '...' ?></td>
                                            <td><?php echo substr("$value->description", 0, 10) . '...' ?> </td>
                                            <td><?php echo $value->notice_date; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-success"><?php echo $value->action; ?></button>
                                            </td>
                                            <td class="jsgrid-align-center ">
                                                <a href="#" title="Edit"
                                                   class="btn btn-sm btn-info waves-effect waves-light disiplinary"
                                                   data-id="<?php echo $value->id; ?>" onclick="editDisciplinary('<?php echo $value->id; ?>')"><i
                                                            class="fa fa-pen"></i></a>
                                                
                                                <a href="DeletDisiplinary?D=<?php echo $value->id; ?>"
                                                   onclick="if (!confirm('Are you sure want to delete this value?')) {return false;} "
                                                   title="Delete"
                                                   class="btn btn-sm btn-danger waves-effect waves-light"><i
                                                            class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="modal" id="exampleModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Disciplinary Notice</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="add_Desciplinary" id="btnSubmit"
                                          enctype="multipart/form-data">
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label class="control-label">Employee Name</label>
                                                <select class="form-control" name="emid"
                                                        data-placeholder="Choose a Category" tabindex="1"
                                                        value=""
                                                        required>
                                                    <option value="">Select Employee</option>
                                                    <?php foreach($allemployees as $value): ?>
                                                        <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name .
                                                                                                               ' ' .
                                                                                                               $value->last_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Disciplinary Action</label>
                                                <select class="form-control"
                                                        data-placeholder="Choose a Category" tabindex="1"
                                                        name="warning"
                                                        value="" required>
                                                    <option value="">Select Action</option>
                                                    <option value="Verbel Warning">Verbel Warning</option>
                                                    <option value="Writing Warning">Writing Warning</option>
                                                    <option value="Demotion">Demotion</option>
                                                    <option value="Suspension">Suspension</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label">Title</label>
                                                <input type="text" name="title" value="" class="form-control"
                                                       id="recipient-name1">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Details</label>
                                                <textarea class="form-control" value="" name="details"
                                                          id="message-text1" rows="4"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Notice Date </label>
                                                <input type="text" name="notice_date" id="calendar-month"
                                                       data-format="yyyy-mm-dd"
                                                       class="form-control mydatetimepickerFull"
                                                       placeholder="From" autocomplete="off"
                                                       value="<?php echo date("Y-m-d") ?>">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="sent_email"
                                                           class="custom-control-input" id="checkbox-signin"
                                                           checked="">
                                                    <label class="custom-control-label" for="checkbox-signin">
                                                        Sent Mail</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="id" value="">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        function editDisciplinary(dis_id){
            var iid = dis_id;
            $('#btnSubmit').trigger("reset");
            $('#exampleModal').modal('show');
            $.ajax({
                url     : 'DisiplinaryByID?id=' + iid,
                method  : 'GET',
                data    : '',
                dataType: 'json',
            }).done(function (response){
                console.log(response, " :280");
                // Populate the form fields with the data returned from server
                $('#btnSubmit').find('[name="id"]').val(response.desipplinary.id).end();
                $('#btnSubmit').find('[name="emid"]').val(response.desipplinary.em_id).end();
                $('#btnSubmit').find('[name="warning"]').val(response.desipplinary.action).end();
                $('#btnSubmit').find('[name="title"]').val(response.desipplinary.title).end();
                $('#btnSubmit').find('[name="details"]').val(response.desipplinary.description).end();
                $('#btnSubmit').find('[name="notice_date"]').val(response.desipplinary.notice_date).end();
                
            });
        }
        
        function emptyInputValue(){
            $('#btnSubmit').trigger("reset");
            $('#btnSubmit').find('[name="id"]').val('').end();
        }
        
        function getFilterData(){
            var employee_id = $('#emid').val();
            
            let from_date = String($('#calendar-month').val());
            let to_date   = String($('#calendar-month-two').val());
            
            if ((from_date != '' && to_date == '') || (from_date == '' && to_date != '')){
                alert('Fill both From Date and To date, If you fill anyone.');
                return;
            }
            
            $("#data_div").empty();
            $.ajax({
                url     : 'FilteredDisciplinaryList',
                method  : 'POST',
                dataType: 'html',
                data    : {
                    employee_id: employee_id,
                    from_date  : from_date,
                    to_date    : to_date
                }
            }).done(function (response){
                $("#data_div tbody").empty();
                
                $("#data_div").append(response);
                
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