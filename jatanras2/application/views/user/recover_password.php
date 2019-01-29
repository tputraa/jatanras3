<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
	<!-- header -->
	<header id="page-title" class="row">
		<div class="col-12 text-center">
			<h1><span class="fa fa-picture-o"></span> 
			<?php 
			$this->load->config('site');
			echo $this->config->item('site_name'); 
			?>
			</h1>
		</div>
	</header>
	<!-- /.header -->
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card card-recover">
			  <div class="card-header"><?php echo lang('mm_tl_rec_pwd'); ?></div>
			  <form class="form-horizontal" role="form" action="<?php echo site_url('user/get_recovery_link'); ?>" method="POST" accept-charset="utf-8">
					<div class="card-body">
						<div class="alert alert-info" role="alert"><?php echo lang('mm_txt_rec_pwd_alert'); ?></div>
    				<?php $this->load->view('messages'); ?>
    				<div class="form-group row">
					    <label for="user" class="col-sm-3 col-form-label" data-toggle="tooltip" title="<?php echo lang('mm_ru_lb_email'); ?>"><?php echo lang('mm_ru_lb_email'); ?></label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="user" name="user" placeholder="<?php echo lang('mm_ru_ph_email'); ?>" value="<?php echo set_value('user'); ?>" autofocus>
								<?php echo form_error('user'); ?>
					    </div>
					  </div>
					</div>
					<div class="card-footer text-right">
						<button type="submit" class="btn btn-primary"><?php echo lang('mm_btn_submit'); ?></button>
						<a href="<?php echo site_url('user'); ?>" class="btn btn-secondary"><?php echo lang('mm_btn_cancel'); ?></a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>