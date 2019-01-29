<!-- OVERVIEW -->
					<div class="row">
						<div class="col-md-12">
							<!-- BASIC TABLE -->
							<?php if(empty($dokumen)): ?>
				          <div class="alert alert-danger">Tidak ada data</div>
				        <?php else: ?>
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">DAFTAR DOKUMEN</h3>
								</div>
								<div class="panel-body">
									<table id="tbl_dokumen" class="table table-striped table-bordered" cellspacing="0">
										<thead>
											<tr>
												<th>No</th>
												<th>No LP</th>
												<th>Tanggal</th>
												<th>Pelapor</th>
												<th>Kasus</th>
												<th>Status</th>
												<th>#</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=1; foreach($dokumen as $user): ?>
							                  <?php if($user->id <> 'x'): ?>
							                  	<?php 
							        			if ($user->is_status=='1'){
													$color ="danger";
												}else{
													$color ="text-primary";
												} ?>
							                  <tr>
							                    <td><?php echo $no++; ?></td>
							                    <td>
							                    	<a style="color: blue;" href="<?php echo site_url('/admin/dokumen/edit_details/'.$user->id); ?>">		<?php echo $user->no_lp; ?>
							                    	</a>
							                    </td>
							                    <td><?php echo $user->tanggal_kejadian; ?></td>
							                    <td><?php echo $user->nama_pelapor; ?></td>
							                    <td><?php echo $user->kasus; ?></td>
							                    <td><?php echo $user->is_status=='0' ? 'Baru' : ($user->is_status=='1' ? 'Proses' : 'Selesai') ; ?></td>
							                    
							                    <td>
													<a class="text-danger" href="<?php echo site_url('/admin/dokumen/edit_details/'.$user->id); ?>"><i class="fa fa-eye"></i></a>

							                    	<a class="text-danger" href="<?php echo site_url('/admin/dokumen/edit_details/'.$user->id); ?>"><i class="fa fa-edit"></i></a>

							                    	<a href="<?php echo site_url('/admin/dokumen/delete/'.$user->id); ?>"><i class="fa fa-trash" style="color:red;"></i></a>

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
					
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Summary</h3>
							<p class="panel-subtitle"></p>
							<form class="navbar-form navbar-left" method="POST" action="<?php echo site_url('admin/dashboard')?>">
								<div class="form-group">
									<label>From Date</label>
								    <div class="input-group date form_datetime col-sm-2">
								        <input placeholder="From Date" name="fromdate" type="text" class="form-control" >
								    <div class="input-group-addon">
								    <span class="glyphicon glyphicon-calendar"></span>
								    </div>
								    </div>
								</div>
								&nbsp;
								<div class="form-group">
									<label>To Date</label>
								    <div class="input-group date form_datetime col-sm-2">
								        <input placeholder="To Date" name="todate" type="text" class="form-control" >
								    <div class="input-group-addon">
								    <span class="glyphicon glyphicon-calendar"></span>
								    </div>
								    </div>
								</div>
								&nbsp;
								<div class="input-group">
									<span class="input-group-btn"><input type="submit" value="Apply" class="btn btn-primary"></span>
								</div>
							</form>
						</div>
						<div class="clearfix"></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-upload"></i></span>
										<p>
											<span class="number"><?php echo $record_count_media; ?></span>
											<span class="title">Upload</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-users"></i></span>
										<p>
											<span class="number"><?php echo $record_count_kasubdit; ?></span>
											<span class="title">Kasubdit</span>
										</p>
									</div>
								</div> 

								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-shield"></i></span>
										<p>
											<span class="number"><?php echo $record_count_kanit; ?></span>
											<span class="title">Kanit</span>
										</p>
									</div>
								</div>

								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-drupal"></i></span>
										<p>
											<span class="number"><?php echo $record_count_penyidik; ?></span>
											<span class="title">Penyidik</span>
										</p>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-book"></i></span>
										<p>
											<span class="number"><?php echo $record_count_pasal; ?></span>
											<span class="title">Pasal</span>
										</p>
									</div>
								</div>

								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-eye"></i></span>
										<p>
											<span class="number"><?php echo $record_count_visitor; ?></span>
											<span class="title">Visits</span>
										</p>
									</div>
								</div>

								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-user"></i></span>
										<p>
											<span class="number"><?php echo $record_count_renmin; ?></span>
											<span class="title">Renmin</span>
										</p>
									</div>
								</div>

							</div>
							
						</div>
					</div>
					<!-- END OVERVIEW -->