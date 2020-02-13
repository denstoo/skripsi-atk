<?php

session_start();
$koneksi = mysql_connect("localhost","root","");
mysql_select_db("atk",$koneksi);

$kodelog=$_SESSION['username'];
$no_keluar = $_GET['no'];
$tglnow = $_GET['tgl'];
$time = $_GET['time'];
$total_keluar = $_GET['total_keluar'];
$username = $_GET['username'];
$kode_konsumen = $_GET['kode_konsumen'];
$ket = $_GET['ket'];

$tambahbarangkeluar = "insert into barangkeluar value ('$no_keluar','$tglnow','$total_keluar','$username','$kode_konsumen','$ket')";
mysql_query($tambahbarangkeluar,$koneksi);

for ($i=1; $i <= $total_keluar ; $i++) 
{ 
	$satu = "nama_barang".$i;
	$dua = "harga".$i;
	$tiga = "qty".$i;

	$kode_barang = $_GET[$satu];
	$harga = $_GET[$dua];
	$qty = $_GET[$tiga];
	$totalkeluar=$harga*$qty;

	$sqlstok="select sum(masuk) as total from stokmasuk where kode_barang='$kode_barang'";
	$querystok=mysql_query($sqlstok,$koneksi);
	$datastok=mysql_fetch_array($querystok);
	$stokall=$datastok['total'];

	if ($qty<=$stokall) {
		$delstok = "insert into detailkeluar value ('$no_keluar','$kode_barang','$qty','$harga','$totalkeluar')";
		mysql_query($delstok,$koneksi);

		$sql="select * from stokmasuk where kode_barang='$kode_barang' order by tgl_masuk asc";
		$query=mysql_query($sql,$koneksi);
		while ($row= mysql_fetch_array($query)) {

			$stok=$row['sisa'];
			$tgl=$row['tgl_masuk'];
			$do=$row['do'];
			
			if ($qty > 0) {
				$temp=$qty;
				$qty=$qty-$stok;

				if ($qty > 0) {
					$stokupdate=0;
				}else{	
					$stokupdate=$stok-$temp;
				}

				$modal=$stokupdate*$do;
				$totalkeluardo=$do*$temp; $laba=$totalkeluar-$totalkeluardo;

				$stokmasuk = "insert into stokkeluar value ('$no_keluar','$tglnow','$kode_konsumen','$kode_barang','$do','$harga','$temp','$totalkeluar','$laba')";
				mysql_query($stokmasuk,$koneksi);

				$delstok = "delete from stokmasuk where sisa=0";
				mysql_query($delstok,$koneksi);

				$updatestok = "update stokmasuk set sisa='$stokupdate',terjual='$temp' where kode_barang='$kode_barang' and tgl_masuk='$tgl'";
				mysql_query($updatestok,$koneksi);

				$tambah3 = "insert into kartustok value ('$kode_barang','$tglnow','Penjualan','$temp','$harga')";
				mysql_query($tambah3,$koneksi);
			}
		}
		header("location:../page-barang-keluar.php?pesan=sukses");
	}else{
		header("location:../page-barang-keluar.php?pesan=stokbarangtidakcukup"); 
	}
}
?>