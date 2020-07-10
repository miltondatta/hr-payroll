<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Vacancy</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Vacancy</a></li>
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

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">Vacancy List</h4>

                                <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                        data-target="#vacancy-modal" onclick="emptyInputValue()">
                                    <i class="fa fa-plus"></i>
                                    <span class="d-inline-block pl-1">Add Vacancy</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" id="planned-leave-table-area">
                                    <table id="data-table" data-page-length='10'
                                           class="display table dataTable table-striped table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th>Job Title</th>
                                            <th>Vacancy Name</th>
                                            <th>Hiring Manager</th>
                                            <th>Number of position</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        <?php $status_text = ''; $badge_color = ''; ?>
                                        <?php foreach ($vacancy_data as $value): ?>
                                            <?php
                                            if ($value->status == 1) {
                                                $status_text = 'Active';
                                                $badge_color = 'success';
                                            } elseif ($value->status == 0) {
                                                $status_text = 'Inactive';
                                                $badge_color = 'danger';
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $value->des_name ?></td>
                                                <td><?php echo $value->vacancy_name ?></td>
                                                <td><?php echo $value->first_name . ' ' . $value->last_name; ?></td>
                                                <td><?php echo $value->number_of_position ?></td>
                                                <td><?php echo substr($value->description, 0, 50);
                                                    echo strlen($value->description) > 50 ? '...' : ''; ?></td>
                                                <td><span class="badge badge-pill badge-<?php echo $badge_color; ?> p-2 mb-1"><?php echo $status_text; ?></span></td>
                                                <td><?php echo date('jS \of F Y', strtotime($value->created_at)) ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-primary rounded-btn"
                                                       onclick="getVacancyInfoById(<?php echo $value->id; ?>)">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure to delete this data?')" href="<?php echo base_url(); ?>Vacancy/deleteVacancy/<?php echo $value->id; ?>"
                                                       class="btn btn-danger rounded-btn"><i class="fa fa-trash"></i></a>
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
                <!-- END: Card DATA-->
            </div>
        </div>
    </div>

    <div class="modal" id="vacancy-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel10">Vacancy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" method="post" action="addVacancy" id="btnSubmit">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="job_title" class="control-label col-md-3">Job Title</label>
                            <select name="job_title" id="job_title" class="form-control col-md-8" required>
                                <option value="">Select Job Title</option>
                                <?php
                                foreach ($designations as $record) {
                                    ?>
                                    <option value="<?php echo $record->id; ?>"><?php echo $record->des_name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="vacancy_name" class="control-label col-md-3">Vacancy Name</label>
                            <input type="text" name="vacancy_name" id="vacancy_name" class="form-control col-md-8" required>
                        </div>
                        <div class="form-group row">
                            <label for="hiring_manager" class="control-label col-md-3">Hiring Manager</label>
                            <select class="form-control col-md-8" name="hiring_manager" id="hiring_manager" required>
                                <option value="">Select Hiring Manager</option>
                                <?php foreach ($employee as $value): ?>
                                    <option value="<?php echo $value->em_id; ?>">
                                        <?php echo $value->first_name; echo ' '; echo $value->last_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="number_of_position" class="control-label col-md-3">Number Of Position</label>
                            <input type="number" name="number_of_position" id="number_of_position" class="form-control col-md-8" required>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="control-label col-md-3">Description</label>
                            <textarea class="form-control col-md-8" name="description" id="description" rows="4" required></textarea>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="control-label col-md-3">Status</label>
                            <select class="form-control col-md-8" name="status" id="status" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="">
                        <button type="button" class="btn btn-danger rounded-btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary rounded-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php $this->load->view('backend/footer'); ?>
<script>
    function getVacancyInfoById(id) {
        $('#btnSubmit').trigger("reset");
        $('#vacancy-modal').modal('show');

        $.ajax({
            url: 'vacancyById?id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).done(function (response) {
            $('#btnSubmit').find('[name="id"]').val(response.vacancy.id).end();
            $('#btnSubmit').find('[name="job_title"]').val(response.vacancy.job_title).end();
            $('#btnSubmit').find('[name="vacancy_name"]').val(response.vacancy.vacancy_name).end();
            $('#btnSubmit').find('[name="hiring_manager"]').val(response.vacancy.hiring_manager).end();
            $('#btnSubmit').find('[name="number_of_position"]').val(response.vacancy.number_of_position).end();
            $('#btnSubmit').find('[name="description"]').val(response.vacancy.description).end();
            $('#btnSubmit').find('[name="status"]').val(response.vacancy.status).end();
        });
    }

    function emptyInputValue() {
        $('#btnSubmit').trigger("reset");
        $('#btnSubmit').find('[name="id"]').val('').end();
    }

    function getPlannedLeaveData() {
        let em_id = $("#em_id").val();
        if (!em_id) {
            alert('Please select employee!');
            return;
        }

        $.ajax({
            url: 'getPlannedLeaveByEmployee',
            method: 'POST',
            data: {
                em_id: em_id,
            }
        }).done(function (data) {
            $("#planned-leave-table-area").empty();
            $("#planned-leave-table-area").append(data);
            $('#data-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                responsive: true
            });
        });
    }
</script>
