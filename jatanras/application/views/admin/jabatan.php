					<h3 class="page-title"><a href="<?php echo site_url('/admin/jabatan/edit_details'); ?>" class="btn btn-info"><span class="fa fa-plus-circle"></span> Add Jabatan</a></h3>
					<div class="row">
						<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">DAFTAR JABATAN</h3>
								</div>
								<div class="panel-body">
									<table id="datatable1" class="table table-striped table-bordered" cellspacing="0">
										<thead>
											<tr>
												<th width="10%">No</th>
												<th>Jabatan</th>
												<th width="10%">Proses</th>
											</tr>
										</thead>
										<tbody>
											<?php if(empty($jabatan)): ?>
									          <div class="alert alert-warning">No result found</div>
									        <?php else: ?>

											<?php $i=1; foreach($jabatan as $row): ?>
							                  <?php if($row->id <> 'x'): ?>
							        
							                  <tr>
							                    <td><?php echo $i++; ?></td>
							                    <td><?php echo $row->jabatan; ?></td>
							                    <td>
							                    	<a  class="text-primary" 
							                    		href="<?php echo site_url('/admin/jabatan/edit_details/'.$row->id);?>"><i class="fa fa-edit"></i></a>
							                    	<a class="text-danger" 
							                    		href="<?php echo site_url('/admin/jabatan/delete/'.$row->id);?>"><i class="fa fa-trash"></i></a>
							                    </td>
							                  </tr>

							                  <?php endif; ?>
							                <?php endforeach; ?>  
							                <?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BASIC TABLE -->
						</div>
					</div>