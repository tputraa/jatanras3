<?php $this->load->view('header');?>
<div class="container profile-content">
	<div class="row">
		<div class="col-md-8"> 
            <div class="card-body">
            	<p>Hasil pencarian "<b><?php echo $keyword; ?></b>", <b> <?php echo count($home); ?></b> hasil ditemukan</p>
            	<br>	
            	<?php foreach($home as $row){?>
	              <div class="row">
	                <div class="col-md-4">
	                	<img class="img-fluid rounded" 
	                		src="<?php echo base_url('assets/images/berita_images/'.$row->images);?>">
	                </div>
	                <div class="col-md-8">
	                	<a href="<?php echo base_url()?>Blog/Post/<?=str_replace(' ','_',$row->judul_slug);?>">
	                		<?php echo $row->judul; ?>
	                	</a></div>
	              </div>
	              <hr>
	            <?php } ?>
            </div>
		</div>
		<div class="col-md-4">
			<div class="card my-4">
            <h5 class="card-header">Recent Post</h5>
            <div class="card-body">
            	<?php foreach($recentpost as $row){?>
	              <div class="row">
	                <div class="col-md-4">
	                	<img class="img-fluid rounded" 
	                		src="<?php echo base_url('assets/images/berita_images/'.$row->images);?>">
	                </div>
	                <div class="col-md-8">
	                	<a href="<?php echo base_url()?>Blog/Post/<?=str_replace(' ','_',$row->judul_slug);?>">
	                		<?php echo $row->judul; ?>
	                	</a></div>
	              </div>
	              <hr>
	            <?php } ?>
            </div>
          </div>
		</div>
	</div>
</div>
<?php $this->load->view('footer');?>