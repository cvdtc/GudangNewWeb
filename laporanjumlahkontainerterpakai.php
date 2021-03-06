<?php
  include('koneksi.php');
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
    
    <link rel="stylesheet" href="assets/css/export.css" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="assets/css/rowGroup.dataTables.min.css"/>
    
</head>

<body>
            <div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Laporan Jumlah Kontainer Terpakai</h4>
                                <div class="data-tables">
                                    <table id="example" class="display" style="width:100%">
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th class="text-left">Kode Kontainer</th>
                                                <th class="text-left">Jumlah Transaksi</th>
                                                <th class="text-left">Jumlah Hari Sewa</th>
                                                <th class="text-left">Lokasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
                                                $query = "SELECT sum(td.jumlah_sewa) AS jumlah_sewa, count(pb.kode_refrensi) AS kode_refrensi, pk.kode_kontainer, l.nama_lokasi FROM 
                                                transaksi t, transaksi_detail td, pembayaran pb, payment_gateway pg, produk pk, lokasi l WHERE 
                                                t.idtransaksi=td.idtransaksi AND t.idtransaksi=pb.idtransaksi AND pb.idpayment_gateway=pg.idpayment_gateway 
                                                AND td.idproduk=pk.idproduk AND pk.idlokasi=l.idlokasi GROUP BY pk.kode_kontainer;";
                                                $result = mysqli_query($koneksi, $query);
                                                //mengecek apakah ada error ketika menjalankan query
                                                if(!$result){
                                                    die ("Query Error: ".mysqli_errno($koneksi).
                                                    " - ".mysqli_error($koneksi));
                                                }
                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                            ?>
                                                <tr>   
                                                    <td class="text-left"><?php echo $row['kode_kontainer']; ?></td>
                                                    <td class="text-left"><?php echo $row['kode_refrensi']; ?></td>
                                                    <td class="text-left"><?php echo $row['jumlah_sewa']; ?></td>
                                                    <td class="text-left"><?php echo $row['nama_lokasi']; ?></td>
                                                </tr>
                                                    
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
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
    <script src="assets/js/3.1.3/jszip.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/buttons.html5.min.js"></script>
    <script src="assets/js/buttons.print.min.js"></script>
    <script src="assets/js/buttons.colVis.min.js "></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/responsive.bootstrap4.min.js"></script>
    <script>
            $(document).ready(function() {
                var table = $('#example').DataTable( {
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ALL"]],
                    buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
                } );
                table.buttons().container()
                    .appendTo( '#example_wrapper .col-md-6:eq(0)' );
            } );
        </script>
    <!--DateRangePicker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</body>
</html>
