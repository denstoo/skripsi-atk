<?php
	session_start();
	include"koneksi.php";
	//GET
	//localhost/atk/config/tambah-keluar.php?no=KLR006&tgl=2019-07-18&time=23%3A13%3A27&total_keluar=1&email=&kode_konsumen=KSN002&nama_barang1=BRG002&harga1=500&qty1=20
	$kodelog=$_SESSION['username'];
	$no_keluar = $_GET['no'];
	$tglnow = $_GET['tgl'];
	$time = $_GET['time'];
	$total_keluar = $_GET['total_keluar'];
	$username = $_GET['username'];
	$kode_konsumen = $_GET['kode_konsumen'];
	$ket = $_GET['ket'];

//tabel barangkeluar
	$tambahbarangkeluar = "insert into barangkeluar value ('$no_keluar','$tglnow','$total_keluar','$username','$kode_konsumen','$ket')";
	mysqli_query($koneksi,$tambahbarangkeluar);

//tabel detailkeluar dan stok
	for ($i=1; $i <= $total_keluar ; $i++) 
	{ 
		$satu = "nama_barang".$i;
		$dua = "harga".$i;
		$tiga = "qty".$i;

		$kode_barang = $_GET[$satu];
		$harga = $_GET[$dua];
		$qty = $_GET[$tiga];//$qtyawal=$qty;
		$totalkeluar=$harga*$qty;
		//mencari jumlah total stok barang
		$sqlqty="select isi,size from barang where kode_barang='$kode_barang'";
		$queryqty=mysqli_query($koneksi,$sqlqty);
		$dataqty=mysqli_fetch_array($queryqty);
		$qty=$dataqty['isi']*$qty;
		//mencari jumlah total stok barang
		$sqlstok="select sum(sisa) as total from stokmasuk where kode_barang='$kode_barang'";
		$querystok=mysqli_query($koneksi,$sqlstok);
		$datastok=mysqli_fetch_array($querystok);
		$stokall=$datastok['total'];
		if ($qty<=$stokall) {//jika banyak barang yang dibeli lebih kecil atau sama dengan stok maka
			//memasukan data ke tabel detail masuk
			$delstok = "insert into detailkeluar value ('$no_keluar','$kode_barang','$qty','$harga','$totalkeluar')";
			mysqli_query($koneksi,$delstok);

			//memasukan update data tabel stok
			$sql="select * from stokmasuk where kode_barang='$kode_barang' order by tgl_masuk asc";
			$query=mysqli_query($koneksi,$sql);
			while ($row= mysqli_fetch_array($query)) {
				$stok=$row['sisa'];
				$tgl=$row['tgl_masuk'];
				$do=$row['do'];
				$size=$dataqty['size'];
				$isi=$dataqty['isi'];
				
				if ($qty > 0) {
					$temp=$qty;
					$qty=$qty-$stok;
					if ($qty > 0) {
						$stokupdate=0;
						
					}else{	
						$stokupdate=$stok-$temp;
					}
					//$modal=$stokupdate*$do;
					//$totalkeluardo=$do*$temp; $laba=$totalkeluar-$totalkeluardo;
					// $stokmasuk = "insert into stokkeluar value ('$no_keluar','$tglnow','$kode_konsumen','$kode_barang','$do','$harga','$temp','$totalkeluar','$laba')";
					// mysqli_query($koneksi,$stokmasuk);

					$delstok = "delete from stokmasuk where sisa=0";
					mysqli_query($koneksi,$delstok);
					$updatestok = "update stokmasuk set sisa='$stokupdate',terjual='$temp' where kode_barang='$kode_barang' and tgl_masuk='$tgl'";
					mysqli_query($koneksi,$updatestok);
					//memasukan data tabel kartu stok
					$temp1=$temp;
					$temp1=$temp/$dataqty['isi'];
					$tambah3 = "insert into kartustok value ('$kode_barang','$tglnow','$no_keluar','1 $size/$isi Pcs dari $row[no_masuk]','$harga','','$temp1 $size','$stokupdate')";
					mysqli_query($koneksi,$tambah3);
				}
			}
			header("location:../page-barang-keluar.php?pesan=sukses");
		}else{
			header("location:../page-barang-keluar.php?pesan=stokbarangtidakcukup"); 
		}
	}
?>