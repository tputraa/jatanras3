<?php $this->load->view('header');?>
<div class="container">
	<div class="highlight">
	    <div class="row">
	    	<?php foreach($singlepost as $row){?>
	    	 <div class="col-lg-8">

	          <!-- Title -->
	          <h2 class="mt-4"><?php echo $row->judul;?></h2>

	          <!-- Author -->
	          

	          <hr>

	          <!-- Date/Time -->
	          <p>Posted on <?php echo date('F j, Y, g:i a', strtotime($row->tanggal_posting));?> by
	            <a href="#"><?php echo $row->posted_by;?></a></p>

	          <hr>

	          <!-- Preview Image -->
	          <img class="img-fluid rounded" src="<?php echo base_url('assets/images/berita_images/'.$row->images);?>">

	          <hr>

	          <!-- Post Content -->
	          <div style="font-size: 16px;">
	          	<?php echo $row->isi;?>
	          </div>
	          <hr>
	          <div>
	          		<i class="fa fa-share-alt" style="padding-right: 10px"></i>Bagikan : &nbsp;&nbsp;&nbsp;
		          <a href="http://www.facebook.com/share.php?u=<?php echo base_url(uri_string())?>&t=<?php echo $row->judul?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
		          <a href="https://twitter.com/share?text=<?php echo $row->judul; ?>&url=<?php echo base_url(uri_string());?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
	          </div>
	          <br><br>
	        </div>
	    	<?php }?>

	    	<div class="col-md-4">
	          <div class="card my-4">
		            <h5 class="card-header">Search</h5>
		            <div class="card-body">
		              <div class="input-group">
		                <input type="text" class="form-control" placeholder="Search for...">
		                <span class="input-group-btn">
		                  <button class="btn btn-secondary" type="button">Go!</button>
		                </span>
		              </div>
		            </div>
		          </div>

		          <!-- Categories Widget -->

		          <!-- Side Widget -->
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
	</div>
</div>
<?php $this->load->view('footer');?>