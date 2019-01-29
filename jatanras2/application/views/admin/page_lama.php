<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top navbar-top">
  <span>
    <img width="30px" height="30px" src="<?php echo base_url('assets/images/jatanras.jpg'); ?>">
  &nbsp;</span>
  <a class="navbar-brand" href="<?php echo site_url('admin/dashboard'); ?>">
  <?php 
  $this->load->config('site');
  echo $this->config->item('site_name'); 
  ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav" aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
  <div class="collapse navbar-collapse" id="navbar-nav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="nav-dd-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-user fa-fw"></span></a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="nav-dd-menu">
          <a class="dropdown-item" href="<?php echo site_url('/admin/users/edit_details/'.$this->session->userdata('admin_user_id')); ?>"><span class="fa fa-user fa-fw"></span> User Profile</a>
          <a class="dropdown-item" href="<?php echo site_url('admin/dashboard/logout'); ?>"><span class="fa fa-sign-out fa-fw"></span> Logout</a>
        </div>
      </li>
    </ul>
  </div>
</div>
<div class="wrapper d-flex align-items-stretch">
  <div id="sidebar">
    <ul class="list-unstyled">
      <li><a class="nav-link active" href="<?php echo site_url().'admin/dashboard'; ?>"><span class="fa fa-desktop fa-fw"></span> Dashboard</a></li>

      <li><a class="nav-link" href="<?php echo site_url().'admin/kasubdit'; ?>"><span class="fa fa-address-book-o fa-fw"></span> Kasubdit</a></li>

      <li><a class="nav-link" href="<?php echo site_url().'admin/region'; ?>"><span class="fa fa-sitemap fa-fw"></span> Kanit</a></li>

      <li><a class="nav-link" href="<?php echo site_url().'admin/users'; ?>"><span class="fa fa-user fa-fw"></span> Users</a></li>

      <li><a class="nav-link" href="<?php echo site_url().'admin/users'; ?>"><span class="fa fa-user fa-fw"></span> Documen</a></li>

      <li><a class="nav-link" href="<?php echo site_url().'admin/media'; ?>"><span class="fa fa-cogs fa-fw"></span> Settings</a></li>
    </ul>
  </div>
  <div id="content">
    <button type="button" id="sidebar-toggler" class="btn btn-sm btn-info"><i class="fa fa-th"></i> </button>
    <?php $this->load->view($page); ?>
  </div>
</div>