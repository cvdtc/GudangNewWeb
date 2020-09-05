<?php
    // header ('location: datamasterkota.php');
    include('datamasterkota.php');
    
    $profile = "http://35.229.217.130:9992/api/ekota";
    $ch = curl_init($profile);
    $basedata = array(
        'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZHBlbmdndW5hIjoxLCJpYXQiOjE1OTkxMDQ0NDAsImV4cCI6MTU5OTEwODA0MH0.U_OQLyWkB2roGFJzBf3QqYcLjU9KPPFkDFOTH5z2KTs',
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
    return $server_output;
    echo $server_output;
    echo $data;
    // print_r($data);
?>