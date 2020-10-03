<?php

    include_once 'url.php';
    session_start();
    header ('location: home.php?page=kota');
    $profile = "$url/ukota";

    $ch = curl_init($profile);
    $token = $_SESSION['access_token'];
    $basedata = array(
        'token' => $token,
        'idkota' => $_POST['idkota'],
        'nama_kota' => $_POST['nama_kota'],
        'keterangan' => $_POST['keterangan'],
        'idprovinsi' => $_POST['idprovinsi'],
        'status' => $_POST['status']
    );  
    $data = json_encode($basedata);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $server_output = curl_exec($ch);
    if (curl_errno($ch)) {
        die('Couldn\'t send request: ' . curl_error($ch));
    } else {
        $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($resultStatus == 403) {
            header('Location: login.php');
        } else if ($resultStatus == 401) {
            header('location: login.php');
        }
        else if ($resultStatus == 200) {
            return $server_output;
        }
    }
    curl_close($ch);
?>