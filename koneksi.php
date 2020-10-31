<?php
$koneksi = mysqli_connect("factory.grand-elephant.co.id","root","hanyaadminyangtau","gudang");

 
// Check connection
if(!$koneksi){ 
    die ("Koneksi dengan database gagal: ".mysql_connect_error());
  }
 
?>