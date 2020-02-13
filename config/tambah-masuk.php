<?php
	session_start();
	include"koneksi.php";
	//GET data dari Form Halaman sebelumnya
	$no_masuk = $_GET['no'];
	$tgl = $_GET['tgl'];
	$time = $_GET['time'];
	$total_masuk = $_GET['total_masuk'];
	$username = $_GET['username'];
	$kode_supplier = $_GET['kode_supplier'];
	$ket = $_GET['ket'];
//tabel barangmasuk
	$tambahbarangmasuk = "insert into barangmasuk value ('$no_masuk','$tgl','$total_masuk','$username','$kode_supplier','$ket')";
	mysqli_query($koneksi,$tambahbarangmasuk);

//tabel detailmasuk dan stok
	for ($i=1; $i <= $total_masuk ; $i++) 
	{ 	//mengambil nama, harga, dan qty
		$satu = "nama_barang".$i;
		$dua = "harga".$i;
		$tiga = "qty".$i;
		//mengambil data dengan GET
		$kode_barang = $_GET[$satu];
		$harga = $_GET[$dua];
		$qty = $_GET[$tiga];
		//size
		$sqlisi="select isi,size from barang where kode_barang='$kode_barang'";
		$queryisi=mysqli_query($koneksi,$sqlisi);
		$dataisi=mysqli_fetch_array($queryisi);
		$isi=$dataisi['isi'];$size=$dataisi['size'];
		//satuan
		$qty1=$qty*$isi;
		$harga1=$harga/$isi;
		//memasukan data ke tabel detailstok
		$tambah = "insert into detailmasuk value ('$no_masuk','$kode_barang','$harga','$qty')";
		mysqli_query($koneksi,$tambah);
		//memasukan data ke tabel stok
		$tambah2 = "insert into stokmasuk value ('$no_masuk','$tgl','$kode_supplier','$kode_barang','$harga','$harga1','$qty1','0','$qty1')";
		mysqli_query($koneksi,$tambah2);
		//memasukan data tabel kartu stok
		$tambah3 = "insert into kartustok value ('$kode_barang','$tgl','$no_masuk','1 $size/$isi Pcs','$harga','$qty','','$qty1')";
		mysqli_query($koneksi,$tambah3);
	}



	header("location:../page-barang-masuk.php?pesan=sukses"); 
?>