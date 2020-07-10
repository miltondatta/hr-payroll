<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Training Agency</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Training Agency</a></li>
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
                                <h4 class="card-title">Edit Training Agency</h4>
                            </div>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="post"
                                                  action="<?php echo base_url(); ?>training_agency/update/<?php echo $item->id; ?>">

                                                <div class="form-group">
                                                    <label for="agency_name">Agency Name</label>
                                                    <input type="text" class="form-control" name="agency_name"
                                                           id="agency_name" placeholder="Agency Name"
                                                           value="<?php echo $item->agency_name ?>"
                                                           required>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>Course Name </label>
                                                        <select name="course_id" id="course_id"
                                                                class="form-control" required>
                                                            <option value="">Select Designation</option>
                                                            <?Php foreach($courses as $value): ?>
                                                                <option value="<?php echo $value->id ?>"
                                                                    <?php echo ($item->course_id == $value->id) ?
                                                                        "selected" : ''; ?>>
                                                                    <?php echo $value->course_name ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label for="agency_name">Address</label>
                                                    <textarea name="address" id="address"
                                                              placeholder="Address"
                                                              cols="76" rows="4"><?php echo $item->address ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="agency_name">Country</label>
                                                    <input type="text" class="form-control" name="country"
                                                           id="country"
                                                           placeholder="Country"
                                                           value="<?php echo $item->country ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="agency_name">State</label>
                                                    <input type="text" class="form-control" name="state"
                                                           id="state"
                                                           placeholder="State"
                                                           value="<?php echo $item->state ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="agency_name">City</label>
                                                    <input type="text" class="form-control" name="city"
                                                           id="city"
                                                           placeholder="City"
                                                           value="<?php echo $item->city ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="agency_name">Mobile</label>
                                                    <input type="text" class="form-control" name="mobile"
                                                           id="mobile"
                                                           placeholder="Mobile"
                                                           value="<?php echo $item->mobile ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary rounded-btn mb-2"><i
                                                                class="fa fa-check"></i> Update
                                                    </button>
                                                    <a href="<?php echo base_url(); ?>training_agency/index"
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
                                <h4 class="card-title">Add Training Agency</h4>
                            </div>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="post" action="save">
                                                <div class="form-group">
                                                    <label for="agency_name">Agency Name</label>
                                                    <input type="text" class="form-control" name="agency_name"
                                                           id="agency_name"
                                                           placeholder="Agency Name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Course Name </label>
                                                    <select name="course_id" id="course_id"
                                                            class="form-control" required>
                                                        <option value="">Select Designation</option>
                                                        <?Php foreach($courses as $value): ?>
                                                            <option value="<?php echo $value->id ?>">
                                                                <?php echo $value->course_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="agency_name">Address</label>
                                                    <textarea name="address" id="address"
                                                              placeholder="Address"
                                                              cols="76" rows="4"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="agency_name">Country</label>
                                                    <input type="text" class="form-control" name="country"
                                                           id="country"
                                                           placeholder="Country">
                                                </div>
                                                <div class="form-group">
                                                    <label for="agency_name">State</label>
                                                    <input type="text" class="form-control" name="state"
                                                           id="state"
                                                           placeholder="State">
                                                </div>
                                                <div class="form-group">
                                                    <label for="agency_name">City</label>
                                                    <input type="text" class="form-control" name="city"
                                                           id="city"
                                                           placeholder="City">
                                                </div>
                                                <div class="form-group">
                                                    <label for="agency_name">Mobile</label>
                                                    <input type="text" class="form-control" name="mobile"
                                                           id="mobile"
                                                           placeholder="Mobile" required>
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
                                    <h4 class="card-title">Training Agency</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-table"
                                               class="display table dataTable table-striped table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>Agency</th>
                                                <th>Course</th>
                                                <th>Address</th>
                                                <th>Country</th>
                                                <th>State</th>
                                                <th>City</th>
                                                <th>Mobile</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php foreach($lists as $value){ ?>
                                                <tr>
                                                    <td><?php echo $value->agency_name; ?></td>
                                                    <td><?php echo $value->course_name; ?></td>
                                                    <td><?php echo $value->address; ?></td>
                                                    <td><?php echo $value->country; ?></td>
                                                    <td><?php echo $value->state; ?></td>
                                                    <td><?php echo $value->city; ?></td>
                                                    <td><?php echo $value->mobile; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>training_agency/edit/<?php echo $value->id; ?>"
                                                           class="btn btn-primary rounded-btn"><i
                                                                    class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete this data?')"
                                                           href="<?php echo base_url(); ?>training_agency/delete/<?php echo $value->id; ?>"
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