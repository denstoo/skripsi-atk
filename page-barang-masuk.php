<?php include 'theader.php';?>
					<!-- start: page -->
					<section class="card">
						<header class="card-header">
							<div class="card-actions">
								<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
								<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
							</div>
							<h2 class="card-title">Barang Masuk</h2>
							<p class="card-subtitle">
								Masuk Kode supplier dengan awalan "S" dan Nomor (contoh "S001").
							</p>
							<p class="card-subtitle">
								<a class="mb-1 mt-1 mr-1 modal-with-move-anim ws-normal btn btn-default" href="#modalForm"><i class='el el-plus'></i> Delivery Order</a>
								<!-- <a href="all.php"><i class='el el-plus'></i> Hapus ALl</a> -->
							</p>
						</header>
						<div class="card-body">
							<a href="all.php">Hapus All Data</a>
							<table class="table table-bordered table-striped mb-0" id="datatable-editable">
								<thead>
									<tr>
										<th>Tanggal Masuk</th>
										<th width='50%'>Nama Supplier</th>
										<th>List Barang</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if ($lvl==1) {
											$sql = "select * from barangmasuk,supplier where barangmasuk.kode_supplier=supplier.kode_supplier";
											$query = mysqli_query($koneksi,$sql);
										}else{
											$sql = "select * from barangmasuk,supplier where barangmasuk.kode_supplier=supplier.kode_supplier";
											$query = mysqli_query($koneksi,$sql);
										}$no=0;
										while ($data = mysqli_fetch_array($query))
										{for ($i=0; $i < 1; $i++) {$no=$no+1; }

											echo "
												<tr data-item-id='$no'>
													<td>$data[tgl_masuk]</td>
													<td>$data[nama_supplier]</td>
													<td>$data[total_masuk]</td>
													<td>
														<a href='surat-invoice-supplier.php?no_masuk=$data[no_masuk]' class='mb-1 mt-1 mr-1 btn btn-info'><i class='el el-search'></i> Detail</a>
														<a href='#modalHeaderColorDanger$data[no_masuk]' class='mb-1 mt-1 mr-1 modal-with-move-anim modal-basic btn btn-danger'><i class='el el-trash'></i> Hapus</a>
												</tr>


												<!-- Modal Danger -->

												<div id='modalHeaderColorDanger$data[no_masuk]' class='modal-block zoom-anim-dialog modal-header-color modal-block-danger mfp-hide'>
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
																	<p>Apakah $namalog ingin menghapus $data[no_masuk]?</p>
																</div>
															</div>
														</div>
														<footer class='card-footer'>
															<div class='row'>
																<div class='col-md-12 text-right'>
																	<a href='config/hapus-masuk.php?no_masuk=$data[no_masuk]' class='btn btn-danger'>Ya</a>
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
						$querymodal="select max(no_masuk) as maxkode from barangmasuk";
						$hasilmodal=mysqli_query($koneksi,$querymodal);
						$kode_modal_barang=mysqli_fetch_array($hasilmodal);
						$modal_barang=$kode_modal_barang['maxkode'];

						$nourutbarang=(int) substr($modal_barang, 3, 5);
						$nourutbarang++;

						$char="MSK";
						$otomatisbarang= $char . sprintf("%03s",$nourutbarang);
					?>
					<div id="modalForm" class="modal-block modal-header-color zoom-anim-dialog modal-block-success mfp-hide">
						<section class="card">
							<header class="card-header">
								<h2 class="card-title">Delivery Order</h2>
							</header>
							<form action="form-masuk.php" method='GET'>
							<input name="username" type="text" value="<?php echo "$userlog";?>" hidden>
							<input name="no_masuk" type="text" value="<?php echo "$otomatisbarang";?>" hidden>
								<div class="card-body">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="inputAddress">Nama Supllier</label>
												<select name='kode_supplier' data-plugin-selectTwo class="form-control populate" required>
													<option value="">Pilih Supplier</option>
													<?php
														$sqls = "select * from supplier";
														$querys = mysqli_query($koneksi,$sqls);$no=0;
														while ($datas = mysqli_fetch_array($querys))
														{
															echo "<option value=$datas[kode_supplier]>$datas[nama_supplier]</option>";
														}
													?>
												</select>
											</div>
											<div class="form-group col-md-6 mb-3 mb-lg-0">
												<label for="inputAddress">Tanggal Delivery Order</label>
												<input name="tgl" type="date" class="form-control" value="<php $now=date() ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label text-sm-right pt-2">Banyak Barang</label>
											<div class="col-sm-6">
												<input type="text" onkeypress="return angka(event)" name="total_masuk" class="form-control" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label text-sm-right pt-2">Keterangan</label>
											<div class="col-sm-6">
												<textarea name='ket' class="form-control" rows="3" data-plugin-maxlength maxlength="140"></textarea>
												<p>
													<code>max-length</code> set to 140.
												</p>
											</div>
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