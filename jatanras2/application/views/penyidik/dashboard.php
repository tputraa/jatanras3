<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Dashboard</h3>
							<p class="panel-subtitle"></p>
							<form class="navbar-form navbar-left" method="POST" action="<?php echo site_url('penyidik/dashboard')?>">
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
											<span class="number"><?php echo $record_count_visit; ?></span>
											<span class="title">Visits</span>
										</p>
									</div>
								</div>

							</div>
							
						</div>
					</div>
					<!-- END OVERVIEW -->