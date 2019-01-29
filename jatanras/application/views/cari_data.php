<!-- INPUTS -->
<h3 class="page-title"><a href="<?php echo site_url('/admin'); ?>" class="btn btn-info"><span class="fa fa-arrow-left"></span> Back</a></h3>
				<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Hasil pencarian</h3>
								</div>
								
								<div class="panel-body">

									<?php if(empty($result)): ?>
				          <div class="alert alert-danger">Data tidak ditemukan</div>
				        <?php else: ?>

									<ul class="list-unstyled activity-timeline">
										<?php  foreach ($result as $rows) {
											?>
											<li>
												<i class="fa fa-check activity-icon"></i>
												<p><a href="<?php echo site_url('cari/details/'.$rows->id)?>"><?php echo $rows->no_lp;?></a> Kasus : <?php echo $rows->kasus;?> <span class="timestamp">Tanggal Kejadian : <?php echo $rows->tanggal_kejadian;?>, Pelaku : <?php echo $rows->pelaku;?>, Pelapor : <?php echo $rows->nama_pelapor;?></span></p>
											</li>
											<?php
										}
										?>	
											


										</ul>
								</div>
								<?php endif; ?>
							
							</div>
							<!-- END INPUTS -->