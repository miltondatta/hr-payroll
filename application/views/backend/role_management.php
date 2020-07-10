<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Role Management</h4></div>
                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Role Assign</a></li>
                            <li class="breadcrumb-item active">Role Assign Index</li>
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


                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> User Role List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data_table_example"
                                       class="display table dataTable table-striped table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>Role Name</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($roles as $value): ?>
                                        <tr>
                                            <td><?php echo $value->role_name; ?></td>
                                            <td><?php echo $value->role_desc; ?></td>
                                            <td><?php echo date('jS \of F Y', strtotime($value->created_at)) ?></td>
                                            <td class="align-content-center ">
                                                <a href="<?php echo base_url(); ?>UserManagement/AssignMenuEdit?id=<?php echo base64_encode($value->id); ?>"
                                                   title="Edit" class="btn btn-sm btn-info"><i
                                                            class="fa fa-pen"></i></a>
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
        </div>
    </main>

<?php $this->load->view('backend/footer'); ?>