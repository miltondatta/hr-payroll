<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Leave Types</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Leave</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="fa fa-compass" aria-hidden="true"></i> Leave Sheet
                            </h4>
                        </div>
                        <div class="card-body">
                            <table id="data_table_example"
                                   class="display table dataTable table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Em ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Duration</th>
                                    <th>Hour</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($embalance as $value): ?>
                                    <tr>
                                        <td><?php echo $value->emp_id; ?></td>
                                        <td>
                                            <mark><?php echo $value->first_name . ' ' . $value->last_name ?></mark>
                                        </td>
                                        <td>
                                            <mark><?php echo $value->name ?></mark>
                                        </td>
                                        <td><?php echo $value->day ?></td>
                                        <td><?php echo $value->hour ?></td>
                                        <td><?php echo $value->dateyear ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $this->load->view('backend/footer'); ?>