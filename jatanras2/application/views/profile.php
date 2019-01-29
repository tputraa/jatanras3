<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="<?php echo base_url('assets/uploads/avatar/thumb/').$biodata->avatar_thumb;?>" width="225px" height="225px" alt="Avatar">
										<h3 class="name"><?php echo $biodata->name; ?></h3>
										<span class="online-status status-available">Available</span>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
<!-- 								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Basic Info</h4>
										<ul class="list-unstyled list-justify">
											<li>Birthdate <span>24 Aug, 2016</span></li>
											<li>Mobile <span>(124) 823409234</span></li>
											<li>Email <span>samuel@mydomain.com</span></li>
											<li>Website <span><a href="https://www.themeineed.com">www.themeineed.com</a></span></li>
										</ul>
									</div>
									<div class="text-center"><a href="#" class="btn btn-primary">Edit Profile</a></div>
								</div> -->
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							
							<script type="text/javascript">


								<?php if($this->session->flashdata('success')){ ?>
								    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
								<?php }else if($this->session->flashdata('error')){  ?>
								    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
								<?php } ?>


							</script>
							<div class="profile-right">
								<!-- TABBED CONTENT -->
								<div class="custom-tabs-line tabs-line-bottom left-aligned">
									<ul class="nav" role="tablist">
										<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Personal Info</a></li>
										<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Change Profile Image</a></li>
										<li><a href="#tab-bottom-left3" role="tab" data-toggle="tab">Change Password</a></li>
									</ul>
								</div>
								<div class="tab-content">
									<div class="tab-pane fade in active" id="tab-bottom-left1">
										<form method="post" action="<?php echo site_url('profile/Update_info');?>" enctype="multipart/form-data">
											<div class="form-group">
							                  <label>Nama</label>
							                  <input type="text" name="nama" 
							                  	class="form-control" 
							                  	value="<?php echo $biodata->name;?>" >
							                </div>
							                <div class="form-group">
							                  <label>Email</label>
							                  <input type="email" name="email" 
							                  	class="form-control" 
							                  	value="<?php echo $biodata->email;?>" >
							                </div>
						                 	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
						                 </form>
									</div>
									<div class="tab-pane fade in" id="tab-bottom-left2">
										<form method="post" action="<?php echo site_url('profile/update_avatar');?>" enctype="multipart/form-data">
											<div class="form-group">
							                  <label>Change Profile Image</label>
							                  <input type="file" name="userfile" 
							                  	class="form-control" >
							                </div>
						                 	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
						                 </form>
									</div>
									<div class="tab-pane fade" id="tab-bottom-left3">
                                       
										<form method="POST" 
											action="<?php echo site_url('profile/update_pass');?>" enctype="multipart/form-data">
                                            <?php
                                            $err = form_error('password', '<p class="help-block">', '</p>');
                                            ?>
    										<div class="form-group <?php echo ($err)? 'has-error':''?>">
    											
    						                  <label>New Password</label>
    						                  <input type="password" name="password" class="form-control">
                                              <?php echo $err ?>
    						                </div>
                                            <?php
                                            $err = form_error('repassword', '<p class="help-block">', '</p>');
                                            ?>
    						                <div class="form-group <?php echo ($err)? 'has-error':''?>">
    						                	
    						                  <label>Confirm Password </label>
    						                  <input type="password" name="repassword" class="form-control">
                                              <?php echo $err ?>
    						                </div>
				                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
						                 </form>
									</div>
								</div>
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
					</div>
