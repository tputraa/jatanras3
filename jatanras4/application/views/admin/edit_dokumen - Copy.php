<!-- INPUTS -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Edit Data Laporan</h3>
								</div>
								<div class="panel-body">
								<form class="form-horizontal" action="<?php echo site_url('admin/dokumen/update'); ?>" enctype="multipart/form-data" method="POST"  >
									
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
									
								  	<div class="form-group">
								  	<label class="control-label col-sm-2" for="email">Upload File </label>
					                    <div class="col-sm-10">
								    		<input type="file" name="userfile" class="form-control" placeholder="Choose a file..."/>		
										<br>

										<?php
											$media_id = $item['id'];
											$sql="SELECT * FROM media_detail where media_id='$media_id'";
											$data = $this->db->query($sql)->result();
											foreach ($data as $rows) :

												$file_name = $rows->file_name;
										?>
										<?php if(isset($item) == null){ ?>
											<img style="display: none;" class="col-md-2" 
											src="<?php echo base_url('assets/uploads/').$file_name;?>">	
										<?php }else if($item['file_ext'] == '.pdf'){ ?>
											<img class="col-md-2" 
											src="<?php echo base_url('assets/uploads/pdf-icon.png');?>">
											<?php echo $item['file_name']; ?>
										<?php }else if($item['file_ext'] == '.txt'){ ?>
											<img class="col-md-2" 
											src="<?php echo base_url('assets/uploads/txt-icon.png');?>">
											<?php echo $item['file_name']; ?>
										<?php }else if($item['file_ext'] == '.xls' || $item['file_ext'] == '.xlsx'){ ?>
											<img class="col-md-2" 
											src="<?php echo base_url('assets/uploads/excel-icon.png');?>">
											<?php echo $item['file_name']; ?>
										<?php }else if($item['file_ext'] == '.doc' || $item['file_ext'] == '.docx'){ ?>
											<img class="col-md-2" 
											src="<?php echo base_url('assets/uploads/docx-icon.png');?>">
											<?php echo $item['file_name']; ?>
										<?php }else{?>
										<img class="col-md-2 img-fluid img-thumbnail" 
											src="<?php echo base_url('assets/uploads/').$file_name;?>">
											<?php echo $item['file_name']; ?>
										<?php }?>
									</div>

									<?php endforeach; ?>  
									</div>

								<input type="hidden" name="id" value="<?php echo $item['id']; ?>" />

								
								<hr/>
								<input type="submit" class="btn btn-warning" value="Save Details">
					            <?php if(!isset($item['id'])): ?>
					            <input type="reset" class="btn btn-primary" value="Reset">          
					            <?php endif; ?>
					            <a class="btn btn-danger" href="<?php echo site_url().'admin/dokumen'; ?>">Close</a>

								
							</form>
							</div>
							</div>
							<!-- END INPUTS -->