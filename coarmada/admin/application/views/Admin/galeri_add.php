<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-thumb-tack"></i> Content
        <small>Galeri</small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="<?php echo site_url('galeri');?>"><i class="fa fa-dashboard"></i>Galeri</a></li>
            <li class="active">Tambah Foto Galeri</li>
          </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <form method="post" action="<?php echo site_url('Admin/Galeri/Save');?>" enctype="multipart/form-data">
                    <label style="color: red;"><?php echo $error;?></label>
                    <div class="form-group">
                    <label>Judul</label>
                      <input type="text" id="judul" name="judul" 
                             class="form-control" placeholder="Judul" required/>
                      <p class="required"></p>
                    </div>
                    <div class="form-group">
                        <label>Upload</label>
                        <input type="file" name="userfile" class="form-control" required>
                        <p class="required"></p>
                      </div>
                    <input id="save" type="submit" class="btn btn-primary" value="Save" />
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>