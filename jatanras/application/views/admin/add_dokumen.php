<!-- INPUTS -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Input Data Laporan</h3>
								</div>
								<div class="panel-body">
								<form class="form-horizontal" action="<?php echo site_url('admin/dokumen/save'); ?>" enctype="multipart/form-data" method="POST"  >
									
									<div class="form-group">
								      <label class="control-label col-sm-2" for="email">Nomor LP </label>
								      <div class="col-sm-10">
								        <input type="text" class="form-control" id="nolp" placeholder="Nomor LP" name="nolp" value="<?php echo htmlspecialchars(isset($_POST['nolp']) ? $_POST['nolp']:'');?>" required>
								        <?php echo form_error('nrp'); ?>
								      </div>
								    </div>

									<div class="form-group">
								      <label class="control-label col-sm-2" for="email">Nama Pelapor </label>
								      <div class="col-sm-10">
								        <input name="pelapor" type="text" class="form-control" placeholder="Nama Pelapor" value="<?php echo htmlspecialchars(isset($_POST['pelapor']) ? $_POST['pelapor']:'');?>" required>
										<?php echo form_error('nama'); ?>
								      </div>
								    </div>

									
									<div class="form-group">
								      <label class="control-label col-sm-2" for="email">Kasus </label>
								      <div class="col-sm-10">
								        <select class="form-control" name="kasus">
											<?php foreach($pasal as $rows): ?>
										<option value="<?php echo $rows->id;?>"><?php echo $rows->kasus;?></option>
										
										<?php endforeach; ?> 
										</select>
										<?php echo form_error('pasal'); ?>
								      </div>
								    </div>


								    <div class="form-group">
					                    <label class="control-label col-sm-2" for="email">Tanggal Kejadian </label>
					                    <div class="col-sm-10">
					                    <div class="input-group date form_datetime">
					                      <input placeholder="Tanggal Kejadian" name="tanggal_kejadian" type="text" class="form-control" required>
					                      <div class="input-group-addon">
					                             <span class="glyphicon glyphicon-calendar"></span>
					                      </div>
					                    </div>
					                </div>
					                 </div>

					                <div class="form-group">
								      <label class="control-label col-sm-2" for="email">Nama Pelaku </label>
								      <div class="col-sm-10">
								        <input name="pelaku" type="text" class="form-control" placeholder="Nama Pelaku" value="<?php echo htmlspecialchars(isset($_POST['pelaku']) ? $_POST['pelaku']:'');?>" required>
										<?php echo form_error('pelaku'); ?>
								      </div>
								    </div>

								    <div class="form-group">
								      <label class="control-label col-sm-2" for="email">Korban </label>
								      <div class="col-sm-10">
								        <input name="korban" type="text" class="form-control" placeholder="Nama Korban" value="<?php echo htmlspecialchars(isset($_POST['korban']) ? $_POST['korban']:'');?>" required>
										<?php echo form_error('korban'); ?>
								      </div>
								    </div>

								    <div class="form-group">
					                    <label class="control-label col-sm-2" for="email">Tanggal Pelaporan </label>
					                    <div class="col-sm-10">
					                    <div class="input-group date form_datetime">
					                      <input placeholder="Tanggal Pelaporan" name="tanggal_lapor" type="text" class="form-control">
					                      <div class="input-group-addon">
					                             <span class="glyphicon glyphicon-calendar"></span>
					                      </div>
					                    </div>
					                	</div>
					                </div>
									
								  	<div class="form-group">
								  	<label class="control-label col-sm-2" for="email">Upload File </label>
					                    <div class="col-sm-10">
								    		<input type="file" name="userfile" class="form-control" placeholder="Choose a file..." required/>		
										</div>
									</div>
								<hr/>
								<input type="submit" class="btn btn-warning" value="Save Details">       
					            <a class="btn btn-danger" href="<?php echo site_url().'admin/dokumen'; ?>">Close</a>

								
							</form>
							</div>
							</div>
							<!-- END INPUTS -->

							