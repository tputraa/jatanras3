<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
	<title>
    <?php 
    $this->load->config('site');
    echo $this->config->item('site_name'); 
    ?>
    </title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo base_url('template')?>/assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('template')?>/assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('template')?>/assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/datepicker/datepicker3.css">

	<!-- DIALOG -->
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">

	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo base_url('template')?>/assets/css/main.css">
	<link rel="stylesheet" href="<?php echo base_url('template')?>/assets/css/demo.css">
	
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('template')?>/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('template')?>/assets/img/favicon.png">

	<link rel="stylesheet" href="<?php echo base_url()?>/assets/datatables/css/dataTables.bootstrap.min.css">
	
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('template')?>/assets/vendor/toastr/toastr.min.css">
	<script src="<?php echo base_url(); ?>assets/datatables/js/jquery.js"></script>
	<script src="<?php echo base_url('template');?>/assets/vendor/toastr/toastr.min.js"></script>
</head>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="<?php echo site_url('penyidik/dashboard')?>"><img src="<?php echo base_url();?>/template/assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>

				<form class="navbar-form navbar-left" method="GET" action="<?php echo site_url('cari/dokumen')?>">
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
						<input type="hidden" name="page" class="form-control" value="4">
						<span class="input-group-btn"><input type="submit" value="Cari" class="btn btn-primary"></span>
					</div>

					
				</form>
				
				<form class="navbar-form navbar-left">
					<div class="input-group">
						<span class="input-group-btn"><button type="button" class="btn btn-flat btn-info">PANEL PENYIDIK</button></span>
					</div>
				</form>

				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url('assets/uploads/avatar/thumb/').$this->session->userdata('avatar_thumb');?>" class="img-circle" alt="Avatar"> <span><?php echo $this->session->userdata('name');?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo site_url('penyidik/profile');?>"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
							
								<li><a href="<?php echo site_url('user/logout'); ?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
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
						<li><a href="<?php echo site_url('penyidik/dashboard'); ?>" class="<?php echo $page=='media' ? 'active' : ''; ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>

						
						<li><a href="<?php echo site_url('penyidik/dokumen');?>" class="<?php echo $page=='dokumen' ? 'active' : ''; ?>"><i class="lnr lnr-file-empty"></i> <span>Dokumen</span></a></li>

						

						<li><a href="<?php echo site_url('user/logout'); ?>" class=""><i class="lnr lnr-exit"></i> <span>Keluar</span></a></li>
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
				<p class="copyright">&copy; <?php echo date('Y');?> <a href="https://www.themeineed.com" target="_blank">Haribima</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	
	<script src="<?php echo base_url('template')?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
	
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
				"columnDefs": [
				      { "targets": [0,4], "orderable": false }
				  ],		        
                "createdRow": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData[5] == "Baru" )
                    {
                        $('td', nRow).css('background-color', '#efe439').css('color', 'Blue');
                    }
                    else if ( aData[5] == "Proses" )
                    {
                        $('td', nRow).css('background-color', '#6480f9').css('color', 'white');
                    }else{
                    	$('td', nRow).css('background-color', '#4cf774').css('color', 'Black');;
                    }
                }
            });

        //datatables
        datatable = $('#datatable1').DataTable({
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

		function disposisi (id){
			/*
			BootstrapDialog.show({
				title: 'Example',
			    message: 'Write your example here.',
			    buttons: [{
			   		label: 'Close',
			        action: function(dialog) {
			        	dialog.close();
			        }
			    }]
			});
			*/

			$.ajax({
		        url : "<?php echo site_url('dokumen/save_session/')?>",
		        type: "POST",
		        dataType: "JSON",
		        data:{id_dokumen : id},
		        success: function(data)
		        {
		 		
		 			$("#txt_id").val(data.id_dokumen);
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            alert('Error get data from ajax');
		        }
		    });

			$('#myModal').modal('show');
		}
		
		
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
	
</body>
</html>
