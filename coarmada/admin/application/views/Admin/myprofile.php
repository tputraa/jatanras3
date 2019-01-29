<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-thumb-tack"></i> My Profile
        <small>Profile</small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
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
                <div class="form-group">
                  <div class="message">
                    
                  </div>
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" value="<?php echo $this->session->userdata('nama_lengkap');?>" readonly>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" value="<?php echo $this->session->userdata('email');?>" readonly>
                </div>
                <a href="<?php echo site_url();?>admin/Myprofile/Change_password"><button class="btn btn-danger">Change Password</button></a>
                <a href="<?php echo site_url();?>Admin/Myprofile/Change_avatar"><button class="btn btn-primary">Change Avatar</button></a>
                
              </div>
            </div>
          </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>