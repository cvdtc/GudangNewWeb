<?php 

include_once 'url.php';
session_start();
// if ($_SESSION['access_token']='') {
if (!$_SESSION['logged_in']) {
    header("Location: login.php");
    exit;
}

function curl1($url){
    $authorization = "Authorization: Bearer ".$_SESSION['access_token'];
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
     
    $output = curl_exec($ch);  
          
    // return $output;
    if (curl_errno($ch)) {
        die('Couldn\'t send request: ' . curl_error($ch));
    } else {
        $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($resultStatus == 200) {
        } else if ($resultStatus == 403) {
            header("Location: login.php");
        }
        else if ($resultStatus == 401) {
            header("Location: login.php");
        }
    }
    curl_close($ch);
}

$profile = curl1("$url/asuransi");


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
    <link rel="stylesheet" type="text/css" href="assets/css/rowGroup.dataTables.min.css"/>
    <!-- daterangepicker -->
    <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="home.php"><img src="assets/images/icon/logo_gudang.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li><a href="home.php"><i class="ti-dashboard"></i> <span>Home</span></a></li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i><span>Master</span></a>
                                <ul class="collapse">
                                    <li><a href="home.php?page=provinsi"><i class="ti-layers-alt"></i> &nbsp;Master Provinsi</a></li>
                                    <li><a href="home.php?page=kota"><i class="fa fa-th-large"></i> &nbsp;Master Kota</a></li>
                                    <li><a href="home.php?page=lokasi"><i class="fa fa-map"></i> &nbsp;Master Lokasi</a></li>
                                    <li><a href="home.php?page=jenisproduk"><i class="fa fa-object-group"></i> &nbsp;Master Jenis Produk</a></li>
                                    <li><a href="home.php?page=produk"><i class="ti-arrow-circle-down"></i> &nbsp;Master Produk</a></li>
                                    <li><a href="home.php?page=device"><i class="fa fa-tablet"></i> &nbsp;Master Device</a></li>
                                    <li><a href="home.php?page=kondisi"><i class="fa fa-square-o"></i> &nbsp;Master Kondisi</a></li>
                                    <li><a href="home.php?page=asuransi"><i class="fa fa-chain"></i> &nbsp;Master Asuransi</a></li>
                                    <li><a href="home.php?page=payment"><i class="fa fa-credit-card"></i> &nbsp;Master Payment</a></li>
                                    <li><a href="home.php?page=voucher"><i class="fa fa-money"></i> &nbsp;Master Voucher</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-receipt"></i><span>Transaksi</span></a>
                                <ul class="collapse">
                                    <li><a href="home.php?page=mutasi" class="ti-flag-alt-2"> Mutasi</a></li>
                                </ul>
                                <ul class="collapse">
                                    <li><a href="home.php?page=listsewaexpired" class="ti-marker-alt"> Sewa Expired</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-table"></i><span>Laporan</span></a>
                                <ul class="collapse">
                                    <li><a href="home.php?page=laporanpenjualan" class="ti-file"> Laporan Penjualan</a></li>
                                </ul>
                                <ul class="collapse">
                                    <li><a href="home.php?page=laporanpenjualanjenisproduk" class="ti-files"> Laporan Penjualan Jenis produk</a></li>
                                </ul>
                                <ul class="collapse">
                                    <li><a href="home.php?page=laporanpenjualancostumercontainer" class="ti-envelope"> Laporan Penjualan Customer Kontainer</a></li>
                                </ul>
                                <ul class="collapse">
                                    <li><a href="home.php?page=laporanpenjualancontainercostumer" class="ti-eraser"> Laporan Penjualan Kontainer Customer</a></li>
                                </ul>
                                <ul class="collapse">
                                    <li><a href="home.php?page=laporanjumlahkontainerterpakai" class="ti-bar-chart-alt"> Laporan Jumlah Kontainer Terpakai</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="home.php">Home</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['nama_customer'] ?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- sidebar menu area end -->
        <div class="main-content-inner">
        <?php
        if (isset($_GET['page'])){
            $page = $_GET['page'];
            switch ($page){
                case 'provinsi':
                    include "datamasterprovinsi.php";
                    break;
                case 'kota':
                    include "datamasterkota.php";
                    break;
                case 'lokasi':
                    include "datamasterlokasi.php";
                    break;
                case 'jenisproduk':
                    include "datamasterjenisproduk.php";
                    break;
                case 'produk':
                    include "datamasterproduk.php";
                    break;
                case 'device':
                    // $profile = curl("http://server.horang.id:9992/api/device");
                    include "datamasterdevice.php";
                    break;
                case 'kondisi':
                    include "datamasterkondisi.php";
                    break;
                case 'asuransi':
                    // $profile = curl("http://server.horang.id:9992/api/asuransi");
                    include "datamasterasuransi.php";
                    break;
                case 'payment':
                    include "datamasterpayment.php";
                    break;
                case 'voucher':
                    include "datamastervoucher.php";
                    break;    
                case 'mutasi':
                    include "mutasi.php";
                    break;   
                case 'listsewaexpired':
                    include "listsewaexpired.php";
                    break;
                case 'laporanpenjualan':
                    include "laporanpenjualan.php";
                    break;  
                case 'laporanpenjualanjenisproduk':
                    include "laporanpenjualanjenisproduk.php";
                    break;
                case 'laporanpenjualancostumercontainer':
                    include "laporanpenjualancostumercontainer.php";
                    break;    
                case 'laporanpenjualancontainercostumer':
                    include "laporanpenjualancontainercostumer.php";
                    break;    
                case 'laporanjumlahkontainerterpakai':
                    include "laporanjumlahkontainerterpakai.php";
                    break;  
            }
        } 
        else {
            // $profile = curl("http://server.horang.id:9992/api/asuransi");
            include 'datamasterasuransi.php';
        }
        ?>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- Start datatable js -->
    <script src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/js/responsive.bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/js/jszip.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/0.1.53/vfs_fonts.js"></script>
    <script src="assets/js/buttons.html5.min.js"></script>
    <script src="assets/js/buttons.print.min.js"></script>    
    <script src="assets/js/buttons.colVis.min.js "></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/js/dataTables.rowGroup.min.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
    <!-- <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->
</body>

</html>
