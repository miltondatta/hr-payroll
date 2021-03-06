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
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>employee/Employees">Employees</a>
                            </li>
                            <li class="breadcrumb-item active">Employee Add</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="message"></div>
            <?php $degvalue = $this->employee_model->getdesignation(); ?>
            <?php $depvalue = $this->employee_model->getdepartment(); ?>
            <?php $rolevalue = $this->employee_model->getRoles(); ?>
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="col-12 pl-0">
                                <a class="btn btn-primary text-white"
                                   href="<?php echo base_url(); ?>employee/Employees">
                                    <i class="fa fa-bars"></i>
                                    Employee List
                                </a>
                                <a class="btn btn-primary text-white"
                                   href="<?php echo base_url(); ?>employee/Disciplinary">
                                    <i class="fa fa-bars"></i>
                                    Disciplinary List
                                </a>
                            </div>
                        </div>
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Add New Employee</h4>
                        </div>
                        <?php echo validation_errors(); ?>
                        <?php echo $this->upload->display_errors(); ?>
                        
                        <?php echo $this->session->flashdata('formdata'); ?>
                        <?php echo $this->session->flashdata('feedback'); ?>

                        <div class="card-body">
                            <form class="row" method="post" action="Save" enctype="multipart/form-data">
                                <div class="form-group col-md-3 m-t-20">
                                    <label>First Name</label>
                                    <input type="text" name="fname" class="form-control form-control-line"
                                           placeholder="Your first name" minlength="2" required>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Last Name </label>
                                    <input type="text" id="" name="lname" class="form-control form-control-line"
                                           value="" placeholder="Your last name" minlength="2" required>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Employee Code </label>
                                    <input type="text" name="eid" class="form-control form-control-line"
                                           placeholder="ID">
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Department</label>
                                    <select name="dept" value="" class="form-control custom-select" required>
                                        <option>Select Department</option>
                                        <?Php foreach($depvalue as $value): ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->dep_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Designation </label>
                                    <select name="deg" class="form-control custom-select" required>
                                        <option>Select Designation</option>
                                        <?Php foreach($degvalue as $value): ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->des_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>User Role </label>
                                    <select name="role" class="form-control custom-select" required>
                                        <option>Select Role</option>
                                        <?Php foreach($rolevalue as $value): ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->role_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Gender </label>
                                    <select name="gender" class="form-control custom-select" required>
                                        <option>Select Gender</option>
                                        <option value="MALE">Male</option>
                                        <option value="FEMALE">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Blood Group </label>
                                    <select name="blood" class="form-control custom-select">
                                        <option>Select Gender</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>NID</label>
                                    <input type="text" name="nid" class="form-control" value="" placeholder=""
                                           minlength="10" required>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Contact Number </label>
                                    <input type="text" name="contact" class="form-control" value=""
                                           placeholder="+8801231456" minlength="10" maxlength="15" required>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Date Of Birth </label>
                                    <input type="date" name="dob" id="example-email2" name="example-email"
                                           class="form-control" placeholder="" required>
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Date Of Joining </label>
                                    <input type="date" name="joindate" id="example-email2" name="example-email"
                                           class="form-control" placeholder="">
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Date Of Leaving </label>
                                    <input type="date" name="leavedate" id="example-email2" name="example-email"
                                           class="form-control" placeholder="">
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Username </label>
                                    <input type="text" name="username" class="form-control form-control-line" value=""
                                           placeholder="Username">
                                </div>
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Email </label>
                                    <input type="email" id="example-email2" name="email" class="form-control"
                                           placeholder="email@mail.com" minlength="7" required>
                                </div><!--
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Password </label>
                                        <input type="text" name="password" class="form-control" value="" placeholder="**********">
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Confirm Password </label>
                                        <input type="text" name="confirm" class="form-control" value="" placeholder="**********">
                                    </div>-->
                                <div class="form-group col-md-3 m-t-20">
                                    <label>Image </label>
                                    <input type="file" name="image_url" class="form-control" value="">
                                </div>
                                <div class="form-actions col-md-12">
                                    <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Save</button>
                                    <button type="button" class="btn btn-info">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $this->load->view('backend/footer'); ?>