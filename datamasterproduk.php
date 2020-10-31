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

$produkget = curl("$url/produkcustom1"); // url untuk get produk
$jenisproduk = curl("$url/jenisproduk");
$lokasi = curl("$url/lokasi");
$device = curl("$url/device");
$kondisi = curl("$url/kondisi");

// mengubah JSON menjadi array
$datagetproduk = json_decode($produkget, TRUE);
$datajenisproduk = json_decode($jenisproduk, TRUE);
$datalokasi = json_decode($lokasi, TRUE);
$datadevice = json_decode($device, TRUE);
$datakondisi = json_decode($kondisi, TRUE);

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
            <div class="main-content-inner">
                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <!-- modal form add master -->
                                <button type="button" class="btn btn-primary btn-flat btn-lg mt-3" data-toggle="modal" data-target="#modaltambah">Tambah Data Produk</button>
                                <div class="col-lg-6 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Modal -->
                                            <div class="modal fade" id="modaltambah">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tambah Data Produk</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action='postmasterproduk.php'>
                                                                <div class="position-relative form-group">
                                                                    <label for="exampleSelect" class="">Jenis Produk</label>
                                                                    <select name="idjenis_produk" id="exampleSelect" class="form-control" required>
                                                                    <?php 
                                                                        foreach ($datajenisproduk as $rowjenisproduk) : ?>
                                                                        <option value="<?php echo $rowjenisproduk['idjenis_produk']; ?>"><?php echo $rowjenisproduk['nama']; ?></option>
                                                                    <?php endforeach; ?>
                                                                    </select>   
                                                                </div>
                                                                <div class="position-relative form-group">
                                                                    <label for="exampleSelect" class="">Lokasi</label>
                                                                    <select name="idlokasi" id="exampleSelect" class="form-control" required>
                                                                    <?php 
                                                                        foreach ($datalokasi as $rowlokasi) : ?>
                                                                        <option value="<?php echo $rowlokasi['idlokasi']; ?>"><?php echo $rowlokasi['nama_lokasi']; ?></option>
                                                                    <?php endforeach; ?>
                                                                    </select>   
                                                                </div> 
                                                                <div class="position-relative form-group">
                                                                    <label for="examplePassword" class="">Kode Kontainer</label>
                                                                    <input name="kode_kontainer" placeholder="ketik kode kontainer disini..." type="text" class="form-control" required>
                                                                </div>    
                                                                <div class="position-relative form-group">
                                                                    <label for="examplePassword" class="">Keterangan</label>
                                                                    <input name="keterangan" placeholder="ketik keterangan disini..." type="text" class="form-control" required>
                                                                </div>
                                                                <div class="position-relative form-group">
                                                                    <label for="examplePassword" class="">Gambar</label>
                                                                    <input name="gambar" value="-" type="text" class="form-control" readonly="readonly">
                                                                </div>
                                                                <div class="position-relative form-group">
                                                                    <label for="examplePassword" class="">Harga</label>
                                                                    <input name="harga" placeholder="ketik harga disini..." type="number" class="form-control" required>
                                                                </div>
                                                                <div class="position-relative form-group">
                                                                    <label for="exampleSelect" class="">Device</label>
                                                                    <select name="iddevice" id="exampleSelect" class="form-control" required>
                                                                    <?php 
                                                                        foreach ($datadevice as $rowdevice) : ?>
                                                                        <option value="<?php echo $rowdevice['iddevice']; ?>"><?php echo $rowdevice['kode_device']; ?></option>
                                                                    <?php endforeach; ?>
                                                                    </select>   
                                                                </div> 
                                                                <div class="position-relative form-group">
                                                                    <label for="exampleSelect" class="">Kondisi</label>
                                                                    <select name="idkondisi" id="exampleSelect" class="form-control" required>
                                                                    <?php 
                                                                        foreach ($datakondisi as $rowkondisi) : ?>
                                                                        <option value="<?php echo $rowkondisi['idkondisi']; ?>"><?php echo $rowkondisi['kondisi']; ?></option>
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
                                <h4 class="header-title">Data Master Jenis Produk</h4>
                                <div class="data-tables">
                                    <table id="example" class="table table-bordered table-striped dt-responsive nowrab" style="width:100%">
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                            <th class="text-left">No</th>
                                                <th class="text-left">Kode Kontainer</th>
                                                <th class="text-left">Jenis Produk</th>
                                                <th class="text-left">Harga</th>
                                                <th class="text-left">Lokasi</th>
                                                <th class="text-left">Kode Device</th>
                                                <th class="text-left">Ipaddress</th>
                                                <th class="text-left">Kondisi</th>
                                                <th class="text-left">Keterangan</th>
                                                <th class="text-left">Gambar</th>
                                                <th class="text-left">Upload Gambar</th>
                                                <th class="text-left">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            foreach ($datagetproduk as $rowgetproduk) :
                                            ?>
                                            <tr>
                                            <th scope="row"><?php echo $i; $i++ ?></th>
                                                <td class="text-left"><?php echo $rowgetproduk["kode_kontainer"]?></td>
                                                <td class="text-left"><?php echo $rowgetproduk["nama"]?></td>
                                                <td class="text-left"><?php echo $rowgetproduk["harga"]?></td>
                                                <td class="text-left"><?php echo $rowgetproduk["nama_lokasi"]?></td>
                                                <td class="text-left"><?php echo $rowgetproduk["kode_device"]?></td>
                                                <td class="text-left"><?php echo $rowgetproduk["ipaddress"]?></td>
                                                <td class="text-left"><?php echo $rowgetproduk["kondisi"]?></td>
                                                <td class="text-left"><?php echo $rowgetproduk["keterangan"] ?></td>
                                                <td style="text-align: center;"><img src="<?php echo $rowgetproduk['gambar']; ?>" style="width: 120px;"></td>
                                                <th>
                                                    <form method="post">
                                                            <button type="button" data-toggle="modal" class="btn btn-primary" name="idproduk" type="submit"  data-target=".modal-upload<?php echo $rowgetproduk["idproduk"]; ?>">Upload Gambar</button>
                                                    </form>
                                                </th>   
                                                <th>
                                                    <form method="post">
                                                        <button type="button" data-toggle="modal" class="btn btn-primary" name="idproduk" type="submit"  data-target=".modal-edit<?php echo $rowgetproduk["idproduk"]; ?>">Edit</button>
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
        foreach ($datagetproduk as $rowgetproduk) :
?>
<!-- modal edit form master -->
<div class="modal fade modal-edit<?php echo $rowgetproduk['idproduk']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form method="post" action="editproduk.php">    
                    <input name="idproduk" value="<?php echo $rowgetproduk['idproduk'] ?>" style="display:none">
                    <!-- combobox jenis produk -->
                    <div class="position-relative form-group">
                        <label for="exampleSelect" class="">Jenis Produk</label>
                        <select name="idjenis_produk" id="exampleSelect" class="form-control" required>
                        <?php 
                            $jenisprodukselect = "";
                            foreach ($datajenisproduk as $rowjenisproduk) :
                                if($rowgetproduk['idjenis_produk']==$rowjenisproduk['idjenis_produk'])
                                    $jenisprodukselect = "SELECTED";
                                else   
                                    $jenisprodukselect = "";
                        ?>
                            <option value="<?php echo $rowjenisproduk['idjenis_produk']; ?>" <?php echo $jenisprodukselect; ?>><?php echo $rowjenisproduk['nama']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="position-relative form-group">
                        <label for="exampleSelect" class="">Lokasi</label>
                        <select name="idlokasi" id="exampleSelect" class="form-control" required>
                        <?php 
                            $lokasiselect = "";
                            foreach ($datalokasi as $rowlokasi) :
                                if($rowgetproduk['idlokasi']==$rowlokasi['idlokasi'])
                                    $lokasiselect = "SELECTED";
                                else   
                                    $lokasiselect = "";
                        ?>
                            <option value="<?php echo $rowlokasi['idlokasi']; ?>" <?php echo $lokasiselect; ?>><?php echo $rowlokasi['nama_lokasi']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Kode Kontainer</label>
                        <input name="kode_kontainer" value="<?php echo $rowgetproduk['kode_kontainer'] ?>" placeholder="ketik kode kontainer disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Keterangan</label>
                        <input name="keterangan" value="<?php echo $rowgetproduk['keterangan'] ?>" placeholder="ketik keterangan disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Gambar</label>
                        <input name="gambar" value="<?php echo $rowgetproduk['gambar'] ?>" placeholder="ketik gambar disini..." type="text" class="form-control" readonly="readonly">
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Harga</label>
                        <input name="harga" value="<?php echo $rowgetproduk['harga'] ?>" placeholder="ketik harga disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="exampleSelect" class="">Device</label>
                        <select name="iddevice" id="exampleSelect" class="form-control" disabled>
                        <?php 
                            $deviceselect = "";
                            foreach ($datadevice as $rowdevice) :
                                if($rowgetproduk['iddevice']==$rowdevice['iddevice'])
                                    $deviceselect = "SELECTED";
                                else   
                                    $deviceselect = "";
                        ?>
                            <option value="<?php echo $rowdevice['iddevice']; ?>" <?php echo $deviceselect; ?>><?php echo $rowdevice['kode_device']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="position-relative form-group">
                        <label for="exampleSelect" class="">Kondisi</label>
                        <select name="idkondisi" id="exampleSelect" class="form-control" required>
                        <?php 
                            $kondisiselect = "";
                            foreach ($datakondisi as $rowkondisi) :
                                if($rowgetproduk['idkondisi']==$rowkondisi['idkondisi'])
                                    $kondisiselect = "SELECTED";
                                else   
                                    $kondisiselect = "";
                        ?>
                            <option value="<?php echo $rowkondisi['idkondisi']; ?>" <?php echo $kondisiselect; ?>><?php echo $rowkondisi['kondisi']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Status</label>
                        <select name="status" id="exampleSelect" class="form-control" required>
                        <option value="0" <?php echo $rowgetproduk['status']==0?'SELECTED':''; ?>>TIDAK AKTIF</option>
                        <option value="1" <?php echo $rowgetproduk['status']==1?'SELECTED':''; ?>>AKTIF</option>
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

            <?php
        foreach ($datagetproduk as $rowgetproduk) :
?>
<!-- modal upload gambar -->
<div class="modal fade modal-upload<?php echo $rowgetproduk['idproduk']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Gambar Jenis Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form method="post" action="uploadgambarproduk.php" enctype="multipart/form-data">    
                    <input name="idproduk" value="<?php echo $rowgetproduk['idproduk'] ?>" style="display:none">
                    <div class="position-relative form-group"><label for="exampleEmail" class="">Kode Kontainer</label>
                        <input value="<?php echo $rowgetproduk['kode_kontainer'] ?>" type="text" class="form-control" readonly="readonly">
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Keterangan</label>
                        <input value="<?php echo $rowgetproduk['keterangan'] ?>" type="text" class="form-control" readonly="readonly">
                    </div>
                    <div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Harga</label>
                        <input value="<?php echo $rowgetproduk['harga'] ?>" type="text" class="form-control" readonly="readonly">
                    </div>
                        <label>Gambar</label>
                        <img src="<?php echo $rowgetproduk['gambar']; ?>" style="width: 120px;float: left;margin-bottom: 5px;">
                        <input type="file" name="gambar" />
                        <i style="float: left;font-size: 11px;color: red">Ekstensi Yang Diperbolehkan 'JPG','jpg'</i>
                    </div>
                        <br>
                        <button class="mt-1 btn btn-primary" type="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
            <!-- end madal edit -->
            <?php endforeach ?>