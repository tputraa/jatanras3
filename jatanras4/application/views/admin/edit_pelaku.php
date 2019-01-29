<!-- INPUTS -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Input Data Pelaku</h3>
								</div>
								<form action="<?php echo site_url('admin/pelaku/save_details'); ?>" method="POST">
								<div class="panel-body">
									<input required name="nama" type="text" class="form-control" placeholder="Nama Lengkap" value="<?php echo set_value('nama',isset($item['nama']) ? $item['nama'] : ''); ?>">
									
				                    <br>
									<input required name="tempat_lahir" type="text" class="form-control" placeholder="Tempat Lahir" value="<?php echo set_value('tempat_lahir',isset($item['tempat_lahir']) ? $item['tempat_lahir'] : ''); ?>">
									
									<br>
				                    <div class="input-group date form_datetime">
				                      <input placeholder="Tanggal Lahir" name="tanggal_lahir" type="text" class="form-control" value="<?php echo set_value('tanggal_lahir',isset($item['tanggal_lahir']) ? $item['tanggal_lahir'] : ''); ?>" autocomplete="off" required>
				                      <div class="input-group-addon">
				                             <span class="glyphicon glyphicon-calendar"></span>
				                      </div>
				                    </div>
				                    <br>
									<textarea required name="alamat" class="form-control" placeholder="Alamat Lengkap" rows="2"><?php echo set_value('alamat',isset($item['alamat']) ? $item['alamat'] : ''); ?></textarea>
									<br>

									<input required name="telpon" type="text" placeholder="Telepon" class="form-control" value="<?php echo set_value('telpon',isset($item['telpon']) ? $item['telpon'] : ''); ?>">
									
									<br>
									<select required class="form-control" name="jenis_kelamin">
										<option value="L" <?php if($item['jenis_kelamin']=="L") echo 'selected="selected"'; ?>>L</option>
										<option value="P" <?php if($item['jenis_kelamin']=="P") echo 'selected="selected"'; ?>>P</option>
									</select>
									<br>

								<input type="hidden" name="id" value="<?php echo set_value('id',isset($item['id']) ? $item['id'] : ''); ?>" />

								<input type="submit" class="btn btn-warning" value="Save Details">
					            <?php if(!isset($item['id'])): ?>
					            <input type="reset" class="btn btn-primary" value="Reset">          
					            <?php endif; ?>
					            <a class="btn btn-danger" href="<?php echo site_url().'admin/pelaku'; ?>">Close</a>

								</div>
							</form>
							</div>
							<!-- END INPUTS -->