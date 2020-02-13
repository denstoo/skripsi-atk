<?php
	include"koneksi.php"; 
	$no_masuk = $_GET['no_masuk'];

	$delete1 = "delete from barangmasuk where no_masuk='$no_masuk'";
	mysqli_query($koneksi,$delete1);
	$delete2 = "delete from detailmasuk where no_masuk='$no_masuk'";
	mysqli_query($koneksi,$delete2);
	$delete3 = "delete from nomasuk where no_masuk='$no_masuk'";
	mysqli_query($koneksi,$delete3);



	header("location:../page-barang-masuk.php"); 
?>