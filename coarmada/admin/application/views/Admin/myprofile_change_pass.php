<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-thumb-tack"></i> My Profile
        <small>Profile</small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="index"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">My Profile</li>
          </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <div class="panel-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="profile-header">
                    <div class="overlay"></div>
                    <div class="profile-main">
                      <img src="<?php echo base_url('assets/images/avatar/'.$this->session->userdata('avatar'));?>" class="img-responsive" alt="Avatar">
                      
                    </div>
                  </div>
              </div>
              <div class="col-md-6">
                <?php if($this->session->flashdata('success')){ ?>
                  <div class="alert alert-success" id="success-alert">
                      <a href="" class="close" data-dismiss="alert">&times;</a>
                      <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                  </div>
                  <?php }else if($this->session->flashdata('error')){  ?>
                      <div class="alert alert-danger" id="error-alert">
                          <a href="" class="close" data-dismiss="alert">&times;</a>
                          <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                      </div>
              <?php } ?>

                <form method="post" action="<?php echo site_url('Admin/Myprofile/Update_pass');?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="password_lama">Password</label>
                      <input type="password" class="form-control" name="password" required="true" />
                  </div>

                  <div class="form-group">
                    <label for="password_baru">Confirm Password</label>
                      <input type="password" required="true" class="form-control" name="cpasssword" />
                  </div>

                  <a href="<?php echo base_url(); ?>Admin/myprofile" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Batal</a>
                  <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </form>
                
              </div>
            </div>
          </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>