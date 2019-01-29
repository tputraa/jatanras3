<?php $this->load->view('header'); ?>
<div class="container profile-content">
	<?php foreach($profiles as $row){ ?>
      <div class="row">
        <img src="<?php echo base_url('assets/images/profile_images/').$row->images?>" style="width: 100%;">
      </div>
      <div class="row" style="padding: 40px;">
        <h2><?php echo $row->judul;?></h2><br><br><br>
        <?php echo $row->isi;?>
      </div>
  	<?php } ?>
</div>
    <br><br>
<?php $this->load->view('footer'); ?>