<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-12">
  <h2 class="page-header"><?php echo isset($item['id']) ? 'Edit User Details' : 'Add User'; ?></h2>
  <?php $this->load->view('messages'); ?>  
  <div class="card">
    <div class="card-header">User form</div>
    <div class="card-body">
      <form action="<?php echo site_url('admin/users/save_details'); ?>" method="POST">
        <div class="col-lg-6">
          <fieldset class="form-group">
            <label for="name">Name</label>   
            <input type="text" class="form-control" name="name" maxlength="255" placeholder="Full Name" value="<?php echo set_value('name',isset($item['name']) ? $item['name'] : ''); ?>" autofocus>
            <?php echo form_error('name'); ?>
          </fieldset>                             
          <fieldset class="form-group"> 
            <label for="email">Email</label>  
            <input type="email" class="form-control" name="email" placeholder="Email Address" value="<?php echo set_value('email',isset($item['email']) ? $item['email'] : ''); ?>">
            <?php echo form_error('email'); ?>
          </fieldset> 
          <fieldset class="form-group">  
            <label for="username">Username</label> 
            <input type="text" class="form-control" name="username" maxlength="32" placeholder="Username" value="<?php echo set_value('username',isset($item['username']) ? $item['username'] : ''); ?>">
            <?php echo form_error('username'); ?>
          </fieldset> 
          <fieldset class="form-group">   
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" maxlength="32" placeholder="Password">                     
            <?php echo form_error('password'); ?>
          </fieldset> 
          <fieldset class="form-group"> 
            <label for="confirm-password">Confirm Password</label>  
            <input type="password" class="form-control" name="confirm_password" maxlength="32" placeholder="Confirm Password">
            <?php echo form_error('confirm_password'); ?>
          </fieldset>                  
          <div id="pwd-container">
            <div class="pwstrength_viewport_progress"></div>
          </div>
          <label for="month">Birthday</label>
          <fieldset class="form-group">
            <div class="form-row">
              <div class="col-sm-4">
                <?php $options = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');?>
                <?php echo form_dropdown('month', $options, set_value('month',isset($item['month']) ? $item['month'] : ''), 'class="form-control"'); ?> 
                <?php echo form_error('month'); ?>
              </div>
              <div class="w-100 mb-2 d-block d-sm-none"></div>
              <div class="col-sm-4">
                <input type="number" class="form-control" name="day" maxlength="2" min="1" max="31" placeholder="Day" value="<?php echo set_value('day',isset($item['day']) ? $item['day'] : ''); ?>">
                <?php echo form_error('day'); ?>
              </div>
              <div class="w-100 mb-2 d-block d-sm-none"></div>
              <div class="col-sm-4">
                <input type="number" class="form-control" name="year" maxlength="4" size="4" placeholder="Year" value="<?php echo set_value('year',isset($item['year']) ? $item['year'] : ''); ?>">
                <?php echo form_error('year'); ?>
              </div>
            </div>
          </fieldset>           
          <fieldset class="form-group"> 
            <label for="gender">Gender</label>  
            <?php $options = array('male'=>'Male','female'=>'Female');?>
            <?php echo form_dropdown('gender', $options, set_value('gender',isset($item['gender']) ? $item['gender'] : ''), 'class="form-control"'); ?>
            <?php echo form_error('gender'); ?>
          </fieldset>
          <fieldset class="form-group"> 
            <label for="mobile_no">Mobile phone</label>  
            <input type="tel" class="form-control" name="mobile_no" maxlength="15" placeholder="Mobile no" value="<?php echo set_value('mobile_no',isset($item['mobile_no']) ? $item['mobile_no'] : ''); ?>">
            <?php echo form_error('mobile_no'); ?>
          </fieldset>
          <fieldset class="form-group"> 
            <label for="location">Location</label>
            <?php 
            $result = $this->db->get('region')->result();
            $options = array();
            foreach($result as $row){
                $options[$row->id] = $row->name;
            }
            ?>                
            <?php echo form_dropdown('location', $options, set_value('location',isset($item['location']) ? $item['location'] : ''), 'class="form-control"'); ?>                 
            <?php echo form_error('location'); ?>
          </fieldset> 
          <input type="hidden" name="id" value="<?php echo set_value('id',isset($item['id']) ? $item['id'] : ''); ?>" />                             
          <fieldset class="form-group"> 
            <input type="submit" class="btn btn-success" value="Save Details">
            <?php if(!isset($item['id'])): ?>
            <input type="reset" class="btn btn-primary" value="Reset">          
            <?php endif; ?>
            <a class="btn btn-warning" href="<?php echo site_url().'admin/users'; ?>">Close</a>
          </fieldset>
        </div>
        <div class="clearfix"></div>
      </form>
    </div>
  </div>
</div>