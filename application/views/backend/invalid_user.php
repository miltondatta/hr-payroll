<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Inactive Employee</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>employee/Employees">Employees</a>
                            </li>
                            <li class="breadcrumb-item active">Inactive Employee</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="pb-2">
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

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Inactive Employee List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data_table_example"
                                       class="display table dataTable table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Employee Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Roll</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($invalidem as $value): ?>
                                        <tr>
                                            <td><?php echo $value->em_code; ?></td>
                                            <td><?php echo $value->first_name . ' ' . $value->last_name; ?></td>
                                            <td><?php echo $value->em_email; ?></td>
                                            <td><?php echo $value->em_phone; ?></td>
                                            <td><?php echo $value->em_role; ?></td>
                                            <td class="jsgrid-align-center ">
                                                <a href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($value->em_id); ?>"
                                                   title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i
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