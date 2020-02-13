<?php
session_start();
	include"koneksi.php";

	$kode = $_POST['kode'];
	$nama = $_POST['nama'];
	$merk = $_POST['merk'];

	mysqli_query($koneksi,"update barang set nama_barang='$nama', kode_merk='$merk' where kode_barang='$kode'");

	header("location:../page-barang.php?ubah=sukses"); 
?>