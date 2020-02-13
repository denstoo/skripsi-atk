<?php include 'theader.php';?>
					<!-- start: page -->
					<section class="card">
						<header class="card-header">
							<div class="card-actions">
								<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
								<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
							</div>
			
							<h2 class="card-title">Barang Keluar / Penjualan Barang</h2>
							<p class="card-subtitle">
								Barang bisa dijual untuk perorangan dan bisa juga untuk perusahaan.
							</p>
							<p class="card-subtitle">
								<a class="mb-1 mt-1 mr-1 modal-with-move-anim ws-normal btn btn-default" href="#modalFormPerusahaan"><i class='el el-plus'></i> Perusahaan</a>
								<a class="mb-1 mt-1 mr-1 modal-with-move-anim ws-normal btn btn-default" href="#modalFormPerorangan"><i class='el el-plus'></i> Perorangan</a>
							</p>
						</header>
						<div class="card-body">
							<table class="table table-bordered table-striped mb-0" id="datatable-editable">
								<thead>
									<tr>
										<th>Tanggal keluar</th>
										<th width='50%'>Nama Konsumen</th>
										<th>List Barang</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sql = "select * from barangkeluar,konsumen where barangkeluar.kode_konsumen=konsumen.kode_konsumen order by tgl_keluar desc";
										$query = mysqli_query($koneksi,$sql);$no=0;
										while ($data = mysqli_fetch_array($query))
										{for ($i=0; $i < 1; $i++) {$no=$no+1; }

											echo "
												<tr data-item-id='$no'>
													<td>$data[tgl_keluar]</td>
													<td>$data[nama_konsumen]</td>
													<td>$data[total_keluar]</td>
													<td>
														<a href='surat-invoice-konsumen.php?no_keluar=$data[no_keluar]' class='mb-1 mt-1 mr-1 btn btn-info'><i class='el el-search'></i> Detail</a>
														<a href='#modalHeaderColorDanger$data[no_keluar]' class='mb-1 mt-1 mr-1 modal-with-move-anim modal-basic btn btn-danger'><i class='el el-trash'></i> Hapus</a>
												</tr>


												<!-- Modal Danger -->

												<div id='modalHeaderColorDanger$data[no_keluar]' class='modal-block zoom-anim-dialog modal-header-color modal-block-danger mfp-hide'>
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
																	<h4>Danger</h4>
																	<p>Apakah $namalog ingin menghapus $data[no_keluar]?</p>
																</div>
															</div>
														</div>
														<footer class='card-footer'>
															<div class='row'>
																<div class='col-md-12 text-right'>
																	<a href='config/hapus-keluar.php?no_keluar=$data[no_keluar]' class='btn btn-danger'>Ya</a>
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
					<?php
						$querymodal="select max(no_keluar) as maxkode from barangkeluar";
						$hasilmodal=mysqli_query($koneksi,$querymodal);
						$kode_modal_barang=mysqli_fetch_array($hasilmodal);
						$modal_barang=$kode_modal_barang['maxkode'];

						$nourutbarang=(int) substr($modal_barang, 3, 5);
						$nourutbarang++;

						$char="KLR";
						$otomatisbarang= $char . sprintf("%03s",$nourutbarang);
					?>
					<div id="modalFormPerusahaan" class="modal-block zoom-anim-dialog modal-header-color modal-block-success mfp-hide">
						<section class="card">
							<header class="card-header">
								<h2 class="card-title">Purchase Order</h2>
							</header>
							<form action="form-keluar.php" method='GET'>
								<input name="dari" type="text" value="perusahaan" hidden>
								<input name="username" type="text" value="<?php echo "$userlog";?>" hidden>
								<input name="no_keluar" type="text" value="<?php echo "$otomatisbarang";?>" hidden>
								<div class="card-body">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="inputAddress">Nama Perusahaan</label>
												<select name='kode_konsumen' data-plugin-selectTwo class="form-control populate" required>
													<option value="">Cari Perusahaan</option>
													<?php
														$sqls = "select * from konsumen where kategori_konsumen='Perusahaan'";
														$querys = mysqli_query($koneksi,$sqls);$no=0;
														while ($datas = mysqli_fetch_array($querys))
														{
															echo "<option value=$datas[kode_konsumen]>$datas[nama_konsumen]</option>";
														}
													?>
												</select>
											</div>
											<div class="form-group col-md-6 mb-3 mb-lg-0">
												<label for="inputAddress">Tanggal Delivery Order</label>
												<input name="tgl" type="date" class="form-control" required>
											</div>
										</div>
										<div class="form-group col-md-12">
											<input onkeypress="return angka(event)" name="total_keluar" type="text" class="form-control" placeholder="Ada berapa banyak daftar barang yg di jual ?" required>
										</div>
										<div class="form-group col-md-12">
											<textarea name='ket' class="form-control" rows="3" data-plugin-maxlength maxlength="140">Catatan</textarea>
											<p>
												<code>max-length</code> set to 140.
											</p>
										</div>
								</div>
								<footer class="card-footer">
									<div class="row">
										<div class="col-md-12 text-right">
											<input type="submit" value="Enter" class="btn btn-success">
											<button class="btn btn-default modal-dismiss">Batal</button>
										</div>
									</div>
								</footer>
							</form>
						</section>
					</div>
					<div id="modalFormPerorangan" class="modal-block zoom-anim-dialog modal-header-color modal-block-success mfp-hide">
						<section class="card">
							<header class="card-header">
								<h2 class="card-title">Penjualan ke Perorangan</h2>
							</header>
							<form action="form-keluar.php" method='GET'>
								<input name="dari" type="text" value="perorangan" hidden>
								<input name="username" type="text" value="<?php echo "$userlog";?>" hidden>
								<input name="no_keluar" type="text" value="<?php echo "$otomatisbarang";?>" hidden>
								<div class="card-body">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="inputAddress">Nama Konsumen</label>
												<select name='kode_konsumen' data-plugin-selectTwo class="form-control populate" required>
													<option value="">Cari Konsumen</option>
													<?php
														$sqls = "select * from konsumen where kategori_konsumen='Perorangan'";
														$querys = mysqli_query($koneksi,$sqls);$no=0;
														while ($datas = mysqli_fetch_array($querys))
														{
															echo "<option value=$datas[kode_konsumen]>$datas[nama_konsumen]</option>";
														}
													?>
												</select>
											</div>
											<div class="form-group col-md-6 mb-3 mb-lg-0">
												<label for="inputAddress">Tanggal Beli</label>
												<input name="tgl" type="date" class="form-control" required>
											</div>
										</div>
										<div class="form-group col-md-12">
											<input onkeypress="return angka(event)" name="total_keluar" type="text" class="form-control" placeholder="Ada berapa banyak daftar barang yg di jual ?" required>

										</div>
										<div class="form-group col-md-12">
											<textarea name='ket' class="form-control" rows="3" data-plugin-maxlength maxlength="140">Catatan</textarea>
											<p>
												<code>max-length</code> set to 140.
											</p>
										</div>
								</div>
								<footer class="card-footer">
									<div class="row">
										<div class="col-md-12 text-right">
											<input type="submit" value="Enter" class="btn btn-success">
											<button class="btn btn-default modal-dismiss">Batal</button>
										</div>
									</div>
								</footer>
							</form>
						</section>
					</div>
<?php include 'tfooter.php';?>