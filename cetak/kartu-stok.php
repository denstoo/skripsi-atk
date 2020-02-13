<?php
session_start();
include"../config/koneksi.php";
$kode=$_POST['kode'];
$tgl1=$_POST['tgl1'];
$tgl2=$_POST['tgl2'];
$sql = "select * from barang where kode_barang='$kode'";
$query = mysqli_query($koneksi,$sql);
$data = mysqli_fetch_array($query);
$tanggal = $data['tgl_keluar'];
$tanggal = date('d F Y', strtotime($tanggal));
?>
<html>
	
<!-- Mirrored from preview.oklerthemes.com/porto-admin/2.2.0/pages-invoice-print.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Jul 2019 14:10:29 GMT -->
<head>
		<title><?php echo $data['nama_barang']; ?></title>
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css" />

		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="../css/invoice-print.css" />
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
										<img src='../img/logo3	.png' alt='OKLER Themes'  height=100 />
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
			<div class='bill-info'>
				<div class='row'>
					<div class='col-md-12'>
						<div class='bill-to'>
							<p class='h5 mb-1 text-dark text-center font-weight-semibold'><b>KARTU STOK</b></p>
							<p class='text-center'>
								<?php echo "$data[nama_barang]<br>$tgl1 - $tgl2";?>
							</p>
						</div>
					</div>
				</div>
			</div>

			<table class='table table-bordered table-striped mb-0'>
				<thead>
					<tr class='text-dark'>
						<th id='cell-id'     class='font-weight-semibold'>Tanggal</th>
						<th id='cell-item'   class='font-weight-semibold'> No Transaksi</th>
						<th id='cell-desc'   class='font-weight-semibold'>Keterangan</th>
						<th id='cell-qty'    class='font-weight-semibold'>Masuk</th>
						<th id='cell-qty'    class='font-weight-semibold'>Keluar</th>
						<th id='cell-qty'    class='font-weight-semibold'>Sisa</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql2 = "select * from kartustok,barang where barang.kode_barang=kartustok.kode_barang and barang.kode_barang='$kode'";
						$query2 = mysqli_query($koneksi,$sql2);
						while ($data2 = mysqli_fetch_array($query2)) {
							$isi=$data2['isi'];$size=$data2['size'];
							if ($data2['masuk']==0) {$in=""; }else{$in=number_format($data2['masuk'])." $size"; }
							if ($data2['keluar']==0) {$out=""; }else{$out=number_format($data2['keluar'])." Pcs"; }
							if ($data2['sisa']==0) {$sisa2="HABIS"; }else{$sisa2=number_format($data2['sisa'])." Pcs"; }
							$nomor1=$data2['no_transaksi'];$nomor2=substr($nomor1, 0,3);
							if ($nomor2=="KLR") {$nomor="text-right"; }else{$nomor="text-dark"; }
							echo "
								<tr>
									<td>$data2[tgl]</td>
									<td class='$nomor'>$data2[no_transaksi]</td>
									<td>Rp. ".number_format($data2['harga'])." ($data2[keterangan_kartustok])</td>
									<td>$in</td>
									<td>$out</td>
									<td>$sisa2</td>
								</tr>
							";
						}
					?>
					<tr>
						<?php
						$sql3 = "select sum(masuk) as masuk,sum(keluar) as terjual from kartustok where kode_barang='$kode'";
						$query3 = mysqli_query($koneksi,$sql3);
						$data3 = mysqli_fetch_array($query3);
						$masuk=$data3['masuk']*$isi;
						$sisa=$masuk-$data3['terjual'];
						?>
						<th colspan="3" align="right">Total</th>
						<td><?php echo number_format($masuk)." Pcs"; ?></td>
						<td><?php echo number_format($data3['terjual'])." Pcs";?></td>
						<td><?php echo number_format($sisa)." Pcs"; ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<script>
			window.print();
		</script>
	</body>

<!-- Mirrored from preview.oklerthemes.com/porto-admin/2.2.0/pages-invoice-print.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Jul 2019 14:10:29 GMT -->
</html>