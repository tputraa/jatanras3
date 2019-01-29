<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> User Management
        <small>Edit User</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url('Admin/User/Update');?>" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control required" id="nama_lengkap" name="nama_lengkap" maxlength="128" value="<?php echo $user->nama_lengkap; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control required email" id="email"  name="email" maxlength="128" value="<?php echo $user->email; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control required" id="username" name="username" maxlength="25" value="<?php echo $user->username; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control required" id="password"  name="password" maxlength="15">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Level</label>
                                              <select class="form-control" name="level">
                                                <?php foreach($levels as $lv){ ?>
                                                  <option value="<?php echo $lv->level_id;?>">
                                                        <?php echo $lv->nama_level; ?>
                                                  </option>
                                                <?php } ?>
                                              </select>
                                    </div>
                                </div>    
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <a href="<?php echo base_url(); ?>userlist" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Batal</a>
                            <input type="submit" class="btn btn-primary" value="Submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </section>
</div>

<!-- <script src="<?php echo base_url();?>assets/js/addUser.js"></script> -->