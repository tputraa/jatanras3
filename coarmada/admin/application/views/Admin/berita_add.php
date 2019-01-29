<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-thumb-tack"></i> Berita
        <small>Tambah Berita</small>
      </h1>
      <ol class="breadcrumb">
            <li><a href="<?php echo site_url('berita');?>"><i class="fa fa-dashboard"></i>Berita</a></li>
            <li class="active">Tambah Berita</li>
          </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <form method="post" action="<?php echo site_url('Admin/Berita/Save');?>" enctype="multipart/form-data">
                <label style="color: red;"><?php echo $error;?></label>
                <?php ?>
                <div class="form-group">
                <label>Judul</label>
                  <input type="text" id="judul" name="judul" 
                         class="form-control" placeholder="Judul" 
                         value="<?php echo htmlspecialchars(isset($_POST['judul']) ? $_POST['judul']:'');?>" required/>
                  <p class="required"></p>
                </div>
                <div class="form-group">
                    <label>Upload</label>
                    <input type="file" name="userfile" required>
                    <p class="required"></p>
                  </div>
                <div class="form-group">
                  <label>Isi</label>
                  <br>
                  <textarea class="tinymce" name="isi" id="isi"><?php echo htmlspecialchars(isset($_POST['isi']) ? $_POST['isi']:'');?></textarea>
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