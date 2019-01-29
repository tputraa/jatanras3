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
                <form method="post" action="<?php echo site_url('Admin/Myprofile/UpdateAvatar');?>" enctype="multipart/form-data">
                  <?php echo $error; ?>
                  <div class="form-group">
                    <input type="file" name="userfile" class="form-control" required>
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