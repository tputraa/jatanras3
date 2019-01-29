<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- INPUTS -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo isset($item['id']) ? 'Edit User Details' : 'Add User'; ?></h3>
                </div>
                <form class="form-horizontal" action="<?php echo site_url('admin/users/save_details'); ?>" method="POST">
                <div class="panel-body">
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">NRP : </label>
                    <div class="col-sm-10">
                      <input required name="nrp" type="text" class="form-control" placeholder="NRP" value="<?php echo set_value('nrp',isset($item['nrp']) ? $item['nrp'] : ''); ?>" autofocus>
                      <?php echo form_error('nrp'); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Username : </label>
                    <div class="col-sm-10">
                      <input required name="username" type="text" class="form-control" placeholder="Username" value="<?php echo set_value('username',isset($item['username']) ? $item['username'] : ''); ?>">
                  <?php echo form_error('username'); ?>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Nama Lengkap : </label>
                    <div class="col-sm-10">
                      <input required name="nama" type="text" class="form-control" placeholder="Nama Lengkap" value="<?php echo set_value('nama',isset($item['name']) ? $item['name'] : ''); ?>">
                  <?php echo form_error('nama'); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Jabatan : </label>
                    <div class="col-sm-10">
                  
                  <?php 
                  $result = $this->db->get('jabatan')->result();
                  $options = array();
                  foreach($result as $row){
                      $options[$row->id] = $row->jabatan;
                  }
                  ?>                
                  <?php echo form_dropdown('jabatan', $options, set_value('jabatan',isset($item['jabatan_id']) ? $item['jabatan_id'] : ''), 'class="form-control"'); ?>                 
                  <?php echo form_error('jabatan'); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Alamat Lengkap : </label>
                    <div class="col-sm-10">
                      <textarea required name="alamat" class="form-control" placeholder="Alamat Lengkap" rows="2"><?php echo set_value('alamat',isset($item['alamat']) ? $item['alamat'] : ''); ?></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Telpon : </label>
                    <div class="col-sm-10">
                      <input required name="telpon" type="text" placeholder="Telpon" class="form-control" value="<?php echo set_value('telpon',isset($item['telpon']) ? $item['telpon'] : ''); ?>">
                  <?php echo form_error('telpon'); ?>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Level : </label>
                    <div class="col-sm-10">
                      
                  
                  <?php 
                  $result = $this->db->get('level')->result();
                  $options = array();
                  foreach($result as $row){
                      $options[$row->id] = $row->level;
                  }
                  ?>                
                  <?php echo form_dropdown('level', $options, set_value('level',isset($item['usertype']) ? $item['usertype'] : ''), 'class="form-control"'); ?>                 
                  <?php echo form_error('location'); ?>
                
                    </div>
                  </div>

                <input type="hidden" name="id" value="<?php echo set_value('id',isset($item['id']) ? $item['id'] : ''); ?>" />

                <br />
                <input type="submit" class="btn btn-warning" value="Save Details">
                      <?php if(!isset($item['id'])): ?>
                      <input type="reset" class="btn btn-primary" value="Reset">          
                      <?php endif; ?>
                      <a class="btn btn-danger" href="<?php echo site_url().'admin/users'; ?>">Close</a>

                </div>
              </form>
              </div>
              <!-- END INPUTS -->