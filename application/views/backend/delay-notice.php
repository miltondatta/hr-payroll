<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Delay Notice</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Delay Notice</a></li>
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
                                <h4 class="card-title">Delay Notice List</h4>

                                <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                        data-target="#delay-notice-modal" onclick="emptyInputValue()">
                                    <i class="fa fa-plus"></i>
                                    <span class="d-inline-block pl-1">Add Delay Notice</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="data-table" data-page-length='10'
                                           class="display table dataTable table-striped table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Name</th>
                                            <th>Hour</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        <?php $status_text = ''; $badge_color = ''; ?>
                                        <?php foreach ($delay_notice as $key => $value): ?>
                                            <tr>
                                                <td><?php echo $key + 1 ?></td>
                                                <td><?php echo $value->description ?></td>
                                                <td><?php echo $value->hour ?></td>
                                                <?php
                                                if ($value->status == 1) {
                                                    $status_text = 'Pending';
                                                    $badge_color = 'primary';
                                                } elseif ($value->status == 2) {
                                                    $status_text = 'Approved';
                                                    $badge_color = 'success';
                                                } elseif ($value->status == 3) {
                                                    $status_text = 'Rejected';
                                                    $badge_color = 'warning';
                                                }
                                                ?>
                                                <td>
                                                    <span class="badge badge-pill badge-<?php echo $badge_color; ?> p-2 mb-1"><?php echo $status_text; ?></span>
                                                </td>
                                                <td><?php echo date('jS \of F Y', strtotime($value->created_at)) ?></td>
                                                <td>
                                                    <?php
                                                        if ($value->status == 1) {
                                                            ?>
                                                            <a href="javascript:void(0);" class="btn btn-info rounded-btn" onclick="getDelayNoticeInfoById(<?php echo $value->id; ?>)">
                                                                View
                                                            </a>
                                                            <a href="<?php echo base_url(); ?>DelayNotice/updateDelayNotice?id=<?php echo $value->id; ?>&status=2" class="btn btn-primary rounded-btn">
                                                                Approve
                                                            </a>
                                                            <a href="<?php echo base_url(); ?>DelayNotice/updateDelayNotice?id=<?php echo $value->id; ?>&status=3" class="btn btn-danger rounded-btn">
                                                                Reject
                                                            </a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="javascript:void(0);" class="btn btn-info rounded-btn" onclick="getDelayNoticeInfoById(<?php echo $value->id; ?>)">
                                                                View
                                                            </a>
                                                            <?php
                                                        }
                                                    ?>

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

    <div class="modal" id="delay-notice-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel10">Delay Notice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" method="post" action="addDelayNotice" id="btnSubmit">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="description" class="control-label col-md-3">Description</label>
                            <textarea class="form-control col-md-8" name="description" required></textarea>
                        </div>
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Hour</label>
                            <input type="text" name="hour" class="form-control col-md-8" required>
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
    function getDelayNoticeInfoById(id) {
        $('#btnSubmit').trigger("reset");
        $('#delay-notice-modal').modal('show');
        $.ajax({
            url: 'delayNoticeById?id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).done(function (response) {
            $('#btnSubmit').find('[name="description"]').val(response.delay_notice.description).end();
            $('#btnSubmit').find('[name="hour"]').val(response.delay_notice.hour).end();
        });
    }
</script>
