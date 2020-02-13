<?php include 'theader.php';?>

					<!-- start: page -->
					<div class="row">
						<section class="card mt-4">
							<header class="card-header bg-white">
								<center>
								<h3 class="mt-0 font-weight-semibold mt-0 text-center"><?php echo $namalog ?></h3><hr>
									<img src="img/user/<?php echo $gambar ?>" width="50%">
								</center>
							</header>
							<div class="card-body">
								<h4 class="mt-0 font-weight-semibold mt-0 text-left">Keterangan</h4>
								<p class="text-justify"><?php echo nl2br(htmlspecialchars($keteranganlog)) ?></p>
								
							</div>
						</section>
					</div>
					<!-- end: page -->
<?php include 'tfooter.php';?>