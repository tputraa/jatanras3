<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
	<title>
    <?php 
    $this->load->config('site');
    echo $this->config->item('site_name'); 
    ?>
    </title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo base_url('template')?>/assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('template')?>/assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('template')?>/assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/datepicker/datepicker3.css">

	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo base_url('template')?>/assets/css/main.css">
	<link rel="stylesheet" href="<?php echo base_url('template')?>/assets/css/demo.css">
	
	
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('template')?>/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('template')?>/assets/img/favicon.png">
</head>
<?php 
   $view = $page;

  $userpages = array('admin/login','admin/recover_username','admin/recover_password','admin/reset_password');    
  if(!in_array($page, $userpages)) {
    $view = 'admin/page';
  }
  ?>
<body>
	<?php $this->load->view($view); ?>
</body>
</html>