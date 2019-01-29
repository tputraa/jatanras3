					<h3 class="page-title"><a href="<?php echo site_url('/admin/kasubdit/edit_details'); ?>" class="btn btn-info"><span class="fa fa-plus-circle"></span> Add Kasubdit</a></h3>
					<div class="row">

						
						<div class="col-md-12">

							<?php if(empty($users)): ?>
				          <div class="alert alert-danger">Tidak ada data</div>
				        <?php else: ?>


							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">DAFTAR KASUBDIT</h3>
								</div>
								<div class="panel-body">
									<table id="datatable1" class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>NRP</th>
												<th>Nama Lengkap</th>
												<th>Alamat</th>
												<th>Telpon</th>
												<th>Proses</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; foreach($users as $user): ?>
							                  <?php if($user->id <> 'x'): ?>
							        
							                  <tr>
							                    <td><?php echo $i++; ?></td>
							                    <td><?php echo $user->nrp; ?></td>
							                    <td><?php echo $user->nama; ?></td>
							                    <td><?php echo $user->alamat; ?></td>
							                    <td><?php echo $user->telpon; ?></td>
							                    
							                    
							                    <td>
							                    	<a class="btn btn-primary" href="<?php echo site_url('/admin/kasubdit/edit_details/'.$user->id); ?>"><i class="fa fa-edit"></i></a>

							                    	<a class="btn btn-danger" href="<?php echo site_url('/admin/kasubdit/delete/'.$user->id); ?>"><i class="fa fa-trash"></i></a>

							                    </td>
							                  </tr>

							                  <?php endif; ?>
							                <?php endforeach; ?>  
										</tbody>
									</table>
								</div>
							</div>
							<?php endif; ?>
						</div>
						
					</div>