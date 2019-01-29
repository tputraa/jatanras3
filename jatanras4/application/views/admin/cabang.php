<style type="text/css">
	.jarak {
		padding: 10px;
	}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2 class="page-header">Document Cabang</h2>
<?php $this->load->view('messages'); ?>
<div class="row">
	<?php if(empty($region)): ?>
          <div class="alert alert-warning">No result found</div>
        <?php else: ?>

    <?php foreach($region as $rows): ?>
	<div class="col-sm-4 col-lg-2 col-xl-2 jarak">
		<div class="card border-primary">
			<div class="card-body bg-primary text-white">
				<div class="float-left">					<span class="fa fa-sitemap fa-2x"></span>
				</div>
				
				<div class="clearfix"></div>
			</div>
			<a href="<?php echo site_url('admin/region/list_user_cabang/'.$rows->id);?>">
				<div class="card-footer text-primary">
					<div class="float-left"><?php echo $rows->name; ?></div>
					
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

				<div></div>
	<?php endforeach; ?>  
	<?php endif; ?>

</div>