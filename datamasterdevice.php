<?php 

include_once 'url.php';
// session_start();
    if (!$_SESSION['logged_in']) {
        header("Location: login.php");
        exit;
    }
   
function curl($url){
    $authorization = "Authorization: Bearer ".$_SESSION['access_token'];    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
     
    $output = curl_exec($ch);  
    if (curl_errno($ch)) {
        die('Couldn\'t send request: ' . curl_error($ch));
    } else {
        $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($resultStatus == 200) {
            return $output;
        } else if ($resultStatus == 403) {
            header("Location: login.php");
        }
        else if ($resultStatus == 401) {
            header("Location: login.php");
        }
    }
    curl_close($ch);
}

$profile = curl("$url/device");

// mengubah JSON menjadi array
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
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <!-- modal form add master -->
                        <button type="button" class="btn btn-primary btn-flat btn-lg mt-3" data-toggle="modal" data-target="#modaltambah">Tambah Data device</button>
                        <div class="col-lg-6 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Modal -->
                                    <div class="modal fade" id="modaltambah">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah Data device</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action='postmasterdevice.php'>
                                                    <div class="position-relative form-group">
                                                        <label for="examplePassword" class="">Kode Device</label>
                                                        <input name="kode_device" placeholder="ketik kode device disini..." type="text" class="form-control" required>
                                                    </div>
                                                    <div class="position-relative form-group">
                                                        <label for="examplePassword" class="">Serial Device</label>
                                                        <input name="serial_device" placeholder="ketik serial device disini..." type="text" class="form-control" required>
                                                    </div>
                                                    <div class="position-relative form-group">
                                                        <label for="examplePassword" class="">Hardware ID</label>
                                                        <input name="hardware_id" placeholder="ketik hardware id disini..." type="text" class="form-control" required>
                                                    </div>
                                                    <div class="position-relative form-group">
                                                        <label for="examplePassword" class="">Ipaddress</label>
                                                        <input name="ipaddress" placeholder="ketik ipaddress disini..." type="text" class="form-control" required>
                                                    </div>
                                                        <br>
                                                        <button class="mt-1 btn btn-primary" type="submit">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end modal form add master -->
                        <h4 class="header-title">Data Master device</h4>
                        <div class="data-tables">
                            <table id="example" class="table table-bordered table-striped dt-responsive nowrab" style="width:100%">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th class="text-left">No</th>
                                        <th class="text-left">Kode Device</th>
                                        <th class="text-left">Serial Device</th>
                                        <th class="text-left">Hrdware ID</th>
                                        <th class="text-left">Ipaddress</th>
                                        <th class="text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    foreach ($data as $row) :
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; $i++ ?></th>
                                        <td class="text-left"><?php echo $row["kode_device"]?></td>
                                        <td class="text-left"><?php echo $row["serial_device"] ?></td>
                                        <td class="text-left"><?php echo $row["hardware_id"] ?></td>
                                        <td class="text-left"><?php echo $row["ipaddress"]?></td>                                              
                                        <th>
                                            <form method="post">
                                                <button type="button" data-toggle="modal" class="btn btn-primary" name="iddevice" type="submit"  data-target=".modal-edit<?php echo $row["iddevice"]; ?>">Edit</button>
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>    
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js "></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script>
            $(document).ready(function() {
                var table = $('#example').DataTable( {
                    lengthChange: false,
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
<div class="modal fade modal-edit<?php echo $row['iddevice']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="editdevice.php">    
                        <input name="iddevice" value="<?php echo $row['iddevice'] ?>" style="display:none">
                        <div class="position-relative form-group"><label for="exampleEmail" class="">Kode Device</label>
                            <input name="kode_device" value="<?php echo $row['kode_device'] ?>" placeholder="ketik kode device disini..." type="text" class="form-control" required>
                        </div>
                        <div class="position-relative form-group">
                            <label for="examplePassword" class="">Serial Device</label>
                            <input name="serial_device" value="<?php echo $row['serial_device'] ?>" placeholder="ketik serial device disini..." type="text" class="form-control" required>
                        </div>
                        <div class="position-relative form-group">
                            <label for="examplePassword" class="">Hardware ID</label>
                            <input name="hardware_id" value="<?php echo $row['hardware_id'] ?>" placeholder="ketik hardware id disini..." type="text" class="form-control" required>
                        </div>
                        <div class="position-relative form-group">
                            <label for="examplePassword" class="">Serial Device</label>
                            <input name="ipaddress" value="<?php echo $row['ipaddress'] ?>" placeholder="ketik ipaddress device disini..." type="text" class="form-control" required>
                        </div>
                            <br>
                            <button class="mt-1 btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
            <!-- end madal edit -->
            <?php endforeach ?>