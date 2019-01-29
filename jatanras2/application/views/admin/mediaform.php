<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- file upload form -->        
<div id="collapse-upload" class="collapse media-forms">   
	<form id="upload-form" action="<?php echo site_url(CN_BASE.'do_upload'); ?>" method="post" enctype="multipart/form-data" class="dropzone" role="form">
		<div class="form-inline">
			<div class="form-group fallback">              
				<label for="filedata">Upload file</label>      
				<input type="file" name="filedata[]" id="filedata" class="form-control form-control-sm mx-sm-3" multiple>
				<button class="btn btn-sm btn-primary"><span class="fa fa-upload"></span> Start Upload</button>
			</div>
		</div>
		<div class="meter"><span class="roller"></span></div>
		<button type="button" class="btn btn-sm btn-primary btn-upload"><span class="fa fa-upload"></span> Start Upload</button>
	</form>
	<p class="text-muted small">Upload files (Maximum Size: <?php echo $this->config->item('max_size'); ?> MB)</p>
</div>      
<!-- /.file upload form -->
<!-- create folder form -->
<div id="collapse-folder" class="collapse media-forms">
	<form action="<?php echo site_url(CN_BASE.'create_folder'); ?>" method="post" class="form-inline" role="form">
		<div class="form-group">
			<label class="sr-only" for="folderpath">Folder path</label>
			<input type="text" id="folderpath" class="form-control form-control-sm" readonly value="<?php echo $this->session->userdata('path').'/'; ?>">
		</div>
		<div class="form-group mx-sm-3">
			<label class="sr-only" for="foldername">Folder name</label>
			<input type="text" name="foldername" id="foldername" class="form-control form-control-sm">
		</div>          
		<button type="submit" class="btn btn-secondary btn-sm"><span class="fa fa-folder-open"></span> Create Folder</button>
	</form>
</div>


<div id="collapse-search" class="collapse media-forms">
	<form action="<?php echo site_url(CN_BASE.'create_folder'); ?>" method="post" class="form-inline" role="form">
		
		<div class="form-group">
			<input type="text" name="foldername" id="foldername" class="form-control form-control-sm">
		</div>          
		<button type="submit" class="btn btn-secondary btn-sm mx-sm-3"><span class="fa fa-search"></span> Search File</button>
	</form>
</div>

<!-- /.create folder form -->