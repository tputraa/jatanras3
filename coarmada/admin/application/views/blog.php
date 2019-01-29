<?php $this->load->view('header');?>
<div class="container">
    <div class="row">
    		<div class="col-md-8"> 
    			<?php foreach($home as $row){?>
	    		<div class="card mb-4">
		            <img class="card-img-top" src="<?php echo base_url('assets/images/berita_images/'.$row->images);?>">
		            <div class="card-body">
		              <a href="<?php echo base_url()?>Blog/Post/<?=str_replace(' ','_',$row->judul_slug);?>" style="color:#212529;"><h2 class="card-title"><?php echo $row->judul?></h2></a>
			              <p class="card-text">
			              	<?php 
			              		$text = $row->isi;
			              		$text = character_limiter($text,200);
			              		echo $text; 
			              	?>
			              	<?php ?>
			              </p>
			              
		              <a href="<?php echo base_url()?>Blog/Post/<?=str_replace(' ','_',$row->judul_slug);?>" class="btn btn-primary">Read More &rarr;</a>
		            </div>
		            <div class="card-footer text-muted">
		              <?php echo date('F j, Y, g:i a', strtotime($row->tanggal_posting));?> by
		              <a href=""><?php echo $row->posted_by;?></a>
		            </div>
	          	</div>
	          	<?php }?>
    		</div>
    	<div class="col-md-4" style="">
    		<div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
            	<form action="<?php echo base_url('Blog/Search');?>" method="get">
	              <div class="input-group">
	                <input type="text" class="form-control" name="q" placeholder="Search...">
	                <span class="input-group-btn">
	                  <input type="submit" class="btn btn-secondary" value="Go!">
	                </span>
	              </div>
	            </form>
	            </div>
	        </div>

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
    	<div class="d-flex mx-auto"> 
    		<?php echo $pages; ?> 
    	</div>
    </div>
 </div>
<?php $this->load->view('footer');?>