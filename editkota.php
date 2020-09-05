<?php
    header ('location: datamasterkota.php');
    
    $profile = "http://35.229.217.130:9992/api/ekota";
    $ch = curl_init($profile);
    $basedata = array(
        'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZHBlbmdndW5hIjoxLCJpYXQiOjE1OTkxODM1MzgsImV4cCI6MTU5OTE4NzEzOH0.s2T2QmYSnv-Ahy3nquNB0Ie-bB3ymlruerOatD2l_Uk',
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