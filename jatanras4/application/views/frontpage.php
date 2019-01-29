<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | Jatanras</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>/template/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/template/assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/template/assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>/template/assets/css/main.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/template/assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

	<style>
div.relative {
  position: relative;
  left: 30px;
  border: 3px solid #73AD21;
}

div.absolute {
  position: absolute;
  top: 55px;
  right: 0;
  left: 20px;
  width: 500px;
  height: 30px;
  border: 0px solid #ffffff;
  text-align: center;
  color: #ffffff;
  font-size: 20px;
}

</style>

</head>
<body>
	<!-- WRAPPER -->
	<div id="wrapper" style="background-color: #232124;">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
					<div class="center-block">
						<div class="container">
							<div class="panel" style="background-color: #232124;">
								<div class="panel-body">
									<div class="col-md-12">
										<div class="col-md-6">
											<div class="pull-left">
												<div class="absolute pull-left">Tanggal : <?php echo date('d-m-Y'); ?> </div>
												<img style="width: 100%;height: 72%;" src="<?php echo base_url(); ?>template/assets/img/front-bg.jpg">
											</div>
										</div>
										<div class="col-md-6">
											<div class="col-md-10">
												<a href="<?php echo base_url('dokumen');?>">
													<div class="metric">
														<span class="icon" style="background-color:white;">
															<i class="fa fa-envelope" style="color:black;"></i></span>
														<p style="color: white;">
															<span class="number"><?php echo $document_baru; ?></span>
															<span class="title">Baru</span>
														</p>
													</div>
												</a>
												<a href="<?php echo base_url('dokumen');?>">
													<div class="metric">
														<span class="icon" style="background-color:white;">
															<i class="fa fa-hourglass-2" style="color:black;"></i></span>
														<p style="color:white;">
															<span class="number"><?php echo $document_proses; ?></span>
															<span class="title">Proses</span>
														</p>
													</div>
												</a>
												<a href="<?php echo base_url('dokumen');?>">
													<div class="metric">
														<span class="icon" style="background-color:white;">
															<i class="fa fa-check" style="color:black;"></i></span>
														<p style="color: white;">
															<span class="number"><?php echo $document_selesai; ?></span>
															<span class="title">Selesai</span>
														</p>
													</div>
												</a>
											</div>
											<div> <a class="btn btn-danger" href="<?php echo site_url('dashboard'); ?>">Lihat Dashboard</a></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
</html>
