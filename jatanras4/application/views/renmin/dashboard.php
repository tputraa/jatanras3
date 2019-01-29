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
											<?php foreach($dokumen as $user): ?>
							                  
							        
							                  <tr class="<?php echo $user->is_status =="1" ? "success" : "danger"; ?>" >
							                    <td><div class="text-primary"><span class="fa fa-folder"></span></div></td>
							                    
							                    <td>
							                    	<a style="color: blue;" href="<?php echo site_url('/renmin/dokumen/details/'.$user->id); ?>"><?php echo $user->no_lp; ?>
							                    	</a>
							                    	</td>
							                    <td><?php echo $user->tanggal_kejadian; ?></td>
							                    <td><?php echo $user->nama_pelapor; ?></td>
							                    <td><?php echo $user->kasus; ?></td>
							                    <td><?php echo $user->is_status =="1" ? "di proses" : "pending"; ?></td>
							                    <td>
							                    	<a class="text-danger" href="<?php echo site_url('/renmin/dokumen/details/'.$user->id); ?>"><i class="fa fa-eye"></i></a>
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
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Dashboard</h3>
							<p class="panel-subtitle"></p>
							<form class="navbar-form navbar-left" method="POST" action="<?php echo site_url('renmin/dashboard')?>">
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
											<span class="title">Dokumen</span>
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
											<span class="number"><?php echo $record_count_visit; ?></span>
											<span class="title">Visits</span>
										</p>
									</div>
								</div>

							</div>
							
						</div>
					</div>
					<!-- END OVERVIEW -->