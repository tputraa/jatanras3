

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>SYNC.ID</b> Admin System
        </div>
        <strong>Copyright &copy; <?php echo DATE('Y');?> <a href="https://sync.id">SYNC.ID</a>.</strong> All rights reserved.
    </footer>
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/css/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/css/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/css/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url() ?>assets/css/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url() ?>assets/css/plugins/tinymce/js/tinymce/init-tinymce.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/css/dist/js/app.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/koarmada.js"></script> -->
    <script type="text/javascript">


        $(document).ready(function () {

            var table = $('#dtTable').DataTable();

            $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                $("#success-alert").slideUp(500);
            });

            $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
                $("#error-alert").slideUp(500);
            });

            var url = window.location;
            // Will only work if string in href matches with location
            $('ul.sidebar-menu a[href="' + url + '"]').parent().addClass('active');

            // Will also work for relative and absolute hrefs
            $('ul.treeview-menu a').filter(function () {
                return this.href == url;
            }).parent().addClass('active').parent().parent().addClass('active');

        });

        // var windowURL = window.location.href;
        // pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        // var x= $('a[href="'+pageURL+'"]');
        //     x.addClass('active');
        //     x.parent().addClass('active');
        // var y= $('a[href="'+windowURL+'"]');
        //     y.addClass('active');
        //     y.parent().addClass('active');

    </script>
  </body>
</html>