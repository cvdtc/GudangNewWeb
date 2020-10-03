
<?php
// header('location: mutasi.php');
include_once 'url.php';
session_start();
$profile = "$url/searchorder";

$ch = curl_init($profile);
$token = $_SESSION['access_token'];
$basedata = array(
    'token' => $token,
    'no_order' => $_POST['no_order']
);    

//    $data = json_encode($basedata);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($basedata)); 

$server_output = curl_exec($ch);
$data = json_decode($server_output, TRUE);
print_r ($data);

// echo $data['0']['idpembayaran'];
// echo $data['0']['no_order'];
$_SESSION['no_order']=$data['0']['no_order'];
$_SESSION['keterangan']=$data['0']['keterangan'];
// echo $_SESSION['no_order'];
?>