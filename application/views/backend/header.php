<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->
<head>
    <meta charset="UTF-8">
    <?php $settingsvalue = $this->settings_model->GetSettingsValue(); ?>
    <title><?php echo $settingsvalue->sitetitle; ?></title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/fav.ico" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="author" content="Penta Global Ltd">
    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/flags-icon/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/flag-select/css/flags.css">
    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/morris/morris.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/starrr/starrr.css">
    <link href="<?= base_url(); ?>assets/dist/vendors/bootstrap-tour/css/bootstrap-tour-standalone.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet"
          href="<?= base_url(); ?>assets/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/fullcalendar/core/main.min.css">
    <link rel="stylesheet" href='<?= base_url(); ?>assets/dist/vendors/fullcalendar/daygrid/main.css' />
    <link rel="stylesheet" href='<?= base_url(); ?>assets/dist/vendors/fullcalendar/timegrid/main.css' />
    <link rel="stylesheet" href='<?= base_url(); ?>assets/dist/vendors/fullcalendar/list/main.css' />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/select2/css/select2.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/vendors/select2/css/select2-bootstrap.min.css" />
    <!-- END Template CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/main.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.style.css">
    <!-- END: Custom CSS-->
    <script src="<?= base_url(); ?>assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href='<?= base_url(); ?>assets/dist/vendors/time_picker/jquery-clockpicker.min.css' />
    <script src='<?= base_url(); ?>assets/dist/vendors/time_picker/jquery-clockpicker.min.js'></script>

</head>
<!-- END Head-->

<!-- START: Body-->
<body id="main-container" class="default">
<?php
$id            = $this->session->userdata('user_login_id');
$basicinfo     = $this->employee_model->GetBasic($id);
$settingsvalue = $this->settings_model->GetSettingsValue();
$year          = date('y');
$y             = substr($year, - 2);
$date          = date("m/d/$y");
$leavetoday    = $this->leave_model->GetLeaveToday($date);
?>
<!-- START: Pre Loader-->
<div class="se-pre-con">
    <img src="<?= base_url(); ?>assets/dist/images/logo.png" alt="logo" width="50" class="img-fluid" />
</div>
<!-- END: Pre Loader-->

<!-- Base Url -->
<input type="text" id="base" value="<?php echo base_url(); ?>"/>

<!-- START: Header-->
<div id="header-fix" class="header fixed-top">
    <nav class="navbar navbar-expand-lg  p-0">
        <div class="navbar-header h4 mb-0 align-self-center d-flex">
            <a href="<?= base_url(); ?>" class="horizontal-logo align-self-center d-flex d-lg-none">
                <img src="<?php echo base_url(); ?>assets/images/<?php echo $settingsvalue->sitelogo; ?>" alt="logo"
                     width="100" class="img-fluid" /> <span class="h5 align-self-center mb-0 ">HRM</span>
            </a>
            <a href="#" class="sidebarCollapse ml-2" id="collapse"><i class="icon-menu body-color"></i></a>
        </div>

        <!--<form class="float-left d-none d-lg-block search-form pl-3">
            <div class="form-group mb-0 position-relative">
                <input type="text" class="form-control border-0 rounded bg-search pl-5"
                       placeholder="Search anything...">
                <div class="btn-search position-absolute top-0">
                    <a href="#"><i class="h5 icon-magnifier body-color"></i></a>
                </div>
                <a href="#" class="position-absolute close-button mobilesearch d-lg-none" data-toggle="dropdown"
                   aria-expanded="false"><i class="icon-close h5"></i>
                </a>

            </div>
        </form>-->
        <div class="navbar-right ml-auto">
            <ul class="ml-auto p-0 m-0 list-unstyled d-flex">
                <li class="mr-1 d-inline-block my-auto d-block d-lg-none">
                    <a href="#" class="nav-link px-2 mobilesearch" data-toggle="dropdown" aria-expanded="false"><i
                                class="icon-magnifier h4"></i>
                    </a>
                </li>

                <li class="dropdown align-self-center mr-1 d-inline-block">
                    <a href="#" class="nav-link px-2" data-toggle="dropdown" aria-expanded="false"><i
                                class="icon-bell h4"></i>
                        <span class="badge badge-default"> <span class="ring">
                                    </span><span class="ring-point">
                                    </span> </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right border   py-0">
                        <?php foreach($leavetoday as $value): ?>
                            <li>
                                <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0"
                                   href="#">
                                    <div class="media">
                                        <h5><?php echo $value->first_name; ?></h5>
                                        <div class="media-body">
                                            <h6 class="mb-0 text-success"><?php echo $value->reason; ?></h6>
                                            <?php echo $value->start_date; ?>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li><a class="dropdown-item text-center py-2 text-dark" href="#"> <strong>Read All Notifications<i
                                            class="icon-arrow-right pl-2 small"></i></strong></a></li>
                    </ul>
                </li>

                <li class="dropdown user-profile d-inline-block py-1 mr-2">
                    <a href="#" class="nav-link px-2 py-0" data-toggle="dropdown" aria-expanded="false">
                        <div class="media">
                            <div class="media-body align-self-center d-none d-sm-block mr-2">
                                <p class="mb-0 text-uppercase line-height-1"><b><?php echo $basicinfo->first_name .
                                                                                           ' ' .
                                                                                           $basicinfo->last_name; ?></b><br /><span> <?php echo $basicinfo->em_email ?> </span>
                                </p>

                            </div>
                            <?php if( !empty($basicinfo->em_image)){
                                $login_image = $basicinfo->em_image;
                            } else{
                                $login_image = 'user.png';
                            } ?>
                            <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $login_image; ?>"
                                 alt="" class="d-flex img-fluid rounded-circle" width="45">

                        </div>
                    </a>

                    <div class="dropdown-menu  dropdown-menu-right p-0">
                        <a href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>"
                           class="dropdown-item px-2 align-self-center d-flex text-dark">
                            <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                        <?php if($this->session->userdata('user_type') != 'EMPLOYEE'){ ?>
                            <a href="<?php echo base_url(); ?>settings/Settings"
                               class="dropdown-item px-2 align-self-center d-flex text-dark">
                                <span class="icon-settings mr-2 h6 mb-0"></span> Account Settings</a>
                        <?php } ?>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo base_url(); ?>login/logout"
                           class="dropdown-item px-2 text-danger align-self-center d-flex">
                            <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                    </div>

                </li>

            </ul>
        </div>
    </nav>
</div>
<!-- END: Header-->