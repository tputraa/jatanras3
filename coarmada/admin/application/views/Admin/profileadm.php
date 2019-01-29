<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-thumb-tack"></i> Profile
        <small>Profile Koarmada</small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="<?php echo site_url('berita');?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Profile Koarmada</li>
          </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                <label style="color: red;"><?php echo $error;?></label>
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
                <form method="post" action="<?php echo site_url('Admin/Myprofile/UpdateProfile');?>" enctype="multipart/form-data">
                <div class="form-group">
                <label>Judul</label>
                <input type="hidden" name="profile_id" value="<?php echo $profile->profile_id; ?>">
                  <input type="text" id="judul" name="judul" 
                         class="form-control" placeholder="Judul" 
                         value="<?php echo $profile->judul; ?>" required/>
                  <p class="required"></p>
                </div>
                <div class="form-group">
                    <label>Upload</label>
                    <input type="file" name="userfile">
                    <br>
                     <img src="<?php echo base_url('assets/images/profile_images/').$profile->images;?>" class="img-responsive" style="height:150px;width:200px;"><br/>
                    <p class="required"></p>
                  </div>
                <div class="form-group">
                  <label>Isi</label>
                  <br>
                  <textarea class="tinymce" name="isi" id="isi"><?php echo $profile->isi; ?></textarea>
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
<script type="text/javascript">
    $(document).ready(function(){
        //$('#isi').html( tinymce.get('isi').setContent() );

        $('#save').click(function() {
          tinyMCE.triggerSave();
          var editorContent = tinyMCE.activeEditor.getContent();
          if (editorContent == "" || editorContent == null)
          {
            $(tinyMCE.activeEditor.getBody())
              .css("background-color", '#ffeeee')
              .parent()
              .css({
                "background-color": '#ffeeee',
                "border": '1px solid #ff0000'
              });
              //alert("cannot be empty");
              return false;
          }
        });
    });
</script>