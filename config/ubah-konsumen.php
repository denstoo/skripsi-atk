<?php
session_start();
	include"koneksi.php";
	$kode = $_POST['kode'];
	$nama = $_POST['nama'];
	$ket = $_POST['ket'];

	mysqli_query($koneksi,"update konsumen set nama_konsumen='$nama', keterangan_konsumen='$ket' where kode_konsumen='$kode'");

	header("location:../page-konsumen.php?ubah=sukses"); 
?>