<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Notice Board</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        </li>
                        <li class="breadcrumb-item active">Notice Board</li>
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

                <div class="pb-2">
                    <a data-toggle="modal" data-target="#noticemodel" data-whatever="@getbootstrap" class="btn btn-info text-white">
                        <i class="fa fa-plus"></i>
                        Add Notice
                    </a>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title"><i class="fa fa-compass" aria-hidden="true"></i>Notice</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data_table_example"
                                   class="display table dataTable table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Title</th>
                                    <th>File</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($notice as $value): ?>
                                    <tr>
                                        <td><?php echo $value->id; ?></td>
                                        <td><?php echo $value->title; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>assets/images/notice/<?php echo $value->file_url; ?>"
                                               target="_blank"><?php echo $value->file_url; ?></a></td>
                                        <td><?php echo $value->date; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- sample modal content -->
                            <div class="modal" id="noticemodel" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content ">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel1">Notice Board</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <form role="form" method="post" action="Published_Notice" id="btnSubmit"
                                              enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="message-text" class="control-label">Notice Title</label>
                                                    <textarea class="form-control" name="title" id="message-text1"
                                                              required minlength="25" maxlength="150"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Document</label>
                                                    <label for="recipient-name1" class="control-label">Title</label>
                                                    <input type="file" name="file_url" class="form-control"
                                                           id="recipient-name1" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="control-label">Published
                                                        Date</label>
                                                    <input type="date" name="nodate" class="form-control"
                                                           id="recipient-name1" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
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
<?php $this->load->view('backend/footer'); ?>
