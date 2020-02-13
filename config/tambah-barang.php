<?php
	session_start();
	include"koneksi.php";

	$kode_barang = $_GET['kode'];
	$nama_barang = $_GET['nama'];
	$merk = $_GET['merk'];
	$size = $_GET['size'];
	$isi = $_GET['isi'];

	mysqli_query($koneksi,"insert into barang value ('$kode_barang','$nama_barang','$merk','$size','$isi')");

	header("location:../page-barang.php"); 
?>