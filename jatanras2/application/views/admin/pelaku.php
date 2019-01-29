					<h3 class="page-title"><a href="<?php echo site_url('/admin/pelaku/edit_details'); ?>" class="btn btn-info"><span class="fa fa-plus-circle"></span> Add Pelaku</a></h3>
					<div class="row">
						<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">DAFTAR PELAKU</h3>
								</div>
								<div class="panel-body">
									<table id="datatable1" class="table table-striped table-bordered" cellspacing="0">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama Lengkap</th>
												<th>Tempat, Tgl Lahir</th>
												<th>L/P</th>
												<th width="40%">Alamat</th>
												<th>Proses</th>
											</tr>
										</thead>
										<tbody>
											<?php if(empty($pelaku)): ?>
									          <div class="alert alert-danger">Tidak ada data</div>
									        <?php else: ?>

											<?php $i=1; foreach($pelaku as $row): ?>
							        
							                  <tr>
							                    <td><?php echo $i++; ?></td>
							                    <td>
							                    	<?php echo $row->nama; ?>
							                    </td>
							                    
							                    <td><?php echo $row->tempat_lahir.", ".date("d-m-Y", strtotime($row->tanggal_lahir)); ?></td>
							                    <td><?php echo $row->jenis_kelamin; ?></td>
							                    <td><?php echo $row->alamat; ?></td>
							                    <td>
							                    	<a  class="text-primary" 
							                    		href="<?php echo site_url('/admin/pelaku/edit_details/'.$row->id);?>"><i class="fa fa-edit"></i></a>
							                    	<a class="text-danger" 
							                    		href="<?php echo site_url('/admin/pelaku/delete/'.$row->id);?>"><i class="fa fa-trash"></i></a>
							                    </td>
							                  </tr>

							                  
							                <?php endforeach; ?>  
							                <?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BASIC TABLE -->
						</div>
					</div>