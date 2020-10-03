<?php
$koneksi = mysqli_connect("factory.grand-elephant.co.id","root","hanyaadminyangtau","gudang");

 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>