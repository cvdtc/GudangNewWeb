<?php
include 'koneksi.php';

$idvoucher = $_POST['idvoucher'];
$rand = rand();
$ekstensi =  array('png','jpg','jpeg','gif');
$filename = $_FILES['gambar']['name'];
$ukuran = $_FILES['gambar']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
 
if(!in_array($ext,$ekstensi) ) {
	echo "ektensi tidak valid";
}else{
	if($ukuran < 1044070){		
		$gambar = $rand.'_'.$filename;
		move_uploaded_file($_FILES['gambar']['tmp_name'], 'gambar/'.$rand.'_'.$filename);
		mysqli_query($koneksi, "UPDATE gambar SET gambar='$gambar' WHERE idvoucher=$idvoucher");
		echo "berhasil";
	}else{
		// header("location:index.php?alert=gagak_ukuran");
		echo "gagal";
	}
}
?>