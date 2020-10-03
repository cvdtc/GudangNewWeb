

<?php

    include_once 'url.php';
    session_start();
    $profile = "$url/login";
    
    $ch = curl_init($profile);

    $basedata = array(
       'email' => $_POST['email'],
       'password' => $_POST['password']
    );    

    //    $data = json_encode($basedata);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($basedata)); 

    $server_output = curl_exec($ch);
    $data = json_decode($server_output, TRUE);
    // print_r($data);  
    //echo $data['access_token']; //sukses

     if ($data['access_token']!=""){
         $_SESSION['nama_customer']=$data['nama_customer'];
         $_SESSION['access_token']=$data['access_token'];
         $_SESSION['logged_in'] = "true";
         header('Location: home.php');
     } else {
         header('Location: login.php');
     }
?>








