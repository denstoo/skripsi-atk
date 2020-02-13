<?php
session_start();

	mysql_connect("localhost","root","");
	mysql_select_db("atk");

	$username = $_POST['username'];
	$nama = $_POST['nama'];
	$foto=$_FILES['foto']['name'];
	$password = $_POST['password'];
	$ket = $_POST['ket'];
	$pwd=md5($password);

	if ($foto=="") {
			mysql_query("update user set nama='$nama',keterangan='$ket' where username='$username'");
			header("location:../page-user.php?pesan=tampapoto");
	}else{
		$u=mysql_query("select * from user where username='$username'");
		$us=mysql_fetch_array($u);
		if(file_exists("../img/user/".$us['gambar'])){
			unlink("../img/user/".$us['gambar']);
			move_uploaded_file($_FILES['foto']['tmp_name'], "../img/user/".$_FILES['foto']['name']);
			mysql_query("update user set gambar='$foto' where username='$username'");
			mysql_query("update user set nama='$nama',keterangan='$ket' where username='$username'");
			header("location:../page-user.php?pesan=$password");
		}else{
			move_uploaded_file($_FILES['foto']['tmp_name'], "../img/user/".$_FILES['foto']['name']);
			mysql_query("update user set gambar='$foto' where username='$username'");
			header("location:../page-user.php?pesan=ubah?ubah=sukses");
		} 
	}
	
?>