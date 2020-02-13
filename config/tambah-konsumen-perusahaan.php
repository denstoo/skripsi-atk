<?php
session_start();
	$koneksi = mysql_connect("localhost","root","");
	mysql_select_db("atk",$koneksi);

	$kode_konsumen = $_GET['kode_konsumen'];
	$nama_konsumen = $_GET['nama_konsumen'];
	$ket = $_GET['ket'];

	$tambah = "insert into konsumen value ('$kode_konsumen','$nama_konsumen','Perusahaan','$ket')";
	mysql_query($tambah,$koneksi);

	header("location:../page-konsumen.php?pesan=sukses"); 
?>