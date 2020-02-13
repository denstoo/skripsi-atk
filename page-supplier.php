<?php include 'theader.php';?>
					<!-- start: page -->
					<section class="card">
						<header class="card-header">
							<div class="card-actions">
								<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
								<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
							</div>
			
							<h2 class="card-title">Data Supplier</h2>
							<p class="card-subtitle">
								Menampilkan data semua data supplier.
							</p>
							<p class="card-subtitle">
								<a class="mb-1 mt-1 mr-1 modal-with-move-anim ws-normal btn btn-default" href="#modalForm"><i class='el el-plus'></i> Supplier Baru</a>
							</p>
						</header>
						<div class="card-body">
							<?php if (isset($_GET['pesan'])=="sukses") {?>
								<div class="alert alert-success"><!-- default primary success info warning danger dark info nomargin -->
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									Penambahan data <strong>Supplier</strong> berhasil.
								</div>
							<?php } ?>
							<table class="table table-bordered table-striped mb-0" id="datatable-editable">
								<thead>
									<tr>
										<th>Kode Supplier</th>
										<th>Nama Supplier</th>
										<th width='40%'>Keterangan</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sql = "select * from supplier order by kode_supplier desc";
										$query = mysqli_query($koneksi,$sql);$no=0;
										while ($data = mysqli_fetch_array($query))
										{for ($i=0; $i < 1; $i++) {$no=$no+1; }

											echo "
												<tr data-item-id='$no'>
													<td>$data[kode_supplier]</td>
													<td>$data[nama_supplier]</td>
													<td>".nl2br(htmlspecialchars($data['keterangan_supplier']))."</td>
													<td>
														<a href='#modalLG$data[kode_supplier]' class='mb-1 mt-1 mr-1 modal-with-move-anim modal-sizes btn btn-warning'><i class='el el-pencil'></i> Ubah</a>
														<a href='#modalHeaderColorDanger$data[kode_supplier]' class='mb-1 mt-1 mr-1 modal-with-move-anim modal-basic btn btn-danger'><i class='el el-trash'></i> Hapus</a>
												</tr>

												<!-- Modal Danger -->
													<div id='modalLG$data[kode_supplier]' class='zoom-anim-dialog modal-block modal-header-color modal-block-warning mfp-hide'>
														<section class='card'>
															<form action='config/ubah-supplier.php' method='POST'>
																<header class='card-header'>
																	<h2 class='card-title'>Ubah Data Supplier</h2>
																</header>
																<div class='card-body'>
																	<div class='form-group row'>
																		<label class='col-sm-4 control-label text-sm-right pt-2' for='inputReadOnly'>Kode Supplier</label>
																		<div class='col-lg-6'>
																			<input name='kode_supplier' type='text' value='$data[kode_supplier]' id='inputReadOnly' class='form-control' readonly='readonly'>
																		</div>
																	</div>
																	<div class='form-group row'>
																		<label class='col-sm-4 control-label text-sm-right pt-2'>Nama Supplier: </label>
																		<div class='col-sm-6'>
																			<input type='text' name='nama_supplier' value='$data[nama_supplier]' class='form-control'>
																		</div>
																	</div>
																	<div class='form-group row'>
																		<label class='col-sm-4 control-label text-sm-right pt-2' for='textareaDefault'>Textarea</label>
																		<div class='col-sm-6'>
																			<textarea name='ket' class='form-control' rows='3' data-plugin-maxlength maxlength='140'>$data[keterangan_supplier]</textarea>
																			<p>
																				<code>max-length</code> set to 140.
																			</p>
																		</div>
																	</div>
																</div>
																<footer class='card-footer'>
																	<div class='row'>
																		<div class='col-md-12 text-right'>
																			<input type='submit' value='Ubah' class='btn btn-warning'>
																			<button class='btn btn-default modal-dismiss'>Cancel</button>
																		</div>
																	</div>
																</footer>
															</form>
														</section>
													</div>

												<div id='modalHeaderColorDanger$data[kode_supplier]' class='zoom-anim-dialog modal-block modal-header-color modal-block-danger mfp-hide'>
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
																	<p>Apakah $namalog ingin menghapus $data[nama_supplier]?</p>
																</div>
															</div>
														</div>
														<footer class='card-footer'>
															<div class='row'>
																<div class='col-md-12 text-right'>
																	<a href='config/hapus-supplier.php?kode_supplier=$data[kode_supplier]' class='btn btn-danger'>Ya</a>
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
								<h2 class="card-title">Tambah Data Supplier Baru</h2>
							</header>
							<form action="config/tambah-supplier.php" method='POST'>
								<div class="card-body">
										<div class="form-group row">
											<?php
											$query="select max(kode_supplier) as maxkode from supplier";
											$hasil=mysqli_query($koneksi,$query);
											$koda=mysqli_fetch_array($hasil);
											$kode_supplier=$koda['maxkode'];

											$nourut=(int) substr($kode_supplier, 3, 4);
											$nourut++;

											$char="SUP";
											$kode_supplier= $char . sprintf("%03s",$nourut);
											?>
											<input hidden name="kode_supplier" type="text" value="<?php echo "$kode_supplier";?>" id="inputReadOnly" class="form-control" readonly="readonly">
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label text-sm-right pt-2">Nama Supplier </label>
											<div class="col-sm-6">
												<input type="text" name="nama_supplier" class="form-control" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 control-label text-sm-right pt-2" for="textareaDefault">Keterangan</label>
											<div class="col-sm-6">
												<textarea name='ket' class="form-control" rows="3" data-plugin-maxlength maxlength="140"></textarea>
												<p>
													<code>Maksimal Karakter</code> sampai 140 karakter.
												</p>
											</div>
										</div>
								</div>
								<footer class="card-footer">
									<div class="row">
										<div class="col-md-12 text-right">
											<input type="submit" value="Simpan" class="btn btn-success">
											<button class="btn btn-default modal-dismiss">Batal</button>
										</div>
									</div>
								</footer>
							</form>
						</section>
					</div>
					<!-- end: page -->
<?php include 'tfooter.php';?>