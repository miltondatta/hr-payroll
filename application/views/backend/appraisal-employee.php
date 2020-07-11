<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Appraisal Employee</h4></div>
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Appraisal Employee</a></li>
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
                                <h4 class="card-title">Appraisal Employee List</h4>

                                <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                        data-target="#appraisal-employee-modal" onclick="emptyInputValue()">
                                    <i class="fa fa-plus"></i>
                                    <span class="d-inline-block pl-1">Add Appraisal Employee</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="data-table" data-page-length='10'
                                           class="display table dataTable table-striped table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Designation</th>
                                            <th>Financial Year</th>
                                            <th>Appraisal Category</th>
                                            <th>Rating Text</th>
                                            <th>Rating Value</th>
                                            <th>Created At</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        <?php foreach ($appraisal_employee_data as $value): ?>
                                            <tr>
                                                <td><?php echo $value->first_name . ' ' . $value->last_name; ?></td>
                                                <td><?php echo $value->des_name; ?></td>
                                                <td><?php echo $value->financial_year; ?></td>
                                                <td><?php echo $value->category_name; ?></td>
                                                <td><?php echo $value->category_rating; ?></td>
                                                <td><?php echo $value->category_value; ?></td>
                                                <td><?php echo date_format(date_create($value->created_at), 'Y-m-d H:i:s'); ?></td>
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

    <div class="modal" id="appraisal-employee-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel10">Appraisal Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" method="post" action="addAppraisalEmployee" id="btnSubmit">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="financial_year" class="control-label col-md-3">Financial Year</label>
                            <select class="form-control col-md-8" name="financial_year" id="financial_year" required>
                                <option value="">Select Financial Year</option>
                                <?php foreach ($financial_years as $value): ?>
                                    <option value="<?php echo $value->year; ?>">
                                        <?php echo $value->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="em_id" class="control-label col-md-3">Employee</label>
                            <select class="form-control col-md-8" name="em_id" id="em_id" onchange="getAppraisalCategory()" required>
                                <option value="">Select Employee</option>
                                <?php foreach ($employee as $value): ?>
                                    <option value="<?php echo $value->em_id; ?>">
                                        <?php echo $value->first_name; echo ' '; echo $value->last_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="appraisal-category-input-area">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger rounded-btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary rounded-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php $this->load->view('backend/footer'); ?>
<script>
    function getAppraisalCategory() {
        let em_id = $("#em_id").val();
        let financial_year = $("#financial_year").val();

        if (!financial_year) {
            alert('Please select Financial Year!');
            $("#em_id").val('');
            return;
        }

        $.ajax({
            url: 'getAppraisalCategory?em_id=' + em_id + '&financial_year=' + financial_year,
            method: 'GET',
            data: '',
            dataType: 'html',
        }).done(function (response) {
            $("#appraisal-category-input-area").empty();
            $("#appraisal-category-input-area").append(response);
        });
    }

    function emptyInputValue() {
        $('#btnSubmit').trigger("reset");
        $('#btnSubmit').find('[name="id"]').val('').end();
    }

    $("#financial_year").change(function () {
        $("#appraisal-category-input-area").empty();
        $("#em_id").val('');
    });
</script>
