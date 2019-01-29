<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
  <!-- header -->
  <header id="page-title" class="row">
    <div class="col-12 text-center">
      <h1><span class="fa fa-picture-o"></span> 
      <?php 
      $this->load->config('site');
      echo $this->config->item('site_name').' - Admin'; 
      ?>
      </h1>
    </div>
  </header>
  <!-- /.header -->
  <div class="row justify-content-center">
    <div class="col-md-4">
      <?php $this->load->view('messages'); ?>
      <div class="card card-login">
        <div class="card-header">Please Sign In</div>
        <div class="card-body">
          <form role="form" action="<?php echo site_url('admin/dashboard/validate_credentials'); ?>" method="POST">
            <fieldset>
              <div class="form-group">
                <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Password" name="password" type="password" value="">
              </div>                            
              <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>                            
              <div class="form-bottom-links">                                    
                <a href="<?php echo site_url('admin/dashboard/recover_username'); ?>">Forgot Username?</a><br>
                <a href="<?php echo site_url('admin/dashboard/recover_password'); ?>">Forgot password?</a>                                                                            
              </div>
            </fieldset>
          </form>
        </div>                    
      </div>
    </div>
  </div>
</div>