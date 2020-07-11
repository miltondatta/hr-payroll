<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Candidate</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Candidate</a></li>
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
                                <h4 class="card-title">Candidate List</h4>

                                <button class="btn btn-primary rounded-btn mb-2" data-toggle="modal"
                                        data-target="#candidate-modal" onclick="emptyInputValue()">
                                    <i class="fa fa-plus"></i>
                                    <span class="d-inline-block pl-1">Add Candidate</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" id="planned-leave-table-area">
                                    <table id="data-table" data-page-length='10'
                                           class="display table dataTable table-striped table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Vacancy Name</th>
                                            <th>File</th>
                                            <th>Comment</th>
                                            <th>Application Date</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        <?php foreach ($candidate_data as $value): ?>
                                            <tr>
                                                <td><?php echo $value->full_name ?></td>
                                                <td><?php echo $value->email ?></td>
                                                <td><?php echo $value->mobile; ?></td>
                                                <td><?php echo $value->vacancy_name ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>assets/images/candidate/<?php echo $value->resume_file; ?>" style="color: #5858b5;" download>
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td><?php echo substr($value->comment, 0, 50);
                                                    echo strlen($value->comment) > 50 ? '...' : ''; ?></td>
                                                <td><?php echo $value->application_date; ?></td>
                                                <td><?php echo date_format(date_create($value->created_at), 'Y-m-d H:i:s'); ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-primary rounded-btn"
                                                       onclick="getCandidateInfoById(<?php echo $value->id; ?>)">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure to delete this data?')"
                                                       href="<?php echo base_url(); ?>Candidate/deleteCandidate/<?php echo $value->id; ?>"
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

    <div class="modal" id="candidate-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel10">Candidate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" method="post" action="addCandidate" id="btnSubmit" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="full_name" class="control-label col-md-3">Full Name</label>
                            <input type="text" name="full_name" id="full_name" class="form-control col-md-8"
                                   required>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-md-3">Email</label>
                            <input type="email" name="email" id="email" class="form-control col-md-8" required>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="control-label col-md-3">Mobile</label>
                            <input type="text" name="mobile" id="mobile" class="form-control col-md-8" maxlength="11" required>
                        </div>
                        <div class="form-group row">
                            <label for="vacancy_id" class="control-label col-md-3">Vacancy</label>
                            <select name="vacancy_id" id="vacancy_id" class="form-control col-md-8" required>
                                <option value="">Select Vacancy</option>
                                <?php
                                foreach ($vacancy as $record) {
                                    ?>
                                    <option value="<?php echo $record->id; ?>"><?php echo $record->vacancy_name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Resume File</label>
                            <div class="custom-file overflow-hidden col-md-8">
                                <input name="resume_file" id="resume_file" type="file" class="custom-file-input" accept=".doc,.docx,.pdf,.xlsx">
                                <label for="resume_file" class="custom-file-label">Choose file</label>
                            </div>
                            <div class="col-md-8 offset-md-3 pl-0" id="previous-file-area">
                                <a href="" style="color: lightseagreen; font-size: 12px;" download>Download previous file</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comment" class="control-label col-md-3">Comment</label>
                            <textarea class="form-control col-md-8" name="comment" id="comment" rows="4"></textarea>
                        </div>
                        <div class="form-group row">
                            <label for="application_date" class="control-label col-md-3">Application Date</label>
                            <input type="date" class="form-control col-md-8" name="application_date" id="application_date" rows="4" required>
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
    $(document).ready(function () {
        $("#previous-file-area").hide();
    });

    function getCandidateInfoById(id) {
        $('#btnSubmit').trigger("reset");
        $('#candidate-modal').modal('show');
        let base = $("#base").val();

        $.ajax({
            url: 'candidateById?id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).done(function (response) {
            $("#previous-file-area").show();
            $("#previous-file-area a").attr('href', base + 'assets/images/candidate/' +response.candidate.resume_file);
            $('#btnSubmit').find('[name="id"]').val(response.candidate.id).end();
            $('#btnSubmit').find('[name="full_name"]').val(response.candidate.full_name).end();
            $('#btnSubmit').find('[name="mobile"]').val(response.candidate.mobile).end();
            $('#btnSubmit').find('[name="email"]').val(response.candidate.email).end();
            $('#btnSubmit').find('[name="vacancy_id"]').val(response.candidate.vacancy_id).end();
            $('#btnSubmit').find('[name="comment"]').val(response.candidate.comment).end();
            $('#btnSubmit').find('[name="application_date"]').val(response.candidate.application_date).end();
        });
    }

    function emptyInputValue() {
        $('#btnSubmit').trigger("reset");
        $('#btnSubmit').find('[name="id"]').val('').end();
        $("#previous-file-area").hide();
    }
</script>
