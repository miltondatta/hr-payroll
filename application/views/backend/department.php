<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Department</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Department</a></li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 col-lg-5 mt-3">
                    <?php if ($this->session->flashdata('feedback')) { ?>
                        <div class="alert alert-success alert-dismissible show" role="alert">
                            <strong><?php echo $this->session->flashdata('feedback'); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?php } ?>

                    <?php if (isset($editdepartment)) { ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Department</h4>
                            </div>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="post" action="<?php echo base_url(); ?>organization/update_dep/<?php echo $editdepartment->id; ?>">
                                                <div class="form-group">
                                                    <label for="department">Department Name</label>
                                                    <input type="text" class="form-control" name="department"
                                                           id="department" value="<?php  echo $editdepartment->dep_name;?>"
                                                           placeholder="Department">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary rounded-btn mb-2"><i
                                                                class="fa fa-check"></i> Update
                                                    </button>
                                                    <a href="<?php echo base_url(); ?>organization/department" class="btn btn-info rounded-btn mb-2 text-light"><i class="fa fa-backward"></i> Go Back</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Department</h4>
                            </div>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="post" action="Save_dep">
                                                <div class="form-group">
                                                    <label for="department">Department Name</label>
                                                    <input type="text" class="form-control" name="department"
                                                           id="department"
                                                           placeholder="Department">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary rounded-btn mb-2"><i
                                                                class="fa fa-check"></i> Save
                                                    </button>
                                                    <button type="reset" class="btn btn-warning rounded-btn mb-2"><i
                                                                class="fas fa-redo"></i> Reset
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-12 col-lg-7 mt-3">
                    <?php if ($this->session->flashdata('delsuccess')) { ?>
                        <div class="alert alert-success alert-dismissible show" role="alert">
                            <strong><?php echo $this->session->flashdata('delsuccess'); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?php } ?>

                    <!-- START: Card Data-->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header  justify-content-between align-items-center">
                                    <h4 class="card-title">Department List</h4>
                                </div>
                                <?php echo $this->session->flashdata('delsuccess'); ?>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-table" data-page-length='5'
                                               class="display table dataTable table-striped table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>Department Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php foreach ($department as $value) { ?>
                                                <tr>
                                                    <td><?php echo $value->dep_name; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>organization/dep_edit/<?php echo $value->id; ?>"
                                                           class="btn btn-primary rounded-btn"><i
                                                                    class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete this data?')" href="<?php echo base_url(); ?>organization/delete_dep/<?php echo $value->id; ?>"
                                                           class="btn btn-danger rounded-btn"><i
                                                                    class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
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
            <!-- END: Card DATA-->
        </div>
    </main>
<?php $this->load->view('backend/footer'); ?>