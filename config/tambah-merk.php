<?php
	session_start();
	include"koneksi.php";

	$kode_merk = $_GET['kode'];
	$nama_merk = $_GET['nama'];

	mysqli_query($koneksi,"insert into merk value ('$kode_merk','$nama_merk')");

	header("location:../page-barang.php"); 
?>