<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Assets</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Assets</a></li>
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
                                    <h4 class="card-title">Assets List</h4>

                                    <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                            data-target="#assetsmodal" onclick="emptyInputValue()">
                                        <i class="fa fa-plus"></i>
                                        <span class="d-inline-block pl-1">Add Assets</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-table" data-page-length='10'
                                               class="display table dataTable table-striped table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <!--<th>ID</th>
                                                <th>Type </th>-->
                                                <th>category</th>
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Model</th>
                                                <th>Code</th>
                                                <th>Configuration</th>
                                                <th>InStock</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php foreach ($assets as $value): ?>
                                                <tr>
                                                    <!--                                                <td><?php echo $value->ass_id ?></td>
                                                <td><?php echo $value->cat_status ?></td>-->
                                                    <td><?php echo $value->cat_name ?></td>
                                                    <td><?php echo $value->ass_name ?></td>
                                                    <td><?php echo $value->ass_brand ?></td>
                                                    <td><?php echo $value->ass_model ?></td>
                                                    <td><?php echo $value->ass_code ?></td>
                                                    <td><?php echo substr($value->configuration, 0, 25) . '...' ?></td>
                                                    <td><?php echo $value->in_stock ?></td>
                                                    <td>
                                                        <a class="btn btn-primary rounded-btn installment text-light assets"
                                                           data-id="<?php echo $value->ass_id ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a onclick="return confirm('Are you sure to delete this data?')"
                                                           href="<?php echo base_url(); ?>logistice/delete_assets/<?php echo $value->ass_id; ?>"
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
                        <h5 class="modal-title" id="myLargeModalLabel10">Assets</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="Add_Assets" id="btnSubmit">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Asset name</label>
                                        <input type="text" name="assname" value="" class="form-control"
                                               id="recipient-name1" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="catid">Category Type</label>
                                        <select name="catid" id="catid" class="form-control" required>
                                            <option>Select Category</option>
                                            <?php foreach ($catvalue as $value): ?>
                                                <option value="<?php echo $value->cat_id ?>"><?php echo $value->cat_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Assets Brand</label>
                                        <input type="text" name="brand" value="" class="form-control"
                                               id="recipient-name1">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Assets Model</label>
                                        <input type="text" name="model" value="" class="form-control"
                                               id="recipient-name1">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Assets Code</label>
                                        <input type="text" name="code" value="" class="form-control"
                                               id="recipient-name1 ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Configuration</label>
                                        <textarea class="form-control" name="config" id="message-text1" required
                                                  minlength="14" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Purchaseing Date</label>
                                        <input type="text" name="purchase" value="" class="form-control"
                                               data-format="yyyy-mm-dd"
                                               id="calendar-month">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Price</label>
                                        <input type="number" name="price" value="" class="form-control"
                                               id="recipient-name1">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Quantity</label>
                                        <input type="number" name="pqty" value=""
                                               class="form-control" id="recipient-name1">
                                    </div>
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <input name="type" type="checkbox" id="radio_2" data-value="Logistic" value="Logistic"
                                       class="type">
                                <label for="radio_2">Add To Logistic Support List</label>
                            </div>-->
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="aid" value="">
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
            $(".assets").click(function (e) {
                e.preventDefault(e);
                // Get the record's ID via attribute
                var iid = $(this).attr('data-id');
                $('#btnSubmit').trigger("reset");
                $('#assetsmodal').modal('show');
                $.ajax({
                    url: 'AssetsByID?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function (response) {
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('#btnSubmit').find('[name="aid"]').val(response.assetsByid.ass_id).end();
                    $('#btnSubmit').find('[name="catid"]').val(response.assetsByid.cat_id).end();
                    $('#btnSubmit').find('[name="assname"]').val(response.assetsByid.ass_name).end();
                    $('#btnSubmit').find('[name="brand"]').val(response.assetsByid.ass_brand).end();
                    $('#btnSubmit').find('[name="model"]').val(response.assetsByid.ass_model).end();
                    $('#btnSubmit').find('[name="code"]').val(response.assetsByid.ass_code).end();
                    $('#btnSubmit').find('[name="config"]').val(response.assetsByid.configuration).end();
                    $('#btnSubmit').find('[name="purchase"]').val(response.assetsByid.purchasing_date).end();
                    $('#btnSubmit').find('[name="price"]').val(response.assetsByid.ass_price).end();
                    $('#btnSubmit').find('[name="pqty"]').val(response.assetsByid.ass_qty).end();
                    /*if (response.assetsByid.Assets_type == 'Logistic')
                        $('#btnSubmit').find(':checkbox[name=type][value="Logistic"]').prop('checked', true);*/

                });
            });
        });

        function emptyInputValue() {
            $('#btnSubmit').find('[name="aid"]').val('').end();
            $('#btnSubmit').find('[name="catid"]').val('').end();
            $('#btnSubmit').find('[name="assname"]').val('').end();
            $('#btnSubmit').find('[name="brand"]').val('').end();
            $('#btnSubmit').find('[name="model"]').val('').end();
            $('#btnSubmit').find('[name="code"]').val('').end();
            $('#btnSubmit').find('[name="config"]').val('').end();
            $('#btnSubmit').find('[name="purchase"]').val('').end();
            $('#btnSubmit').find('[name="price"]').val('').end();
            $('#btnSubmit').find('[name="pqty"]').val('').end();
        }
    </script>
<?php $this->load->view('backend/footer'); ?>