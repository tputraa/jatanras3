<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2 class="page-header">Dashboard</h2>
<?php $this->load->view('messages'); ?>
<div class="row mb-3">
	<div class="col-sm-6 col-lg-4 col-xl-3">

		<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-download"></i></span>
										<p>
											<span class="number">1,252</span>
											<span class="title">Downloads</span>
										</p>
									</div>
								</div>
								
		<div class="card border-primary">
			<div class="card-body bg-primary text-white">
				<div class="float-left">
					<span class="fa fa-user fa-5x"></span>
				</div>
				<div class="float-right text-right">
					<div class="text-large"><?php echo $this->db->count_all('users'); ?></div>
					<div>Users</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<a href="<?php echo site_url('admin/users'); ?>">
				<div class="card-footer text-primary">
					<div class="float-left">View Details</div>
					<div class="float-right"><span class="fa fa-arrow-circle-right"></span></div>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="w-100 mb-3 d-block d-sm-none"></div>
	<!-- /.users -->
	<div class="col-sm-6 col-lg-4 col-xl-3">
		<div class="card border-success">
			<div class="card-body bg-success text-white">
				<div class="float-left">
					<span class="fa fa-tags fa-5x"></span>
				</div>
				<div class="float-right text-right">
					<div class="text-large"><?php echo $this->db->count_all('region'); ?></div>
					<div>Kanit</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<a href="<?php echo site_url('admin/region'); ?>">
				<div class="card-footer text-success">
					<div class="float-left">View Details</div>
					<div class="float-right"><span class="fa fa-arrow-circle-right"></span></div>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="w-100 mb-3 d-block d-sm-none"></div>
	<!-- /.users -->
	<div class="col-sm-6 col-lg-4 col-xl-3">
		<div class="card border-danger">
			<div class="card-body bg-danger text-white">
				<div class="float-left">
					<span class="fa fa-tags fa-5x"></span>
				</div>
				<div class="float-right text-right">
					<div class="text-large"><?php echo $this->db->count_all('region'); ?></div>
					<div>Penyidik</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<a href="<?php echo site_url('admin/region'); ?>">
				<div class="card-footer text-danger">
					<div class="float-left">View Details</div>
					<div class="float-right"><span class="fa fa-arrow-circle-right"></span></div>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="w-100 mb-3 d-block d-sm-none"></div>
	<!-- /.countries -->
	<div class="col-sm-6 col-lg-4 col-xl-3">
		<div class="card border-warning">
			<div class="card-body bg-warning text-white">
				<div class="float-left">
					<span class="fa fa-file fa-5x"></span>
				</div>
				<div class="float-right text-right">
					<div class="text-large"><?php echo $this->db->count_all('media'); ?></div>
					<div>Dokumen</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<a href="<?php echo site_url('admin/region/list_cabang'); ?>">
				<div class="card-footer text-warning">
					<div class="float-left">View Details</div>
					<div class="float-right"><span class="fa fa-arrow-circle-right"></span></div>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>


	<!-- /.media -->
</div>