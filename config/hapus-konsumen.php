<?php
include"koneksi.php";
	$kode_konsumen = $_GET['kode_konsumen'];

	$delete = "delete from konsumen where kode_konsumen='$kode_konsumen'";
	mysqli_query($koneksi,"delete from konsumen where kode_konsumen='$kode_konsumen'");

	header("location:../page-konsumen.php?hapus=sukses"); 
?>