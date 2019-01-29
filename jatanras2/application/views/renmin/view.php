<style type="text/css">
	.img-wrap {
    position: relative;
    display: inline-block;
    
    font-size: 0;
}
.img-wrap .close {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
    background-color: #FFF;
    padding: 5px 2px 2px;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    opacity: .2;
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
}
.img-wrap:hover .close {
    opacity: 1;
}
</style>
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Edit Data Laporan</h3>
								</div>
								<div class="panel-body">
								<form class="form-horizontal" action="<?php echo site_url('renmin/dokumen/update'); ?>" enctype="multipart/form-data" method="POST"  >
									
									<div class="form-group">
								      <label class="control-label col-sm-2" for="email">Nomor LP </label>
								      <div class="col-sm-10">
								        <input type="text" class="form-control" id="nolp" placeholder="Nomor LP" name="nolp" value="<?php echo $item['no_lp']; ?>" required autofocus>
								        <?php echo form_error('nrp'); ?>
								      </div>
								    </div>

									<div class="form-group">
								      <label class="control-label col-sm-2" for="email">Nama Pelapor </label>
								      <div class="col-sm-10">
								        <input name="pelapor" type="text" class="form-control" placeholder="Nama Pelapor" value="<?php echo $item['nama_pelapor']; ?>" required>
										<?php echo form_error('nama'); ?>
								      </div>
								    </div>

									
									<div class="form-group">
								      <label class="control-label col-sm-2" for="email">Kasus </label>
								      <div class="col-sm-10">
								        <select class="form-control" name="kasus">
											<?php foreach($pasal as $rows): ?>
										<!-- <option value="<?php echo $rows->id;?>"><?php echo $rows->kasus;?></option> -->
										<option <?php if($rows->id == $item['pasal_id']){ 
														echo 'selected="selected"'; } ?> 
														value="<?php echo $rows->id; ?>">
															<?php echo $rows->kasus;?> 
													</option>
										<?php endforeach; ?> 
										</select>
										<?php echo form_error('pasal'); ?>
								      </div>
								    </div>


								    <div class="form-group">
					                    <label class="control-label col-sm-2" for="email">Tanggal Kejadian </label>
					                    <div class="col-sm-10">
					                    <div class="input-group date form_datetime">
					                      <input placeholder="Tanggal Kejadian" name="tanggal_kejadian" type="text" class="form-control" 
					                      value="<?php echo $item['tanggal_kejadian']; ?>">
					                      <div class="input-group-addon">
					                             <span class="glyphicon glyphicon-calendar"></span>
					                      </div>
					                    </div>
					                </div>
					                 </div>

					                <div class="form-group">
								      <label class="control-label col-sm-2" for="email">Nama Pelaku </label>
								      <div class="col-sm-10">
								        <input name="pelaku" type="text" class="form-control" placeholder="Nama Pelaku" value="<?php echo $item['pelaku']; ?>" required>
										<?php echo form_error('pelaku'); ?>
								      </div>
								    </div>

								    <div class="form-group">
								      <label class="control-label col-sm-2" for="email">Korban </label>
								      <div class="col-sm-10">
								        <input name="korban" type="text" class="form-control" placeholder="Nama Korban" value="<?php echo $item['korban']; ?>" required>
										<?php echo form_error('pelaku'); ?>
								      </div>
								    </div>

								    <div class="form-group">
					                    <label class="control-label col-sm-2" for="email">Tanggal Pelaporan </label>
					                    <div class="col-sm-10">
					                    <div class="input-group date form_datetime">
					                      <input placeholder="Tanggal Pelaporan" name="tanggal_lapor" type="text" class="form-control" value="<?php echo $item['tanggal_lapor']; ?>">
					                      <div class="input-group-addon">
					                             <span class="glyphicon glyphicon-calendar"></span>
					                      </div>
					                    </div>
					                	</div>
					                </div>
									<br>
								  	<div class="form-group">
										<?php
											$media_id = $item['id'];
											$sql="SELECT * FROM media_detail where media_id='$media_id'";
											$data = $this->db->query($sql)->result();
											foreach ($data as $rows) :

												$file_name = $rows->file_name;
												$data_id = $rows->id;

										?>
										<div class="col-md-2 col-xs-4 px-0 img-wrap" >
											<span class="close">&times;</span>
										<?php if(isset($item) == null){ ?>
											<img data-id="<?php echo $data_id; ?>" style="display: none;" class="col-md-2" 
											src="<?php echo base_url('assets/uploads/').$file_name;?>">	
										<?php }else if($rows->file_ext == '.pdf'){ ?>
											<a class="media-pdf" data-href="<?php echo base_url('assets/uploads/').$file_name?>" href="<?php echo base_url('assets/uploads/').$file_name?>" target="modal">
												<img data-id="<?php echo $data_id; ?>" class="img-fluid img-thumbnail" 
												src="<?php echo base_url('assets/uploads/pdf-icon.png');?>">
											</a>
											<p class="text-primary" style="font-size: medium; overflow-y: hidden;"><?php echo $file_name; ?></p>
										<?php }else if($rows->file_ext == '.txt'){ ?>
											<img data-id="<?php echo $data_id; ?>" class="img-fluid img-thumbnail" 
											src="<?php echo base_url('assets/uploads/txt-icon.png');?>">
											<p class="text-primary" style="font-size: medium; overflow-y: hidden;"><?php echo $file_name; ?></p>
										<?php }else if($rows->file_ext == '.xls' || $rows->file_ext == '.xlsx'){ ?>
											<img data-id="<?php echo $data_id; ?>" class="img-fluid img-thumbnail" 
											src="<?php echo base_url('assets/uploads/excel-icon.png');?>">
											<p class="text-primary" style="font-size: medium; overflow-y: hidden;"><?php echo $file_name; ?></p>
										<?php }else if($rows->file_ext == '.doc' || $rows->file_ext == '.docx'){ ?>
											<img data-id="<?php echo $data_id; ?>" class="img-fluid img-thumbnail" 
											src="<?php echo base_url('assets/uploads/docx-icon.png');?>">
											<p class="text-primary" style="font-size: medium; overflow-y: hidden;"><?php echo $file_name; ?></p>
										<?php }else{?>
										<a class="thumbnail" href="#" data-image-id="<?php echo $data_id?>"
										data-toggle="modal" data-image="<?php echo base_url('assets/uploads/').$file_name;?>" data-target="#image-gallery" >
											<img data-id="<?php echo $data_id; ?>" 
											class="img-fluid" style="width: auto; height: 140px;"
											src="<?php echo base_url('assets/uploads/').$file_name;?>"/> </a>
											<p class="text-primary" style="font-size: medium; overflow-y: hidden;"><?php echo $file_name; ?></p>
										<?php }?>
									</div>
								
									<?php endforeach; ?> 

									
									</div>

								<input type="hidden" name="id" value="<?php echo $item['id']; ?>" />

								<div id="demo" class="collapse dropzone" >

									  <div class="dz-message">
									   <h3> Klik atau Drop dokumen disini</h3>
									  </div>

									</div>

								<hr/>
								<input type="submit" class="btn btn-warning" value="Simpan Details">
					            <?php if(!isset($item['id'])): ?>
					            <input type="reset" class="btn btn-primary" value="Reset">    

					            <?php endif; ?>
					            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Upload</button> 
					            <a class="btn btn-danger" href="<?php echo site_url().'renmin/dokumen'; ?>">Close</a>

								
							</form>
							</div>
							</div>
							<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					            <div class="modal-dialog">
					                <div class="modal-content">
					                    <div class="modal-header" style="border: 0">
					                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
					                        </button>
					                    </div>
					                    <div class="modal-body">
					                        <img id="image-gallery-image" class="img-responsive" src="">
					                    </div>
					                    <div class="modal-footer" style="border: 0">
					                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
					                        </button>

					                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
					                        </button>
					                    </div>
					                </div>
					            </div>
					        </div>
					        <div class="modal fade" id="viewer-doc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					            <div class="modal-dialog modal-lg">
					                <div class="modal-content">
					                    <div class="modal-header" style="border: 0">
					                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
					                        </button>
					                    </div>
					                    <div class="modal-body-2">
					                    </div>
					                </div>
					            </div>
				        	</div>
	<script src="<?php echo base_url('assets/js/jquery.media.js');?>"></script>
	<script type="text/javascript">var baseURL = "<?php echo base_url(); ?>";</script>
	<script type="text/javascript">
		$(function () {
                $(document).on('click', '.media-pdf', function (e) {
                    e.preventDefault();
                    $("#viewer-doc").modal('show');
                    $.post(baseURL + 'renmin/dokumen/hasil', {id: $(this).attr('data-href')},
                    function (html) {
                        $(".modal-body-2").html(html);
                    }
                    );
                });
            });
    </script>
    <script>
      let modalId = $('#image-gallery');

	$(document).ready(function() {loadGallery(true, 'a.thumbnail');

	    //This function disables buttons when needed
	    function disableButtons(counter_max, counter_current) {
	      $('#show-previous-image, #show-next-image')
	        .show();
	      if (counter_max === counter_current) {
	        $('#show-next-image')
	          .hide();
	      } else if (counter_current === 1) {
	        $('#show-previous-image')
	          .hide();
	      }
	    }

	    /**
	     *
	     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
	     * @param setClickAttr  Sets the attribute for the click handler.
	     */

	    function loadGallery(setIDs, setClickAttr) {
	      let current_image,
	        selector,
	        counter = 0;

	      $('#show-next-image, #show-previous-image')
	        .click(function () {
	          if ($(this)
	            .attr('id') === 'show-previous-image') {
	            current_image--;
	          } else {
	            current_image++;
	          }

	          selector = $('[data-image-id="' + current_image + '"]');
	          updateGallery(selector);
	        });

	      function updateGallery(selector) {
	        let $sel = selector;
	        current_image = $sel.data('image-id');
	        $('#image-gallery-image').attr('src', $sel.data('image'));
	        disableButtons(counter, $sel.data('image-id'));
	      }

	      if (setIDs == true) {
	        $('[data-image-id]')
	          .each(function () {
	            counter++;
	            $(this)
	              .attr('data-image-id', counter);
	          });
	      }
	      $(setClickAttr)
	        .on('click', function () {
	          updateGallery($(this));
	        });
	    }
	  });

	// build key actions
	$(document)
	  .keydown(function (e) {
	    switch (e.which) {
	      case 37: // left
	        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
	          $('#show-previous-image')
	            .click();
	        }
	        break;

	      case 39: // right
	        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
	          $('#show-next-image')
	            .click();
	        }
	        break;

	      default:
	        return; // exit this handler for other keys
	    }
	    e.preventDefault(); // prevent the default action (scroll / move caret)
	  });

    </script>
							<!-- END INPUTS -->

<script type="text/javascript">
	$('.img-wrap .close').on('click', function() {
	    var id = $(this).closest('.img-wrap').find('img').data('id');
	    //alert('remove picture: ' + id);

	    var token=id;
		$.ajax({
			type:"post",
			data:{token:token},
			url:"<?php echo site_url('/renmin/dokumen/remove_media') ?>",
			cache:false,
			dataType: 'json',
			success: function(){
				console.log("Foto terhapus");
				location.reload(); 
			},
			error: function(){
				console.log("Error");
				location.reload(); 
			}
		});



	});
</script>