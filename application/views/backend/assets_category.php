<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Assets Category</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Assets Category</a></li>
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
                                    <h4 class="card-title">Assets Category List</h4>

                                    <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                            data-target="#assetsmodal" onclick="emptyInputValue()">
                                        <i class="fa fa-plus"></i>
                                        <span class="d-inline-block pl-1">Add Assets Category</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-table" data-page-length='10'
                                               class="display table dataTable table-striped table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>SERIAL</th>
                                                <th>Type</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php foreach ($catvalue as $key => $value): ?>
                                                <tr>
                                                    <td><?php echo $key + 1; ?></td>
                                                    <td><?php echo $value->cat_status ?></td>
                                                    <td><?php echo $value->cat_name; ?></td>
                                                    <td>
                                                        <a class="btn btn-primary rounded-btn installment text-light AssetsModal"
                                                           data-id="<?php echo $value->cat_id ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a onclick="return confirm('Are you sure to delete this data?')"
                                                           href="<?php echo base_url(); ?>logistice/delete_assets_category/<?php echo $value->cat_id; ?>"
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

        <div class="modal" id="assetsmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel10">Assets Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="Add_Assets_Category" id="assetsform">
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Category Type </label>
                                <select name="cattype" class="form-control" required>
                                    <option>Select Category</option>
                                    <option value="ASSETS">Assets</option>
                                    <option value="LOGISTIC">Logistice</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Category Name </label>
                                <input type="text" name="catname" class="form-control" value=""
                                       placeholder="Category name..." minlength="2" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="catid" value="" class="form-control" id="recipient-name1">
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
            $(".AssetsModal").click(function (e) {
                e.preventDefault(e);
                // Get the record's ID via attribute
                var iid = $(this).attr('data-id');
                $('#assetsform').trigger("reset");
                $('#assetsmodal').modal('show');
                $.ajax({
                    url: 'AssetscatByID?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function (response) {
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('#assetsform').find('[name="catid"]').val(response.assetscatval.cat_id).end();
                    $('#assetsform').find('[name="catname"]').val(response.assetscatval.cat_name).end();
                    $('#assetsform').find('[name="cattype"]').val(response.assetscatval.cat_status).end();
                    /*if (response.assetsByid.Assets_type == 'Logistic')
                        $('#btnSubmit').find(':checkbox[name=type][value="Logistic"]').prop('checked', true);*/

                });
            });
        });

        function emptyInputValue() {
            $('#assetsform').find('[name="catid"]').val('').end();
            $('#assetsform').find('[name="catname"]').val('').end();
            $('#assetsform').find('[name="cattype"]').val('').end();
        }
    </script>
<?php $this->load->view('backend/footer'); ?>