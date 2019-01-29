<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-thumb-tack"></i> Berita
        <small>Edit Berita</small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="<?php echo site_url('berita');?>"><i class="fa fa-dashboard"></i>Berita</a></li>
            <li class="active">Edit Berita</li>
          </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <?php 
                  if (!$berita){ ?>
                  <p>Denied!</p>
                  <input type="button" class="btn btn-primary" value="Back" onClick="history.go(-1);">
                  <?php }else{ ?>
                  <form method="post" action="<?php echo site_url('Admin/Berita/Update');?>" enctype="multipart/form-data">
                <label style="color: red;"><?php echo $error;?></label>
                <div class="form-group">
                <label>Judul</label>
                <input type="hidden" name="berita_id" value="<?php echo $berita->berita_id;?>">
                  <input type="text" id="judul" name="judul" 
                         class="form-control" placeholder="Judul" 
                         value="<?php echo $berita->judul; ?>" required/>
                  <p class="required"></p>
                </div>
                <div class="form-group">
                    <label>Upload</label>
                    <input type="file" name="userfile">
                    <br>
                    <img src="<?php echo base_url('assets/images/berita_images/').$berita->images;?>" class="img-responsive" style="height:150px;width:200px;"><br/>
                    <p class="required"></p>
                </div>
                <div class="form-group">
                  <label>Isi</label>
                  <br>
                  <textarea class="tinymce" name="isi" id="isi"><?php echo $berita->isi; ?></textarea>
                  <p class="required"></p>
                </div>
                <input id="save" type="submit" class="btn btn-primary" value="Save" />
              </form>
                <?php }?>
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