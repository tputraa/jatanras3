          <h3 class="page-title"><a href="<?php echo site_url('/admin/users/edit_details'); ?>" class="btn btn-info"><span class="fa fa-plus-circle"></span> Add User</a></h3>
          <div class="row">
            <div class="col-md-12">
              <!-- BASIC TABLE -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">DAFTAR USERS</h3>
                </div>
                <div class="panel-body">
                  <table id="datatable1" class="table table-striped table-hover table-bordered" cellspacing="0">
                    <thead>
                      <tr>
                        <th width="10%">No</th>
                        <th>NRP</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Telpon</th>
                        <th width="10%">#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($users as $rows) {?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $rows->nrp; ?></td>
                          <td><?php echo $rows->nama; ?></td>
                          <td><?php echo $rows->alamat; ?></td>
                          <td><?php echo $rows->telpon; ?></td>
                          <td>
                            <a  href="<?php echo site_url('/admin/users/edit_details/'.$rows->id); ?>"><i class="fa fa-edit"></i></a>

                            <a href="<?php echo site_url('/admin/users/delete/'.$rows->id); ?>"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr> 
                      <?php $i++;} ?>
                      

                    </tbody>
                  </table>
                </div>
              </div>
            </div>  
          </div>