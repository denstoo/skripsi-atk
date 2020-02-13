<?php
session_start();
$koneksi = mysql_connect("localhost","root",""); mysql_select_db("atk",$koneksi);
?>
<html>
	
<!-- Mirrored from preview.oklerthemes.com/porto-admin/2.2.0/pages-invoice-print.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Jul 2019 14:10:29 GMT -->
<head>
		<title>Invoice Konsumen Print</title>
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />

		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="css/invoice-print.css" />
	</head>
	<body>
		<div class="invoice">
			<header class="clearfix">
				<div class='row'>
					<div class='col-sm-12 mt-3'>
						<table class='table h6 text-dark' border=0>
							<tbody>
								<tr class='b-top-0'>
									<td class='text-center' width='20%'>
										<div class='ib'>
											<img src='img/logo3.png' alt='OKLER Themes'  height=125 />
										</div>
									</td>
									<td class='text-center'>
										<address class='ib mr-1'>
											<b>Marketing Department</b>
											<br/>
											Jl. Syeh Quro, Perumahan Safira Residence Blok A2/12,
											<br />
											Kelurahan Palumbonsari, Kecamatan Karawang Timur
											<br/>
											Phone: +6281-3222-29682, (WA) +62 815-1004-4444
											<br/>
											E-Mail: yoppy withrelation@yahoo.co.id
										</address>
									</td>
									<td class='text-right' width='20%'>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</header>
			<hr>
			<?php 
				$no_keluar=$_GET['no_keluar'];
				$sql = "select * from barangkeluar,konsumen where konsumen.kode_konsumen=barangkeluar.kode_konsumen and barangkeluar.no_keluar='$no_keluar'";
				$query = mysql_query($sql,$koneksi);
				$data = mysql_fetch_array($query);
				$tanggal = $data['tgl_keluar'];
				$tanggal = date('d F Y', strtotime($tanggal));
			?>
			<div class='bill-info'>
				<div class='row'>
					<div class='col-md-4'>
						<div class='bill-to'>
							<p class='h5 mb-1 text-dark font-weight-semibold'></p>
							<address>
								<br/>
								<br/>
								<br/>
								Dari Perusahaan,
								<br/>
								CV. BINTANG SATRIA
							</address>
						</div>
					</div>
					<div class='col-md-4'>
						<div class='bill-to'>
							<p class='h5 mb-1 text-dark text-center font-weight-semibold'>INVOICE</p>
							<address class='text-center'>
								No : <?php echo $data['no_keluar'];?>/Bisa/07/2019
							</address>
						</div>
					</div>
					<div class='col-md-4'>
						<div class='bill-data text-left'>
							<address>
								<br/>
								<br/>
								<br/>
								<table align='center'>
									<tr>
										<td width=100>Tanggal</td>
										<td>: <?php echo $tanggal ?></td>
									</tr>
									<tr>
										<td>Perihal</td>
										<td>: Invoice</td>
									</tr>
									<tr>
										<td>Lampiran</td>
										<td>: 1 Lembar</td>
									</tr>
								</table>
							</address>
						</div>
					</div>
				</div>
			</div>
		
			<div class='row'>
									<div class='col-md-12'>
										<p>Ini merupakan lampirkan Invoice Delivery Order Alat Tulis Kantor dengan rincian barang sebagai berikut :</p>
									</div>
								</div>
								<table class='table table-responsive-md invoice-items'>
									<thead>
										<tr class='text-dark'>
											<th id='cell-id'     class='font-weight-semibold'>No</th>
											<th id='cell-item'   class='font-weight-semibold'> Nama Barang</th>
											<th id='cell-desc'   class='font-weight-semibold'>Merk</th>
											<th id='cell-qty'    class='text-center font-weight-semibold'>Quantity</th>
											<th id='cell-desc'   class='font-weight-semibold'>Satuan</th>
											<th id='cell-qty'    class='text-center font-weight-semibold'>Harga</th>
											<th id='cell-total'  class='text-center font-weight-semibold'>Total</th>
										</tr>
									</thead>
									<tbody>
											<?php
												$sql2 = "select * from stokkeluar,barang,merk where barang.kode_merk=merk.kode_merk and stokkeluar.kode_barang=barang.kode_barang and no_keluar='$no_keluar'";
												$query2 = mysql_query($sql2,$koneksi);
												$o=0;
												while ($data2 = mysql_fetch_array($query2)) {
													$o++;
													echo "
														<tr>
															<td>$o</td>
															<td>$data2[nama_barang]</td>
															<td>$data2[nama_merk]</td>
															<td class='text-center'>$data2[keluar]</td>
															<td>PCS</td>
															<td class='text-right'>Rp.".number_format($data2['po']).",-</td>
															<td class='text-right'>Rp.".number_format($data2['totalkeluar']).",-</td>
														</tr>
													";
												}
											?>
									</tbody>
								</table>
								<div class='invoice-summary'>
									<div class='row justify-content-end'>
										<div class='col-sm-6'>
											<table class='table h6 text-dark'>
												<tbody>
													<?php
														$sql3 = "select sum(totalkeluar) as keseluruhan from stokkeluar where no_keluar='$no_keluar'";
														$query3 = mysql_query($sql3,$koneksi);
														$data3 = mysql_fetch_array($query3) 
													?>
													<tr class='h4'>
														<td>Keseluruhan</td>
														<td class='text-left'>Rp <?php echo number_format($data3['keseluruhan']) ?></td>
													</tr>
													<tr class='text-center'>
														<td colspan="2"><br>
															Hormat Kami
															<br>
															<br>
															<br>
															<br>
															<br>
															R. Yoppy S. Prayogo<br>
															CV. Bintang Satria
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
		</div>

		<script>
			window.print();
		</script>
	</body>

<!-- Mirrored from preview.oklerthemes.com/porto-admin/2.2.0/pages-invoice-print.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Jul 2019 14:10:29 GMT -->
</html>