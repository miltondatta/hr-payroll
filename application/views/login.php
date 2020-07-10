<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
<head>
        <meta charset="UTF-8">
        <title>HRM Login</title>
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/dist/images/fav.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/flags-icon/css/flag-icon.min.css"> 
        <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/flag-select/css/flags.css">
        <!-- END Template CSS-->     

        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/social-button/bootstrap-social.css"/>   
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/main.css">
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <style>
        body {
            /*background: -webkit-linear-gradient(bottom, #0250c5, #d43f8d);*/
            background-image: url("<?php echo base_url(); ?>assets/images/bg-01.jpg");
            -webkit-background-size: cover;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: 30% 30%;
        }
    </style>

    <!-- START: Body-->
    <body id="main-container" class="default">
        <!-- START: Main Content-->
        <div class="container">
            <div class="row vh-100 justify-content-between align-items-center">
                <div class="col-12">
                    <form method="POST" action="login/Login_Auth" id="loginform" class="row row-eq-height lockscreen  mt-5 mb-5">
                        <div class="lock-image col-12 col-sm-5"></div>
                        <div class="login-form col-12 col-sm-7">
                            <div class="form-group mb-3">
                                <label for="emailaddress">Email address</label>
                                <input name="email" class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email" value="<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email']; } ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input name="password" class="form-control" type="password" required="" id="password" placeholder="Enter your password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>">
                            </div>

                            <div class="form-group mb-3">
                            <?php if(!empty($this->session->flashdata('feedback'))){ ?>
                                <div class="alert alert-danger" role="alert">
                                <?php echo $this->session->flashdata('feedback')?>
                                </div>
                            <?php
                                }
                            ?>     
                            </div>

                            <div class="form-group mb-0">
                                <button class="btn btn-primary" type="submit"> Log In </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- END: Content-->

        <!-- START: Template JS-->
        <script src="<?= base_url(); ?>assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="<?= base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?= base_url(); ?>assets/dist/vendors/moment/moment.js"></script>
        <script src="<?= base_url(); ?>assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="<?= base_url(); ?>assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?= base_url(); ?>assets/dist/vendors/flag-select/js/jquery.flagstrap.min.js"></script> 
        <!-- END: Template JS-->  
    </body>
    <!-- END: Body-->

</html>
