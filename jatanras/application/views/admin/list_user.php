<style type="text/css">
	.jarak {
		padding: 10px;
	}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2 class="page-header">Document Users</h2>
<?php $this->load->view('messages'); ?>
<div class="row">
	
	<?php if(empty($users)): ?>
          <div class="alert alert-warning">No result found</div>
        <?php else: ?>

    <?php foreach($users as $rows): ?>
	<div class="col-sm-4 col-lg-2 col-xl-2 jarak">
		<div class="card border-primary">
			<div class="card-body bg-primary text-white">
				<div class="float-left">
					<span class="fa fa-user fa-4x"></span>
				</div>
				<div class="clearfix"></div>
			</div>
			<a href="<?php echo site_url('admin/files/index/'.$rows->id); ?>">
				<div class="card-footer text-primary">
					<div class="float-left"><?php echo ucwords($rows->name); ?></div>
					<div class="float-right"><span class="fa fa-arrow-circle-right"></span></div>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<?php endforeach; ?>  
	<?php endif; ?>

</div>