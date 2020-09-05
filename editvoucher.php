<?php
header ('location: datamastervoucher.php');
$profile ='http://35.229.217.130:9992/api/evoucher';
$message = '';
$ch = curl_init($profile);

$basedata = array(
    'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZHBlbmdndW5hIjoxLCJpYXQiOjE1OTkxODYwMTgsImV4cCI6MTU5OTE4OTYxOH0.l1aroWhUoR1V-SsMW6aj9kpphEn5-qBFQWkD_SC1ryQ',
    'idvoucher' => $_POST['idvoucher'],
    'kode_voucher' => $_POST['kode_voucher'],
    'jumlah_voucher' => $_POST['jumlah_voucher'],
    'persentase' => $_POST['persentase'],
    'nominal' => $_POST['nominal'],
    'keterangan' => $_POST['keterangan'],
    'gambar' => $_POST['gambar']
);
$data= json_encode($basedata);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$server_output = curl_exec($ch);

if (curl_errno($ch)) {
    die('Couldn\'t send request: ' . curl_error($ch));
} else {
    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($resultStatus == 200) {
        print_r('Data Berhasil Disimpan'); 
        return $server_output;
    } else if ($resultStatus == 405) {
        // die('Request failed: HTTP status code: ' . $resultStatus);
        print_r('Simpan Data Tidak Berhasil');
    }
    else if ($resultStatus == 403) {
        // die('Request failed: HTTP status code: ' . $resultStatus);
        print_r('Silahkan Login Kembali');
    }
}

// if (curl_exec($ch) === false) {
//     echo 'Data Tidak Dapat Disimpan'.curl_error($ch);
// } else {
//     echo 'Data Berhasil Disimpan';
// }

echo 'coba', $resultStatus;

curl_close($ch);
// return $server_output;
// echo $server_output;

 ?>