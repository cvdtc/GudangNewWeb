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
                                <h4 class="header-title">Laporan Penjualan</h4>
                                <div class="data-tables">
                                    <table id="example" class="display" style="width:100%">
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th class="text-left">Customer</th>
                                                <th class="text-left">Kode Kontainer</th>
                                                <th class="text-left">No Order</th>
                                                <th class="text-left">Harga</th>
                                                <th class="text-left">Jumlah Sewa</th>
                                                <th class="text-left">Total Harga</th>
                                                <th class="text-left">nominal</th>
                                                <th class="text-left">Tanggal Order</th>
                                                <th class="text-left">Tanggal Mulai</th>
                                                <th class="text-left">Tanggal Akhir</th>
                                                <th class="text-left">Kode Refrensi</th>
                                                <th class="text-left">Nama Provider</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
                                                $query = "select c.nama_customer, t.no_order, t.total_harga, t.tanggal_order, 
                                                td.jumlah_sewa, td.harga, td.tanggal_mulai, td.tanggal_akhir, pb.kode_refrensi, pb.nominal, pg.nama_provider, pk.kode_kontainer from 
                                                pengguna p, customer c, transaksi t, transaksi_detail td, pembayaran pb, payment_gateway pg, produk pk where 
                                                p.idpengguna=c.idpengguna and p.idpengguna=t.idpengguna and t.idtransaksi=td.idtransaksi and t.idtransaksi=pb.idtransaksi 
                                                and pb.idpayment_gateway=pg.idpayment_gateway and td.idproduk=pk.idproduk;";
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
                                                    <td class="text-left"><?php echo $row['nama_customer']; ?></td>
                                                    <td class="text-left"><?php echo $row['kode_kontainer']; ?></td>
                                                    <td class="text-left"><?php echo $row['no_order']; ?></td>
                                                    <td class="text-left"><?php echo str_replace('.00', '', $row['harga']); ?></td>
                                                    <td class="text-left"><?php echo $row['jumlah_sewa']; ?></td>
                                                    <td class="text-left"><?php echo str_replace('.00', '', $row['total_harga']); ?></td>
                                                    <td class="text-left"><?php echo str_replace('.00', '', $row['nominal']); ?></td>
                                                    <td class="text-left"><?php echo $row['tanggal_order']; ?></td>
                                                    <td class="text-left"><?php echo $row['tanggal_mulai']; ?></td>
                                                    <td class="text-left"><?php echo $row['tanggal_akhir']; ?></td>
                                                    <td class="text-left"><?php echo $row['kode_refrensi']; ?></td>
                                                    <td class="text-left"><?php echo $row['nama_provider']; ?></td>
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
    <script src="assets/js/dataTables.rowGroup.min.js"></script>
  
    <script>
            $(document).ready(function() {
                var table = $('#example').DataTable( {
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ALL"]],
                    buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
                    "order": [[ 0, 'asc' ]],
                    // "displayLength": 100,
                    responsive: true,
                    rowGroup:{
                    // startRender: null,
                    endRender: function(rows, group){
                        var HargaSum = rows
                        .data()
                        .pluck(3)
                        .reduce(function (a,b){
                        return a + b.replace(/[^\d]/g, '')*1;
                        }, 0);
                        var TotalHargaSum = rows
                        .data()
                        .pluck(5)
                        .reduce(function (a,b){
                        return a + b.replace(/[^\d]/g, '')*1;
                        }, 0);
                        var NominalSum = rows
                        .data()
                        .pluck(6)
                        .reduce(function (a,b){
                        return a + b.replace(/[^\d]/g, '')*1;
                        }, 0);
                            return 'Summary Harga Di Customer '+group+': '+
                                $.fn.dataTable.render.number(',', '.', 0, 'Rp. ').display( HargaSum )+
                                ' Total Harga '+': '+
                                $.fn.dataTable.render.number(',', '.', 0, 'Rp. ').display( TotalHargaSum )+
                                ' dan Total Nominal '+': '+
                                $.fn.dataTable.render.number(',', '.', 0, 'Rp. ').display( NominalSum );
                    },
                    dataSrc:1
                    }
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
