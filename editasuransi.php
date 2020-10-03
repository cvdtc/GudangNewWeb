<?php

    include_once 'url.php';
    session_start();
    header ('location: home.php?page=asuransi');
    $profile = "$url/uasuransi";
    $ch = curl_init($profile);

    $token = $_SESSION['access_token'];
    $basedata = array(
        // 'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZHBlbmdndW5hIjoxLCJpYXQiOjE1OTkxMTM4ODEsImV4cCI6MTU5OTExNzQ4MX0.X7-6DTwRPudlyc9XoEhvrwv7xwahW_kgih5PNh8fRqM',
        'token' => $token,
        'idasuransi' => $_POST['idasuransi'],
        'nama_asuransi' => $_POST['nama_asuransi'], 
        'perusahaan' => $_POST['perusahaan'],
        'alamat' => $_POST['alamat'],
        'nilai' => $_POST['nilai'],
        'status' => $_POST['status'],
        'tanggal_kontrak_awal' => $_POST['tanggal_kontrak_awal'],
        'tanggal_kontrak_akhir' => $_POST['tanggal_kontrak_akhir']
    );    

    $data = json_encode($basedata);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
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