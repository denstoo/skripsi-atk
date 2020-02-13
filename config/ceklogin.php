<?php
session_start();
	include"koneksi.php";
	$username = $_POST['username'];
	$pwd = $_POST['pwd'];
	$pas=md5($pwd);

	$query=mysqli_query($koneksi,"select * from user where username='$username' and password='$pas'")or die(mysqli_error());
	if(mysqli_num_rows($query)==1){
		$_SESSION['username']=$username;
		$sql="select*from user where username='$username' and password='$pas'";
		$query=mysqli_query($koneksi,$sql);
		$data=mysqli_fetch_array($query);
		$level=$data['level'];
		if ($level==1) {
			header("location:../login-admin.php");
		}elseif ($level==2) {
			header("location:../page-dashboard.php?pesan=login");
		}else{
			header("location:../page-signin.php");
		}
	}else{
		header("location:../page-signin.php?pesan=gagal")or die(mysqli_error());
		// mysqli_error();
	}
?>