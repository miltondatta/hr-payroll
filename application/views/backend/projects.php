<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Project</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Project</a></li>
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
                                    <h4 class="card-title">Project List</h4>

                                    <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                            data-target="#projectmodal">
                                        <i class="fa fa-plus"></i>
                                        <span class="d-inline-block pl-1">Add Project</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-table" data-page-length='10'
                                               class="display table dataTable table-striped table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>Project Title</th>
                                                <th>Status</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php foreach ($projects as $value): ?>
                                                <tr>
                                                    <td><?php echo substr($value->pro_name, 0, 50) . '....' ?></td>
                                                    <td><?php echo $value->pro_status ?></td>
                                                    <td><?php echo date('jS \of F Y', strtotime($value->pro_start_date)); ?></td>
                                                    <td><?php echo date('jS \of F Y', strtotime($value->pro_end_date)) ?></td>
                                                    <td>
                                                        <a class="btn btn-primary rounded-btn installment text-light"
                                                           href="<?php echo base_url(); ?>projects/view/<?php echo $value->id; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a onclick="return confirm('Are you sure to delete this data?')"
                                                           href="pDelet?D=<?php echo base64_encode($value->id); ?>"
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

        <div class="modal" id="projectmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel10">Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="Add_Projects" id="btnSubmit" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Project Title</label>
                                        <input type="text" name="protitle" class="form-control" id="recipient-name1"
                                               minlength="8" maxlength="250" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Project Start Date</label>
                                        <input type="text" name="startdate" class="form-control" id="calendar-month"
                                               data-format="yyyy-mm-dd" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Project End Date</label>
                                        <input type="text" name="enddate" class="form-control datepicker"
                                               id="calendar-month-two" data-format="yyyy-mm-dd" required placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">Summery</label>
                                        <textarea class="form-control" name="summery" id="message-text1"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">Details</label>
                                        <textarea class="form-control" name="details" id="message-text1" minlength="10"
                                                  maxlength="1300" rows="8" placeholder=""> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <select class="form-control custom-select" data-placeholder="Choose a Category"
                                                tabindex="1" name="prostatus" required>
                                            <option value="upcoming">Upcoming</option>
                                            <option value="complete">Complete</option>
                                            <option value="running">Running</option>
                                        </select>
                                    </div>
                                </div>
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