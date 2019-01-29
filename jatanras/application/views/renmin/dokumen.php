					<h3 class="page-title"><a href="<?php echo site_url('/renmin/dokumen/add'); ?>" class="btn btn-info"><span class="fa fa-plus-circle"></span> Add Dokumen</a></h3>					
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
									<table id="datatable1" class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>No LP</th>
												<th>Tanggal</th>
												<th>Pelapor</th>
												<th>Kasus</th>
												<th width="20%">Status</th>
												<th width="10%">Proses</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($users as $user): ?>
							                  
							        
							                  <tr class="<?php echo $user->is_status =="1" ? "success" : "danger"; ?>" >
							                    <td><div class="text-primary"><span class="fa fa-folder"></span></div></td>
							                    
							                    <td><?php echo $user->no_lp; ?></td>
							                    <td><?php echo $user->tanggal_kejadian; ?></td>
							                    <td><?php echo $user->nama_pelapor; ?></td>
							                    <td><?php echo $user->kasus; ?></td>
							                    <td><?php echo $user->is_status =="1" ? "di proses" : "pending"; ?></td>
							                    <td>
							                    	<a class="text-danger" href="<?php echo site_url('/renmin/dokumen/details/'.$user->id); ?>"><i class="fa fa-edit"></i></a>

							                    	<a class="text-danger" href="<?php echo site_url('/renmin/dokumen/delete/'.$user->id); ?>"><i class="fa fa-trash"></i></a>

							                    </td>
							                  </tr>

							                  
							                <?php endforeach; ?>  
										</tbody>
									</table>
								</div>
							</div>
							<?php endif; ?>
							<!-- END BASIC TABLE https://nakupanda.github.io/bootstrap3-dialog/-->
						</div>
					</div>