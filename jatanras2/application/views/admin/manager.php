<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="media-manager" >
  
  <!-- main container -->
  <div class="row">
    <!-- notifications -->
    <div class="col-12">
      <?php $this->load->view('messages'); ?>
    </div>
    <!-- /.notifications -->
  </div>
  <div class="row wrapper">
    
    <!-- media container -->
    <div class="col-md-9 col-lg-12 main-section">   
      <?php $this->load->view('admin/medialayout'); ?>
    </div>
    <!-- /.media container -->
  </div>
  <!-- /.main-container -->
</div>
<script>var site_url = '<?php echo site_url(CN_BASE).'/'; ?>';</script>