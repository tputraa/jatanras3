					
					<div class="row">
						<div class="col-md-12">
							<!-- BASIC TABLE -->
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
												<th>Disposisi ke</th>
												<th>Proses</th>
											</tr>
										</thead>
										<tbody>
											<?php $nomor=1; foreach($users as $user): ?>
							                  <?php if($user->id <> 'x'): ?>
							        
							                  <tr>
							                    <td><?php echo $nomor++; ?></td>
							                    <td><a style="color: blue;" href="<?php echo site_url('/dokumen/edit_details/'.$user->id); ?>">
							                    		<?php echo $user->no_lp; ?>
							                    	</a></td>
							                    <td><?php echo $user->tanggal_kejadian; ?></td>
							                    <td><?php echo $user->nama_pelapor; ?></td>
							                    <td><?php echo $user->kasus; ?></td>
							                    
							                    <td><?php echo $user->is_status=='0' ? 'Baru' : ($user->is_status=='1' ? 'Proses' : 'Selesai') ; ?></td>
							                    <td><?php echo $user->name; ?></td>
							                    <td>
							                    	<a class="text-danger"  href="<?php echo site_url('/dokumen/edit_details/'.$user->id); ?>"><i class="fa fa-eye"></i> </a>
							                    	<a class="text-danger" href="javascript:void(0)" onclick="disposisi(<?php echo $user->id; ?>)"><i class="fa fa-random" aria-hidden="true"> </i></a>
							                    	<a class="text-danger"  href="<?php echo site_url('/dokumen/edit_details/'.$user->id); ?>"><i class="fa fa-edit"></i> </a>
							                    </td>
							                  </tr>

							                  <?php endif; ?>
							                <?php endforeach; ?>  
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BASIC TABLE https://nakupanda.github.io/bootstrap3-dialog/-->
						</div>
					</div>


					    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Disposisi ke Kanit</h4>
      </div>
      <div class="modal-body">
            
              <form action="<?php echo site_url('dokumen/disposisi'); ?>" method="POST">

              <div class="form-group">
	            <label>Nama Kanit</label>
	            <input type="hidden" class="form-control" id="txt_id" name="txt_id" value="<?php echo $this->session->userdata('id_dokumen')?>"required>
				<select class="form-control" name="kanit_id">
					<?php foreach($kanit as $row) {?>
					<?php if($item['id'] != null){?>
					<option <?php if($row->id == $item['id']){ 
					echo 'selected="selected"'; } ?> 
					value="<?php echo $row->id; ?>">
					<?php echo $row->name;?> 
					</option>
					<?php } else {?>
					<option value="<?php echo $row->id; ?>"><?php echo $row->name;?> </option>
					<?php } }?>
				</select>
			</div>

              <div class="form-group">
                <label for="exampleInputPassword1">Catatan</label>
                <input type="text" class="form-control" id="txt_catatan" name="txt_catatan" placeholder="Catatan" required>
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