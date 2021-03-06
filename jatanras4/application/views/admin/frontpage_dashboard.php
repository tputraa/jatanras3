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
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dropzone/dropzone.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dropzone/basic.min.css') ?>">
	

	

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('template')?>/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('template')?>/assets/img/favicon.png">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('template')?>/assets/vendor/toastr/toastr.min.css">
	<script src="<?php echo base_url(); ?>assets/datatables/js/jquery.js"></script>
	<script src="<?php echo base_url('template');?>/assets/vendor/toastr/toastr.min.js"></script>

	<link rel="stylesheet" href="<?php echo base_url()?>/assets/datatables/css/dataTables.bootstrap.min.css">
</head>
<?php 
  $view = $page;

  $userpages = array('admin/login','admin/recover_username','admin/recover_password','admin/reset_password');
  if($this->session->userdata('usertype') == 5){
  	if(!in_array($page, $userpages)) {
	    $view = 'renmin/frontpage';
	  }
  }
  else if($this->session->userdata('usertype') == 4){
  	if(!in_array($page, $userpages)) {
	    $view = 'penyidik/frontpage';
	  }
  }
  else if($this->session->userdata('usertype') == 3){
  	if(!in_array($page, $userpages)) {
	    $view = 'kanit/frontpage';
	  }
  }
  else if($this->session->userdata('usertype') == 2){
  	if(!in_array($page, $userpages)) {
	    $view = 'frontpage';
	  }
  }
  else{    
	  if(!in_array($page, $userpages)) {
	    $view = 'admin/frontpage';
	  }
	}
  ?>
<body>
	<?php $this->load->view($view); ?>
	<script type="text/javascript">


								<?php if($this->session->flashdata('success')){ ?>
								    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
								<?php }else if($this->session->flashdata('error')){  ?>
								    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
								<?php } ?>


							</script>
</body>
</html>