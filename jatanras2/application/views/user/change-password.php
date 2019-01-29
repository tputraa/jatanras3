<div id="changePwdModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo lang('mm_tl_change_password'); ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal" role="form" action="<?php echo site_url('media/change_password'); ?>" method="POST">
        <div class="modal-body">
          <?php $message = $this->session->flashdata('cpassword.message'); ?>
          <?php if($message): ?>
            <div class="row"><div class="col-sm-12"><?php echo $message; ?></div></div>
          <?php endif; ?>
          <!-- Old password -->
          <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label" data-toggle="tooltip" title="Old Password"><?php echo lang('mm_chpwd_lb_old_password'); ?></label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="old_password" name="old_password" placeholder="<?php echo lang('mm_chpwd_ph_old_password'); ?>" value="" autofocus>
              <?php echo form_error('old_password'); ?>
            </div>
          </div> 
          <!-- New password -->
          <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label" data-toggle="tooltip" title="New Password"><?php echo lang('mm_chpwd_lb_new_password'); ?></label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="new_password" name="new_password" placeholder="<?php echo lang('mm_chpwd_ph_new_password'); ?>" value="">
              <?php echo form_error('new_password'); ?>
            </div>
          </div> 
          <!-- Confirm password -->
          <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label" data-toggle="tooltip" title="Confirm New Password"><?php echo lang('mm_chpwd_lb_cnf_password'); ?></label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="<?php echo lang('mm_chpwd_lb_cnf_password'); ?>" value="">
              <?php echo form_error('conf_password'); ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang('mm_btn_close'); ?></button>
          <button type="submit" class="btn btn-primary"><?php echo lang('mm_btn_update_password'); ?></button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->