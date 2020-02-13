<?php include 'theader.php';?>
					<!-- start: page -->
					<section class='card'>
						<div class='card-body'>
							<div class='invoice'>
								<header class='clearfix'>
									<div class='row'>
										<div class='col-sm-12 mt-3'>
											<table class='table h6 text-dark' border=0>
												<tbody>
													<tr class='b-top-0'>
														<td class='text-center'>
															<div class='ib'>
																<img src='img/logo3.png' alt='OKLER Themes'  height=125 />
															</div>
														</td>
														<td class='text-center' width=500>
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
														<td class='text-right'>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</header>
								<?php 
									$no_masuk=$_GET['no_masuk'];
									$sql = "select * from barangmasuk,supplier where supplier.kode_supplier=barangmasuk.kode_supplier and barangmasuk.no_masuk='$no_masuk'";
									$query = mysqli_query($koneksi,$sql);
									$data = mysqli_fetch_array($query);
									$tanggal = $data['tgl_masuk'];
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
													<?php echo "$data[nama_supplier]";?>
												</address>
											</div>
										</div>
										<div class='col-md-4'>
											<div class='bill-to'>
												<p class='h5 mb-1 text-dark text-center font-weight-semibold'>INVOICE</p>
												<address class='text-center'>
													No : <?php echo $data['no_masuk'];?>/Bisa/07/2019
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
															<td>: 2 Lembar</td>
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
											<th id='cell-desc'   class='font-weight-semibold'>Size</th>
											<th id='cell-qty'    class='text-center font-weight-semibold'>Quantity</th>
											<th id='cell-qty'    class='text-center font-weight-semibold'>Harga</th>
											<th id='cell-total'  class='text-center font-weight-semibold'>Total</th>
										</tr>
									</thead>
									<tbody>
											<?php
												$sql2 = "select *,detailmasuk.qty*detailmasuk.harga as total from detailmasuk,barang where barang.kode_barang=detailmasuk.kode_barang and detailmasuk.no_masuk='$no_masuk'";
												$query2 = mysqli_query($koneksi,$sql2);
												$o=0;
												while ($data2 = mysqli_fetch_array($query2)) {
													$o++;
													echo "
														<tr>
															<td>$o</td>
															<td>$data2[nama_barang]</td>
															<td>$data2[size]</td>
															<td class='text-center'>$data2[qty]</td>
															<td class='text-right'>Rp. ".number_format($data2['harga'])."</td>
															<td class='text-right'>Rp. ".number_format($data2['total'])."</td>
														</tr>
													";
												}
											?>
									</tbody>
								</table>
								<div class='invoice-summary'>
									<div class='row justify-content-end'>
										<div class='col-sm-4'>
											<table class='table h6 text-dark'>
												<tbody>
													<?php
														$sql3 = "select sum(detailmasuk.qty*detailmasuk.harga) as subtotal from detailmasuk,barang where barang.kode_barang=detailmasuk.kode_barang and detailmasuk.no_masuk='$no_masuk'";
														$query3 = mysqli_query($koneksi,$sql3);
														$data3 = mysqli_fetch_array($query3) ?>
													<tr class='b-top-0'>
														<td colspan='2'>Subtotal</td>
														<td class='text-left'>Rp. <?php echo number_format($data3['subtotal']);?>, 00</td>
													</tr>
													<tr>
														<td colspan='2'>Shipping</td>
														<td class='text-left'>$0.00</td>
													</tr>
													<tr class='h4'>
														<td colspan='2'>Grand Total</td>
														<td class='text-left'>$73.00</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class='text-right mr-4'>
								<a href='#' class='btn btn-default'>Submit Invoice</a>
								<a href='pages-invoice-print.html' target='_blank' class='btn btn-primary ml-3'><i class='fas fa-print'></i> Print</a>
							</div>
						</div>
					</section>
					
					<!-- end: page -->
<?php include 'tfooter.php';?>