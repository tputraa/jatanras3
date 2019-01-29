<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-thumb-tack"></i> Image Slider
        <small>Image Slider</small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Image Slider</li>
          </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>tambahimage"><i class="fa fa-plus"></i> Tambah Image Slider</a>
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
                          <th>No</th>
                          <th>Image</th>
                          <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach($image as $row){?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><img width="200px" height="150px" src="<?php echo base_url('assets/images/banner/thumb/').$row->image_thumb; ?>"></td>
                          <td>
                            <div class="btn-group" role="group">
                            <a href="<?php echo site_url('Admin/Banner/Edit/'.$row->banner_id);?>" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-edit"></i> Edit</a>
                            
                            <a href="<?php echo site_url('Admin/Banner/Delete/'.$row->banner_id);?>" 
                              onclick="javascript: return confirm('Anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
                            </div>
                          </td>
                        </tr>
                        <?php $i++;}?>
                      </tbody>
                    </table>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>