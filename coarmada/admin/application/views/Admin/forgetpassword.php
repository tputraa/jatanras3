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
      <form method="post" action="<?php echo base_url('');?>sendemail" enctype="multipart/form-data">
        <div class="form-group">
          <label for="text">Email :</label>
          <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
        </div>
         <input name="send" type="submit" class="btn btn-primary" value="Send" />
         <div class="pull-right">
          <a href="<?php echo base_url();?>login">Login</a>
         </div>
      </form>
      <br>
            <div class="alerterror">
        <?php if($this->session->flashdata('success')){ ?>
            <div class="alert alert-success" id="success-alert">
                <a href="" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php }else if($this->session->flashdata('error')){  ?>
                <div class="alert alert-danger" id="error-alert">
                    <a href="" class="close" data-dismiss="alert">&times;</a>
                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                </div>
        <?php } ?>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>