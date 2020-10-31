<?php

include 'koneksi.php';
include "url.php";

  $idjenis_produk = $_POST['idjenis_produk'];
  $gambar = $_FILES['gambar']['name'];
  
  if($gambar != "") {
    $ekstensi_diperbolehkan = array('jpg','JPG'); 
    $x = explode('.', $gambar); 
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar']['tmp_name'];   
    // $angka_acak     = rand();
    // $nama_gambar_baru = $angka_acak.'-'.$gambar; //menggabungkan angka acak dengan nama file sebenarnya
    $nama_gambar_baru = "gambar/"."jenis_produk".$idjenis_produk.".JPG";
    $path_gambar = $baseurl."/".$nama_gambar_baru;

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, $nama_gambar_baru); //memindah file gambar ke folder gambar
					$query  = "UPDATE jenis_produk SET gambar = '$path_gambar'";
                    $query .= "WHERE idjenis_produk = '$idjenis_produk'";
                    $result = mysqli_query($koneksi, $query);
                    if(!$result){
                        die ("Gagal Upload!!! Pastikan Anda Sudah Memilih Gambar ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
                    } else {
                      echo "<script>alert('Gambar Berhasil Diupload.');window.location='home.php?page=jenisproduk';</script>";
                    }
              } else {     
                  echo "<script>alert('Ekstensi Gambar Tidak Sesuai');window.location='home.php?page=jenisproduk';</script>";
              }
    } else {
      echo "<script>alert('Gagal Upload!!! Pastikan Anda Sudah Memilih Gambar');window.location='home.php?page=jenisproduk';</script>";
    }
?>
