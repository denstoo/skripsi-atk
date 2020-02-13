<?php
	include"koneksi.php";

	$kode_barang = $_GET['kode_barang'];

	mysqli_query($koneksi,"delete from barang where kode_barang='$kode_barang'");

	header("location:../page-barang.php"); 
?>