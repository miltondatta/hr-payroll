<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

    <main>
        <div class="container-fluid">

            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Settings</h4></div>
                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item">Add Setting</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->

            <!-- START: Card Data-->
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

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Your Setting</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form action="Add_Settings" method="post" enctype="multipart/form-data"
                                              accept-charset="utf-8" class="needs-validation" novalidate>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustom01">Upload Logo</label>
                                                    <div class="custom-file overflow-hidden  mb-5">
                                                        <input id="customFile" name="img_url" type="file"
                                                               class="custom-file-input">
                                                        <label for="customFile" class="custom-file-label">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <?php if ($settingsvalue->sitelogo) { ?>
                                                        <img src="<?php echo base_url(); ?>assets/images/<?php echo $settingsvalue->sitelogo; ?>"
                                                             height="100" width="167">
                                                    <?php } else { ?>
                                                        <img src="<?php echo base_url(); ?>assets/img/ci-logo.png"
                                                             height="100" width="167">
                                                    <?php } ?>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Site Title</label>
                                                    <input type="text" class="form-control" name="title"
                                                           value="<?php echo $settingsvalue->sitetitle; ?>" id="title"
                                                           placeholder="Title..." required minlength="7"
                                                           maxlength="120">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Description</label>
                                                    <textarea class="form-control" id="description"
                                                              value="<?php echo $settingsvalue->description; ?>"
                                                              name="description" rows="4" required minlength="20"
                                                              maxlength="512"><?php echo $settingsvalue->description; ?></textarea>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Copyright</label>
                                                    <input type="text" class="form-control" name="copyright"
                                                           value="<?php echo $settingsvalue->copyright; ?>"
                                                           id="copyright" placeholder="copyright...">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Contact</label>
                                                    <input type="number" class="form-control" name="contact"
                                                           value="<?php echo $settingsvalue->contact; ?>" id="contact"
                                                           placeholder="contact...">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Currency</label>
                                                    <input type="text" class="form-control" name="currency"
                                                           value="<?php echo $settingsvalue->currency; ?>" id="currency"
                                                           placeholder="currency...">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Symbol</label>
                                                    <input type="text" class="form-control" name="symbol"
                                                           value="<?php echo $settingsvalue->symbol; ?>" id="symbol"
                                                           placeholder="symbol...">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>System Email</label>
                                                    <input type="text" class="form-control" name="email" id="email"
                                                           value="<?php echo $settingsvalue->system_email; ?>"
                                                           placeholder="email...">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" name="address" id="address"
                                                           value="<?php echo $settingsvalue->address; ?>"
                                                           placeholder="address...">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>Address 2</label>
                                                    <input type="text" class="form-control" name="address2"
                                                           id="address2" value="<?php echo $settingsvalue->address2; ?>"
                                                           placeholder="address more...">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <input type="hidden" name="id"
                                                           value="<?php echo $settingsvalue->id; ?>"/>
                                                    <label>&nbsp;</label>
                                                    <button class="btn btn-primary" type="submit">Submit</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Card DATA-->
        </div>
    </main>
    <!-- END: Content-->
<?php $this->load->view('backend/footer'); ?>