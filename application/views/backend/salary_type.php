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
                            </li>
                            <li class="breadcrumb-item active">Payroll List</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  mt-3">
                    <div class="pb-2">
                        <a class="btn btn-info text-white TypeModal" data-toggle="modal" data-target="#TypeModal"
                           href="#">
                            <i class="fa fa-bars"></i>
                            Add Payroll
                        </a>
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data_table_example"
                                       class="display table dataTable table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Salary Type</th>
                                        <th>Create Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($typevalue as $value): ?>
                                        <tr>
                                            <td><?php echo $value->id; ?></td>
                                            <td><?php echo $value->salary_type ?></td>
                                            <td><?php echo $value->create_date; ?></td>
                                            <td class="jsgrid-align-center ">
                                                <a href="" title="Edit"
                                                   class="btn btn-sm btn-info waves-effect waves-light TypeModal"
                                                   data-id="<?php echo $value->id; ?>"><i
                                                            class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- sample modal content -->
                                <div class="modal" id="SalaryTypemodel" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel1">Salary Type</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form method="post" action="Add_Sallary_Type" id="typeform"
                                                  enctype="multipart/form-data">
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label class="control-label">Salary Type</label>
                                                        <input type="text" name="typename" class="form-control"
                                                               id="recipient-name1" minlength="4"
                                                               maxlength="25" value="" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Create Date</label>
                                                        <input type="date" name="createdate" class="form-control"
                                                               id="recipient-name1" value="">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="id" value="" class="form-control"
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
            $(".TypeModal").click(function (e){
                e.preventDefault(e);
                // Get the record's ID via attribute
                var iid = $(this).attr('data-id');
                $('#typeform').trigger("reset");
                $('#SalaryTypemodel').modal('show');
                $.ajax({
                    url     : 'GetSallaryTypeById?id=' + iid,
                    method  : 'GET',
                    data    : '',
                    dataType: 'json',
                }).done(function (response){
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('#typeform').find('[name="id"]').val(response.typevalueid.id).end();
                    $('#typeform').find('[name="typename"]').val(response.typevalueid.salary_type).end();
                    $('#typeform').find('[name="createdate"]').val(response.typevalueid.create_date).end();
                });
            });
        });
    </script>
<?php $this->load->view('backend/footer'); ?>