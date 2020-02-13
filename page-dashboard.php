<?php include 'theader.php';?>
		<link rel="stylesheet" href="vendor/bootstrap-multiselect/css/bootstrap-multiselect.css" />		<link rel="stylesheet" href="vendor/morris/morris.css" />

					<!-- start: page -->
					<div class="row">
						<div class="col-lg-6 mb-3">
							<section class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-xl-8">
											<div class="chart-data-selector" id="salesSelectorWrapper">
												<h2>
													Omzet : 
													<strong>
														<select class="form-control" id="salesSelector">
															<option value="Porto Admin" selected>2019</option>
															<option value="Porto Drupal" >2020</option>
															<option value="Porto Wordpress" >2021</option>
														</select>
													</strong>
												</h2>
					
												<div id="salesSelectorItems" class="chart-data-selector-items mt-3">
													<!-- Flot: Sales Porto Admin -->
													<div class="chart chart-sm" data-sales-rel="Porto Admin" id="flotDashSales1" class="chart-active" style="height: 203px;"></div>
													<script>
					
														var flotDashSales1Data = [{
														    data: [
														        ["Jan", <?php $sql = "select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar between '2019-01-01' and '2019-01-31'"; $query = mysql_query($sql,$koneksi); $data = mysql_fetch_array($query); echo $data['total']; ?>],
														        ["Feb", <?php $sql = "select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar between '2019-02-01' and '2019-02-31'"; $query = mysql_query($sql,$koneksi); $data = mysql_fetch_array($query); echo $data['total']; ?>],
														        ["Mar", <?php $sql = "select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar between '2019-03-01' and '2019-03-31'"; $query = mysql_query($sql,$koneksi); $data = mysql_fetch_array($query); echo $data['total']; ?>],
														        ["Apr", <?php $sql = "select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar between '2019-04-01' and '2019-04-31'"; $query = mysql_query($sql,$koneksi); $data = mysql_fetch_array($query); echo $data['total']; ?>],
														        ["May", <?php $sql = "select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar between '2019-05-01' and '2019-05-31'"; $query = mysql_query($sql,$koneksi); $data = mysql_fetch_array($query); echo $data['total']; ?>],
														        ["Jun", <?php $sql = "select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar between '2019-06-01' and '2019-06-31'"; $query = mysql_query($sql,$koneksi); $data = mysql_fetch_array($query); echo $data['total']; ?>],
														        ["Jul", <?php $sql = "select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar between '2019-07-01' and '2019-07-31'"; $query = mysql_query($sql,$koneksi); $data = mysql_fetch_array($query); echo $data['total']; ?>],
														        ["Aug", <?php $sql = "select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar between '2019-08-01' and '2019-08-31'"; $query = mysql_query($sql,$koneksi); $data = mysql_fetch_array($query); echo $data['total']; ?>],
														        ["Sep", <?php $sql = "select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar between '2019-09-01' and '2019-09-31'"; $query = mysql_query($sql,$koneksi); $data = mysql_fetch_array($query); echo $data['total']; ?>],
														        ["Okt", <?php $sql = "select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar between '2019-10-01' and '2019-10-31'"; $query = mysql_query($sql,$koneksi); $data = mysql_fetch_array($query); echo $data['total']; ?>],
														        ["Nov", <?php $sql = "select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar between '2019-11-01' and '2019-11-31'"; $query = mysql_query($sql,$koneksi); $data = mysql_fetch_array($query); echo $data['total']; ?>],
														        ["Des", <?php $sql = "select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar between '2019-12-01' and '2019-12-31'"; $query = mysql_query($sql,$koneksi); $data = mysql_fetch_array($query); echo $data['total']; ?>]
														    ],
														    color: "#CCCCCC"
														}];
					
														// See: js/examples/examples.dashboard.js for more settings.
					
													</script>
					
													<!-- Flot: Sales Porto Drupal -->
													<div class="chart chart-sm" data-sales-rel="Porto Drupal" id="flotDashSales2" class="chart-hidden"></div>
													<script>
					
														var flotDashSales2Data = [{
														    data: [
														        ["Jan", 240],
														        ["Feb", 240],
														        ["Mar", 290],
														        ["Apr", 540],
														        ["May", 480],
														        ["Jun", 220],
														        ["Jul", 170],
														        ["Aug", 190]
														    ],
														    color: "#2baab1"
														}];
					
														// See: js/examples/examples.dashboard.js for more settings.
					
													</script>
					
													<!-- Flot: Sales Porto Wordpress -->
													<div class="chart chart-sm" data-sales-rel="Porto Wordpress" id="flotDashSales3" class="chart-hidden"></div>
													<script>
					
														var flotDashSales3Data = [{
														    data: [
														        ["Jan", 840],
														        ["Feb", 740],
														        ["Mar", 690],
														        ["Apr", 940],
														        ["May", 1180],
														        ["Jun", 820],
														        ["Jul", 570],
														        ["Aug", 780]
														    ],
														    color: "#734ba9"
														}];
					
														// See: js/examples/examples.dashboard.js for more settings.
					
													</script>
												</div>
					
											</div>
										</div>
										<div class="col-xl-4 text-center">
											<h2 class="card-title mt-3">Target Omzet</h2>
											<div class="liquid-meter-wrapper liquid-meter-sm mt-3">
												<div class="liquid-meter">
													<meter min="0" max="100" value="35" id="meterSales"></meter>
												</div>
												<div class="liquid-meter-selector mt-4 pt-1" id="meterSalesSel">
													<a href="#" data-val="90" class="active">Bulan ini</a>
													<a href="#" data-val="35">Tahun ini</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
						<div class="col-lg-6">
							<div class="row mb-3">
								<div class="col-xl-6">
									<section class="card card-featured-left card-featured-secondary mb-3">
										<div class="card-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-secondary">
														<i class="fas fa-shopping-cart"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Penjualan Hari ini</h4>
														<div class="info">
															<strong class="amount"><?php $tanggal=date('Y-m-d');$sqlini="select count(no_keluar) as total from barangkeluar where tgl_keluar='$tanggal'"; $queryini=mysql_query($sqlini,$koneksi);$dataini=mysql_fetch_array($queryini); echo number_format($dataini['total']) ;?></strong>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase" href="#">(view all)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-xl-6">
									<section class="card card-featured-left card-featured-primary">
										<div class="card-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														Rp
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Penjualan Hari ini</h4>
														<div class="info">
															<strong class="amount"><?php $tanggal=date('Y-m-d');$sqlini="select sum(detailkeluar.total_keluar) as total from detailkeluar,barangkeluar where barangkeluar.no_keluar=detailkeluar.no_keluar and tgl_keluar='$tanggal'"; $queryini=mysql_query($sqlini,$koneksi);$dataini=mysql_fetch_array($queryini); echo number_format($dataini['total']) ;?></strong>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase" href="#">(withdraw)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-xl-6">
									<section class="card card-featured-left card-featured-secondary mb-3">
										<div class="card-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-secondary">
														<i class="fas fa-shopping-cart"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Pembelian Hari ini</h4>
														<div class="info">
															<strong class="amount"><?php $tanggal=date('Y-m-d');$sqlini="select count(no_masuk) as total from barangmasuk where tgl_masuk='$tanggal'"; $queryini=mysql_query($sqlini,$koneksi);$dataini=mysql_fetch_array($queryini); echo number_format($dataini['total']) ;?></strong>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase" href="#">(view all)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-xl-6">
									<section class="card card-featured-left card-featured-primary">
										<div class="card-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														Rp
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Pembelian Hari ini</h4>
														<div class="info">
															<strong class="amount"><?php $tanggal=date('Y-m-d');$sqlini="select sum(detailmasuk.harga) as total from detailmasuk,barangmasuk where barangmasuk.no_masuk=detailmasuk.no_masuk and tgl_masuk='$tanggal'"; $queryini=mysql_query($sqlini,$koneksi);$dataini=mysql_fetch_array($queryini); echo number_format($dataini['total']) ;?></strong>
														</div>
													</div>
													<div class="summary-footer">
														<a class="text-muted text-uppercase" href="#">(withdraw)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-xl-6">
							<section class="card mt-4">
								<header class="card-header bg-white">
									<center>
										<img src="img/logo3.png" width="150">
									</center>
								</header>
								<div class="card-body">
									<h3 class="mt-0 font-weight-semibold mt-0 text-center">Sejarah CV. Bintang Satria</h3>
									<p class="text-justify">Seiring dengan perkembangan Kota Karawang, khususnya sebagai Kota Industri terbesar diwilayah Jawa Barat, pertumbuhan perusahaan-perusahan industry Automotif, Textile, Elektronik dll, tidak lepas akan kebutuhan suatu perusahaan dengan barang dan jasa, diantaranya :</p>
									<ol>
										<li>Alat Tulis Kantor (ATK)</li>
										<li>Percetakan</li>
										<li>Pengadaan Barang dan Jasa</li>
										<li>Kesehatan Herbal</li>
										<li>Alat Kesehatan Herbal dll</li>
									</ol>
									<p class="text-justify">Dari ke 5 (lima) hal tersebut di atas merupakan kebutuhan pokok perusahaan dan pelaku usaha yang tidak memberikan suatu nilai tambah namun penting bagi jalannya suatu perusahaan (Non Value Adding). Untuk memenuhi kebutuhan tersebut, maka kami berniat untuk berpartisipasi dalam suport pengadaan barang dan jasa diantaranya dari ke 5 (lima) hal tersebut di atas untuk mendukung kelancaran operasional perusahaan.</p>

								</div>
							</section>
						</div>
						<div class="col-lg-6 col-xl-6">
							<section class="card mt-4">
								<header class="card-header bg-primary">
									<h1 class="text-center">Visi & Misi</h1>
								</header>
								<div class="card-body text-center">
									<h3 class="font-weight-semibold mt-3 text-center">Visi</h3>
									<p class="text-center">Memberikan kemudahan dan kenyamanan akan kebutuhan Alat Tulis Kantor (ATK), Percetakan dan jasa lainnya sehingga konsumen merasa aman dan nyaman.</p>
									<p class="text-center">Moto Sehat “Setiap 1 Manusia Membutuhkan Kesehatan” Memberikan pelayanan kesehatan (herbal) dan memberikan solusi kesehatan (Konsultan) berbagai macam penyakit bagi semua pegawai maupun pelaku usaha.</p>
									<h3 class="font-weight-semibold mt-3 text-center">Misi</h3>
									<p class="text-center">Menjadi salah satu Perusahaan Pengadaan Barang dan Jasa serta konsultan keshatan (Herbal) terbaik dan mampu menjadi partnership yang dibutuhkan oleh konsumen.</p>
								</div>
							</section>
						</div>
					</div>
					<!-- end: page -->
<?php include 'tfooter.php';?>
<script src="vendor/jquery-appear/jquery.appear.js"></script>		<script src="vendor/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>		<script src="vendor/jquery.easy-pie-chart/jquery.easypiechart.jss"></script>		<script src="vendor/flot/jquery.flot.js"></script>		<script src="vendor/flot.tooltip/jquery.flot.tooltip.js"></script>		<script src="vendor/flot/jquery.flot.pie.js"></script>		<script src="vendor/flot/jquery.flot.categories.js"></script>		<script src="vendor/flot/jquery.flot.resize.js"></script>		<script src="vendor/jquery-sparkline/jquery.sparkline.js"></script>		<script src="vendor/raphael/raphael.js"></script>		<script src="vendor/morris/morris.js"></script>		<script src="vendor/gauge/gauge.js"></script>		<script src="vendor/snap.svg/snap.svg.js"></script>		<script src="vendor/liquid-meter/liquid.meter.js"></script>
<script src="js/examples/examples.dashboard.js"></script>