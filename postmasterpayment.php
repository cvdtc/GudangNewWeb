<?php
header('location: datamasterpayment.php');
$profile = "http://35.229.217.130:9992/api/paymentgateway";
$ch=curl_init($profile);



$basedata = array(
    "token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZHBlbmdndW5hIjoxLCJpYXQiOjE1OTkxODYwMTgsImV4cCI6MTU5OTE4OTYxOH0.l1aroWhUoR1V-SsMW6aj9kpphEn5-qBFQWkD_SC1ryQ",
    "nama_provider" => $_POST['nama_provider'],
    "token_provider" => $_POST['token_provider'],
    "status" => $_POST['status']
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