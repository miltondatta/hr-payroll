<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Course</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Course</a></li>
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
                                <h4 class="card-title">Edit Course</h4>
                            </div>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="post"
                                                  action="<?php echo base_url(); ?>course/update/<?php echo $item->id; ?>">
                                                <div class="form-group">
                                                    <label for="course_name">Course Name</label>
                                                    <input type="text" class="form-control" name="course_name"
                                                           id="course_name" placeholder="Course Name"
                                                           value="<?php echo $item->course_name ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="course_topics">Course Topics</label>
                                                    <input type="text" class="form-control" name="course_topics"
                                                           id="course_topics" placeholder="Course Topics"
                                                           value="<?php echo $item->course_topics ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="course_description">Course Description</label>
                                                    <textarea name="course_description" id="course_description"
                                                              placeholder="Course Description"
                                                              cols="76" rows="4"><?php echo $item->course_description ?>
                                                    </textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Designation </label>
                                                    <select name="course_for" id="course_for"
                                                            class="form-control" required>
                                                        <option value="">Select Designation</option>
                                                        <?Php foreach($designations as $value): ?>
                                                            <option value="<?php echo $value->id ?>"
                                                                <?php echo ($item->course_for == $value->id) ?
                                                                    "selected" : ''; ?>>
                                                                <?php echo $value->des_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
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
                                <h4 class="card-title">Add Course</h4>
                            </div>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="post" action="save">
                                                <div class="form-group">
                                                    <label for="course_name">Course Name</label>
                                                    <input type="text" class="form-control" name="course_name"
                                                           id="course_name" placeholder="Course Name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="course_topics">Course Topics</label>
                                                    <input type="text" class="form-control" name="course_topics"
                                                           id="course_topics" placeholder="Course Topics">
                                                </div>
                                                <div class="form-group">
                                                    <label for="course_description">Course Description</label>
                                                    <textarea name="course_description" id="course_description"
                                                              placeholder="Course Description"
                                                              cols="76" rows="4">
                                                        
                                                    </textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Designation </label>
                                                    <select name="course_for" id="course_for"
                                                            class="form-control" required>
                                                        <option value="">Select Designation</option>
                                                        <?Php foreach($designations as $value): ?>
                                                            <option value="<?php echo $value->id ?>">
                                                                <?php echo $value->des_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
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
                                    <h4 class="card-title">Course</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-table"
                                               class="display table dataTable table-striped table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>Course Name</th>
                                                <th>Course Topics</th>
                                                <th>Course Description</th>
                                                <th>Course For</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php foreach($lists as $value){ ?>
                                                <tr>
                                                    <td><?php echo $value->course_name; ?></td>
                                                    <td><?php echo $value->course_topics; ?></td>
                                                    <td><?php echo $value->course_description; ?></td>
                                                    <td><?php echo $value->designation_name; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>course/edit/<?php echo $value->id; ?>"
                                                           class="btn btn-primary rounded-btn"><i
                                                                    class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete this data?')"
                                                           href="<?php echo base_url(); ?>course/delete/<?php echo $value->id; ?>"
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