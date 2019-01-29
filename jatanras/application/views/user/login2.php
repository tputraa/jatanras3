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
	<div id="login-register">
		<?php $this->load->view('messages'); ?>
		<!-- login section -->
		<section class="login-block" style="<?php if($form == 'registration') echo 'display:none'; ?>">
			<div class="row justify-content-center">
				<div class="col-sm-7 col-md-5 col-lg-4 col-xl-4">
					<div class="card">
					  <div class="card-header"><?php echo lang('mm_tl_signin'); ?></div>
					  <div class="card-body">
					    <form action="<?php echo site_url('user/validate_credentials'); ?>" method="POST" accept-charset="utf-8">
								<fieldset>
									<div class="row justify-content-center">
										<img class="profile-img" src="<?php echo base_url();?>assets/images/photo.jpg" alt="">
										<div class="col-12">
											<input type="text" class="form-control" name="username" placeholder="<?php echo lang('mm_sign_ph_username'); ?>" required="" autofocus="">
											<input type="password" class="form-control" name="password" placeholder="<?php echo lang('mm_sign_ph_password'); ?>" required="">
											<div class="checkbox">
												<label>
													<input id="login-remember" type="checkbox" name="remember" value="1"> <?php echo lang('mm_sign_lb_rememberme'); ?>
												</label>
											</div>
											<input type="submit" class="btn btn-lg btn-primary btn-block" value="<?php echo lang('mm_btn_signin'); ?>">
											<div class="form-bottom-links">
												<?php echo lang('mm_txt_dont_have_ac'); ?> <a class="register-link" href="#"><?php echo lang('mm_txt_signup'); ?></a><br>
												<a href="<?php echo site_url('user/recover_username'); ?>"><?php echo lang('mm_txt_forgot_username'); ?></a><br>
												<a href="<?php echo site_url('user/recover_password'); ?>"><?php echo lang('mm_txt_forgot_password'); ?></a>
											</div>  
										</div>
									</div>
								</fieldset>
							</form>
					  </div>
					</div>
				</div>
			</div>
		</section>
		<!-- /.login section -->
		<!-- register section -->
		<section class="register-block col-md-12" style="<?php if($form == 'login') echo 'display:none'; ?>">
			<div class="row">
				<div class="col-sm-5 col-md-6 col-lg-7 d-none d-sm-block">
					<h2>Welcome to Media Manager</h2>
					<p>PHP Script to manage media files.</p>
					<h3>Features:</h3>
					<ul>
						<li>Upload image and other files with drag &amp; drop feature.</li>
						<li>Create directories to manage media.</li>
						<li>Remove files or folders.</li>
						<li>Responsive layout.</li>
						<li>Login, register and other auth facilities provided.</li>
						<li>Developed with codeigniter and bootstrap.</li>  
					</ul>
				</div>
				<div class="col-sm-7 col-md-6 col-lg-5">
					<div class="card">
					  <div class="card-header">
					  	<div class="float-left"><?php echo lang('mm_tl_signup'); ?></div> 
					  	<div class="float-right login-link"><a href="#"><?php echo lang('mm_txt_signin'); ?></a></div>
					  	<div class="clearfix"></div>
					  </div>
					  <div class="card-body">
					  	<form action="<?php echo site_url('user/register'); ?>" method="POST" accept-charset="utf-8" autocomplete="off" novalidate>
					  		<div class="row">
									<div class="form-group col-md-12">
										<label for="name"><?php echo lang('mm_rgtr_lb_name'); ?></label>   
										<input type="text" class="form-control form-control-sm" name="name" maxlength="255" placeholder="<?php echo lang('mm_rgtr_ph_name'); ?>" value="<?php echo set_value('name'); ?>" required autofocus>
										<?php echo form_error('name'); ?>
									</div>  	                       
									<div class="form-group col-md-12"> 
										<label for="email"><?php echo lang('mm_rgtr_lb_email'); ?></label>  
										<input type="email" class="form-control form-control-sm" name="email" placeholder="<?php echo lang('mm_rgtr_ph_email'); ?>" value="<?php echo set_value('email'); ?>" required>
										<?php echo form_error('email'); ?>
									</div> 
									<div class="form-group col-md-12">  
										<label for="username"><?php echo lang('mm_rgtr_lb_username'); ?></label>
										<input type="text" class="form-control form-control-sm" name="username" maxlength="32" placeholder="<?php echo lang('mm_rgtr_ph_username'); ?>" value="<?php echo set_value('username'); ?>" required>
										<?php echo form_error('username'); ?>
									</div> 
									<div class="form-group col-md-6">   
										<label for="password"><?php echo lang('mm_rgtr_lb_password'); ?></label>
										<input type="password" class="form-control form-control-sm" name="password" id="password" maxlength="32" placeholder="<?php echo lang('mm_rgtr_ph_password'); ?>" required>		              
										<?php echo form_error('password'); ?>
									</div> 
									<div class="form-group col-md-6"> 
										<label for="confirm-password"><?php echo lang('mm_rgtr_lb_cnf_password'); ?></label>  
										<input type="password" class="form-control form-control-sm" name="confirm_password" maxlength="32" placeholder="<?php echo lang('mm_rgtr_ph_cnf_password'); ?>" required>
										<?php echo form_error('confirm_password'); ?>
									</div>		            
									<div class="col-md-12" id="pwd-container">
										<div class="pwstrength_viewport_progress"></div>
									</div>
									<label for="month" class="col-md-12"><?php echo lang('mm_rgtr_lb_birthday'); ?></label>		            
									<div class="clearfix"></div>
									<div class="form-group col-md-4 col-sm-4 col-xs-12">
										<?php $options = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');?>
										<?php echo form_dropdown('month', $options, set_value('month'), 'class="form-control form-control-sm"'); ?>	
										<?php echo form_error('month'); ?>
									</div>
									<div class="form-group col-md-4 col-sm-4 col-xs-6">
										<input type="number" class="form-control form-control-sm" name="day" maxlength="2" min="1" max="31" placeholder="<?php echo lang('mm_rgtr_ph_day'); ?>" value="<?php echo set_value('day'); ?>" required>
										<?php echo form_error('day'); ?>
									</div>
									<div class="form-group col-md-4 col-sm-4 col-xs-6">
										<input type="number" class="form-control form-control-sm" name="year" maxlength="4" size="4" placeholder="<?php echo lang('mm_rgtr_ph_year'); ?>" value="<?php echo set_value('year'); ?>" required>
										<?php echo form_error('year'); ?>
									</div> 
									<div class="form-group col-md-6"> 
										<label for="gender"><?php echo lang('mm_rgtr_lb_gender'); ?></label>  
										<?php $options = array('male'=>'Male','female'=>'Female','other'=>'Other');?>
										<?php echo form_dropdown('gender', $options, set_value('gender'), 'class="form-control form-control-sm"'); ?>
										<?php echo form_error('gender'); ?>
									</div>
									<div class="form-group col-md-6"> 
										<label for="mobile_no"><?php echo lang('mm_rgtr_lb_mobile'); ?></label>
										<input type="tel" class="form-control form-control-sm" name="mobile_no" maxlength="15" placeholder="<?php echo lang('mm_rgtr_ph_mobile'); ?>" value="<?php echo set_value('mobile_no'); ?>" required>
										<?php echo form_error('mobile_no'); ?>
									</div>
									<div class="form-group col-md-12"> 
										<label for="location"><?php echo lang('mm_rgtr_lb_location'); ?></label>
										<?php 
										$result = $this->db->get('countries')->result();
										$options = array();
										foreach($result as $row){
											$options[$row->id] = $row->name;
										}
										?> 	              
										<?php echo form_dropdown('location', $options, set_value('location'), 'class="form-control form-control-sm"'); ?>	              
										<?php echo form_error('location'); ?>
									</div>
									<?php
									$this->load->config('recaptcha');
									$site_key = $this->config->item('recaptcha_site_key');
									$secret_key = $this->config->item('recaptcha_secret_key');
									$lang = $this->config->item('recaptcha_lang');
									?>
									<?php if(($site_key) && ($secret_key)): ?>
										<div class="form-group col-md-12">		            	
											<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="<?php echo $site_key;?>"></div>
											<?php echo form_error('g-recaptcha-response'); ?>
										</div>				      	
									<?php endif; ?>
									<div class="form-group col-md-12">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="accept_terms" value="1" <?php echo set_checkbox('accept_terms[]', '1'); ?>> <?php echo lang('mm_rgtr_lb_terms_1'); ?> 
												<a href="<?php echo site_url('pages/index/terms-of-service'); ?>" target="_blank"><?php echo lang('mm_rgtr_lb_terms_2'); ?></a> 
												<?php echo lang('mm_rgtr_lb_terms_3'); ?> <a href="<?php echo site_url('pages/index/privacy-policy'); ?>" target="_blank"><?php echo lang('mm_rgtr_lb_terms_4'); ?></a>
												<?php echo form_error('accept_terms'); ?>
											</label>
										</div>
									</div>
									<div class="form-group col-md-12"> 
										<input type="submit" class="btn btn-sm btn-success btn-submit" value="<?php echo lang('mm_btn_signup'); ?>">
										<input type="reset" class="btn btn-sm btn-primary" value="<?php echo lang('mm_btn_reset'); ?>">    
									</div>
								</div>				
							</form>
					 	</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /.register section -->
	</div>
</div>