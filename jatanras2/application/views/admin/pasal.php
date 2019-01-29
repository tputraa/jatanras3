					<h3 class="page-title"><a href="<?php echo site_url('/admin/pasal/edit_details'); ?>" class="btn btn-info"><span class="fa fa-plus-circle"></span> Add Pasal</a></h3>
					<div class="row">
						<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">DAFTAR PASAL</h3>
								</div>
								<div class="panel-body">
									<table id="datatable1" class="table table-striped table-bordered" cellspacing="0">
										<thead>
											<tr>
												<th>#</th>
												<th>Pasal</th>
												<th>Judul</th>
												<th width="40%">Deskripsi</th>
												<th>Proses</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; foreach($pasal as $row): ?>
							                  <?php if($row->id <> 'x'): ?>
							        
							                  <tr>
							                    <td><?php echo $i++; ?></td>
							                    <td>
							                    	<a href="<?php echo site_url('/admin/pasal/edit_details/'.$row->id); ?>">
							                    		<?php echo $row->pasal; ?>
							                    	</a>
							                    </td>
							                    <td><?php echo $row->kasus; ?></td>
							                    <td><?php echo $row->deskripsi; ?></td>
							                    <td>
							                    	<a  class="text-primary" 
							                    		href="<?php echo site_url('/admin/pasal/edit_details/'.$row->id);?>"><i class="fa fa-edit"></i></a>
							                    	<a class="text-danger" 
							                    		href="<?php echo site_url('/admin/pasal/delete/'.$row->id);?>" onclick="return confirm('Are you sure you want to delete this item ?');"><i class="fa fa-trash"></i></a>

							                    		
							                    </td>
							                  </tr>

							                  <?php endif; ?>
							                <?php endforeach; ?>  
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BASIC TABLE -->
						</div>
					</div>