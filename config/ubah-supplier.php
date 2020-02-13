<?php
session_start();
	include"koneksi.php";
	$kode_supplier = $_POST['kode_supplier'];
	$nama_supplier = $_POST['nama_supplier'];
	$ket = $_POST['ket'];

	mysqli_query($koneksi,"update supplier set nama_supplier='$nama_supplier', keterangan_supplier='$ket' where kode_supplier='$kode_supplier'");

	header("location:../page-supplier.php?ubah=sukses"); 
?>