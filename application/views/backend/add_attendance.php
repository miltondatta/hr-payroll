<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

    <main>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto"><h4 class="mb-0">Attendance</h4></div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>attendance/Attendance">Attendance</a>
                            </li>
                            <li class="breadcrumb-item active"><?php echo $card_head; ?></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  mt-3">
                    <?php if($this->session->flashdata('feedback')){ ?>
                        <div class="alert alert-success alert-dismissible show" role="alert">
                            <strong><?php echo $this->session->flashdata('feedback'); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php if($this->session->flashdata('error')){ ?>
                        <div class="alert alert-danger alert-dismissible show" role="alert">
                            <strong><?php echo $this->session->flashdata('error'); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?php } ?>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="fa fa-compass"
                                                      aria-hidden="true"></i><?php echo $card_head; ?></h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="Add_Attendance" id="holidayform">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Employee</label>
                                        <select class="form-control" data-placeholder="Choose a Category"
                                                tabindex="1" name="emid" required>
                                            
                                            <?php if( !empty($attval->em_code)){ ?>
                                                <option value="<?php echo $attval->em_code ?>"><?php echo $attval->first_name .
                                                                                                          ' ' .
                                                                                                          $attval->last_name ?></option>
                                            <?php } else{ ?>
                                                <option value="#">Select Here</option>
                                                <?php foreach($employee as $value): ?>
                                                    <option value="<?php echo $value->em_code ?>"><?php echo $value->first_name .
                                                                                                             ' ' .
                                                                                                             $value->last_name ?></option>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label>Select Date: </label>
                                    <div class="input-group mb-3">
                                        <input name="attdate" class="form-control mydatetimepickerFull"
                                               id="calendar-month"
                                               value="<?php if( !empty($attval->atten_date)){
                                                   $old_date_timestamp = strtotime($attval->atten_date);
                                                   $new_date           = date('Y-m-d', $old_date_timestamp);
                                                   echo $new_date;
                                               } ?>" required autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent border-left-0"
                                                  id="basic-email"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="m-t-20">Sign In Time</label>
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input class="form-control" name="signin" id="single-input"
                                                   value="<?php if( !empty($attval->signin_time)){
                                                       echo $attval->signin_time;
                                                   } ?>" required autocomplete="off">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="m-t-20">Sign Out Time</label>
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" name="signout" class="form-control"
                                                   value="<?php if( !empty($attval->signout_time)){
                                                       echo $attval->signout_time;
                                                   } ?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Place</label>
                                        <select class="form-control" data-placeholder="" tabindex="1"
                                                name="place"
                                                required>
                                            <option value="office" <?php if(isset($attval->place) &&
                                                                            $attval->place == "office"){
                                                echo "selected";
                                            } ?>>Office
                                            </option>
                                            <option value="field" <?php if(isset($attval->place) &&
                                                                           $attval->place == "field"){
                                                echo "selected";
                                            } ?>>Field
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id" value="<?php if( !empty($attval->id)){
                                        echo $attval->id;
                                    } ?>" class="form-control" id="recipient-name1">
                                    <button type="reset" class="btn btn-warning rounded-btn mb-2">
                                        <i class="fas fa-redo"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary rounded-btn mb-2">
                                        <i class="fa fa-check"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="holysmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Holidays</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post" action="Add_Holidays" id="holidayform" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label">Holidays name</label>
                                <input type="text" name="holiname" class="form-control" id="recipient-name1"
                                       minlength="4"
                                       maxlength="25" value="" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Holidays Start Date</label>
                                <input type="date" name="startdate" class="form-control" id="recipient-name1" value="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Holidays End Date</label>
                                <input type="date" name="enddate" class="form-control" id="recipient-name1" value="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Number of Days</label>
                                <input type="number" name="nofdate" class="form-control" id="recipient-name1" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label"> Year</label>
                                <textarea class="form-control" name="year" id="message-text1"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" value="" class="form-control" id="recipient-name1">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $('.clockpicker').clockpicker();
        </script>
        <script type="text/javascript">
            $(document).ready(function (){
                $(".holiday").click(function (e){
                    e.preventDefault(e);
                    // Get the record's ID via attribute
                    var iid = $(this).attr('data-id');
                    $('#holidayform').trigger("reset");
                    $('#holysmodel').modal('show');
                    $.ajax({
                        url     : 'Holidaybyib?id=' + iid,
                        method  : 'GET',
                        data    : '',
                        dataType: 'json',
                    }).done(function (response){
                        console.log(response);
                        // Populate the form fields with the data returned from server
                        $('#holidayform').find('[name="id"]').val(response.holidayvalue.id).end();
                        $('#holidayform').find('[name="holiname"]').val(response.holidayvalue.holiday_name).end();
                        $('#holidayform').find('[name="startdate"]').val(response.holidayvalue.from_date).end();
                        $('#holidayform').find('[name="enddate"]').val(response.holidayvalue.to_date).end();
                        $('#holidayform').find('[name="nofdate"]').val(response.holidayvalue.number_of_days).end();
                        $('#holidayform').find('[name="year"]').val(response.holidayvalue.year).end();
                    });
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function (){
                $(".holidelet").click(function (e){
                    e.preventDefault(e);
                    // Get the record's ID via attribute
                    var iid = $(this).attr('data-id');
                    $.ajax({
                        url   : 'HOLIvalueDelet?id=' + iid,
                        method: 'GET',
                        data  : 'data',
                    }).done(function (response){
                        console.log(response);
                        $(".message").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
                        window.setTimeout(function (){location.reload()}, 2000)
                        // Populate the form fields with the data returned from server
                    });
                });
                $("#attendanceUpdate").on("click", function (){
                    window.setTimeout(function (){location.reload()}, 1000);
                });
            });
        </script>
    </main>

<?php $this->load->view('backend/footer'); ?>