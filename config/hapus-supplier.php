<?php
include"koneksi.php";
	$kode_supplier = $_GET['kode_supplier'];

	mysqli_query($koneksi,"delete from supplier where kode_supplier='$kode_supplier'");

	header("location:../page-supplier.php"); 
?>