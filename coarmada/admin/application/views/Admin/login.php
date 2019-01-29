<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/customize.css" />

    <title>Sistem Informasi Koarmada</title>
  </head>
  <body>
    
    <div class="container login-wrapp">

      <h2 align="center">Pusat Data & Informasi KOARMADA1</h2>
      <img class="logo" src="<?php echo base_url();?>assets/images/logo/koarmadalogo.png" alt="">
      <div class="alerterror"></div>
      <?php echo form_open('Admin/Login/signin');?>
        <div class="form-group">
          <label for="text">Username :</label>
          <input type="text" class="form-control" id="username" placeholder="Username" name="username">
        </div>
        <div class="form-group">
          <label for="password">Password :</label>
          <input type="password" class="form-control" id="password" placeholder="Password" name="password">
        </div>

         <input name="login" type="submit" class="btn btn-primary" value="Login" />
         <div class="pull-right">
          <a href="<?php echo base_url();?>forgetpassword">Lupa Password?</a>
         </div>
      </form>
      <?php echo form_close();?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>