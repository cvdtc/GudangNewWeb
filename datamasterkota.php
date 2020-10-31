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

$profile = curl("$url/kota");
$provinsi = curl("$url/provinsi");

// mengubah JSON menjadi array
$data = json_decode($profile, TRUE);
$datap = json_decode($provinsi, TRUE);

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
                                <!-- modal form add master -->
                                <button type="button" class="btn btn-primary btn-flat btn-lg mt-3" data-toggle="modal" data-target="#modaltambah">Tambah Data kota</button>
                                <div class="col-lg-6 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Modal -->
                                            <div class="modal fade" id="modaltambah">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tambah Data Kota</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action='postmasterkota.php'>
                                                            <div class="position-relative form-group"><label for="exampleEmail" class="">Nama Kota</label>
                                                                <input name="nama_kota" placeholder="ketik nama kota disini..." type="text" class="form-control" required>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="examplePassword" class="">Keterangan</label>
                                                                <input name="keterangan" placeholder="ketik Keterangan disini..." type="text" class="form-control" required>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="exampleSelect" class="">Provinsi</label>
                                                                <select name="idprovinsi" id="exampleSelect" class="form-control" required>
                                                                <?php 
                                                                    foreach ($datap as $rowp) : ?>
                                                                    <option value="<?php echo $rowp['idprovinsi']; ?>"><?php echo $rowp['nama_provinsi']; ?></option>
                                                                <?php endforeach; ?>
                                                                </select>   
                                                            </div>     
                                                            <div class="position-relative form-group">
                                                                <label for="exampleSelect" class="">status</label>
                                                                <select name="status" id="exampleSelect" class="form-control" required>
                                                                <option value="1">Aktif</option>
                                                                <option value="0">Tidak Aktif</option>
                                                                </select>
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
                                <h4 class="header-title">Data Master Kota</h4>
                                <div class="data-tables">
                                    <table id="example" style="width:100%">
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <!-- <th class="text-left">No</th> -->
                                                <th class="text-left">Kota</th>
                                                <th class="text-left">Keterangan</th>
                                                <th class="text-left">Provinsi</th>
                                                <th class="text-left">Status</th>
                                                <th class="text-left">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            foreach ($data as $row) :
                                            ?>
                                            <tr>
                                                <!-- <th scope="row"><?php echo $i; $i++ ?></th> -->
                                                <td class="text-left"><?php echo $row["nama_kota"]?></td>
                                                <td class="text-left"><?php echo $row["keterangan"] ?></td>
                                                <td class="text-left"><h4><b><?php echo $row["provinsi"] ?></b></h4></td>
                                                <td class="text-left"><?php 
                                                if ($row["status"]==1){
                                                    echo 'Aktif';
                                                } else if ($row["status"]==0){
                                                    echo 'Tidak Aktif';
                                                } ?></td>
                                                <th>
                                                    <form method="post">
                                                        <button type="button" data-toggle="modal" class="btn btn-primary" name="idkota" type="submit"  data-target=".modal-edit<?php echo $row["idkota"]; ?>">Edit</button>
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
        </div>
        <!-- main content area end -->
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
                var groupColumn = 2;
                var table = $('#example').DataTable( {
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ALL"]],
                    buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
                    // order: [[0, 'asc']],
                    // rowGroup: {
                        // dataSrc: 0
                    // group columb
                "columnDefs": [
                        { "visible": false, "targets": groupColumn }
                    ],
                    "order": [[ groupColumn, 'asc' ]],
                    "displayLength": 25,
                    "drawCallback": function ( settings ) {
                        var api = this.api();
                        var rows = api.rows( {page:'current'} ).nodes();
                        var last=null;
            
                        api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                            if ( last !== group ) {
                                $(rows).eq( i ).before(
                                    '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                                );
            
                                last = group;
                            }
                        } );
                    }
                } );
                // group columb
                $('#example tbody').on( 'click', 'tr.group', function () {
                    var currentOrder = table.order()[0];
                    if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
                        table.order( [ groupColumn, 'desc' ] ).draw();
                    }
                    else {
                        table.order( [ groupColumn, 'asc' ] ).draw();
                    }
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
<div class="modal fade modal-edit<?php echo $row['idkota']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Kota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form method="post" action="editkota.php">    
                    <input name="idkota" value="<?php echo $row['idkota'] ?>" style="display:none">
                    <div class="position-relative form-group"><label for="exampleEmail" class="">Provinsi</label>
                        <input name="nama_kota" value="<?php echo $row['nama_kota'] ?>" placeholder="ketik kota disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Keterangan</label>
                        <input name="keterangan" value="<?php echo $row['keterangan'] ?>" placeholder="ketik keterangan disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="exampleSelect" class="">Provinsi</label>
                        <select name="idprovinsi" id="exampleSelect" class="form-control" required>
                        <?php 
                            $propinsiselect = "";
                            foreach ($datap as $rowp) :
                                if($row['idprovinsi']==$rowp['idprovinsi'])
                                    $propinsiselect = "SELECTED";
                                else   
                                    $propinsiselect = "";
                        ?>
                            <option value="<?php echo $rowp['idprovinsi']; ?>" <?php echo $propinsiselect; ?>><?php echo $rowp['nama_provinsi']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Status</label>
                        <select name="status" id="exampleSelect" class="form-control" required>
                        <option value="0" <?php echo $row['status']==0?'SELECTED':''; ?>>TIDAK AKTIF</option>
                        <option value="1" <?php echo $row['status']==1?'SELECTED':''; ?>>AKTIF</option>
                        </select>
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