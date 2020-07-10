<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Training Budget</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Training Budget</a></li>
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
                                <h4 class="card-title">Edit Training Budget</h4>
                            </div>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="post"
                                                  action="<?php echo base_url(); ?>budget/update/<?php echo $item->id; ?>">
                                                <div class="form-group">
                                                    <label for="Financial Year">Financial Year</label>
                                                    <input type="text" class="form-control" name="financial_year"
                                                           id="financial_year"
                                                           placeholder="Financial Year"
                                                           value="<?php echo $item->financial_year; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Budget Period">Budget Period</label>
                                                    <select class="form-control" tabindex="1" name="budget_period"
                                                            id="budget_period">
                                                        <option value="">Select Budget Period</option>
                                                        <option value="1" <?php echo ($item->budget_period == 1) ?
                                                            "selected" : ''; ?>>Monthly
                                                        </option>
                                                        <option value="2" <?php echo ($item->budget_period == 2) ?
                                                            "selected" : ''; ?>>Quarterly
                                                        </option>
                                                        <option value="3" <?php echo ($item->budget_period == 3) ?
                                                            "selected" : ''; ?>>Half Yearly
                                                        </option>
                                                        <option value="4" <?php echo ($item->budget_period == 4) ?
                                                            "selected" : ''; ?>>Yearly
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <input type="text" class="form-control" name="amount"
                                                           id="amount" placeholder="Amount"
                                                           value="<?php echo $item->amount; ?>"
                                                    >
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary rounded-btn mb-2"><i
                                                                class="fa fa-check"></i> Update
                                                    </button>
                                                    <a href="<?php echo base_url(); ?>budget/index"
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
                                <h4 class="card-title">Add Training Budget</h4>
                            </div>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="post" action="save">
                                                <div class="form-group">
                                                    <label for="financial_year">Financial Year</label>
                                                    <input type="text" class="form-control" name="financial_year"
                                                           id="financial_year"
                                                           placeholder="Financial Year" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="budget_period">Budget Period</label>
                                                    <select class="form-control" tabindex="1" name="budget_period"
                                                            id="budget_period" required>
                                                        <option value="">Select Budget Period</option>
                                                        <option value="1">Monthly</option>
                                                        <option value="2">Quarterly</option>
                                                        <option value="3">Half Yearly</option>
                                                        <option value="4">Yearly</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <input type="number" class="form-control" name="amount"
                                                           id="amount" placeholder="Amount" required>
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
                                    <h4 class="card-title">Training Budget</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-table"
                                               class="display table dataTable table-striped table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>Financial Year</th>
                                                <th>Budget Period</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php foreach($lists as $value){ ?>
                                                <tr>
                                                    <td><?php echo $value->financial_year; ?></td>
                                                    <td><?php echo $value->budget_period_name; ?></td>
                                                    <td><?php echo $value->amount; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>budget/edit/<?php echo $value->id; ?>"
                                                           class="btn btn-primary rounded-btn"><i
                                                                    class="fa fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure to delete this data?')"
                                                           href="<?php echo base_url(); ?>budget/delete/<?php echo $value->id; ?>"
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