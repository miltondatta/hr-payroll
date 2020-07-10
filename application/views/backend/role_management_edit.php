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
                            <li class="breadcrumb-item active">Role Assignment</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> User Role</h4>
                        </div>

                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php $this->load->view('backend/footer'); ?>