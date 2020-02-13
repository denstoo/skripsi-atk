<?php
	session_start();
	$koneksi = mysql_connect("localhost","root","");
	mysql_select_db("atk",$koneksi);

	$total_masuk = $_GET['total_masuk'];
	$no=$_GET['no_masuk'];
	$nostok1="select sum(nomasuk) from stokmasuk";
	$nostok2=mysql_query($nostok1,$koneksi);
	$nostok=mysql_fetch_array($nostok2);
	$nomasuk=$nostok['nomasuk']+1;

	for ($i=1; $i <= $total_masuk ; $i++) 
	{ 
		$satu = "nama_barang".$i;
		$dua = "harga".$i;
		$tiga = "qty".$i;

		$nama_barang = $_GET[$satu];
		$harga = $_GET[$dua];
		$qty = $_GET[$tiga];

		$tambah = "insert into detailmasuk value ('$no','$nama_barang','$harga','$qty')";
		mysql_query($tambah,$koneksi);
		$tambah2 = "insert into stokmasuk value ('$nomasuk','$nama_barang','$harga','$qty')";
		mysql_query($tambah2,$koneksi);
	}

	header("location:../page-barang-masuk.php?no=$no_masuk&total_masuk=$total_masuk"); 
?>