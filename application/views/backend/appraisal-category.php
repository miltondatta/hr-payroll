<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Appraisal Category</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Appraisal Category</a></li>
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
                                <h4 class="card-title">Appraisal Category List</h4>

                                <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                        data-target="#appraisal-category-modal" onclick="emptyInputValue()">
                                    <i class="fa fa-plus"></i>
                                    <span class="d-inline-block pl-1">Add Appraisal Category</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="data-table" data-page-length='10'
                                           class="display table dataTable table-striped table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Rating Text</th>
                                            <th>Rating Value</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        <?php foreach ($appraisal_category_data as $value): ?>
                                            <tr>
                                                <td><?php echo $value->category_name ?></td>
                                                <td><?php echo $value->rating_text ?></td>
                                                <td><?php echo $value->rating_value ?></td>
                                                <td><?php echo date_format(date_create($value->created_at), 'Y-m-d H:i:s'); ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-primary rounded-btn"
                                                       onclick="getAppraisalCategoryInfoById(<?php echo $value->id; ?>)">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure to delete this data?')" href="<?php echo base_url(); ?>Appraisal/deleteAppraisalCategory/<?php echo $value->id; ?>"
                                                       class="btn btn-danger rounded-btn"><i
                                                            class="fa fa-trash"></i></a>
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

    <div class="modal" id="appraisal-category-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel10">Appraisal Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" method="post" action="addAppraisalCategory" id="btnSubmit">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="category_name" class="control-label col-md-3">Appraisal Category</label>
                            <input type="text" name="category_name" id="category_name" class="form-control col-md-8" required>
                        </div>
                        <div class="form-group row">
                            <label for="rating_text" class="control-label col-md-3">Rating Text(Comma Separated)</label>
                            <input type="text" name="rating_text" id="rating_text" class="form-control col-md-8" required>
                        </div>
                        <div class="form-group row">
                            <label for="rating_value" class="control-label col-md-3">Rating Value(%)(Comma Separated)</label>
                            <input type="text" name="rating_value" id="rating_value" class="form-control col-md-8" required>
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
<script>
    function getAppraisalCategoryInfoById(id) {
        $('#btnSubmit').trigger("reset");
        $('#appraisal-category-modal').modal('show');

        $.ajax({
            url: 'appraisalCategoryById?id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).done(function (response) {
            $('#btnSubmit').find('[name="id"]').val(response.appraisal_category.id).end();
            $('#btnSubmit').find('[name="category_name"]').val(response.appraisal_category.category_name).end();
            $('#btnSubmit').find('[name="rating_text"]').val(response.appraisal_category.rating_text).end();
            $('#btnSubmit').find('[name="rating_value"]').val(response.appraisal_category.rating_value).end();
        });
    }

    function emptyInputValue() {
        $('#btnSubmit').trigger("reset");
        $('#btnSubmit').find('[name="id"]').val('').end();
    }
</script>
