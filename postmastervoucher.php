<?php
header('location: datamastervoucher.php');


// if (isset($_FILES['gamabar']['tmp_name'])){
    $profile = "http://35.229.217.130:9992/api/voucher";
    $ch=curl_init($profile);
    // $cfile = new CURLFile($_FILES['gambar']['tmp_name'], $_FILES['gambar']['type'], $_FILES['gambar']['name']);
$basedata = array(
    "token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZHBlbmdndW5hIjoxLCJpYXQiOjE1OTkxODYwMTgsImV4cCI6MTU5OTE4OTYxOH0.l1aroWhUoR1V-SsMW6aj9kpphEn5-qBFQWkD_SC1ryQ",
    "kode_voucher" => $_POST['kode_voucher'],
    "jumlah_voucher" => $_POST['jumlah_voucher'],
    "persentase" => $_POST['persentase'],
    "nominal" => $_POST['nominal'],
    "keterangan" => $_POST['keterangan'],
    // "mygambar" => $cfile
    "gambar" => $_POST['gambar']
    // "gambar" => $_FILES['gambar']['name']
    // "tmp" => $_POST['gambar']['tmp_name']
);

$data = json_encode($basedata);

// print_r($data);
// if ($basedata['gambar'] !=""){
//     // $ekstensi_diperbolehkan = array('png','jpg');
//     $x = explode('.',$basedata['gambar']);
//     $ekstensi = strtolower(end($x));
//     $file_tmp = $_FILES['gambar']['tmp_name'];
//     $acak_angka = rand(1,999);
//     $nama_gambar_baru = $acak_angka.'-'.$basedata['gambar'];
//     if (in_array($ekstensi)=== true){
//         move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//         curl_setopt($ch, CURLOPT_POST, 1);
//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//         $server_output = curl_exec($ch);
//         if ($server_output == true){
//             echo 'FILE UPLOAD';
//         }
//         return $server_output;
//     }
//     else {     
//         echo "Error:".curl_error($ch);   
//     }
// }



// $fotobaru = date('dmYHis').$basedata['gambar'];

// $fpath = "gambar/".$fotobaru;

// if (move_uploaded_file($basedata['tmp'], $fpath )){
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//     $server_output = curl_exec($ch);
//         if ($server_output == true){
//             echo 'FILE UPLOAD';
//         }
//         return $server_output;

// }else{  
//     echo "Error:".curl_error($ch);  
// }

// curl_setopt($ch, CURLOPT_URL, "http://localhost:8081/gudang/uploadgambar.php");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$server_output = curl_exec($ch);
// if ($server_output == true){
//     echo 'FILE UPLOAD';
// } else{
//     echo "Error:".curl_error($ch);
// }
return $server_output;
echo $server_output;
// }
// echo $_POST ['token'];
echo $_POST['kode_voucher'];
echo $_POST['jumlah_voucher'];
echo $_POST['persentase'];
echo $_POST['nominal'];
echo $_POST['keterangan'];
// // echo $cfile;
?>