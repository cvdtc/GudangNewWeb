<?php
    header ('location: datamasterkota.php');
    $profile = "http://35.229.217.130:9992/api/kota";
    $ch = curl_init($profile);

    $basedata = array(
        'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZHBlbmdndW5hIjoxLCJpYXQiOjE1OTkyMDU0NzksImV4cCI6MTU5OTIwOTA3OX0.4vsku7grZ-JGU8KcIzxDlMYBKWqS-eAiUtW5hRV3CBo',
        'nama_kota' => $_POST['nama_kota'],
        'keterangan' => $_POST['keterangan'],
        'idprovinsi' => $_POST['idprovinsi'],
        'status' => $_POST['status']
    );    

    $data = json_encode($basedata);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $server_output = curl_exec($ch);
    return $server_output;
    // print_r($data);
?>