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

    <meta http-equiv="cache-control" content="no-store, no-cache, must-revalidate" />
    <meta http-equiv="Pragma" content="no-store, no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="robots" content="noarchive">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/vendor.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/admin/style.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/media.css'; ?>">
    
    <script type = "text/javascript" >
      history.pushState(null, null, '');
      window.addEventListener('popstate', function(event) {
      history.pushState(null, null, '');
      });


      var ctrlKeyDown = false;

      $(document).ready(function(){    
          $(document).on("keydown", keydown);
          $(document).on("keyup", keyup);
      });

      function keydown(e) { 

          if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
              // Pressing F5 or Ctrl+R
              e.preventDefault();
          } else if ((e.which || e.keyCode) == 17) {
              // Pressing  only Ctrl
              ctrlKeyDown = true;
          }
      };

      function keyup(e){
          // Key up Ctrl
          if ((e.which || e.keyCode) == 17) 
              ctrlKeyDown = false;
      };

  </script>
    
  </head>
  <?php 
  $view = $page;

  $userpages = array('admin/login','admin/recover_username','admin/recover_password','admin/reset_password');    
  if(!in_array($page, $userpages)) {
    $view = 'admin/page';
  }
  ?>
  <body <?php echo ($view == 'admin/page') ? 'class="dashboard"' : ''; ?>>
    <?php $this->load->view($view); ?>
    
    <script src="<?php echo base_url().'assets/js/vendor.js?v=4'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/media.js?v=4'; ?>"></script>    
    <script src="<?php echo base_url().'assets/js/client.js?v=4'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/script.js?v=4'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.binarytransport.js?v=4'; ?>"></script>

    <script type="text/javascript">
    $(function() {
      // show tooltip over form labels 
      $('[data-toggle="tooltip"]').tooltip();

      $('#sidebar-toggler').click(function() {
        $('#sidebar').toggleClass('active');
      });
    });
    </script>
  </body>
</html>