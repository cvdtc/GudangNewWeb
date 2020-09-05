<?php

    session_start();
    $profile = "http://35.229.217.130:9992/api/login";
    
    $ch = curl_init($profile);
    $basedata = array(
        'email' => $_POST['email'],
        'password' => $_POST['password']
    );    

    $data = json_decode($ch);
    $access_token = $data['access_token'];
    echo "masukkkkkkkk";

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 

    $server_output = curl_exec($ch);
    return $server_output;
    // print_r($data);

    // $data1 = json_decode($profile, TRUE);
    // print_r ($data1);
    // foreach ($data1 as $row) :
    //     echo $row["access_token"];
    //     echo "masukkkkkkkkkkkkkk";
    // endforeach;
    // echo "masukkkkkkkk";
    // print_r ($data['access_token']);
    
    // echo "masukkkkkkkk";
    // print_r ($data1['access_token']);
    
    echo $data['access_token'];
    $_SESSION["access_token"] = $access_token;
    if ($data['access_token']!=""){
        $_SESSION['logged_in'] = "true";
        header('Location: datamasterkota.php');
    } else {
        header('Location: login.php');
    }
?>