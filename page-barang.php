<?php include 'theader.php';?>
					<!-- start: page -->
					<section class="card">
						<header class="card-header">
							<div class="card-actions">
								<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
								<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
							</div>
			
							<h2 class="card-title">Data Barang</h2>
							<p class="card-subtitle">
								Menampilkan semua data barang baik perorangan maupun perusahaan (badan usaha).
							</p>
							<p class="card-subtitle">
								<a class="mb-1 mt-1 mr-1 modal-with-move-anim ws-normal btn btn-default" href="#modalForm"><i class='el el-plus'></i> Barang Baru</a>
								<a class="mb-1 mt-1 mr-1 modal-with-move-anim ws-normal btn btn-default" href="#modalForm2"><i class='el el-plus'></i> Merk Baru</a>
								<a class="mb-1 mt-1 mr-1 modal-with-move-anim ws-normal btn btn-default" href="#modalForm3"><i class='el el-minus'></i> Hapus Merk</a>
							</p>
						</header>
						<div class="card-body">
							<table class="table table-bordered table-striped mb-0" id="datatable-editable">
								<thead>
									<tr>
										<th>Barang</th>
										<th>HPP</th>
										<th>Harga Jual (Up to 35%)</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sql = "select * from barang,merk where barang.kode_merk=merk.kode_merk";
										$query = mysqli_query($koneksi,$sql);$no=0;
										while ($data = mysqli_fetch_array($query))
										{for ($i=0; $i < 1; $i++) {$no=$no+1; }
											$sqlstok = "select sum(sisa) as total from stokmasuk where kode_barang='$data[kode_barang]'";
											$querystok = mysqli_query($koneksi,$sqlstok);$no=0;
											$datastok = mysqli_fetch_array($querystok);
											?>
											<tr data-item-id='$no'>
												<td>
													<b><?php echo $data['nama_barang'] ?></b><br>
													1 <?php echo $data['size'] ?> = <?php echo $data['isi'] ?> Pcs<br>
													<b><?php echo $data['nama_merk'] ?></b>
												</td>
												<td>
													<?php
														$sqlstok2 = "select * from stokmasuk where kode_barang='$data[kode_barang]' order by tgl_masuk asc";
														$querystok2 = mysqli_query($koneksi,$sqlstok2);
														while ($datastok2 = mysqli_fetch_array($querystok2)){
															$sisa=$datastok2['sisa']/$data['isi'];//Stok : $sisa --(HPP : $datastok2[do])<br>
															echo "<b>Rp. ".number_format($datastok2['do'])." / $data[size] ($sisa)</b><br>";
															if ($data['size']!=='Pcs') {
																echo "Rp. ".number_format($datastok2['do_pcs'])." / Pcs ($datastok2[sisa])<br>";
															}
																
													}?>
												</td>
												<td>
													<?php
														$sqlstok3 = "select * from stokmasuk where kode_barang='$data[kode_barang]' order by tgl_masuk asc";
														$querystok3 = mysqli_query($koneksi,$sqlstok3);
														while ($datastok3 = mysqli_fetch_array($querystok3)){
															$jual=$datastok3['do']/100*40;$jual_pcs=$datastok3['do_pcs']/100*40;
															$jual=$datastok3['do']+$jual;$jual_pcs=$datastok3['do_pcs']+$jual_pcs;
															echo "<b>Rp. ".number_format($jual)." / $data[size]</b><br>";
															if ($data['size']!=='Pcs') {
																echo "Rp. ".number_format($jual_pcs)." / Pcs<br>";
															}
																
													}?>
												</td>
												<td>
													<a href='#modalLG<?php echo $data['kode_barang'] ?>' class='mb-1 mt-1 modal-with-move-anim mr-1 modal-sizes btn btn-warning'><i class='el el-pencil'></i> Ubah</a>
													<a href='#modalHeaderColorDanger<?php echo $data['kode_barang'] ?>' class='mb-1 mt-1 mr-1 modal-with-move-anim modal-basic btn btn-danger'><i class='el el-trash'></i> Hapus</a>
												</td>
											</tr>

											<!-- Modal ubah -->
												<div id='modalLG<?php echo $data['kode_barang'] ?>' class='modal-block zoom-anim-dialog modal-header-color modal-block-warning mfp-hide'>
													<section class='card'>
														<form action='config/ubah-barang.php' method='POST'>
															<header class='card-header'>
																<h2 class='card-title'>Ubah Data barang</h2>
															</header>
															<div class='card-body'>
																<div class="form-group row">
																	<label class="col-sm-4 control-label text-sm-right pt-2" for="inputReadOnly">Kode Barang</label>
																	<div class="col-lg-6">
																		<input name="kode" type="text" value="<?php echo $data['kode_barang'] ?>" id="inputReadOnly" class="form-control" readonly="readonly">
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-4 control-label text-sm-right pt-2">Nama barang </label>
																	<div class="col-sm-6">
																		<input type="text" name="nama" value="<?php echo $data['nama_barang'] ?>" class="form-control" required>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-4 control-label text-sm-right pt-2">Nama Merk </label>
																	<div class="col-sm-6">
																		<select name='merk' data-plugin-selectTwo class="form-control populate" required>
																			<option value="<?php echo $data['kode_merk'] ?>"><?php echo $data['nama_merk'] ?></option>
																			<?php
																				$sqls = "select * from merk";
																				$querys = mysqli_query($koneksi,$sqls);$no=0;
																				while ($datas = mysqli_fetch_array($querys))
																				{
																					echo "<option value=$datas[kode_merk]>$datas[nama_merk]</option>";
																				}
																			?>
																		</select>
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

											<div id='modalHeaderColorDanger<?php echo $data['kode_barang'] ?>' class='modal-block zoom-anim-dialog modal-header-color modal-block-danger mfp-hide'>
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
																<p><?php echo "Apakah $namalog ingin menghapus $data[nama_barang]?"; ?></p>
															</div>
														</div>
													</div>
													<footer class='card-footer'>
														<div class='row'>
															<div class='col-md-12 text-right'>
																<a href='config/hapus-barang.php?kode_barang=<?php echo $data['kode_barang'] ?>' class='btn btn-danger'>Ya</a>
																<button class='btn btn-default modal-dismiss'>Cancel</button>
															</div>
														</div>
													</footer>
												</section>
											</div>
									<?php	
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
					<div id="modalForm" class="modal-block zoom-anim-dialog modal-header-color modal-block-success mfp-hide">
						<section class="card">
							<header class="card-header">
								<h2 class="card-title">Tambah Data Barang Baru</h2>
							</header>
							<form action="config/tambah-barang.php" method='GET'>
								<div class="card-body">
									<?php
									$query="select max(kode_barang) as maxkode from barang";
									$hasil=mysqli_query($koneksi,$query);
									$koda=mysqli_fetch_array($hasil);
									$kode_supplier=$koda['maxkode'];

									$nourut=(int) substr($kode_supplier, 3, 4);
									$nourut++;

									$char="BRG";
									$kode_supplier= $char . sprintf("%03s",$nourut);
									?>
									<input hidden name="kode" type="text" value="<?php echo "$kode_supplier";?>">
									<div class="form-group row">
										<label class="col-sm-4 control-label text-sm-right pt-2">Nama barang </label>
										<div class="col-sm-6">
											<input type="text" name="nama" class="form-control" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 control-label text-sm-right pt-2">Nama Merk </label>
										<div class="col-sm-6">
											<select name='merk' data-plugin-selectTwo class='form-control populate' required>
												<option value="">Pilih Merk</option>
												<?php
													$sqls = "select * from merk";
													$querys = mysqli_query($koneksi,$sqls);
													while ($datas = mysqli_fetch_array($querys))
													{
														echo "<option value='$datas[kode_merk]'>$datas[nama_merk]</option>";
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 control-label text-sm-right pt-2">Size</label>
										<div class="col-sm-6">
											<select name='size' data-plugin-selectTwo class="form-control populate" required>
												<option value="">Pilih Size</option>
												<option value="Pcs">Pcs</option>
												<option value="Botol">Botol</option>
												<option value="Box">Box</option>
												<option value="Buku">Buku</option>
												<option value="Dozz">Dozz</option>
												<option value="Dus">Dus</option>
												<option value="Gross">Gross</option>
												<option value="Karton">Karton</option>
												<option value="Lembar">Lembar</option>
												<option value="Lusin">Lusin</option>
												<option value="Pack">Pack</option>
												<option value="Rim">Rim</option>
												<option value="Roll">Roll</option>
												<option value="Set">Set</option>
												<option value="Slop">Slop</option>
												<option value="Tube">Tube</option>
												<option value="Unit">Unit</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 control-label text-sm-right pt-2" required>Isi</label>
										<div class="col-sm-6">
											<input type="text" onkeypress="return angka(event)" name="isi" class="form-control" required>
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
					<div id="modalForm2" class="modal-block zoom-anim-dialog modal-header-color modal-block-success mfp-hide">
						<section class="card">
							<header class="card-header">
								<h2 class="card-title">Tambah Data Merk Baru</h2>
							</header>
							<form action="config/tambah-merk.php" method='GET'>
								<div class="card-body">
												<?php
												$query="select max(kode_merk) as maxkode from merk";
												$hasil=mysqli_query($koneksi,$query);
												$koda=mysqli_fetch_array($hasil);
												$kode_supplier=$koda['maxkode'];

												$nourut=(int) substr($kode_supplier, 3, 4);
												$nourut++;

												$char="MRK";
												$kode_supplier= $char . sprintf("%03s",$nourut);
												?>
												<input hidden name="kode" type="text" value="<?php echo "$kode_supplier";?>">
										<div class="form-group row">
											<label class="col-sm-4 control-label text-sm-right pt-2">Nama Merk </label>
											<div class="col-sm-6">
												<input type="text" name="nama" class="form-control" required>
											</div>
										</div>
									</div>
								<footer class="card-footer">
									<div class="row">
										<div class="col-md-12 text-center">
											<input type="submit" value="Buat" class="btn btn-success">
											<button class="btn btn-default modal-dismiss">Cancel</button>
										</div>
									</div>
								</footer>
							</form>
						</section>
					</div>
					<div id="modalForm3" class="modal-block zoom-anim-dialog modal-header-color modal-block-success mfp-hide">
						<section class="card">
							<header class="card-header">
								<h2 class="card-title">Hapus Merk</h2>
							</header>
							<form action="config/hapus-merk.php" method='GET'>
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-4 control-label text-sm-right pt-2">Nama Merk </label>
										<div class="col-sm-6">
											<select name='merk' data-plugin-selectTwo class="form-control populate" required>
												<option value="">Pilih Merk</option>
												<?php
													$sqls = "select * from merk";
													$querys = mysqli_query($koneksi,$sqls);$no=0;
													while ($datas = mysqli_fetch_array($querys))
													{
														echo "<option value=$datas[kode_merk]>$datas[nama_merk]</option>";
													}
												?>
											</select>
										</div>
									</div>
								</div>
								<footer class="card-footer">
									<div class="row">
										<div class="col-md-12 text-center">
											<input type="submit" value="Hapus" class="btn btn-success">
											<button class="btn btn-default modal-dismiss">Batal</button>
										</div>
									</div>
								</footer>
							</form>
						</section>
					</div>
					<!-- end: page -->
<?php include 'tfooter.php';?>

