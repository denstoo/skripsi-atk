<?php
session_start();
	include"koneksi.php";
	$kode_supplier = $_POST['kode_supplier'];
	$nama_supplier = $_POST['nama_supplier'];
	$ket = $_POST['ket'];

	mysqli_query($koneksi,"insert into supplier value ('$kode_supplier','$nama_supplier','$ket')");

	header("location:../page-supplier.php?pesan=sukses"); 
?>