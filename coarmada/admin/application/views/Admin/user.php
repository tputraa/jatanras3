<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-thumb-tack"></i> User
        <small>Add, Edit & Delete</small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">User</li>
          </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>tambahuser"><i class="fa fa-plus"></i> Tambah User</a>
                    <br>
                    <br>
                    <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success" id="success-alert">
                        <a href="" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php }else if($this->session->flashdata('error')){  ?>
                        <div class="alert alert-danger" id="error-alert">
                            <a href="" class="close" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>
                </div>
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable" id="dtTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Nama Lengkap</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Level</th>
                          <th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($user as $row){?>
                        <tr>
                          <td><?php echo $row->nama_lengkap;?></td>
                          <td><?php echo $row->username; ?></td>
                          <td><?php echo $row->email; ?></td>
                          <td>
                            <?php if($row->level == 1){
                                $val = 'Admin';
                              }else{
                                $val = 'User';
                              }
                              echo $val;
                            ?>
                          </td>
                          <td>
                             <?php 
                              if($this->session->userdata('level') == "1"){
                                ?>
                                  <div class="btn-group" role="group" align="center">
                                  <a href="<?php echo site_url('Admin/User/Edit/'.$row->user_id);?>" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-edit"></i> Edit</a>
                                  
                                  <a href="<?php echo site_url('Admin/User/Delete/'.$row->user_id);?>" onclick="javascript: return confirm('Anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
                                  </div>
                                
                              <?php } else {?>
                                <div class="btn-group" role="group" align="center">
                                  <a href="<?php echo site_url('Admin/User/Edit/'.$row->user_id);?>" class="btn btn-sm btn-primary btn-flat" disabled><i class="fa fa-edit"></i> Edit</a>
                                  
                                  <a href="<?php echo site_url('Admin/User/Delete/'.$row->user_id);?>" onclick="return false;" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
                                  </div>
                          </td>
                        </tr>
                        <?php } } ?>
                      </tbody>
                    </table>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>