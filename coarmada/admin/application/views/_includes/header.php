<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/css/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins/datatables/dataTables.bootstrap.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/css/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/css/kustom.css" /> -->
    <style>
      .error{
        color:red;
        font-weight: normal;
      }
    </style>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- <body class="sidebar-mini skin-black-light"> -->
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="<?php echo base_url('assets/images/logo/');?>koarmadalogo.png" class="pull-left" width='50px' height='50'></span>
          <!-- logo for regular state and mobile devices -->
          <img src="<?php echo base_url('assets/images/logo/');?>koarmadalogo.png" class="pull-left" width='50px' height='50'>
          <span class="logo-lg">KOARMADA</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url('assets/images/avatar/thumb/'.$this->session->userdata('avatar_thumb')); ?>" class="user-image" />
                  <span class="hidden-xs"><?php echo $this->session->userdata('nama_lengkap'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>myprofile" class="btn btn-default btn-flat"><i class="fa fa-user"></i> My Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>signout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/images/avatar/thumb/'.$this->session->userdata('avatar_thumb'));?>" class="img-circle">
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('nama_lengkap'); ?></p>
              <a href="<?php echo base_url(); ?>myprofile"><i class="fa fa-circle text-success"></i> Online </a>
            </div>
          </div>
      <!-- search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo base_url();?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url();?>berita">
                  <i class="fa fa-newspaper-o"></i>Berita
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url();?>menugaleri">
                  <i class="fa fa-image"></i>Galeri
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url();?>banner">
                  <i class="fa fa-file-photo-o"></i>Image Slider
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url();?>profile">
                  <i class="fa fa-user"></i>Profile Koarmada
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url();?>runningtext">
                  <i class="fa fa-font"></i>Running Text
                </a>
            </li>

            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Content</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
                <ul class="treeview-menu" style="">
                  <li><a href="<?php echo base_url();?>Admin/Sintel"><i class="fa fa-circle-o"></i>Staff Intelijen</a></li>
                  <li><a href="<?php echo base_url();?>runningtext"><i class="fa fa-circle-o"></i>Staff Operasi</a></li>
                  <li><a href="<?php echo base_url();?>runningtext"><i class="fa fa-circle-o"></i>Staff Logistik</a></li>
                  <li><a href="<?php echo base_url();?>runningtext"><i class="fa fa-circle-o"></i>Staff Personel</a></li>
                </ul>
            </li> -->
            <?php if($this->session->userdata('level') == 1){?>
              <li class="treeview">
              <a href="<?php echo base_url(); ?>userlist">
                <i class="fa fa-users"></i>
                <span>User Management</span>
              </a>
            </li>
            <? } else {?>
              
            <?php }?>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>