<?php
header('location: datamasterasuransi.php');
$profile = "http://35.229.217.130:9992/api/asuransi";
$ch=curl_init($profile);

$basedata = array(
    "token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZHBlbmdndW5hIjoxLCJpYXQiOjE1OTkxMTM4ODEsImV4cCI6MTU5OTExNzQ4MX0.X7-6DTwRPudlyc9XoEhvrwv7xwahW_kgih5PNh8fRqM",
    "nama_asuransi" => $_POST['nama_asuransi'],
    "perusahaan" => $_POST['perusahaan'],
    "alamat" => $_POST['alamat'],
    "nilai" => $_POST['nilai'],
    "status" => $_POST['status'],
    "tanggal_kontrak_awal" => $_POST['tanggal_kontrak_awal'],
    "tanggal_kontrak_akhir" => $_POST['tanggal_kontrak_akhir']
);

$data = json_encode($basedata);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$server_output = curl_exec($ch);
return $server_output;
echo $server_output
?>