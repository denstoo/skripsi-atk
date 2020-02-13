<?php
	include"koneksi.php";
	$kode_merk = $_GET['merk'];

	mysqli_query($koneksi,"delete from merk where kode_merk='$kode_merk'");

	header("location:../page-barang.php?merek=hapus"); 
?>