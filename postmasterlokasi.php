<?php
header('location: datamasterlokasi.php');
$profile = "http://35.229.217.130:9992/api/lokasi";
$ch=curl_init($profile);



$basedata = array(
    "token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZHBlbmdndW5hIjoxLCJpYXQiOjE1OTkxMjI2NTAsImV4cCI6MTU5OTEyNjI1MH0.0kk4RDIFRBYG4s-cSRG9QxwyLMHc8mJrmT_4DY0SVG8",
    "nama_lokasi" => $_POST['nama_lokasi'],
    "keterangan" => $_POST['keterangan'],
    "latitude" => $_POST['latitude'],
    "longitude" => $_POST['longitude'],
    "idkota" => $_POST['idkota']
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