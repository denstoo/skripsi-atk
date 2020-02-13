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
							<li class="dropdown nav-expanded nav-active">
							    <a class="nav-link" href="login-admin.php">
							        <i class="fas fa-home" aria-hidden="true"></i>User
							    </a>    
							</li>
							<li class="">
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
					<header class="card-header">
						<div class="card-actions">
							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
							<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
						</div>
		
						<h2 class="card-title">Data User</h2>
						<p class="card-subtitle">
							Menampilkan semua data konsumen baik perorangan maupun perusahaan (badan usaha).
						</p>
						<p class="card-subtitle">
						<a class="mb-1 mt-1 mr-1 modal-with-move-anim ws-normal btn btn-default" href="#modalForm"><i class='el el-plus'></i> User Baru</a>
						</p>
					</header>

					<div class="card-body">
						<?php if (isset($_GET['pesan'])) { ?>
							<div class="alert alert-success"><!-- default primary success info warning danger dark info nomargin -->
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								Penambahan data <strong>Konsumen</strong> berhasil.
							</div>
						<?php }elseif (isset($_GET['ubah'])) { ?>
							<div class="alert alert-success"><!-- default primary success info warning danger dark info nomargin -->
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								Perubahan data <strong>Konsumen</strong> berhasil.
							</div>
						<?php }elseif (isset($_GET['hapus'])) { ?>
							<div class="alert alert-success"><!-- default primary success info warning danger dark info nomargin -->
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								Penghapusan data <strong>Konsumen</strong> berhasil.
							</div>
						<?php }elseif (isset($_GET['pass'])) {
							echo "
								<div class='alert alert-danger'><!-- default primary success info warning danger dark info nomargin -->
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
								$_GET[pass]
							</div>
							";
						} 
						?>
						<table class="table">
							<tbody>
								<?php
									$sql = "select * from user";
									$query = mysqli_query($koneksi,$sql);$no=0;
									while ($data = mysqli_fetch_array($query))
									{	
										if($data['level']==1){$posisi="Administrator"; }elseif ($data['level']==2) {$posisi="Pegawai"; }
										if ($data['gambar']=="") {
											$src="user.jpg";
										}else{
											$src=$data['gambar'];
										}
										echo "
											<tr data-item-id='$no'>
												<td width='200'>
												<div class='thumb-preview'>
												<a class='thumb-image' href='img/user/$src'>
													<img src='img/user/$src' width='100%' class='rounded-circle' data-lock-picture='img/%21logged-user.jpg' />
												</a>
												</td>
												<td>
													<b>$data[nama]</b><br>
													Posisi : $posisi<br>
													".nl2br(htmlspecialchars($data['keterangan']))."<br>
													<a href='#modalLG$data[username]' class='mb-1 mt-1 mr-1 modal-with-move-anim btn btn-info'><i class='el el-pencil'></i> Ubah</a>
													<a class='mb-1 mt-1 mr-1 modal-with-move-anim btn btn-default' href='#foto$data[username]'><i class='el el-picture'></i> Ubah Foto Profil</a>
													<a class='mb-1 mt-1 mr-1 modal-with-move-anim btn btn-warning' href='#password$data[username]'><i class='el el-lock'></i> Ubah Password</a>
													<a href='#modalHeaderColorDanger$data[username]' class='mb-1 mt-1 mr-1 modal-with-move-anim btn btn-danger'><i class='el el-trash'></i> Hapus</a>
												</td>
											</tr>
											<!-- Modal foto -->
												<div id='foto$data[username]' class='zoom-anim-dialog modal-block modal-block-sm modal-block-default mfp-hide'>
													<section class='card'>
														<form action='config/ubah-user-foto.php' method='POST' enctype='multipart/form-data'>
															<input hidden name='username' value='$data[username]' for='inputReadOnly' readonly='readonly' type='text' class='form-control form-control-lg' />
															<header class='card-header'>
																<h2 class='card-title'>Ubah Foto Profil</h2>
															</header>
															<div class='card-body'>
																<div class='form-group row'>
																		<label class='col-sm-4 control-label text-sm-right pt-2'>Upload Gambar</label>
																	<div class='input-group col-sm-8'>
																		<div class='fileupload fileupload-new' data-provides='fileupload'>
																			<div class='input-append'>
																				<div class='uneditable-input'>
																					<i class='fas fa-file fileupload-exists'></i>
																					<span class='fileupload-preview'></span>
																				</div>
																				<span class='btn btn-default btn-file'>
																					<span class='fileupload-exists'>Change</span>
																					<span class='fileupload-new'>Select file</span>
																					<input required name='foto' type='file'>
																				</span>
																				<a href='#' class='btn btn-default fileupload-exists' data-dismiss='fileupload'>Remove</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<footer class='card-footer'>
																<div class='row'>
																	<div class='col-md-12 text-right'>
																		<input type='submit' value='Simpan' class='btn btn-default'>
																		<button class='btn btn-default modal-dismiss'>Batal</button>
																	</div>
																</div>
															</footer>
														</form>
													</section>
												</div>

											<!-- Modal password -->
												<div id='password$data[username]' class='zoom-anim-dialog modal-block modal-block-sm modal-header-color modal-block-warning mfp-hide'>
													<section class='card'>
														<form action='config/ubah-user-password.php' method='POST' enctype='multipart/form-data'>
															<input hidden name='username' value='$data[username]' for='inputReadOnly' readonly='readonly' type='text' class='form-control form-control-lg' />
															<header class='card-header'>
																<h2 class='card-title'>Password Baru</h2>
															</header>
															<div class='card-body'>
																<div class='form-group row'>
																	<div class='col-sm-12'>
																		<input required type='password' name='pass' placeholder='Password Lama' class='form-control'>
																	</div>
																</div>
																<div class='form-group row'>
																	<div class='col-sm-12'>
																		<input required id='idpwd' type='password' name='pass1' placeholder='Password Baru' class='form-control'>
																		<div class='checkbox-custom checkbox-default'>
																			<input class='spwd' name='rememberme' type='checkbox'/>
																			<label for='RememberMe'>Show Password</label>
																		</div>
																	</div>
																</div>
																<div class='form-group row'>
																	<div class='col-sm-12'>
																		<input required type='password' name='pass2' placeholder='Password Baru sekali lagi' class='form-control'>
																	</div>
																</div>
															</div>
															<footer class='card-footer'>
																<div class='row'>
																	<div class='col-md-12 text-right'>
																		<input type='submit' value='Simpan' class='btn btn-warning'>
																		<button class='btn btn-default modal-dismiss'>Batal</button>
																	</div>
																</div>
															</footer>
														</form>
													</section>
												</div>

											<!-- Modal Ubah -->
												<div id='modalLG$data[username]' class='zoom-anim-dialog modal-block modal-header-color modal-block-info mfp-hide'>
													<section class='card'>
														<form action='config/ubah-user.php' method='POST'>
															<header class='card-header'>
																<h2 class='card-title'>Ubah Data User</h2>
															</header>
															<div class='card-body'>
																<input hidden name='username' value='$data[username]' for='inputReadOnly' readonly='readonly' type='text' class='form-control form-control-lg' />
																<div class='form-group row'>
																	<label class='col-sm-4 control-label text-sm-right pt-2'>Nama</label>
																	<div class='col-sm-6'>
																		<input required type='text' name='nama' value='$data[nama]' class='form-control'>
																	</div>
																</div>
																<div class='form-group row'>
																	<label class='col-sm-4 control-label text-sm-right pt-2' for='textareaDefault'>Keterangan</label>
																	<div class='col-sm-8'>
																		<textarea name='ket' class='form-control' rows='3' data-plugin-maxlength maxlength='140'>$data[keterangan]</textarea>
																		<p>
																			<code>Maksimal Karakter</code> sampai 140 karakter.
																		</p>
																	</div>
																</div>
															</div>
															<footer class='card-footer'>
																<div class='row'>
																	<div class='col-md-12 text-right'>
																		<input type='submit' value='Simpan' class='btn btn-info'>
																		<button class='btn btn-default modal-dismiss'>Batal</button>
																	</div>
																</div>
															</footer>
														</form>
													</section>
												</div>

											<!-- Modal hapus -->
											<div id='modalHeaderColorDanger$data[username]' class='zoom-anim-dialog modal-block modal-block-sm modal-full-color modal-block-danger mfp-hide'>
												<section class='card'>
													<header class='card-header'>
														<h2 class='card-title'>Peringatan!</h2>
													</header>
													<div class='card-body'>
														<div class='modal-wrapper'>
															<div class='modal-icon'>
																<i class='fas fa-times-circle'></i>
															</div>
															<div class='modal-text'>
																<p>Apakah $namalog ingin menghapus $data[nama]?</p>
															</div>
														</div>
													</div>
													<footer class='card-footer'>
														<div class='row'>
															<div class='col-md-12 text-right'>
																<a href='config/hapus-user.php?username=$data[username]' class='btn btn-danger'>Ya</a>
																<button class='btn btn-default modal-dismiss'>Cancel</button>
															</div>
														</div>
													</footer>
												</section>
											</div>
											";
									}
								?>
							</tbody>
						</table>
					</div>
				</section>
				<div class='row'>
					<p></p>
				</div>
					
					<!-- Modal Form -->
					<div id="modalForm" class="zoom-anim-dialog modal-block modal-header-color modal-block-success mfp-hide">
						<section class="card">
							<header class="card-header">
								<h2 class="card-title">Tambah Data User Baru</h2>
							</header>
							<form action="config/tambah-user.php" method='POST' enctype='multipart/form-data'>
								<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-4 control-label text-sm-right pt-2">Username</label>
											<div class="input-group col-sm-6">
												<input required type="text" name="username" class="form-control form-control-lg">
												<span class="input-group-append">
													<span class="input-group-text">
														<i class="fas fa-user"></i>
													</span>
												</span>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label text-sm-right pt-2">Password</label>
											<div class="col-sm-6">
												<input required id="idpwd" type="password" name="password" class="form-control">
												<div class='checkbox-custom checkbox-default'>
													<input class='spwd' name='rememberme' type='checkbox'/>
													<label for='RememberMe'>Show Password</label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label text-sm-right pt-2">Nama User</label>
											<div class="col-sm-6">
												<input required type="text" name="nama" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label text-sm-right pt-2">Level</label>
											<div class="col-sm-6">
												<select required name='level' class="form-control">
													<option value=''>Pilih Level</option>
													<option value='1'>Administrator</option>
													<option value='2'>Pegawai</option>
												</select>
											</div>
										</div>
										<div class='form-group row'>
											<label class='col-sm-4 control-label text-sm-right pt-2'>Foto Profil</label>
											<div class='input-group col-sm-8'>
												<div class='fileupload fileupload-new' data-provides='fileupload'>
													<div class='input-append'>
														<div class='uneditable-input'>
															<i class='fas fa-file fileupload-exists'></i>
															<span class='fileupload-preview'></span>
														</div>
														<span class='btn btn-default btn-file'>
															<span class='fileupload-exists'>Change</span>
															<span class='fileupload-new'>Select file</span>
															<input required name='foto' type='file'>
														</span>
														<a href='#' class='btn btn-default fileupload-exists' data-dismiss='fileupload'>Remove</a>
													</div>
												</div>
											</div>
										</div>
										<div class='form-group row'>
											<label class='col-sm-4 control-label text-sm-right pt-2' for='textareaDefault'>Keterangan</label>
											<div class='col-sm-8'>
												<textarea name='ket' class='form-control' rows='3' data-plugin-maxlength maxlength='140'></textarea>
												<p>
													<code>max-length</code> set to 140.
												</p>
											</div>
										</div>
									</div>
								<footer class="card-footer">
									<div class="row">
										<div class="col-md-12 text-center">
											<input type="submit" value="Simpan" class="btn btn-success">
											<button class="btn btn-default modal-dismiss">Cancel</button>
										</div>
									</div>
								</footer>
							</form>
						</section>
					</div>
					<!-- end: page -->
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
		<script src="js/examples/examples.wizard.js"></script>
		<script src="js/examples/examples.mediagallery.js"></script>
		
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

<!-- Mirrored from preview.oklerthemes.com/porto-admin/2.2.0/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Jul 2019 14:04:38 GMT -->
</html>

																<!-- <div class='form-group row'>
																	<label class='col-sm-4 control-label text-sm-right pt-2'>Nama</label>
																	<div class='input-group col-sm-8'>
																		<div class='fileupload fileupload-new' data-provides='fileupload'>
																			<div class='input-append'>
																				<div class='uneditable-input'>
																					<i class='fas fa-file fileupload-exists'></i>
																					<span class='fileupload-preview'></span>
																				</div>
																				<span class='btn btn-default btn-file'>
																					<span class='fileupload-exists'>Change</span>
																					<span class='fileupload-new'>Select file</span>
																					<input name='foto' type='file'>
																				</span>
																				<a href='#' class='btn btn-default fileupload-exists' data-dismiss='fileupload'>Remove</a>
																			</div>
																		</div>
																	</div>
																</div> -->