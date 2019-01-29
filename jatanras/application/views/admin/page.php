
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="#"><img src="<?php echo base_url();?>/template/assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>

				<form class="navbar-form navbar-left" method="POST" action="<?php echo site_url('cari/dokumen')?>">
					<div class="input-group">
						<select class="form-control col-md-4" name="opsi">
							<option value="1" <?php if($this->session->userdata('opsi')=="1") echo 'selected="selected"'; ?>>Nomor LP</option>
							<option value="2" <?php if($this->session->userdata('opsi')=="2") echo 'selected="selected"'; ?>>Kasus</option>
							<option value="3" <?php if($this->session->userdata('opsi')=="3") echo 'selected="selected"'; ?> >Pelapor</option>
							<option value="4" <?php if($this->session->userdata('opsi')=="4") echo 'selected="selected"'; ?>>Pelaku</option>
							<option value="5" <?php if($this->session->userdata('opsi')=="5") echo 'selected="selected"'; ?>>Korban</option>
							<option value="6" <?php if($this->session->userdata('opsi')=="6") echo 'selected="selected"'; ?>>All</option>
						</select>
					</div>

					
					<div class="form-group">
					    <div class="input-group date form_datetime col-sm-6">
					        <input placeholder="Tanggal" name="tanggal" type="text" class="form-control" >
					    <div class="input-group-addon">
					    <span class="glyphicon glyphicon-calendar"></span>
					    </div>
					    </div>
					</div>

					<div class="input-group">
						<input type="text" value="<?php echo $this->session->userdata('keyword'); ?>" name="keyword" class="form-control" placeholder="Search data...">
						<input type="hidden" name="page" class="form-control" value="1">
						<span class="input-group-btn"><input type="submit" value="Cari" class="btn btn-primary"></span>
					</div>
				</form>

				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right" id="notif_container">
						<li class="dropdown">
						
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown" id="notif_anchor">
								<i class="lnr lnr-alarm"></i>
								<span id="notif_count" class="badge bg-danger">0</span>
							</a>
							

							<!-- Menu toggle button -->
							<!--
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="notif_anchor">
                                <i class="lnr lnr-alarm"></i>
                                <span id="notif_count" class="label label-danger">0</span>
                            </a>
                        -->

							<ul class="dropdown-menu notifications">
								
								<li>
                                    <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu" id="notif_ul">
                                        <!-- <li>
                                          <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                          </a>
                                        </li>    -->
                                        <!--  AJAX call soon -->
                                    </ul>
                                </li>

								<!--
								
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
								
-->

								<li class="footer"><a href="<?php echo base_url('realtime/site/notif_all'); ?>" class="more">View all</a></li>

							</ul>
						</li>
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url('assets/uploads/avatar/thumb/').$this->session->userdata('avatar_thumb');?>" class="img-circle" alt="Avatar"> <span><?php echo $this->session->userdata('username');?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo site_url('admin/profile'); ?>"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="<?php echo site_url('admin/dashboard/logout'); ?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="<?php echo site_url('admin'); ?>" class="<?php echo $page=='admin/dashboard' ? 'active' : ''; ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li>

						<?php 
						if ($page=="admin/jabatan") {
							$menu ='active';
							$sub_menu ='collapse in';
						}elseif ($page=="admin/renmin") {
							$menu ='active';
							$sub_menu ='collapse in';
						}elseif ($page=="admin/kasubdit") {
							$menu ='active';
							$sub_menu ='collapse in';
						}elseif ($page=="admin/kanit"){
							$menu ='active';
							$sub_menu ='collapse in';
						}elseif ($page=="admin/penyidik"){
							$menu ='active';
							$sub_menu ='collapse in';
						}elseif ($page=="admin/pasal"){
							$menu ='active';
							$sub_menu ='collapse in';
						}elseif ($page=="admin/users"){
							$menu ='active';
							$sub_menu ='collapse in';
						}elseif ($page=="admin/pelaku"){
							$menu ='active';
							$sub_menu ='collapse in';
						}else{
							$menu='collapse';
							$sub_menu ='collapse';
						}
						?>
							<a href="#subPages" data-toggle="collapse" class="<?php echo $menu; ?>" ><i class="lnr lnr-database"></i> <span>Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="<?php echo $sub_menu; ?>">
								<ul class="nav">
									<li><a href="<?php echo site_url('admin/jabatan');?>" class="<?php echo $page=='admin/jabatan' ? 'active' : ''; ?>">Jabatan</a></li>
									<li><a href="<?php echo site_url('admin/users');?>" class="<?php echo $page=='admin/users' ? 'active' : ''; ?>">Users</a></li>

									<!--
									<li><a href="<?php echo site_url('admin/renmin');?>" class="<?php echo $page=='admin/renmin' ? 'active' : ''; ?>">Renmin</a></li>
									<li><a href="<?php echo site_url('admin/kasubdit');?>"  class="<?php echo $page=='admin/kasubdit' ? 'active' : ''; ?>">Kasubdit</a></li>
									<li><a href="<?php echo site_url('admin/kanit');?>" class="<?php echo $page=='admin/kanit' ? 'active' : ''; ?>">Kanit</a></li>
									<li><a href="<?php echo site_url('admin/penyidik');?>" class="<?php echo $page=='admin/penyidik' ? 'active' : ''; ?>">Penyidik</a></li>

									-->

									<li><a href="<?php echo site_url('admin/pasal');?>" class="<?php echo $page=='admin/pasal' ? 'active' : ''; ?>">Pasal</a></li>

									<li><a href="<?php echo site_url('admin/pelaku');?>" class="<?php echo $page=='admin/pelaku' ? 'active' : ''; ?>">Pelaku</a></li>

									
								</ul>
							</div>
						</li>

						<li><a href="<?php echo site_url('admin/dokumen');?>" class="<?php echo $page=='admin/dokumen' ? 'active' : ''; ?>"><i class="lnr lnr-file-empty"></i> <span>Dokumen</span></a></li>

						<li><a href="#" class="<?php echo $page=='admin/settings' ? 'active' : ''; ?>"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
						<li><a href="<?php echo site_url('admin/dashboard/logout'); ?>" class=""><i class="lnr lnr-exit"></i> <span>Keluar</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<?php $this->load->view($page); ?>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	

	
	<script src="<?php echo base_url('template')?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/datatables/js/dataTables.bootstrap.min.js"></script>

	<script src="<?php echo base_url('template')?>/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	
	<script src="<?php echo base_url(); ?>assets/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url('template')?>/assets/scripts/klorofil-common.js"></script>
	<script>
	
	var datatable;
$(document).ready(function () {

	$('#tbl_dokumen').DataTable({
                "iDisplayLength": 100,
                "bFilter": false,
                "searching": true,
                "aaSorting" : [[2, "desc"]],

                /*
                rowCallback: function(row, data, index){
		            if(data[4] == "1"){
		                $('td', row).css('background-color', 'blue');
		            }
		        },

		        "createdRow": function( row, data, dataIndex ) {
	                if ( data[4] == "1" ) {
	                    $( row ).css( "background-color", "Orange" );
	                    $( row ).addClass( "warning" );
	                }
	            },*/

		        
                "createdRow": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData[5] == "Baru" )
                    {
                        //$('td', nRow).css('background-color', '#f2dede');
                        $('td', nRow).css('background-color', '#efe439').css('color', 'Blue');
                    }
                    else if ( aData[5] == "Proses" )
                    {
                        //$('td', nRow).css('background-color', '#ffff');
                        $('td', nRow).css('background-color', '#6480f9').css('color', 'white');
                    }else{
                    	$('td', nRow).css('background-color', '#4cf774').css('color', 'Black');;
                    }
                }
            });

	  

        $('#datatable1').DataTable();

        //datatables
        datatable = $('#datatable2').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "searching": true,
            "order": [], //Initial no order.
            "pageLength": 5, // Set Page Length
            "lengthMenu":[[5, 25, 50, 100, -1], [5, 25, 50, 100, "All"]],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/kanit/getdata')?>",
                "type": "POST",
                "data": {id:1}
                
            },
            
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0,4,5], //first, Fourth, seventh column
                    "orderable": false //set not orderable
                }
            ],
           "fnInitComplete": function (oSettings, response) {
          }
            
        });
 });
    
</script>

	
	<script>

		function bs_input_file() {
			$(".input-file").before(
				function() {
					if ( ! $(this).prev().hasClass('input-ghost') ) {
						var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
						element.attr("name",$(this).attr("name"));
						element.change(function(){
							element.next(element).find('input').val((element.val()).split('\\').pop());
						});
						$(this).find("button.btn-choose").click(function(){
							element.click();
						});
						$(this).find("button.btn-reset").click(function(){
							element.val(null);
							$(this).parents(".input-file").find('input').val('');
						});
						$(this).find('input').css("cursor","pointer");
						$(this).find('input').mousedown(function() {
							$(this).parents('.input-file').prev().click();
							return false;
						});
						return element;
					}
				}
			);
		}

		$(function() {
			bs_input_file();
		});

		$(function() {
			$(".form_datetime").datepicker({
	              format: 'yyyy-mm-dd',
	              autoclose: true,
	              todayHighlight: true,
	          });
		});
	</script>


	
	<!-- file js utama -->
<script src="<?php echo base_url('assets/notifikasi/main.js'); ?>" type="text/javascript"></script>
<!-- file js untuk testing -->
<script src="<?php echo base_url('assets/notifikasi/test.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        window.setInterval(function () {
            notificationStream(
                1 // id user yang sedang login
            );
        }, 3000);
    });
</script>

</body>
</html>
