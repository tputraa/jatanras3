<!-- INPUTS -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Input Data Penyidik</h3>
								</div>
								<form action="<?php echo site_url('admin/penyidik/save_details'); ?>" method="POST">
								<div class="panel-body">
									<input required name="nrp" type="text" class="form-control" placeholder="NRP" value="<?php echo set_value('nrp',isset($item['nrp']) ? $item['nrp'] : ''); ?>" autofocus>
									<?php echo form_error('nrp'); ?>
									<br>
									<input required name="nama" type="text" class="form-control" placeholder="Nama Lengkap" value="<?php echo set_value('nama',isset($item['nama']) ? $item['nama'] : ''); ?>">
									<?php echo form_error('nama'); ?>
									<br>
									
									<textarea required name="alamat" class="form-control" placeholder="Alamat Lengkap" rows="2"><?php echo set_value('alamat',isset($item['alamat']) ? $item['alamat'] : ''); ?></textarea>
									<br>
									<select class="form-control" name="activation" required>
										<option value="1">Aktif</option>
										<option value="0">Tidak Aktif</option>
									</select>
									<br>

									<input required name="telpon" type="text" placeholder="Telpon" class="form-control" value="<?php echo set_value('telpon',isset($item['telpon']) ? $item['telpon'] : ''); ?>">
									<?php echo form_error('telpon'); ?>
									<br>
									<div class="form-group">
	                  					<label>Nama Kanit</label>
										<select class="form-control" name="kanit_id">
											<?php foreach($kanit as $row) {?>
												<?php if($item['kanit_id'] != null){?>
													<option <?php if($row->id == $item['kanit_id']){ 
														echo 'selected="selected"'; } ?> 
														value="<?php echo $row->id; ?>">
															<?php echo $row->nama;?> 
													</option>
												<?php } else {?>
												<option value="<?php echo $row->id; ?>"><?php echo $row->nama;?> </option>
											<?php } }?>
										</select>
									</div>
									<br>

								<input type="hidden" name="id" value="<?php echo set_value('id',isset($item['id']) ? $item['id'] : ''); ?>" />

								<!--
								<a href="<?php echo site_url('admin/kasubdit'); ?>" class="btn btn-success"><span class="fa fa-pointer-left"></span> Cancel</a>
								<a href="<?php echo site_url('/admin/kasubdit/edit_details'); ?>" class="btn btn-info"><span class="fa fa-save"></span> Save</a>
								-->

								<input type="submit" class="btn btn-warning" value="Save Details">
					            <?php if(!isset($item['id'])): ?>
					            <input type="reset" class="btn btn-primary" value="Reset">          
					            <?php endif; ?>
					            <a class="btn btn-danger" href="<?php echo site_url().'admin/penyidik'; ?>">Close</a>

								</div>
							</form>
							</div>
							<!-- END INPUTS -->