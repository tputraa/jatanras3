<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2 class="page-header">Media Manager Settings</h2>
<?php $this->load->view('messages'); ?>  
<div class="card">
  <div class="card-header">Media Form</div>
  <div class="card-body">
    <form action="<?php echo site_url('admin/media/save_params'); ?>" method="POST">
      <!-- allowed extensions -->
      <fieldset class="form-group">
        <div class="row">
          <label for="allowed_types" class="col-md-5 col-lg-3" data-toggle="tooltip" title="Allowed extension types (separated by comma)">Allowed Types</label>
          <div class="col-md-7 col-lg-4"><input type="text" class="form-control" id="allowed_types" name="allowed_types" placeholder="Allowed Extensions (separated by comma)" value="<?php echo $this->config->item('allowed_types'); ?>"></div>
        </div>
      </fieldset>
      <!-- msx. file size -->                  
      <fieldset class="form-group">
        <div class="row">
          <label for="max_size" class="col-md-5 col-lg-3" data-toggle="tooltip" title="Maximum file size (MB) can be uploaded">Maximum Size (in MB)</label>
          <div class="col-md-7 col-lg-4"><input type="number" min="1" class="form-control" id="max_size" name="max_size" placeholder="Maximum size (MB)" value="<?php echo $this->config->item('max_size'); ?>"></div>
        </div>
      </fieldset>
      <!-- max. width -->
      <fieldset class="form-group">
        <div class="row">
          <label for="max_width" class="col-md-5 col-lg-3" data-toggle="tooltip" title="Maximum width of images allowed to be uploaded">Maximum Width (in Px)</label>
          <div class="col-md-7 col-lg-4"><input type="number" min="1" class="form-control" id="max_width" name="max_width" placeholder="Maximum Width (in Px for images)" value="<?php echo $this->config->item('max_width'); ?>"></div>
        </div>
      </fieldset>
      <!-- max. height -->
      <fieldset class="form-group">
        <div class="row">
          <label for="max_height" class="col-md-5 col-lg-3" data-toggle="tooltip" title="Maximum height of images allowed to be uploaded">Maximum Height (in Px)</label>
          <div class="col-md-7 col-lg-4"><input type="number" min="1" class="form-control" id="max_height" name="max_height" placeholder="Maximum Height (in Px for images)" value="<?php echo $this->config->item('max_height'); ?>"></div>
        </div>
      </fieldset>   
      <!-- media folder -->   
      <!--              
      <fieldset class="form-group">
        <div class="row">
          <label for="media_path" class="col-md-5 col-lg-3" data-toggle="tooltip" title="Valid path to media folder">Media Folder</label>
          <div class="col-md-7 col-lg-4"><input type="text" class="form-control" id="media_path" name="media_path" placeholder="Media folder path" value="<?php echo $this->config->item('media_path'); ?>"></div>
        </div>
      </fieldset> 
    -->
      <!-- max. file name -->         
      <fieldset class="form-group">
        <div class="row">
          <label for="max_filename" class="col-md-5 col-lg-3" data-toggle="tooltip" title="Maximum characters of file name to be uploaded (0: Unlimited)">Maximum File Name</label>
          <div class="col-md-7 col-lg-4"><input type="number" min="0" class="form-control" id="max_filename" name="max_filename" placeholder="Maximum filename (in characters)" value="<?php echo $this->config->item('max_filename'); ?>"></div>
        </div>
      </fieldset>
      <!-- max. files -->         
      <fieldset class="form-group">
        <div class="row">
          <label for="max_files" class="col-md-5 col-lg-3" data-toggle="tooltip" title="Maximum number of files that can uploaded once">Maximum Files</label>
          <div class="col-md-7 col-lg-4"><input type="number" min="0" class="form-control" id="max_files" name="max_files" placeholder="Maximum no. of files" value="<?php echo $this->config->item('max_files'); ?>"></div>
        </div>
      </fieldset>
      <!-- overwrite-->
      <fieldset class="form-group">
        <div class="row">
          <label class="col-sm-6 col-md-5 col-lg-3" data-toggle="tooltip" title="If checked files with same name and type will be overwritten">Overwrite</label>
          <div class="col-sm-6 col-md-7 col-lg-4"><input type="checkbox" name="overwrite" <?php if($this->config->item('overwrite')) echo 'checked'; ?>></div>            
        </div>
      </fieldset> 
      <!-- remove spaces -->
      <fieldset class="form-group">
        <div class="row">
          <label class="col-sm-6 col-md-5 col-lg-3" data-toggle="tooltip" title="Remove spaces between name of uploaded files">Remove Spaces</label>
          <div class="col-sm-6 col-md-7 col-lg-4"><input type="checkbox" name="remove_spaces" <?php if($this->config->item('remove_spaces')) echo 'checked'; ?>></div>            
        </div>
      </fieldset> 
      <!-- encrypt media name -->
      <fieldset class="form-group">
        <div class="row">
          <label class="col-sm-6 col-md-5 col-lg-3" data-toggle="tooltip" title="Encrypt name of uploaded files">Encrypt File Name</label>
          <div class="col-sm-6 col-md-7 col-lg-4"><input type="checkbox" name="encrypt_name" <?php if($this->config->item('encrypt_name')) echo 'checked'; ?>></div>            
        </div>
      </fieldset>
      <!-- restore default settings -->
      <fieldset class="form-group">
        <div class="row">
          <label class="col-sm-6 col-md-5 col-lg-3" data-toggle="tooltip" title="Restore default settings of media manager">Restore Default Settings</label>
          <div class="col-sm-6 col-md-7 col-lg-4"><input type="checkbox" name="restore"></div>            
        </div>
      </fieldset>        
      <p class="alert alert-info"><strong>Note: </strong>Set file-size, width, height, file-name to 0 for no limit</p>
      <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
    </form>
  </div>
</div>