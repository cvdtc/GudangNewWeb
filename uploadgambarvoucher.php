<?php

include 'koneksi.php';
include "url.php";

  $idvoucher = $_POST['idvoucher'];
  $gambar = $_FILES['gambar']['name'];
  
  if($gambar != "") {
    $ekstensi_diperbolehkan = array('jpg','JPG');  
    $x = explode('.', $gambar); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar']['tmp_name'];   
    // $angka_acak     = rand();
    // $nama_gambar_baru = $angka_acak.'-'.$gambar; //menggabungkan angka acak dengan nama file sebenarnya
    $nama_gambar_baru = "gambar/"."voucger".$idvoucher.".JPG";
    $path_gambar = $baseurl."/".$nama_gambar_baru;
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, $nama_gambar_baru);//memindah file gambar ke folder gambar
					$query  = "UPDATE voucher SET gambar = '$path_gambar'";
                    $query .= "WHERE idvoucher = '$idvoucher'";
                    $result = mysqli_query($koneksi, $query);
                    if(!$result){
                        die ("Gagal Upload!!! Pastikan Anda Sudah Memilih Gambar: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
                    } else {
                      echo "<script>alert('gambar berhasil diupload.');window.location='home.php?page=voucher';</script>";
                    }
              } else {     
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='home.php?page=voucher';</script>";
              }
    } else {
      echo "<script>alert('Gagal Upload!!! Pastikan Anda Sudah Memilih Gambar');window.location='home.php?page=jenisproduk';</script>";
    }

 

