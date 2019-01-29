<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-thumb-tack"></i> Content
        <small>Image Slider</small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="<?php echo site_url('banner');?>"><i class="fa fa-dashboard"></i>Image Slider</a></li>
            <li class="active">Tambah Image Slider</li>
          </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <form method="post" action="<?php echo site_url('Admin/Banner/Save');?>" enctype="multipart/form-data">
                    <label style="color: red;"><?php echo $error;?></label>
                    <?php ?>
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