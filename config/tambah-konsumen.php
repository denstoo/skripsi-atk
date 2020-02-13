<?php
session_start();
	$koneksi = mysql_connect("localhost","root","");
	mysql_select_db("atk",$koneksi);

	$kode_konsumen = $_GET['kode_konsumen'];
	$nama_konsumen = $_GET['nama_konsumen'];
	$kategori_konsumen = $_GET['kategori'];
	$ket = $_GET['ket'];

	$tambah = "insert into konsumen value ('$kode_konsumen','$nama_konsumen','$kategori_konsumen','$ket')";
	mysql_query($tambah,$koneksi);

	header("location:../page-konsumen.php?pesan=sukses"); 
?>