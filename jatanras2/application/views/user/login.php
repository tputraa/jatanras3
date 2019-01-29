<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title><?php 
      $this->load->config('site');
      echo $this->config->item('site_name'); 
      ?></title>
  
    <link rel="SHORTCUT ICON" href="<?php echo base_url(); ?>assets/images/jatanras.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
</head >

<body>
  <div class="image">
<div class="pen-title">
  <img src="<?php echo base_url(); ?>assets/images/jatanras.png" width="120">
</div>
<div class="form-module" style="border: 8px solid #efefef;">
  <div></div>
      
  <div class="form">
    <h2>Sign In</h2>
 <form action="<?php echo site_url('user/validate_credentials'); ?>" method="POST" accept-charset="utf-8">
         
      <input type="text" id="login-username" name="username" placeholder="Username"/>
      <input type="password" id="login-password" name="password" placeholder="Password"/>
      <button type="submit" name="simpan">Login</button>
       </form>

     
  </div>
  </div>
</body>
</html>
