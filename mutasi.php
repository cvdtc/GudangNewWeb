<?php 


include_once 'url.php';
// session_start();
    if (!$_SESSION['logged_in']) {
        header("Location: login.php");
        exit;
    }
   
$profile = "$url/searchorder";

$ch = curl_init($profile);
$token = $_SESSION['access_token'];
$basedata = array(
    'token' => $token,
    'no_order' => ISSET($_POST['no_order'])?$_POST['no_order']:""
);    
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($basedata)); 

$server_output = curl_exec($ch);
$data = json_decode($server_output, TRUE);
if (curl_errno($ch)) {
    die('Couldn\'t send request: ' . curl_error($ch));
} else {
    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($resultStatus == 200) {
        // print_r('Data Berhasil Disimpan'); 
        $data = json_decode($server_output, TRUE);
    } else if ($resultStatus == 403) {
        // die('Request failed: HTTP status code: ' . $resultStatus);
        // print_r('Silahkan Login Kembali');
        header("Location: login.php");
    }
    else if ($resultStatus == 401) {
        header("Location: login.php");
    }
}
// print_r ($data);
// echo $data['0']['no_order'];
$no_order = ISSET($data['0']['no_order'])?$data['0']['no_order']:"";
$keterangan = ISSET($data['0']['keterangan'])?$data['0']['keterangan']:"";
$jumlah_sewa = ISSET($data['0']['jumlah_sewa'])?$data['0']['jumlah_sewa']:"";
$harga = ISSET($data['0']['harga'])?$data['0']['harga']:"";
$total_harga = ISSET($data['0']['total_harga'])?$data['0']['total_harga']:"";
$nama_provider = ISSET($data['0']['nama_provider'])?$data['0']['nama_provider']:"";
$kode_kontainer = ISSET($data['0']['kode_kontainer'])?$data['0']['kode_kontainer']:"";
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PT. Indah Horang Pintar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amcharts css -->
    <link rel="stylesheet" href="assets/css/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <!-- form search no order -->
                                <div class="col-12">
                                    <div class="card mt-5">
                                        <div class="card-body">
                                            <h4 class="header-title">Masukkan No Order</h4>
                                            <form class="needs-validation" novalidate="" method="post" action='?page=mutasi'>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="validationCustom03">No Order</label>
                                                        <input type="text" class="form-control" id="no_order" name="no_order" placeholder="No Order" required="">
                                                        <div class="invalid-feedback">
                                                            No Order Kosong !!!
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Cari No Order</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="modal-dialog"> -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Mutasi</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action='postmutasi.php'>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="exampleEmail" class="">No Order</label>
                                                        <input name="no_order" id="no_order" value="<?php echo $no_order ?>" type="text" class="form-control" readonly="readonly">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="harga">Harga</label>
                                                        <input type="text" value="<?php echo $harga ?>" class="form-control" readonly="readonly">
                                                    </div>
                                                </div>
                                                        <div class="form-row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="kode_kontainer">Kode Kontainer</label>
                                                        <input type="text" value="<?php echo $kode_kontainer ?>" class="form-control" readonly="readonly">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="jumlah_sewa">Jumlah Sewa</label>
                                                        <input type="text" value="<?php echo $jumlah_sewa ?>" class="form-control" readonly="readonly">
                                                    </div> 
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="nama_provider">Nama Provider</label>
                                                        <input type="text" value="<?php echo $nama_provider ?>" class="form-control" readonly="readonly">
                                                    </div> 
                                                    <div class="col-md-6 mb-3">
                                                        <label for="total_harga">Total Harga</label>
                                                        <input type="text" value="<?php echo $total_harga ?>" class="form-control" readonly="readonly">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="keterangan">Keterangan</label>
                                                        <input name="keterangan" type="text" id="keterangan" value="<?php echo $keterangan ?>" class="form-control" readonly="readonly">
                                                    </div>
                                                </div>
                                                <br>
                                                <button class="mt-1 btn btn-primary" type="submit">Mutasi</button>
                                            </form>
                                        </div>
                                    </div>
                                <!-- </div> -->
                                <!-- end form mutasi -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <!-- <script src="assets/js/popper.min.js"></script> -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- Start datatable js -->
    <script src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/js/responsive.bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <!-- others plugins -->
    <!-- <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script> -->
</body>

</html>