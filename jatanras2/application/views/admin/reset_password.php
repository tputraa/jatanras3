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
		<div class="col-md-6">
			<div class="card card-recover">
			  <div class="card-header">Reset Password</div>
			  <form class="form-horizontal" role="form" action="<?php echo site_url('admin/dashboard/update_password'); ?>" method="POST" accept-charset="utf-8">
					<div class="card-body">						
    				<?php $this->load->view('messages'); ?>
    				<div class="form-group row">
					    <label for="password" class="col-sm-3 col-form-label" data-toggle="tooltip" title="Password">Password</label>
					    <div class="col-sm-9">
					      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" autofocus>
								<?php echo form_error('password'); ?>
					    </div>
					  </div>
					</div>
					<div class="card-footer text-right">
						<button type="submit" class="btn btn-primary">Submit</button>
						<a href="<?php echo site_url('admin'); ?>" class="btn btn-secondary">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>