<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-thumb-tack"></i> Running Text
        <small>Running Text</small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Running Text</li>
          </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>tambahtext"><i class="fa fa-plus"></i> Tambah Running Text</a>
                </div>
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
                  <div class="table-responsive">
                    *Keterangan <br><i class="fa fa-eye"></i> Aktif &nbsp;&nbsp;<i class="fa fa-eye-slash"></i> Non-Aktif
                    <br>
                    <br>
                    <table class="table table-bordered table-hover dataTable" id="dtTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Judul</th>
                          <th width="50%">Isi</th>
                          <th>Status</th>
                          <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach($text as $row){?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $row->judul; ?></td>
                          <td><?php echo $row->isi; ?></td>
                          <td>
                            <?php if($row->status == 1){ ?>
                              <a href="<?php echo site_url('Admin/Runningtext/status_submit/').$row->text_id.'/'.'0';?>">
                              <i class="fa fa-eye"></i></a>
                            <?php } else { ?>
                              <a href="<?php echo site_url('Admin/Runningtext/status_submit/').$row->text_id.'/'.'1';?>"><i class="fa fa-eye-slash"></i></a> 
                            <?php }?>
                          </td>
                          <td>
                            <div class="btn-group" role="group">
                            <a href="<?php echo site_url('Admin/Runningtext/Edit/'.$row->text_id);?>" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-edit"></i> Edit</a>
                            
                            <a href="<?php echo site_url('Admin/Runningtext/Delete/'.$row->text_id);?>" onclick="javascript: return confirm('Anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
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