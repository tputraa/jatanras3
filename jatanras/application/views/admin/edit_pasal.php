<!-- INPUTS -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Input Data Pasal</h3>
								</div>
								<form action="<?php echo site_url('admin/pasal/save_details'); ?>" method="POST">
								<div class="panel-body">
									<input name="pasal" type="text" class="form-control" placeholder="Pasal" value="<?php echo set_value('pasal',isset($item['pasal']) ? $item['pasal'] : ''); ?>" autofocus>
									<?php echo form_error('pasal'); ?>
									<br>
									<input name="kasus" type="text" class="form-control" placeholder="Judul" value="<?php echo set_value('kasus',isset($item['kasus']) ? $item['kasus'] : ''); ?>">
									<?php echo form_error('kasus'); ?>
									<br>
									<input name="deskripsi" type="text" class="form-control" placeholder="Deskripsi" value="<?php echo set_value('deskripsi',isset($item['deskripsi']) ? $item['deskripsi'] : ''); ?>">
									<?php echo form_error('deskripsi'); ?>
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
					            <a class="btn btn-danger" href="<?php echo site_url().'admin/pasal'; ?>">Close</a>

								</div>
							</form>
							</div>
							<!-- END INPUTS -->