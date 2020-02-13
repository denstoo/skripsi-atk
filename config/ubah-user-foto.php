<?php
	session_start();

	include"koneksi.php";
	$username = $_POST['username'];
	$foto=$_FILES['foto']['name'];

	$u=mysqli_query($koneksi,"select * from user where username='$username'");
	$us=mysqli_fetch_array($u);
	if(file_exists("../img/user/".$us['gambar'])){
		unlink("../img/user/".$us['gambar']);
		move_uploaded_file($_FILES['foto']['tmp_name'], "../img/user/".$_FILES['foto']['name']);
		mysqli_query($koneksi,"update user set gambar='$foto' where username='$username'");
		header("location:../login-admin.php?ubah=sukses");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], "../img/user/".$_FILES['foto']['name']);
		mysqli_query($koneksi,"update user set gambar='$foto' where username='$username'");
		header("location:../login-admin.php?ubah=sukses");
	}
?>