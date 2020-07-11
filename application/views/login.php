<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HRM Login</title>
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/dist/images/fav.ico"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/flags-icon/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/flag-select/css/flags.css">
    <!-- END Template CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/main.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/login.css">
    <!-- END: Custom CSS-->
</head>
<body>
<main>
    <div id="wrapper">
        <div class="login-left-side">
            <div class="login-logo-area">
                <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="">
            </div>
            <div class="login-form-area">
                <?php if (!empty($this->session->flashdata('feedback'))) { ?>
                    <div class="alert alert-danger mb-0" role="alert">
                        <?php echo $this->session->flashdata('feedback') ?>
                    </div>
                    <?php
                }?>
                <form method="POST" action="login/Login_Auth" id="loginform">
                    <h3>Log In</h3>
                    <div class="form-group">
                        <input type="email" onfocus="getFocus('email-inside')" onblur="getBlur('email-inside')" name="email" class="form-control form-control-lg float-input inside-label" id="email" value="<?php if (isset($_COOKIE['email'])) { echo $_COOKIE['email'];} ?>" required>
                        <label class="form-control-placeholder inside email-inside" for="email">Email</label>
                    </div>
                    <div class="form-group">
                        <input type="password" onfocus="getFocus('password-inside')" onblur="getBlur('password-inside')" name="password" class="form-control form-control-lg float-input inside-label" id="password" value="<?php if (isset($_COOKIE['password'])) {echo $_COOKIE['password'];} ?>" required>
                        <label class="form-control-placeholder inside password-inside" for="password">Password</label>
                    </div>
                    <div class="d-flex justify-content-between login-button-area">
                        <button type="submit" class="login-button">Log In</button>
                        <a href="javascript:void(0);" class="login-forget-password">Forgot Password?</a>
                    </div>
                    <div class="login-version-text">
                        <p class="m-0 p-0">Penta HRM 2.0.1</p>
                    </div>
                </form>
            </div>
        </div>
        <div class="login-right-side">
            <img src="<?php echo base_url(); ?>assets/images/Login01_vector.png" alt="">
        </div>
    </div>
</main>

<!-- START: Template JS-->
<script src="<?= base_url(); ?>assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
<script src="<?= base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>assets/dist/vendors/moment/moment.js"></script>
<script src="<?= base_url(); ?>assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url(); ?>assets/dist/vendors/flag-select/js/jquery.flagstrap.min.js"></script>
<!-- END: Template JS-->

<!-- START: APP JS-->
<script src="<?= base_url(); ?>assets/dist/js/app.js"></script>
<!-- END: APP JS-->

<script>
    function getFocus(class_name) {
        $("."+class_name).css("color", "#0093c4");
    }

    function getBlur(class_name) {
        $("."+class_name).css("color", "#212529");
    }
</script>
</body>
</html>
