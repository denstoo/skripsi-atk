<?php
session_start();
include "config/koneksi.php";
if(!isset($_SESSION['username'])){
	header("location:page-signin.php");
	}
	$kodelog=$_SESSION['username'];
	$login="select*from user where username='$kodelog'";
	$qlog=mysqli_query($koneksi,$login);
	while($datalogin=mysqli_fetch_array($qlog))
		{
			$namalog=$datalogin['nama'];
			$emaillog=$datalogin['email'];
			$gambar=$datalogin['gambar'];
			if($datalogin['level']==1){
				$level="Administrator";
			}else {
			header("location:page-signin.php");
			}
		}
?>
<!doctype html>
<html class="has-tab-navigation header-dark" data-style-switcher-options="{'headerColor': 'dark', 'backgroundColor': 'light', 'headerColor': 'dark', 'changeLogo': false}">

<!-- Mirrored from preview.oklerthemes.com/porto-admin/2.2.0/layouts-tab-navigation-dark.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Jul 2019 14:06:37 GMT -->
<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Administrator</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="vendor/animate/animate.css">

		<link rel="stylesheet" href="vendor/font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Specific Page Vendor CSS -->		<link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.css" />		<link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.theme.css" />		<link rel="stylesheet" href="vendor/select2/css/select2.css" />		<link rel="stylesheet" href="vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />		<link rel="stylesheet" href="vendor/bootstrap-multiselect/css/bootstrap-multiselect.css" />		<link rel="stylesheet" href="vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />		<link rel="stylesheet" href="vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />		<link rel="stylesheet" href="vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />		<link rel="stylesheet" href="vendor/dropzone/basic.css" />		<link rel="stylesheet" href="vendor/dropzone/dropzone.css" />		<link rel="stylesheet" href="vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />		<link rel="stylesheet" href="vendor/summernote/summernote-bs4.css" />		<link rel="stylesheet" href="vendor/codemirror/lib/codemirror.css" />		<link rel="stylesheet" href="vendor/codemirror/theme/monokai.css" />		<link rel="stylesheet" href="vendor/pnotify/pnotify.custom.css" />		<link rel="stylesheet" href="vendor/elusive-icons/css/elusive-icons.css" />		<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.css" />		<link rel="stylesheet" href="vendor/datatables/media/css/dataTables.bootstrap4.css" />		<link rel="stylesheet" href="vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>		<script src="master/style-switcher/style.switcher.localstorage.js"></script>

	</head>
	<body>
		<header class="header">
			<div class="logo-container">
				<div class="juduladmin">
					<h1>Bintang Satria</h1>
				</div>
				<div class="d-md-none toggle-menu" data-toggle="collapse" data-target=".tab-navigation"><i class="fas fa-bars" aria-label="Toggle Menu"></i></div>
			</div>
			<div class="header-right">
				<div class="admin">
					<h1>Halaman Admin</h1>
				</div>
			</div>
		</header>
		<section class="body">
			<div class="inner-wrapper">
				<div class="tab-navigation collapse">
					<nav>
						<ul class="nav nav-pills">
							<li class="">
							    <a class="nav-link" href="login-admin.php">
							        <i class="fas fa-home" aria-hidden="true"></i>User
							    </a>    
							</li>
							<li class="dropdown nav-expanded nav-active">
							    <a class="nav-link" href="login-laporan.php">
							        <i class="fas fa-copy" aria-hidden="true"></i>Laporan
							    </a>    
							</li>
							<li class="">
							    <a class="nav-link" href="config/ceklogout.php">
							        <i class="fas fa-power-off" aria-hidden="true"></i>Logout
							    </a>    
							</li>
						</ul>
					</nav>
				</div>
				<section class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h1>Laporan</h1>
							</div>
						</div><!-- 
						<div class="row">
							<div class="col-md-12">
								<h2>Cetak laporan pembelian</h2>
								<form action="cetak/pembelian.php" method='POST' enctype='multipart/form-data'>
									<div class="row">
										<div class="col-sm-4">
											<input name="tgl" type="date" class="form-control" required>
										</div>
										<div class="col-sm-4">
											<input name="tgl" type="date" class="form-control" required>
										</div>
										<div class="col-sm-4">
											<input type="submit" value="Cetak" class="btn btn-dark">
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h2>Cetak laporan penjualan</h2>
								<form action="cetak/penjualan.php" method='POST' enctype='multipart/form-data'>
									<div class="row">
										<div class="col-sm-4">
											<input name="tgl" type="date" class="form-control" required>
										</div>
										<div class="col-sm-4">
											<input name="tgl" type="date" class="form-control" required>
										</div>
										<div class="col-sm-4">
											<input type="submit" value="Cetak" class="btn btn-dark">
										</div>
									</div>
								</form>
							</div>
						</div> -->
						<div class="row">
							<div class="col-md-12">
								<h2>Cetak laporan kartu stok</h2>
								<form action="cetak/kartu-stok.php" method='POST' target="_blank" enctype='multipart/form-data'>
									<div class="row">
										<div class="col-sm-3">
											<select name='kode' data-plugin-selectTwo class='form-control populate' required>
												<option value=''>Pilih Barang</option>
													<?php
														$sql = "select * from barang";
														$query = mysqli_query($koneksi,$sql);
														while ($datas = mysqli_fetch_array($query))
														{
															echo "<option value='$datas[kode_barang]'>$datas[nama_barang]</option>";
														}
													?>
											</select>
										</div>
										<div class="col-sm-3">
											<input name="tgl1" type="date" class="form-control" required>
										</div>
										<div class="col-sm-3">
											<input name="tgl2" type="date" class="form-control" required>
										</div>
										<div class="col-sm-3">
											<input type="submit" value="Cetak" class="btn btn-dark">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</section>

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.js"></script>		<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>		<script src="master/style-switcher/style.switcher.js"></script>		<script src="vendor/popper/umd/popper.min.js"></script>		<script src="vendor/bootstrap/js/bootstrap.js"></script>		<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>		<script src="vendor/common/common.js"></script>		<script src="vendor/nanoscroller/nanoscroller.js"></script>		<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>		<script src="vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->		<script src="vendor/jquery-ui/jquery-ui.js"></script>		<script src="vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js"></script>		<script src="vendor/select2/jd"></script>		<script src="vendor/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>		<script src="vendor/jquery-maskedinput/jquery.maskedinput.js"></script>		<script src="vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>		<script src="vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>		<script src="vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>		<script src="vendor/fuelux/js/spinner.js"></script>		<script src="vendor/dropzone/dropzone.js"></script>		<script src="vendor/bootstrap-markdown/js/markdown.js"></script>		<script src="vendor/bootstrap-markdown/js/to-markdown.js"></script>		<script src="vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>		<script src="vendor/codemirror/lib/codemirror.js"></script>		<script src="vendor/codemirror/addon/selection/active-line.js"></script>		<script src="vendor/codemirror/addon/edit/matchbrackets.js"></script>		<script src="vendor/codemirror/mode/javascript/javascript.js"></script>		<script src="vendor/codemirror/mode/xml/xml.js"></script>		<script src="vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>		<script src="vendor/codemirror/mode/css/css.js"></script>		<script src="vendor/summernote/summernote-bs4.js"></script>		<script src="vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>		<script src="vendor/ios7-switch/ios7-switch.js"></script>		<script src="vendor/select2/js/select2.js"></script>		<script src="vendor/pnotify/pnotify.custom.js"></script>		<script src="vendor/jquery-validation/jquery.validate.js"></script>		<script src="vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>		<script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>		<script src="vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"></script>		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"></script>		<script src="vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"></script>		<script src="vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>		<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>		<script src="vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>		<script src="vendor/autosize/autosize.js"></script>		<script src="vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>
		<!-- Analytics to Track Preview Website -->		<script>		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)		  })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');		  ga('create', 'UA-42715764-8', 'auto');		  ga('send', 'pageview');		</script>
		<!-- Examples -->
		<script src="js/examples/examples.datatables.default.js"></script>
		<script src="js/examples/examples.advanced.form.js"></script>
		<script src="js/examples/examples.modals.js"></script>
		
		<style>
			.icons-demo-page .demo-icon-hover {
				cursor: pointer;
				font-size: 15px;
			}

			.icons-demo-page .demo-icon-hover:hover {
				color: #111;
			}

			.icons-demo-page .demo-icon-hover i {
				min-width: 40px;
				padding-right: 15px;
			}

			html.dark .icons-demo-page .demo-icon-hover:hover {
				color: #FEFEFE;
			}
		</style>
	</body>
</html>