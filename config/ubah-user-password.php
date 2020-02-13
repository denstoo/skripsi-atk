<?php
	session_start();

	include"koneksi.php";
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	$pwd=md5($pass);
	$pwd2=md5($pass1);

	$query=mysqli_query($koneksi,"select * from user where username='$username' and password='$pwd'")or die(mysqli_error());
	if(mysqli_num_rows($query)==1){
		if ($pass1==$pass2) {
			mysqli_query($koneksi,"update user set password='$pwd2' where username='$username'");
			header("location:../login-admin.php?ubah=sukses");
		}else{
		header("location:../login-admin.php?pass=<strong>Password baru</strong> anda tidak sesuai");
		}
		
	}else{
		header("location:../login-admin.php?pass=<strong>Username</strong> atau <strong>Password</strong> anda tidak sesuai");
	}
?>