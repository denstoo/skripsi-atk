<?php
include"koneksi.php";
 
	$username = $_GET['username'];
	
	mysqli_query($koneksi,"delete from user where username='$username'");

	header("location:../login-admin.php"); 
?>