<?php
// header('location: datamasterdevice.php');
$profile = "http://35.229.217.130:9992/api/device";
$ch=curl_init($profile);



$basedata = array(
    "token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZHBlbmdndW5hIjoxLCJpYXQiOjE1OTkxMjI2NTAsImV4cCI6MTU5OTEyNjI1MH0.0kk4RDIFRBYG4s-cSRG9QxwyLMHc8mJrmT_4DY0SVG8",
    "kode_device" => $_POST['kode_device'],
    "serial_device" => $_POST['serial_device'],
    "hardware_id" => $_POST['hardware_id'],
    "ipaddress" => $_POST['ipaddress']
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