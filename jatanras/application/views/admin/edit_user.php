<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- INPUTS -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo isset($item['id']) ? 'Edit User Details' : 'Add User'; ?></h3>
                </div>
                <form action="<?php echo site_url('admin/users/save_details'); ?>" method="POST">
                <div class="panel-body">
                  <input required name="nrp" type="text" class="form-control" placeholder="NRP" value="<?php echo set_value('nrp',isset($item['nrp']) ? $item['nrp'] : ''); ?>" autofocus>
                  <?php echo form_error('nrp'); ?>
                  <br>
                  <input required name="nama" type="text" class="form-control" placeholder="Nama Lengkap" value="<?php echo set_value('nama',isset($item['nama']) ? $item['nama'] : ''); ?>">
                  <?php echo form_error('nama'); ?>
                  <br>
                  
                  <fieldset class="form-group"> 
                  
                  <?php 
                  $result = $this->db->get('jabatan')->result();
                  $options = array();
                  foreach($result as $row){
                      $options[$row->id] = $row->jabatan;
                  }
                  ?>                
                  <?php echo form_dropdown('location', $options, set_value('location',isset($item['location']) ? $item['location'] : ''), 'class="form-control"'); ?>                 
                  <?php echo form_error('location'); ?>
                </fieldset> 

                  <textarea required name="alamat" class="form-control" placeholder="Alamat Lengkap" rows="2"><?php echo set_value('alamat',isset($item['alamat']) ? $item['alamat'] : ''); ?></textarea>
                  <br>

                  <input required name="telpon" type="text" placeholder="Telpon" class="form-control" value="<?php echo set_value('telpon',isset($item['telpon']) ? $item['telpon'] : ''); ?>">
                  <?php echo form_error('telpon'); ?>
                  <br>

                  <fieldset class="form-group"> 
                  
                  <?php 
                  $result = $this->db->get('level')->result();
                  $options = array();
                  foreach($result as $row){
                      $options[$row->id] = $row->level;
                  }
                  ?>                
                  <?php echo form_dropdown('location', $options, set_value('location',isset($item['location']) ? $item['location'] : ''), 'class="form-control"'); ?>                 
                  <?php echo form_error('location'); ?>
                </fieldset> 

                <input type="hidden" name="id" value="<?php echo set_value('id',isset($item['id']) ? $item['id'] : ''); ?>" />

                <input type="submit" class="btn btn-warning" value="Save Details">
                      <?php if(!isset($item['id'])): ?>
                      <input type="reset" class="btn btn-primary" value="Reset">          
                      <?php endif; ?>
                      <a class="btn btn-danger" href="<?php echo site_url().'admin/users'; ?>">Close</a>

                </div>
              </form>
              </div>
              <!-- END INPUTS -->