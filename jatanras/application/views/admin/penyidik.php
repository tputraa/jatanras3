					<h3 class="page-title"><a href="<?php echo site_url('/admin/penyidik/edit_details'); ?>" class="btn btn-info"><span class="fa fa-plus-circle"></span> Add Penyidik</a></h3>
					<div class="row">
						<div class="col-md-12">
							<?php if(empty($users)): ?>
				          <div class="alert alert-danger">Tidak ada data</div>
				        <?php else: ?>
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">DAFTAR PENYIDIK</h3>
								</div>
								<div class="panel-body">
									<table id="datatable1" class="table table-striped table-bordered" cellspacing="0">
										<thead>
											<tr>
												<th width="10%">#</th>
												<th>NRP</th>
												<th>Nama Lengkap</th>
												<th>Alamat</th>
												<th>Telpon</th>
												<th>Kanit</th>
												
												<th>Proses</th>
											</tr>
										</thead>
										<tbody>
											<?php $nomor=1; foreach($users as $user): ?>
							                  <?php if($user->id <> 'x'): ?>
							        
							                  <tr>
							                    <td><?php echo $nomor++; ?></td>
							                    <td><a href="<?php echo site_url('/admin/penyidik/edit_details/'.$user->id); ?>"><?php echo $user->nrp; ?></a></td>
							                    <td><?php echo $user->nama; ?></td>
							                    <td><?php echo $user->alamat; ?></td>
							                    <td><?php echo $user->telpon; ?></td>
							                    <td><?php echo $user->nama_kanit;?></td>
							                    
							                    <td>
							                    	<a class="btn btn-primary" href="<?php echo site_url('/admin/penyidik/edit_details/'.$user->id); ?>">Edit</a>

							                    	<a class="btn btn-danger" href="<?php echo site_url('/admin/penyidik/delete/'.$user->id); ?>">Hapus</a>
							                    </td>
							                  </tr>

							                  <?php endif; ?>
							                <?php endforeach; ?>  
										</tbody>
									</table>
								</div>
							</div>
							<?php endif; ?>
							<!-- END BASIC TABLE -->
						</div>
					</div>