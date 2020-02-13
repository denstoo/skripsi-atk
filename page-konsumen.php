<?php include 'theader.php';?>
					<!-- start: page -->
					<section class="card">
						<header class="card-header">
							<div class="card-actions">
								<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
								<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
							</div>
			
							<h2 class="card-title">Data Konsumen</h2>
							<p class="card-subtitle">
								Menampilkan semua data konsumen baik perorangan maupun perusahaan (badan usaha).
							</p>
							<p class="card-subtitle">
								<a class="mb-1 mt-1 mr-1 modal-with-move-anim ws-normal btn btn-default" href="#modalForm"><i class='el el-plus'></i> Konsumen Baru</a>
							</p>
						</header>
						<div class="card-body">
							<?php if (isset($_GET['pesan'])=="sukses") {?>
								<div class="alert alert-success"><!-- default primary success info warning danger dark info nomargin -->
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									Penambahan data <strong>Konsumen</strong> berhasil.
								</div>
							<?php }elseif (isset($_GET['ubah'])=="sukses") { ?>
								<div class="alert alert-success"><!-- default primary success info warning danger dark info nomargin -->
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									Perubahan data <strong>Konsumen</strong> berhasil.
								</div>
							<?php }elseif (isset($_GET['hapus'])=="sukses") { ?>
								<div class="alert alert-success"><!-- default primary success info warning danger dark info nomargin -->
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									Penghapusan data <strong>Konsumen</strong> berhasil.
								</div>
							<?php } ?>
							<table class="table table-bordered table-striped mb-0" id="datatable-editable">
								<thead>
									<tr>
										<th>Kode Konsumen</th>
										<th>Nama Konsumen</th>
										<th width='40%'>Keterangan</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sql = "select * from konsumen order by nama_konsumen asc";
										$query = mysqli_query($koneksi,$sql);$no=0;
										while ($data = mysqli_fetch_array($query))
										{for ($i=0; $i < 1; $i++) {$no=$no+1; }
											if ($data['kategori_konsumen']=='Perusahaan') {$perusahaan="checked='checked'"; $perorangan=""; }elseif ($data['kategori_konsumen']=="Perorangan") {$perusahaan=""; $perorangan="checked='checked'"; }
											echo "
												<tr data-item-id='$no'>
													<td>$data[kode_konsumen]</td>
													<td><b>$data[nama_konsumen]</b><br>$data[kategori_konsumen]</td>
													<td>".nl2br(htmlspecialchars($data['keterangan_konsumen']))."</td>
													<td>
														<a href='#modalLG$data[kode_konsumen]' class='mb-1 mt-1 mr-1 modal-with-move-anim ws-normal btn btn-warning'><i class='el el-pencil'></i> Ubah</a>
														<a href='#modalHeaderColorDanger$data[kode_konsumen]' class='mb-1 mt-1 mr-1 modal-with-move-anim ws-normal btn btn-danger'><i class='el el-trash'></i> Hapus</a>
												</tr>

												<!-- Modal Danger -->
													<div id='modalLG$data[kode_konsumen]' class='zoom-anim-dialog modal-block modal-header-color modal-block-warning mfp-hide'>
														<section class='card'>
															<form action='config/ubah-konsumen.php' method='POST'>
																<header class='card-header'>
																	<h2 class='card-title'>Ubah Data konsumen</h2>
																</header>
																<div class='card-body'>
																	<input hidden name='kode' type='text' value='$data[kode_konsumen]' id='inputReadOnly' class='form-control' readonly='readonly'>
																	<div class='form-group row'>
																		<label class='col-sm-4 control-label text-sm-right pt-2'>Nama konsumen </label>
																		<div class='col-sm-6'>
																			<input type='text' name='nama' value='$data[nama_konsumen]' class='form-control'>
																		</div>
																	</div>
																	<div class='form-group row'>
																		<label class='col-sm-4 control-label text-sm-right pt-2' for='textareaDefault'>Keterangan</label>
																		<div class='col-sm-8'>
																			<textarea name='ket' class='form-control' rows='3' data-plugin-maxlength maxlength='140'>$data[keterangan_konsumen]</textarea>
																			<p>
																				<code>Maksimal Karakter</code> sampai 140 karakter.
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

												<div id='modalHeaderColorDanger$data[kode_konsumen]' class='zoom-anim-dialog modal-block modal-header-color modal-block-danger mfp-hide'>
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
																	<p>Apakah $namalog ingin menghapus $data[nama_konsumen]?</p>
																</div>
															</div>
														</div>
														<footer class='card-footer'>
															<div class='row'>
																<div class='col-md-12 text-right'>
																	<a href='config/hapus-konsumen.php?kode_konsumen=$data[kode_konsumen]' class='btn btn-danger'>Ya</a>
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
								<h2 class="card-title">Tambah Data Konsumen Baru</h2>
							</header>
							<form action="config/tambah-konsumen.php" method='GET'>
								<div class="card-body">
									<?php
									$query="select max(kode_konsumen) as maxkode from konsumen";
									$hasil=mysqli_query($query,$koneksi);
									$koda=mysqli_fetch_array($hasil);
									$kode_supplier=$koda['maxkode'];

									$nourut=(int) substr($kode_supplier, 3, 4);
									$nourut++;

									$char="KSN";
									$kode_supplier= $char . sprintf("%03s",$nourut);
									?>
									<input hidden name="kode_konsumen" type="text" value="<?php echo "$kode_supplier";?>" id="inputReadOnly" class="form-control" readonly="readonly">
									<div class="form-group row">
										<label class="col-sm-4 control-label text-sm-right pt-2">Nama</label>
										<div class="col-sm-6">
											<input type="text" name="nama_konsumen" class="form-control" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 control-label text-sm-right pt-2">Kategori</label>
										<div class="col-sm-8">
											<div class="radio">
												<label>
													<input type="radio" name="kategori" id="optionsRadios1" value="Perusahaan" required>
													Perusahaan
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" name="kategori" id="optionsRadios2" value="Perorangan" required>
													Perorangan
												</label>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 control-label text-sm-right pt-2" for="textareaDefault">Keterangan</label>
										<div class="col-sm-8">
											<textarea name='ket' class="form-control" rows="3" data-plugin-maxlength maxlength="140"></textarea>
											<p>
												<code>Maksimal Karakter</code> sampai 140 karakter.
											</p>
										</div>
									</div>
								</div>
								<footer class="card-footer">
									<div class="row">
										<div class="col-md-12 text-center">
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