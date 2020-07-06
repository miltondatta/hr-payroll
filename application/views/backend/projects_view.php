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

                    <div class="row">
                        <div class="col-lg-12 col-xlg-12 col-md-12">
                            <div class="card">
                                <!-- Nav tabs -->
                                <div id="tabs">
                                    <ul class="nav nav-tabs profile-tab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home"
                                                                role="tab">
                                                Project View </a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tasks"
                                                                role="tab">Projects
                                                tasks </a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#office"
                                                                role="tab">Office
                                                tasks </a></li>
                                        <!--<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#field" role="tab">Field tasks </a> </li>-->
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#education"
                                                                role="tab">
                                                Projects files</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#experience"
                                                                role="tab">
                                                Notes </a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#expenses"
                                                                role="tab">
                                                Expenses</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#logid"
                                                                role="tab">
                                                Logistic</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-4">

                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title"><?php echo $details->pro_name; ?></h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <small class="text-muted">Start Date</small>
                                                            <h6><?php echo $details->pro_start_date; ?></h6>
                                                            <small class="text-muted p-t-30 db">End date</small>
                                                            <h6><?php echo $details->pro_end_date; ?></h6>
                                                            <small class="text-muted p-t-30 db">Status</small>
                                                            <h6><?php echo $details->pro_status; ?></h6>

                                                            <br/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form method="post" action="<?php echo base_url() ?>projects/Add_Projects" id="btnSubmit">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Project
                                                                            Title</label>
                                                                        <input type="text"
                                                                               name="protitle" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
                                                                               value="<?php echo $details->pro_name; ?>"
                                                                               class="form-control" id="recipient-name1"
                                                                               minlength="8" maxlength="250" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Project Start
                                                                            Date</label>
                                                                        <input type="text" name="startdate"
                                                                               value="<?php echo $details->pro_start_date; ?>" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
                                                                               class="form-control"
                                                                               id="calendar-month" data-format="yyyy-mm-dd" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Project End
                                                                            Date</label>
                                                                        <input type="text" name="enddate"
                                                                               value="<?php echo $details->pro_end_date; ?>" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
                                                                               class="form-control" data-format="yyyy-mm-dd"
                                                                               id="calendar-month-two" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="message-text" class="control-label">Project
                                                                            Summery</label>
                                                                        <textarea class="form-control"
                                                                                  value="<?php echo $details->pro_summary; ?>"
                                                                                  name="summery" rows="6"
                                                                                  id="message-text1"
                                                                                  minlength="5" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?> maxlength="512"><?php echo $details->pro_summary; ?></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="message-text"
                                                                               class="control-label">Details</label>
                                                                        <textarea class="form-control"
                                                                                  rows="10" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?> name="details"
                                                                                  value="<?php echo $details->pro_description; ?>"
                                                                                  id="message-text1" minlength="10"
                                                                                  maxlength="1300"><?php echo $details->pro_description; ?></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Status</label>
                                                                        <select class="form-control"
                                                                                data-placeholder="Choose a Category"
                                                                                tabindex="1"
                                                                                name="prostatus" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> readonly <?php } ?>
                                                                                required>
                                                                            <option value="<?php echo $details->pro_status; ?>"><?php echo $details->pro_status; ?></option>
                                                                            <option value="upcoming">Upcoming</option>
                                                                            <option value="complete">Complete</option>
                                                                            <option value="running">Running</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="proid"
                                                                           value="<?php echo $details->id; ?>">
                                                                    <button type="submit" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> disabled <?php } ?>
                                                                            class="btn btn-primary rounded-btn">Update
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!--second tab-->
                                        <div class="tab-pane" id="tasks" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h3 class="card-title">Project tasks</h3>
                                                    <div class="table-responsive " id="">
                                                        <table id="data-table" data-page-length='10'
                                                               class="display table dataTable table-striped table-bordered text-center">
                                                            <thead>
                                                            <tr>
                                                                <th>Serial</th>
                                                                <th>Task Title</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Assigned users</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($tasklist as $key => $value): ?>
                                                                <tr>
                                                                    <td><?php echo $key + 1 ?></td>
                                                                    <td><?php echo $value->task_title ?></td>
                                                                    <td><?php echo $value->start_date ?></td>
                                                                    <td><?php echo $value->end_date ?></td>
                                                                    <td>
                                                                        <?php
                                                                        $id = $value->id;
                                                                        $assignvalue = $this->project_model->getTaskAssignUser($id); ?>
                                                                        <?php foreach ($assignvalue as $value1): ?>
                                                                            <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $value1->em_image ?>"
                                                                                 height="40px" width="40px"
                                                                                 style="border-radius:50px" alt=""
                                                                                 data-toggle="tooltip"
                                                                                 data-placement="top" title=""
                                                                                 data-original-title="<?php echo $value1->user_type; ?>">
                                                                            <?php $value1->user_type; ?>
                                                                        <?php endforeach; ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="office" role="tabpanel">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between">
                                                    <h4 class="card-title">Office tasks</h4>
                                                    <?php if ($this->session->userdata('user_type') != 'EMPLOYEE'){ ?>
                                                    <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                                            data-target="#tasksmodel">
                                                        <i class="fa fa-plus"></i>
                                                        <span class="d-inline-block pl-1">Add Tasks</span>
                                                    </button>
                                                    <?php } ?>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="data-table-two" data-page-length='10'
                                                               class="display table dataTable table-striped table-bordered text-center">
                                                            <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Task Title</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Assigned users</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($tasklist as $value): ?>
                                                                <tr>
                                                                    <td><?php echo $value->id ?></td>
                                                                    <td><?php echo $value->task_title ?></td>
                                                                    <td><?php echo $value->start_date ?></td>
                                                                    <td><?php echo $value->end_date ?></td>
                                                                    <td>
                                                                        <?php
                                                                        $id = $value->id;
                                                                        $assignvalue = $this->project_model->getTaskAssignUser($id); ?>
                                                                        <?php foreach ($assignvalue as $value1): ?>
                                                                            <?php if (!empty($value1->em_image)) { ?>
                                                                                <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $value1->em_image ?>"
                                                                                     height="40px" width="40px"
                                                                                     style="border-radius:50px" alt=""
                                                                                     data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title=""
                                                                                     data-original-title="<?php echo $value1->user_type; ?>">
                                                                            <?php } else { ?>
                                                                                <img src="<?php echo base_url(); ?>assets/images/users/user.png ?>"
                                                                                     height="40px" width="40px"
                                                                                     style="border-radius:50px" alt=""
                                                                                     data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title=""
                                                                                     data-original-title="<?php echo $value1->user_type; ?>">
                                                                            <?php } ?>

                                                                        <?php endforeach; ?>
                                                                    </td>

                                                                    <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>

                                                                    <?php } else { ?>
                                                                        <!--<td class="jsgrid-align-center ">
                                                                            <a href="#" title="Edit"
                                                                               class="btn btn-sm btn-info waves-effect waves-light taskmodal"
                                                                               data-id="<?php /*echo $value->id */?>"><i
                                                                                        class="fa fa-pencil-square-o"></i></a>
                                                                            <a onclick="alert('Are you sure want to delet this Value?')"
                                                                               href="#" title="Delete"
                                                                               class="btn btn-sm btn-info waves-effect waves-light TasksDelet"
                                                                               data-id="<?php /*echo $value->id */?>"><i
                                                                                        class="fa fa-trash-o"></i></a>
                                                                        </td>-->
                                                                        <td>
                                                                            <a class="btn btn-primary rounded-btn text-light taskmodal"
                                                                               data-id="<?php echo $value->id ?>">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <a onclick="return confirm('Are you sure to delete this data?')"
                                                                               data-id="<?php echo $value->id ?>"
                                                                               class="btn btn-danger rounded-btn TasksDelet text-light">
                                                                                <i class="fa fa-trash"></i>
                                                                            </a>
                                                                        </td>
                                                                    <?php } ?>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="field" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h3 class="card-title">Field tasks</h3>
                                                    <span class="pull-right">
                        <?php if ($this->session->userdata('user_type') != 'EMPLOYEE'){ ?>
                        <a data-toggle="modal" data-target="#fieldmodel" data-whatever="@getbootstrap"
                           class="text-white btn btn-info"> Add Field visit</a></span> <?php } ?>
                                                    <div class="table-responsive " id="">
                                                        <table id="example23"
                                                               class="display nowrap table table-hover table-striped table-bordered"
                                                               cellspacing="0" width="100%">
                                                            <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Task Title</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Assigned users</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($tasklist as $value): ?>
                                                                <tr>
                                                                    <td><?php echo $value->id ?></td>
                                                                    <td><?php echo $value->task_title ?></td>
                                                                    <td><?php echo $value->start_date ?></td>
                                                                    <td><?php echo $value->end_date ?></td>
                                                                    <td>
                                                                        <?php
                                                                        $id = $value->id;
                                                                        $assignvalue = $this->project_model->getTaskAssignUser($id); ?>
                                                                        <?php foreach ($assignvalue as $value1): ?>
                                                                            <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $value1->em_image ?>"
                                                                                 height="40px" width="40px"
                                                                                 style="border-radius:50px" alt=""
                                                                                 data-toggle="tooltip"
                                                                                 data-placement="top" title=""
                                                                                 data-original-title="<?php echo $value1->user_type; ?>">
                                                                            <?php $value1->user_type; ?>
                                                                        <?php endforeach; ?>
                                                                    </td>

                                                                    <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?>
                                                                        <!--                                       <td class="jsgrid-align-center ">
                                        <a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light taskmodal" data-id="<?php #echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        </td> -->
                                                                    <?php } else { ?>
                                                                        <td class="jsgrid-align-center ">
                                                                            <a href="#" title="Edit"
                                                                               class="btn btn-sm btn-info waves-effect waves-light taskmodal"
                                                                               data-id="<?php echo $value->id ?>"><i
                                                                                        class="fa fa-pencil-square-o"></i></a>
                                                                            <a onclick="alert('Are you sure want to delet this Value?')"
                                                                               href="#" title="Delete"
                                                                               class="btn btn-sm btn-info waves-effect waves-light TasksDelet"
                                                                               data-id="<?php echo $value->id ?>"><i
                                                                                        class="fa fa-trash-o"></i></a>
                                                                        </td>
                                                                    <?php } ?>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="education" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <?php if ($this->session->userdata('user_type') != 'EMPLOYEE') { ?>
                                                        <form class="row" action="<?php echo base_url(); ?>projects/Add_File" id="insert_education"
                                                              method="post"
                                                              enctype="multipart/form-data">
                                                            <span id="error"></span>
                                                            <div class="form-group col-md-6">
                                                                <label>File Description</label>
                                                                <input type="text"
                                                                       class="form-control form-control-line"
                                                                       placeholder=" File description" name="details"
                                                                       required
                                                                       minlength="12">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Assign To</label>
                                                                <select class="form-control"
                                                                        data-placeholder="Choose a Category"
                                                                        tabindex="1"
                                                                        name="assignto" required>
                                                                    <option value="">Select User</option>
                                                                    <?php
                                                                    $id = $details->id;
                                                                    echo $id;
                                                                    $assignvalue = $this->project_model->getProjectAssignUser($id);
                                                                    ?>
                                                                    <?php foreach ($assignvalue as $value): ?>
                                                                        <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <div class="custom-file overflow-hidden  mb-5">
                                                                    <input name="img_url" id="img_url" type="file" class="custom-file-input">
                                                                    <label for="img_url" class="custom-file-label">Choose file</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions col-md-6">
                                                                <input type="hidden" name="proid"
                                                                       value="<?php echo $details->id; ?>">
                                                                <button type="submit" class="btn btn-primary rounded-btn mb-2"><i
                                                                            class="fa fa-check"></i> Save
                                                                </button>
                                                                <button type="reset" class="btn btn-warning rounded-btn mb-2"><i
                                                                            class="fas fa-redo"></i> Reset
                                                                </button>
                                                            </div>
                                                        </form>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="card mt-3">
                                                <div class="card-body">
                                                    <div class="table-responsive ">
                                                        <table id="data-table-three" data-page-length='10'
                                                               class="display table dataTable table-striped table-bordered text-center">
                                                            <thead>
                                                            <tr>
                                                                <th>File details</th>
                                                                <th>file</th>
                                                                <th>Assigned Employee</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($files as $value): ?>
                                                                <tr>
                                                                    <td><?php echo $value->file_details ?></td>
                                                                    <td>
                                                                        <a href="<?php echo base_url(); ?>assets/images/projects/<?php echo $value->file_url ?>"
                                                                           title="" data-toggle="app-modal"
                                                                           data-sidebar="1"
                                                                           data-url="<?php echo base_url(); ?>assets/images/projects/<?php echo $value->file_url ?>"><?php echo $value->file_url ?></a>
                                                                    </td>
                                                                    <td>
                                                                        <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $value->em_image ?>"
                                                                             height="40px" width="40px"
                                                                             style="border-radius:50px"
                                                                             alt="" data-toggle="tooltip"
                                                                             data-placement="top"
                                                                             title=""
                                                                             data-original-title="<?php echo $value->first_name; ?>">
                                                                    </td>

                                                                    <td class="jsgrid-align-center ">
                                                                        <?php if ($this->session->userdata('user_type') != 'EMPLOYEE') { ?>
                                                                            <a onclick="return confirm('Are you sure to delete this data?')" href="#"
                                                                               class="btn btn-sm btn-danger rounded-btn filedelet"
                                                                               data-id="<?php echo $value->id ?>">
                                                                                <i class="fa fa-trash"></i>
                                                                            </a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="experience" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form class="row" action="<?php echo base_url(); ?>projects/Add_Pro_Notes" method="post"
                                                          id="notesform">
                                                        <div class="form-group col-md-6 m-t-5">
                                                            <label> notes</label>
                                                            <input type="text" name="details"
                                                                   class="form-control form-control-line company_name"
                                                                   placeholder="Notes details">
                                                        </div>
                                                        <div class="form-group col-md-6 m-t-5">
                                                            <label>Assign To</label>
                                                            <select class="form-control"
                                                                    data-placeholder="Choose a Category" tabindex="1"
                                                                    name="assignto">
                                                                <option value="">Select User</option>
                                                                <?php
                                                                //$id = $details->id;
                                                                //echo $id;
                                                                $assignvalue = $this->project_model->getProjectAssignUser($id);
                                                                ?>
                                                                <?php foreach ($assignvalue as $value): ?>
                                                                    <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-actions col-md-12">
                                                            <input type="hidden" name="id" value="">
                                                            <input type="hidden" name="proid"
                                                                   value="<?php echo $details->id; ?>">
                                                            <button type="submit" class="btn btn-primary rounded-btn mb-2" <?php if ($this->session->userdata('user_type') == 'EMPLOYEE') { ?> disabled <?php } ?>>
                                                                <i class="fa fa-check"></i> Save
                                                            </button>
                                                            <button type="reset" class="btn btn-warning rounded-btn mb-2"><i
                                                                        class="fas fa-redo"></i> Reset
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="card mt-3">
                                                <div class="card-body">
                                                    <div class="table-responsive ">
                                                        <table id="data-table-four" data-page-length='10'
                                                               class="display table dataTable table-striped table-bordered text-center">
                                                            <thead>
                                                            <tr>
                                                                <th>Note title</th>
                                                                <th>Assigned users</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($notes as $value): ?>
                                                                <tr>
                                                                    <td><?php echo substr($value->details, 0, 60) . '...'; ?></td>
                                                                    <td>
                                                                        <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $value->em_image ?>"
                                                                             height="40px" width="40px"
                                                                             style="border-radius:50px"
                                                                             alt=""></td>
                                                                    <td>
                                                                        <a href="#" data-id="<?php echo $value->id ?>"
                                                                           class="btn btn-primary rounded-btn notes"><i
                                                                                    class="fa fa-edit"></i></a>

                                                                        <?php if ($this->session->userdata('user_type') != 'EMPLOYEE') { ?>
                                                                            <a onclick="return confirm('Are you sure to delete this data?')" href=""
                                                                               data-id="<?php echo $value->id ?>"
                                                                               class="btn btn-danger rounded-btn notesdelet">
                                                                                <i class="fa fa-trash"></i></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="expenses" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form class="row" action="<?php echo base_url(); ?>projects/Add_Expenses" method="post" id="expenseform">
                                                        <div class="form-group col-md-6 m-t-5">
                                                            <label>Details</label>
                                                            <input type="text" class="form-control form-control-line"
                                                                   placeholder="details..." name="details">
                                                        </div>
                                                        <div class="form-group col-md-6 m-t-5">
                                                            <label>Assign To</label>
                                                            <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="assignto">
                                                                <option value="">Select User</option>
                                                                <?php
                                                                $id = $details->id;
                                                                echo $id;
                                                                $assignvalue = $this->project_model->getProjectAssignUser($id);
                                                                ?>
                                                                <?php foreach ($assignvalue as $value): ?>
                                                                    <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6 m-t-5">
                                                            <label>Amount</label>
                                                            <input type="number" class="form-control form-control-line"
                                                                   placeholder=" amount.." name="amount">
                                                        </div>
                                                        <div class="form-group col-md-6 m-t-5">
                                                            <label>Date</label>
                                                            <input type="text"
                                                                   class="form-control form-control-line" id="calendar-month-five" data-format="yyyy-mm-dd"
                                                                   placeholder="" name="date" value>
                                                        </div>
                                                        <div class="form-actions col-md-12">
                                                            <input type="hidden" name="id" value="">
                                                            <input type="hidden" name="proid"
                                                                   value="<?php echo $details->id; ?>">
                                                            <button type="submit" class="btn btn-primary rounded-btn mb-2">
                                                                <i class="fa fa-check"></i> Save
                                                            </button>
                                                            <button type="reset" class="btn btn-warning rounded-btn mb-2">
                                                                <i class="fas fa-redo"></i> Reset
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="card mt-3">
                                                <div class="card-body">
                                                    <div class="table-responsive ">
                                                        <table id="data-table-five" data-page-length='10'
                                                               class="display table dataTable table-striped table-bordered text-center">
                                                            <thead>
                                                            <tr>
                                                                <th>Details</th>
                                                                <th>Assigned users</th>
                                                                <th>Date</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($expenses as $value): ?>
                                                                <tr>
                                                                    <td><?php echo $value->details ?></td>

                                                                    <td>
                                                                        <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $value->em_image ?>"
                                                                             height="40px" width="40px"
                                                                             style="border-radius:50px"
                                                                             title="<?php echo $value->first_name . ' ' . $value->last_name ?>"
                                                                             alt=""></td>
                                                                    <td><?php echo $value->date ?></td>
                                                                    <td><?php echo $value->amount ?></td>
                                                                    <td>
                                                                        <?php if ($this->session->userdata('user_type') != 'EMPLOYEE') { ?>
                                                                            <a href="#" data-id="<?php echo $value->id ?>"
                                                                               class="btn btn-primary rounded-btn expenses"><i
                                                                                        class="fa fa-edit"></i></a>

                                                                            <a onclick="return confirm('Are you sure to delete this data?')" href=""
                                                                               data-id="<?php echo $value->id ?>"
                                                                               class="btn btn-danger rounded-btn exdelet">
                                                                                <i class="fa fa-trash"></i></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="assets" role="tabpanel">
                                            <div class="card-body">
                                                <div class="table-responsive ">
                                                    <table id="example23"
                                                           class="display nowrap table table-hover table-striped table-bordered"
                                                           cellspacing="0" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Details</th>
                                                            <th>Assigned users</th>
                                                            <th>Date</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($expenses as $value): ?>
                                                            <tr>
                                                                <td><?php echo $value->id ?></td>
                                                                <td><?php echo $value->details ?></td>

                                                                <td>
                                                                    <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $value->em_image ?>"
                                                                         height="40px" width="40px"
                                                                         style="border-radius:50px"
                                                                         alt=""></td>
                                                                <td><?php echo $value->date ?></td>
                                                                <td><?php echo $value->amount ?></td>
                                                                <td class="jsgrid-align-center ">
                                                                    <a href="edit-employee.php" title="Edit"
                                                                       class="btn btn-sm btn-info waves-effect waves-light"><i
                                                                                class="fa fa-pencil-square-o"></i></a>
                                                                    <a href="#" title="Delete"
                                                                       class="btn btn-sm btn-info waves-effect waves-light"><i
                                                                                class="fa fa-trash-o"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <form class="row">
                                                    <div class="form-group col-md-6 m-t-5">
                                                        <label class="">Employee CV</label>
                                                        <input type="file" name="file" class="form-control" required=""
                                                               aria-invalid="false">
                                                    </div>
                                                    <div class="form-group col-md-6 m-t-5">
                                                        <label class="">NID Paper</label>
                                                        <input type="file" name="file" class="form-control" required=""
                                                               aria-invalid="false">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <button class="btn btn-success">Upload Document</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="logid" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <button class="btn btn-primary rounded-btn mb-2 d-block ml-auto" data-toggle="modal"
                                                            data-target="#logisticmodel" onclick="emptyInputValue()">
                                                        <i class="fa fa-plus"></i>
                                                        <span class="d-inline-block pl-1">Add Logistic Support</span>
                                                    </button>
                                                    <div class="table-responsive ">
                                                        <table id="data-table-six" data-page-length='10'
                                                               class="display table dataTable table-striped table-bordered text-center">
                                                            <thead>
                                                            <tr>
                                                                <th>Logistic Name</th>
                                                                <th>Assigned users</th>
                                                                <th>Quantity</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($logisticlist as $value): ?>
                                                                <tr>
                                                                    <td><?php echo $value->ass_name ?></td>
                                                                    <td><?php echo $value->first_name . ' ' . $value->last_name; ?></td>
                                                                    <td><?php echo $value->log_qty ?></td>
                                                                    <td><?php echo $value->start_date ?></td>
                                                                    <td><?php echo $value->end_date ?></td>
                                                                    <td class="jsgrid-align-center ">
                                                                        <a class="btn btn-primary rounded-btn installment text-light logisticeid"
                                                                           onclick="getLogisticData(<?php echo $value->ass_id ?>)"
                                                                           data-id="<?php echo $value->ass_id ?>">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <!--<a href="#" title="Delete" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-trash-o"></i></a>-->
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
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $this->load->view('backend/pro_modal'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".notes").click(function (e) {
                e.preventDefault(e);

                var iid = $(this).attr('data-id');
                $('#notesform').trigger("reset");

                $.ajax({
                    url: base + 'projects/NotesById?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function (response) {
                    $('#notesform').find('[name="id"]').val(response.notesbyidvalue.id).end();
                    $('#notesform').find('[name="details"]').val(response.notesbyidvalue.details).end();
                    $('#notesform').find('[name="assignto"]').val(response.notesbyidvalue.assign_to).end();
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".expenses").click(function (e) {
                e.preventDefault(e);

                var iid = $(this).attr('data-id');
                $('#expenseform').trigger("reset");

                $.ajax({
                    url: base + 'projects/ExpensesById?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function (response) {
                    // Populate the form fields with the data returned from server
                    $('#expenseform').find('[name="id"]').val(response.expensesvalue.id).end();
                    $('#expenseform').find('[name="details"]').val(response.expensesvalue.details).end();
                    $('#expenseform').find('[name="assignto"]').val(response.expensesvalue.assign_to).end();
                    $('#expenseform').find('[name="amount"]').val(response.expensesvalue.amount).end();
                    $('#expenseform').find('[name="date"]').val(response.expensesvalue.date).end();
                });
            });
        });
    </script>
    <script type="text/javascript">
        function getLogisticData(id) {
            $('#logisModalform').trigger("reset");
            $('#logisticmodel').modal('show');

            $.ajax({
                url: base + 'projects/LogisTicById?id=' + id,
                method: 'GET',
                dataType: 'json',
            }).done(function (response) {
                // Populate the form fields with the data returned from server
                $('#logisModalform').find('[name="id"]').val(response.logisticevalue.ass_id).end();
                $('#logisModalform').find('[name="proid"]').val(response.logisticevalue.project_id).end();
                $('#logisModalform').find('[name="teamhead"]').val(response.logisticevalue.assign_id).end();
                $('#logisModalform').find('[name="taskid"]').val(response.logisticevalue.task_id).end();
                $('#logisModalform').find('[name="startdate"]').val(response.logisticevalue.start_date).end();
                $('#logisModalform').find('[name="enddate"]').val(response.logisticevalue.end_date).end();
                $('#logisModalform').find('[name="remarks"]').val(response.logisticevalue.remarks).end();
                $('#logisModalform').find('[name="logistic"]').val(response.logisticevalue.asset_id).end();
                $('#logisModalform').find('[name="qty"]').val(response.logisticevalue.log_qty).end();
                $(".qty_error").text('');

                $(".assetsstock").change();
            });
        }

        function emptyInputValue() {
            $('#logisModalform').find('[name="id"]').val('').end();
            $('#logisModalform').find('[name="proid"]').val('').end();
            $('#logisModalform').find('[name="teamhead"]').val('').end();
            $('#logisModalform').find('[name="taskid"]').val('').end();
            $('#logisModalform').find('[name="startdate"]').val('').end();
            $('#logisModalform').find('[name="enddate"]').val('').end();
            $('#logisModalform').find('[name="remarks"]').val('').end();
            $('#logisModalform').find('[name="logistic"]').val('').end();
            $('#logisModalform').find('[name="qty"]').val('').end();
            $(".qty").text('');

        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".taskmodal").click(function (e) {
                e.preventDefault(e);

                var iid = $(this).attr('data-id');
                $('#tasksModalform').trigger("reset");
                $('#tasksmodel').modal('show');

                $.ajax({
                    url: base + 'projects/TasksById?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function (response) {
                    console.log(response);
                    // Populate the form fields with the data returned from server
                    $('#tasksModalform').find('[name="id"]').val(response.tasksvalue.id).end();
                    $('#tasksModalform').find('[name="projectid"]').val(response.tasksvalue.pro_id).end();
                    $('#tasksModalform').find('[name="assignto"]').val(response.tasksvalue.assigned_id).end();
                    $('#tasksModalform').find('[name="tasktitle"]').val(response.tasksvalue.task_title).end();
                    $('#tasksModalform').find('[name="startdate"]').val(response.tasksvalue.start_date).end();
                    $('#tasksModalform').find('[name="enddate"]').val(response.tasksvalue.end_date).end();
                    $('#tasksModalform').find('[name="details"]').val(response.tasksvalue.description).end();
                    $(".proid").change();

                    if (response.tasksvalue.status == 'complete') {
                        $('#radio_1').attr('checked', true);
                    } else if (response.tasksvalue.status == 'running') {
                        $('#radio_2').attr('checked', true);
                    } else if (response.tasksvalue.status == 'cancel') {
                        $('#radio_3').attr('checked', true);
                    }

                    if (response.tasksvalue.task_type == 'Office') {
                        $('#radio_4').attr('checked', true);
                    }


                    $("#assign_to option").each(function (key, item) {
                        $(item).removeAttr('selected');
                        $('.multiselect').each(function () {
                            $(this).select2({
                                theme: 'bootstrap4',
                                width: 'style',
                                placeholder: $(this).attr('placeholder'),
                                allowClear: Boolean($(this).data('allow-clear')),
                            });
                        });
                    });

                    $("#team_head option").each(function (key, item) {
                        $(item).removeAttr('selected');
                    });


                    $.each(response.employesvalue, function (key, item) {
                        if (item.user_type == 'Collaborators') {
                            $("#assign_to [value='" + item.assign_user + "']").attr("selected", "selected");
                            $('.multiselect').each(function () {
                                $(this).select2({
                                    theme: 'bootstrap4',
                                    width: 'style',
                                    placeholder: $(this).attr('placeholder'),
                                    allowClear: Boolean($(this).data('allow-clear')),
                                });
                            });
                        } else {
                            $("#team_head [value='" + item.assign_user + "']").attr("selected", "selected");
                        }
                    });


                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".TasksDelet").click(function (e) {
                e.preventDefault(e);
                var iid = $(this).attr('data-id');
                $.ajax({
                    url: base + 'projects/TasksDeletByid?id=' + iid,
                    method: 'GET',
                }).done(function () {
                    window.location.reload();
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".exdelet").click(function (e) {
                e.preventDefault(e);

                var iid = $(this).attr('data-id');
                $.ajax({
                    url: base + 'projects/deletExpenses?D=' + iid,
                    method: 'GET',
                    data: 'data',
                }).done(function () {
                    window.location.reload();
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".notesdelet").click(function (e) {
                e.preventDefault(e);

                var iid = $(this).attr('data-id');
                $.ajax({
                    url: base + 'projects/DeletNotes?D=' + iid,
                    method: 'GET',
                }).done(function () {
                    window.location.reload();
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".filedelet").click(function (e) {
                e.preventDefault(e);

                var iid = $(this).attr('data-id');

                $.ajax({
                    url: base + 'projects/FileDeletById?id=' + iid,
                    method: 'GET',
                    data: 'data',
                }).done(function () {
                    window.location.reload();
                });
            });
        });
    </script>
    <script>
        $("#qty").keyup(function () {
            const stock = parseInt($(".qty").text());
            const val = parseInt($(this).val());
            if (val > stock) {
                $(".qty_error").text('Please enter a value less than or equal to ' + stock);
                $(this).val('');
            } else {
                $(".qty_error").text('');
            }
        });
    </script>
<?php $this->load->view('backend/footer'); ?>