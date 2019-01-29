<!-- INPUTS -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Detail Data Laporan</h3>
								</div>
								<div class="panel-body">

									<div class="custom-tabs-line tabs-line-bottom left-aligned">
										<ul class="nav" role="tablist">
											<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Detail Laporan</a></li>
											<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Dokumen</a></li>
										</ul>
									</div>

									<div class="tab-content">
										<div class="tab-pane fade in active" id="tab-bottom-left1">
										<form class="form-horizontal" action="<?php echo site_url('admin/dokumen/save'); ?>" enctype="multipart/form-data" method="POST"  >
									
									<div class="form-group">
								      <label class="control-label col-sm-2" for="email">Nomor LP </label>
								      <div class="col-sm-10">
								        <input type="text" class="form-control" id="nolp" placeholder="Nomor LP" name="nolp" value="<?php echo set_value('nrp',isset($item['no_lp']) ? $item['no_lp'] : ''); ?>" required readonly>
								        <?php echo form_error('nrp'); ?>
								      </div>
								    </div>

									<div class="form-group">
								      <label class="control-label col-sm-2" for="email">Nama Pelapor </label>
								      <div class="col-sm-10">
								        <input name="pelapor" type="text" class="form-control" placeholder="Nama Pelapor" value="<?php echo set_value('nama',isset($item['nama_pelapor']) ? $item['nama_pelapor'] : ''); ?>" required readonly>
										<?php echo form_error('nama'); ?>
								      </div>
								    </div>

									
									<div class="form-group">
								      <label class="control-label col-sm-2" for="email">Kasus </label>
								      <div class="col-sm-10">
								        <input name="pelapor" type="text" class="form-control" placeholder="Nama Pelapor" value="<?php echo set_value('nama',isset($item['kasus']) ? $item['kasus'] : ''); ?>" required readonly>
										<?php echo form_error('pasal'); ?>
								      </div>
								    </div>

								    <div class="form-group">
								      <label class="control-label col-sm-2" for="email">Tanggal Kejadian</label>
								      <div class="col-sm-10">
								        <input name="pelapor" type="text" class="form-control" placeholder="Nama Pelapor" value="<?php echo set_value('nama',isset($item['tanggal_kejadian']) ? $item['tanggal_kejadian'] : ''); ?>" required readonly>
										<?php echo form_error('nama'); ?>
								      </div>
								    </div>

								    
					                <div class="form-group">
								      <label class="control-label col-sm-2" for="email">Nama Pelaku </label>
								      <div class="col-sm-10">
								        <input name="pelaku" type="text" class="form-control" placeholder="Nama Pelaku" value="<?php echo set_value('pelaku',isset($item['pelaku']) ? $item['pelaku'] : ''); ?>" readonly>
										<?php echo form_error('pelaku'); ?>
								      </div>
								    </div>

								    <div class="form-group">
								      <label class="control-label col-sm-2" for="email">Korban </label>
								      <div class="col-sm-10">
								        <input name="korban" type="text" class="form-control" placeholder="Nama Korban" value="<?php echo set_value('pelaku',isset($item['korban']) ? $item['korban'] : ''); ?>" readonly>
										<?php echo form_error('pelaku'); ?>
								      </div>
								    </div>

								   
									
									<div class="form-group">
								      <label class="control-label col-sm-2" for="email">Tanggal Pelaporan</label>
								      <div class="col-sm-10">
								        <input name="pelapor" type="text" class="form-control" placeholder="Nama Pelapor" value="<?php echo set_value('nama',isset($item['tanggal_lapor']) ? $item['tanggal_lapor'] : ''); ?>" required readonly>
										<?php echo form_error('nama'); ?>
								      </div>
								    </div>

								<input type="hidden" name="id" value="<?php echo set_value('id',isset($item['id']) ? $item['id'] : ''); ?>" />

								
								<hr/>
								
					            
								
							</form>
										
									</div>

									<div class="tab-pane fade" id="tab-bottom-left2">
										<img src="<?php echo base_url('assets/uploads/').$item['file_name'];?>" width="400px" height="400px">
									</div>
									</div>

							<table class="table table-bordered">
										<thead>
											<tr>
												<th class="col-md-1">No</th>
												<th class="col-md-2">Tanggal Upload</th>
												<th class="col-md-4">Keterangan</th>
												<th class="col-md-2">#</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; if(empty($dokumen)): ?>
				          
				        <?php else: ?>
											<?php foreach($dokumen as $user): ?>
							                  
							        
							                  <tr>
							                    <td><?php echo $i++; ?></td>
							                    <td><?php echo $user->created_date; ?></td>
							                    <td><?php echo $user->keterangan; ?></td>
							                    <td>
							                    	<a class="btn btn-warning" href="#">Edit</a>
							                    	<a class="btn btn-danger" href="#">Hapus</a>

							                    </td>
							                  </tr>

							                  
							                <?php endforeach; ?>  
							                <?php endif; ?>
										</tbody>
									</table>
							</div>

							<div>
								<div class="margin-top-10 text-center">
									<a class="btn btn-primary" href="<?php echo site_url().'penyidik/dokumen'; ?>">Close</a>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Upload</button>
								</div>
								</div>

								<br />
							</div>
							<!-- END INPUTS -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload Dokumen</h4>
      </div>
      <div class="modal-body">
            
            
              
              <form enctype="multipart/form-data" action="<?php echo site_url('penyidik/dokumen/upload'); ?>" method="POST">
              	<input type="hidden" name="media_id" value="<?php echo set_value('id',isset($item['id']) ? $item['id'] : ''); ?>" />
              <div class="form-group">
	            <label>Keterangan</label>
	            <textarea name="keterangan" class="form-control" placeholder="Keterangan" rows="3"><?php echo set_value('alamat',isset($item['alamat']) ? $item['alamat'] : ''); ?></textarea>
			</div>

              <div class="form-group">
								  	<label class="control-label" for="email">Upload File </label>
					                    
										<div class="input-group input-file" name="Fichier1">

								    		<input type="text" name="imageURL" id="url" class="form-control" placeholder='Choose a file...' />			
								            <span class="input-group-btn">
								        		<button class="btn btn-default btn-choose" type="button">Choose file</button>
								    		</span>
										</div>
										
										
									
									</div>
             
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
							