<?php

include_once 'url.php';
session_start();
// header('location: home.php?page=voucher');
    $profile = "$url/voucher";
    $ch=curl_init($profile);
    $token = $_SESSION['access_token'];
    $basedata = array(
    'token' => $token,
    "kode_voucher" => $_POST['kode_voucher'],
    "jumlah_voucher" => $_POST['jumlah_voucher'],
    "persentase" => $_POST['persentase'],
    "nominal" => $_POST['nominal'],
    "keterangan" => $_POST['keterangan'],
    "gambar" => $_POST['gambar']
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
    else if ($resultStatus == 201) {
        return $server_output;
    }
}
curl_close($ch);


include 'koneksi.php';
 
$rand = rand();
$ekstensi =  array('png','jpg','jpeg','gif');
$filename = $_FILES['gambar']['name'];
$ukuran = $_FILES['gambar']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
 
if(!in_array($ext,$ekstensi) ) {
	echo "ektensi tidak valid";
}else{
	if($ukuran < 1044070){		
		$xx = $rand.'_'.$filename;
		move_uploaded_file($_FILES['gambar']['tmp_name'], 'gambar/'.$rand.'_'.$filename);
		mysqli_query($koneksi, "INSERT INTO voucher (gambar) VALUES('$xx')");
		echo "berhasil";
	}else{
		// header("location:index.php?alert=gagak_ukuran");
		echo "gagal";
	}
}

?>