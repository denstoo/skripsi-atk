<?php
	session_start();

	include"koneksi.php";

	$username = $_POST['username'];
	$nama = $_POST['nama'];
	$ket = $_POST['ket'];

	mysqli_query($koneksi,"update user set nama='$nama',keterangan='$ket' where username='$username'");
	header("location:../login-admin.php?ubah=sukses");
?>