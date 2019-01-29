<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<div id="media-container">                   
	<form id="media-form" action="<?php echo site_url(CN_BASE.'index'); ?>" method="POST">
		
		<div class="control-bar">
			<a id="homeDir" class="btn btn-secondary btn-sm" href="<?php echo site_url('admin/region');?>"><i class="fa fa-sitemap"></i></a>
			<button type="button" id="thumbs" data-layout="thumbs" class="btn btn-sm btn-secondary btn-layout"><span class="fa fa-th-large"></span></button>
			<button type="button" id="details" data-layout="details" class="btn btn-sm btn-secondary btn-layout"><span class="fa fa-list"></span></button>

			<button type="button" id="selectAll" class="btn btn-sm btn-secondary selectAll"><span class="fa fa-check-square-o"></span></button>

			<button type="button" id="btn-select" class="btn btn-sm btn-secondary d-none"><span class="fa fa-check"></span> <span class="d-none d-sm-inline"><?php echo lang('mm_btn_select_items'); ?></span></button>

			<button type="button" id="download" class="btn btn-info btn-sm" ><span class="fa fa-cloud-download"></span> <span class="d-none d-sm-inline"> Download</span></button>

			<input id="path2" name="path2" value="<?php echo $path; ?>" type="hidden" />   

			<?php 

			$crumb = explode("/", $path);
			$newpath = '';
			$i=1;
			foreach($crumb as $value) {
			    $newpath .= $value;
			    if ($i==1){
			    	?>
			    		<a class="btn btn-secondary btn-sm mediapath" href='<?php echo $newpath;?>'> <i class='fa fa-home'></i></a>
			    	<?php 
			    }else {
			    	?>
			    		<a class="btn btn-secondary btn-sm mediapath" href='<?php echo $newpath;?>'> <span><?php echo ucwords($value); ?></span></a>
			    	<?php
			    }
			    $newpath .= '/';
			    $i++;
			}
			?>

		</div>

		<!-- /.control-bar -->
		<!-- thumbs view -->    
		<div id="thumbs-layout" class="media-layout d-none">
			<?php $this->load->view('thumbs'); ?>
		</div>
		<!-- /.thumbs view -->
		<!-- details view -->
		<div id="details-layout" class="media-layout d-none">		
			<?php $this->load->view('details'); ?>
		</div>
		<!-- /.details view -->		
		<input id="path" name="path" type="hidden" />   
		                    
	</form>
</div>  



