<?php
header('location: datamasterjenisproduk.php');
$profile = "http://35.229.217.130:9992/api/jenisproduk";
$ch=curl_init($profile);

$basedata = array(
    "token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZHBlbmdndW5hIjoxLCJpYXQiOjE1OTkwOTkyODIsImV4cCI6MTU5OTEwMjg4Mn0.DetminMG61yK8NyS1DQysrN2_SE_X178y9nu7yYJT48",
    "nama" => $_POST['nama'],
    "keterangan" => $_POST['keterangan'],
    "gambar" => $_POST['gambar']
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