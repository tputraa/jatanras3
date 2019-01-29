<!-- INPUTS -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Input Data Kanit</h3>
								</div>
								<form action="<?php echo site_url('admin/kanit/save_details'); ?>" method="POST">
								<div class="panel-body">
									<input required name="nrp" type="text" class="form-control" placeholder="NRP" value="<?php echo set_value('nrp',isset($item['nrp']) ? $item['nrp'] : ''); ?>" autofocus>
									<?php echo form_error('nrp'); ?>
									<br>
									<input required name="nama" type="text" class="form-control" placeholder="Nama Lengkap" value="<?php echo set_value('nama',isset($item['nama']) ? $item['nama'] : ''); ?>">
									<?php echo form_error('nama'); ?>
									<br>
									
									<textarea required name="alamat" class="form-control" placeholder="Alamat Lengkap" rows="2"><?php echo set_value('alamat',isset($item['alamat']) ? $item['alamat'] : ''); ?></textarea>
									<br>

									<input required name="telpon" type="text" placeholder="Telpon" class="form-control" value="<?php echo set_value('telpon',isset($item['telpon']) ? $item['telpon'] : ''); ?>">
									<?php echo form_error('telpon'); ?>
									<br>
									<select required class="form-control" name="activation">
										<option value="1" <?php if($item['activation']=="1") echo 'selected="selected"'; ?>>Aktif</option>
										<option value="0" <?php if($item['activation']=="0") echo 'selected="selected"'; ?>>Tidak Aktif</option>
									</select>
									<br>

								<input type="hidden" name="id" value="<?php echo set_value('id',isset($item['id']) ? $item['id'] : ''); ?>" />

								<input type="submit" class="btn btn-warning" value="Save Details">
					            <?php if(!isset($item['id'])): ?>
					            <input type="reset" class="btn btn-primary" value="Reset">          
					            <?php endif; ?>
					            <a class="btn btn-danger" href="<?php echo site_url().'admin/kanit'; ?>">Close</a>

								</div>
							</form>
							</div>
							<!-- END INPUTS -->