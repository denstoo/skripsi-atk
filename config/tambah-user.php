<?php
session_start();

	include "koneksi.php";


	$username = $_POST['username'];
	$password = $_POST['password'];
	$nama = $_POST['nama'];
	$level = $_POST['level'];
	$foto=$_FILES['foto']['name'];
	$ket = $_POST['ket'];
	$pwd=md5($password);


	move_uploaded_file($_FILES['foto']['tmp_name'], "../img/user/".$_FILES['foto']['name']);
	mysqli_query($koneksi,"insert into user value('$username','$pwd','$nama','$level','$foto','$ket')");
	header("location:../login-admin.php"); 

?>