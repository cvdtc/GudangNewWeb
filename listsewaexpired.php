<?php

include_once 'url.php';
// session_start();
    if (!$_SESSION['logged_in']) {
        header("Location: login.php");
        exit;    
    }
   
function curl($url){
    $authorization = "Authorization: Bearer ".$_SESSION['access_token'];
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
     
    $output = curl_exec($ch);  
          
    if (curl_errno($ch)) {
        die('Couldn\'t send request: ' . curl_error($ch));
    } else {
        $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($resultStatus == 200) {
            // print_r('Data Berhasil Disimpan'); 
            return $output;
        } else if ($resultStatus == 403) {
            // die('Request failed: HTTP status code: ' . $resultStatus);
            // print_r('Silahkan Login Kembali');
            header("Location: login.php");
        }
        else if ($resultStatus == 401) {
            header("Location: login.php");
        }
    }
    // return $output;
    curl_close($ch);
}

$profile = curl("$url/listsewaexpired");
$data = json_decode($profile, TRUE);

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
    
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    
            <div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <!--end modal form add master -->
                                <h4 class="header-title">Data Sewa Expired</h4>
                                <div class="data-tables">
                                <table id="example" class="table table-bordered table-striped dt-responsive nowrab" style="width:100%">
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                            <th class="text-left">No</th>
                                                <th class="text-left">No Order</th>
                                                <th class="text-left">Nama Customer</th>
                                                <th class="text-left">Kode Kontainer</th>
                                                <th class="text-left">Tanggal Order</th>
                                                <th class="text-left">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            foreach ($data as $row) :
                                            ?>
                                            <tr>
                                            <td><?php echo $i; $i++; ?></td>
                                                <td><?php echo $row["no_order"]?></td>
                                                <td><?php echo $row["nama_customer"] ?></td>
                                                <td><?php echo $row["kode_kontainer"] ?></td>
                                                <td><?php echo substr($row['tanggal_order'],0,10); ?></td>
                                                <th>
                                                    <form method="post">
                                                        <button type="button" data-toggle="modal" class="btn btn-primary" name="idtransaksi" type="submit"  data-target=".modal-edit<?php echo $row["idtransaksi"]; ?>">Edit</button>
                                                    </form>
                                                </th>
                                            </tr>
                                            <?php endforeach ?>
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

    <!-- others plugins -->
    <!-- <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script> -->
</body>

</html>

<?php
        foreach ($data as $row) :
?>
<!-- modal edit form master -->
<div class="modal fade modal-edit<?php echo $row['idtransaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Sewa Expired</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="postselesaisewa.php">    
                    <input name="idtransaksi" value="<?php echo $row['idtransaksi'] ?>" style="display:none">
                    <div class="position-relative form-group"><label for="exampleEmail" class="">No order</label>
                        <input value="<?php echo $row['no_order'] ?>" type="text" class="form-control" readonly="readonly">
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Nama Customer</label>
                        <input value="<?php echo $row['nama_customer'] ?>" type="text" class="form-control" readonly="readonly">
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Kode Kontainer</label>
                        <input value="<?php echo $row['kode_kontainer'] ?>" type="text" class="form-control" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="examplePassword" class="">Tanggal Order</label>
                        <input type="date" class="form-control" value=
                        "<?php echo substr($row['tanggal_order'],0,10); ?>" readonly="readonly">
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Denda</label>
                        <input name="denda" placeholder="ketik Denda disini..." type="number" value="{{model.PortNumber || 0}}" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Keterangan</label>
                        <input name="keterangan" placeholder="ketik Keterangan disini..." type="text" class="form-control" required>
                    </div>
                        <br>
                        <button class="mt-1 btn btn-primary" type="submit">Selesai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
            <!-- end madal edit -->
            <?php endforeach ?>