<!-- INPUTS -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Input Data Kasubdit</h3>
								</div>
								<form action="<?php echo site_url('admin/kasubdit/save_details'); ?>" method="POST">
								<div class="panel-body">
									<input name="nrp" type="text" class="form-control" placeholder="NRP" value="<?php echo set_value('nrp',isset($item['nrp']) ? $item['nrp'] : ''); ?>" autofocus required>
									<?php echo form_error('nrp'); ?>
									<br>
									<input name="nama" type="text" class="form-control" placeholder="Nama Lengkap" value="<?php echo set_value('nama',isset($item['nama']) ? $item['nama'] : ''); ?>" required>
									<?php echo form_error('nama'); ?>
									<br>
									
									<textarea required name="alamat" class="form-control" placeholder="Alamat Lengkap" rows="2"><?php echo set_value('alamat',isset($item['alamat']) ? $item['alamat'] : ''); ?></textarea>
									<?php echo form_error('alamat'); ?>
									<br>

									<input name="telpon" type="text" placeholder="Telpon" class="form-control" value="<?php echo set_value('telpon',isset($item['telpon']) ? $item['telpon'] : ''); ?>" required>
									<?php echo form_error('telpon'); ?>
									<br>

									<select class="form-control" name="activation" required>
										<option value="1" <?php if($item['activation']=="1") echo 'selected="selected"'; ?>>Aktif</option>
										<option value="0" <?php if($item['activation']=="0") echo 'selected="selected"'; ?>>Tidak Aktif</option>
									</select>
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
					            <a class="btn btn-danger" href="<?php echo site_url().'admin/kasubdit'; ?>">Close</a>

								</div>
							</form>
							</div>
							<!-- END INPUTS -->