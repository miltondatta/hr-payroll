<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

<main>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto">
                        <h4 class="mb-0">Role Management</h4>
                    </div>
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Role Assign</a></li>
                        <li class="breadcrumb-item active">Role Assignment</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> User Role Access Edit: <?php echo $role_name; ?> </h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body py-5">
                        <form method="post" action="AssignMenuSave" enctype="multipart/form-data">

                        <input type="hidden" name="menu_assign_id" value="<?php echo $menu_assign_id; ?>">
                        <input type="hidden" name="role_id" value="<?php echo $role_id; ?>">

                            <?php
                                foreach($mainMenu as $record) { ?>
                            <div style="margin-left:50px">
                                <input type="checkbox" name="menu_ids[]" <?php if(in_array($record->id, $menu_id)) echo 'checked=""'; ?> value="<?php echo $record->id ?>">
                                <label
                                    for="primary"><?php echo $record->name ?></label>
                            </div>
                            <br>
                            <?php
                            $subMenu  = $this->settings_model->getMenu($record->id); 
                            foreach($subMenu as $row) { ?>
                                <div style="margin-left:100px">
                                <input type="checkbox" name="menu_ids[]" value="<?php echo $row->id ?>" <?php if(in_array($row->id, $menu_id)) echo 'checked=""'; ?>>
                                <label
                                    for="chksecondary"><?php  echo $row->name ?></label>
                                </div>   
                                <br>
                            <?php }
                                }
                            ?>

<button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Submit</button>
                                
                         </form>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view('backend/footer'); ?>