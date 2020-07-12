<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Member Assignment</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Member Assignment</a></li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 col-lg-5 mt-3">
                    <?php if($this->session->flashdata('feedback')){ ?>
                        <div class="alert alert-success alert-dismissible show" role="alert">
                            <strong><?php echo $this->session->flashdata('feedback'); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?php } ?>
                    
                    <?php if(isset($item)){ ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Member Assignment</h4>
                            </div>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="post"
                                                  action="<?php echo base_url(); ?>member_assignment/update/<?php echo $item->id; ?>">

                                                <div class="form-group">
                                                    <label>Course Name </label>
                                                    <select name="course_id" id="course_id"
                                                            class="form-control" required>
                                                        <option value="">Select Course</option>
                                                        <?Php foreach($courses as $value): ?>
                                                            <option value="<?php echo $value->id ?>"
                                                                <?php echo ($item->course_id == $value->id) ?
                                                                    "selected" : ''; ?>>
                                                                <?php echo $value->course_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Course Name </label>
                                                    <select name="employees[]" id="employees"
                                                            class="form-control" required multiple>
                                                        <?Php foreach($employees as $employee):
                                                            $selected = ''; ?>
                                                            <?Php foreach($item_members as $item_member):
                                                            if($employee->id == $item_member->employee_id){
                                                                $selected = "selected";
                                                                break;
                                                            }
                                                            ?>
                                                        
                                                        <?php endforeach; ?>
                                                            <option value="<?php echo $employee->id ?>" <?php echo $selected ?>>
                                                                <?php echo $employee->em_code . ' - ' .
                                                                           $employee->first_name . ' ' .
                                                                           $employee->first_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>From Date </label>
                                                    <input type="text" name="from_date" id="calendar-month"
                                                           data-format="yyyy-mm-dd"
                                                           class="form-control mydatetimepickerFull"
                                                           placeholder="From" autocomplete="off"
                                                           value="<?php echo $item->from_date ?>"
                                                    >
                                                </div>

                                                <div class="form-group">
                                                    <label>To Date </label>
                                                    <input type="text" name="to_date" id="calendar-month-two"
                                                           data-format="yyyy-mm-dd"
                                                           class="form-control mydatetimepickerFull"
                                                           placeholder="To" autocomplete="off"
                                                           value="<?php echo $item->to_date ?>"
                                                    >
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary rounded-btn mb-2"><i
                                                                class="fa fa-check"></i> Update
                                                    </button>
                                                    <a href="<?php echo base_url(); ?>member_assignment/index"
                                                       class="btn btn-info rounded-btn mb-2 text-light"><i
                                                                class="fa fa-backward"></i> Go Back</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else{ ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Member Assignment</h4>
                            </div>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="post"
                                                  action="<?php echo base_url(); ?>member_assignment/save">
                                                <div class="form-group">
                                                    <label>Course Name </label>
                                                    <select name="course_id" id="course_id"
                                                            class="form-control" required>
                                                        <option value="">Select Course</option>
                                                        <?Php foreach($courses as $value): ?>
                                                            <option value="<?php echo $value->id ?>">
                                                                <?php echo $value->course_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Course Name </label>
                                                    <select name="employees[]" id="employees"
                                                            class="form-control" required multiple>
                                                        <?Php foreach($employees as $employee): ?>
                                                            <option value="<?php echo $employee->id ?>">
                                                                <?php echo $employee->em_code . ' - ' .
                                                                           $employee->first_name . ' ' .
                                                                           $employee->first_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>From Date </label>
                                                    <input type="text" name="from_date" id="calendar-month"
                                                           data-format="yyyy-mm-dd"
                                                           class="form-control mydatetimepickerFull"
                                                           placeholder="From" autocomplete="off">
                                                </div>

                                                <div class="form-group">
                                                    <label>To Date </label>
                                                    <input type="text" name="to_date" id="calendar-month-two"
                                                           data-format="yyyy-mm-dd"
                                                           class="form-control mydatetimepickerFull"
                                                           placeholder="To" autocomplete="off">
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
                    <?php if($this->session->flashdata('delsuccess')){ ?>
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
                                    <h4 class="card-title">Member Assignment</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-table"
                                               class="display table dataTable table-striped table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>Course</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                                <th>Employees</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php foreach($lists as $value){ ?>
                                                <tr>
                                                    <td><?php echo $value->course_name; ?></td>
                                                    <td><?php echo $value->from_date; ?></td>
                                                    <td><?php echo $value->to_date; ?></td>
                                                    <td><?php echo $value->employee_name; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>member_assignment/edit/<?php echo $value->id; ?>"
                                                           class="btn btn-primary rounded-btn"><i
                                                                    class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete this data?')"
                                                           href="<?php echo base_url(); ?>member_assignment/delete/<?php echo $value->id; ?>"
                                                           class="btn btn-danger rounded-btn">
                                                            <i class="fa fa-trash"></i></a>
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