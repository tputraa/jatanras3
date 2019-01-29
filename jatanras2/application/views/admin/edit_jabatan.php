<!-- INPUTS -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Input Data Jabatan</h3>
								</div>
								<form action="<?php echo site_url('admin/jabatan/save_details'); ?>" method="POST">
								<div class="panel-body">
									<input name="jabatan" type="text" class="form-control" placeholder="Jabatan" value="<?php echo set_value('jabatan',isset($item['jabatan']) ? $item['jabatan'] : ''); ?>" autofocus>
									<?php echo form_error('jabatan'); ?>
									
									<br>
								<input type="hidden" name="id" value="<?php echo set_value('id',isset($item['id']) ? $item['id'] : ''); ?>" />

								<input type="submit" class="btn btn-warning" value="Save Details">
					            <?php if(!isset($item['id'])): ?>
					            <input type="reset" class="btn btn-primary" value="Reset">          
					            <?php endif; ?>
					            <a class="btn btn-danger" href="<?php echo site_url().'admin/jabatan'; ?>">Close</a>

								</div>
							</form>
							</div>
							<!-- END INPUTS -->