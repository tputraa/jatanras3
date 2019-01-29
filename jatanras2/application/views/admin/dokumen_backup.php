					<h3 class="page-title"><a href="<?php echo site_url('/admin/dokumen/add'); ?>" class="btn btn-info"><span class="fa fa-plus-circle"></span> Add Dokumen</a></h3>
					<div class="row">
						<div class="col-md-12">
							<!-- BASIC TABLE -->
							<?php if(empty($users)): ?>
				          <div class="alert alert-danger">Tidak ada data</div>
				        <?php else: ?>
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">DAFTAR DOKUMEN</h3>
								</div>
								<div class="panel-body">
									<table id="datatable1" class="table table-striped table-bordered" cellspacing="0">
										<thead>
											<tr>
												<th>#</th>
												<th>No LP</th>
												<th>Tanggal</th>
												<th>Pelapor</th>
												<th>Kasus</th>
												<th>Status</th>
												<th>Proses</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($users as $user): ?>
							                  <?php if($user->id <> 'x'): ?>
							                  	<?php 
							        			if ($user->is_status=='1'){
													$color ="danger";
												}else{
													$color ="text-primary";
												} ?>
							                  <tr class="<?php echo $color; ?>">
							                    <td><div class="text-primary"><span class="fa fa-folder"></span></div></td>
							                    <td><a href="<?php echo site_url('/admin/dokumen/edit_details/'.$user->id); ?>"><?php echo $user->no_lp; ?></a></td>
							                    
							                    <td><?php echo $user->tanggal_kejadian; ?></td>
							                    <td><?php echo $user->nama_pelapor; ?></td>
							                    <td><?php echo $user->kasus; ?></td>
							                    <td><?php echo $user->is_status=='0' ? 'Pending' : 'Proses' ; ?></td>
							                    
							                    <td>
							                    	<a class="btn btn-primary" href="<?php echo site_url('/admin/dokumen/edit_details/'.$user->id); ?>">Edit</a>

							                    	<a class="btn btn-danger" href="<?php echo site_url('/admin/dokumen/delete/'.$user->id); ?>">Hapus</a>

							                    </td>
							                  </tr>

							                  <?php endif; ?>
							                <?php endforeach; ?>  
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BASIC TABLE -->
							<?php endif; ?>
						</div>
					</div>