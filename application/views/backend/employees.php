<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Employee</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Employees</a></li>
                            <li class="breadcrumb-item active">Employees Index</li>
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

                    <div class="row pb-2">
                        <div class="col-md-12">
                            <a class="btn btn-info text-white"
                               href="<?php echo base_url(); ?>employee/Add_employee">
                                <i class="fa fa-plus"></i>
                                Add Employee
                            </a>
                            <a class="btn btn-primary text-white"
                               href="<?php echo base_url(); ?>employee/Disciplinary">
                                <i class="fa fa-bars"></i>
                                Disciplinary List
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Employee List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data_table_example"
                                       class="display table dataTable table-striped table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>PIN</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>User Type</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($employee as $value): ?>
                                        <tr>
                                            <td title="<?php echo $value->first_name . ' ' .
                                                $value->last_name; ?>"><?php echo $value->first_name .
                                                    ' ' .
                                                    $value->last_name; ?></td>
                                            <td><?php echo $value->em_code; ?></td>
                                            <td><?php echo $value->em_email; ?></td>
                                            <td><?php echo $value->em_phone; ?></td>
                                            <td><?php echo $value->em_role; ?></td>
                                            <td class="align-content-center ">
                                                <a href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($value->em_id); ?>"
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