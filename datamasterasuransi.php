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

$profile = curl("$url/asuransi");
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
    <!-- <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css"> -->
    <link rel="stylesheet" href="assets/css/export.css" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/daterangepicker.css" />
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
                                <!-- modal form add master -->
                                <button type="button" class="btn btn-primary btn-flat btn-lg mt-3" data-toggle="modal" data-target="#modaltambah">Tambah Data Asuransi</button>
                                <div class="col-lg-6 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Modal -->
                                            <div class="modal fade" id="modaltambah">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tambah Data Asuransi</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action='postmasterasuransi.php'>
                                                            <div class="position-relative form-group"><label for="exampleEmail" class="">Nama asuransi</label>
                                                                <input name="nama_asuransi" placeholder="ketik nama asuransi disini..." type="text" class="form-control" required>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="examplePassword" class="">Perusahaan</label>
                                                                <input name="perusahaan" placeholder="ketik perusahaan disini..." type="text" class="form-control" required>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="examplePassword" class="">Alamat</label>
                                                                <input name="alamat" placeholder="ketik alamat disini..." type="text" class="form-control" required>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="examplePassword" class="">Nilai</label>
                                                                <input name="nilai" placeholder="ketik nilai disini..." type="text" class="form-control" required>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="examplePassword" class="">Status</label>
                                                            <select name="status" id="exampleSelect" class="form-control" required>
                                                            <option value="1">Aktif</option>
                                                            <option value="0">Tidak Aktif</option>
                                                            </select>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="examplePassword" class="">Tanggal Kontrak Awal</label>
                                                                <input name="tanggal_kontrak_awal" type="date" class="form-control" required>
                                                            </div>
                                                            <div class="position-relative form-group">
                                                                <label for="examplePassword" class="">Tanggal Kontrak Akhir</label>
                                                                <input name="tanggal_kontrak_akhir" type="date" class="form-control" required>
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
                                <h4 class="header-title">Data Master Asuransi</h4>
                                <div class="data-tables">
                                <!-- <table id="example" class="table table-bordered table-striped dt-responsive nowrab" style="width:100%"> -->
                                <table id="example" class="display" style="width:100%">
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                            <th class="text-left">No</th>
                                                <th class="text-left">Nama Asuransi</th>
                                                <th class="text-left">Perusahaan</th>
                                                <th class="text-left">Alamat</th>
                                                <th class="text-left">Nilai</th>
                                                <th class="text-left">Status</th>
                                                <th class="text-left">Tanggal Kontrak Awal</th>
                                                <th class="text-left">Tanggal Kontrak Akhir</th>
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
                                                <td><?php echo $row["nama_asuransi"]?></td>
                                                <td><?php echo $row["perusahaan"] ?></td>
                                                <td><?php echo $row["alamat"] ?></td>
                                                <td><?php echo $row["nilai"] ?></td>
                                                <td><?php 
                                                if ($row["status"]==1){
                                                    echo "Aktif";
                                                } else if ($row["status"]==0){
                                                    echo "Tidak Aktif";
                                                } ?>
                                                </td>
                                                <!-- <td>php echo substr($row['tanggal_kontrak_awal'],0,10); </td> -->
                                                <td><?php $dt = strtotime($row['tanggal_kontrak_awal']); echo date("d/m/Y", $dt); ?></td>
                                                <td><?php $dt = strtotime($row['tanggal_kontrak_akhir']); echo date("d/m/Y", $dt); ?></td>
                                                <!-- <td> $dt = strtotime($row['tanggal_kontrak_akhir']); echo substr(date("m/d/Y", $dt),0,10); ?></td> -->
                                                <th>
                                                    <form method="post">
                                                        <button type="button" data-toggle="modal" class="btn btn-primary" name="idasuransi" type="submit"  data-target=".modal-edit<?php echo $row["idasuransi"]; ?>">Edit</button>
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
    <!-- <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script> -->

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
    <!--DateRangePicker -->
    <!-- <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->

<!-- java script search date range -->
<!-- <script type="text/javascript">  
   //fungsi untuk filtering data berdasarkan tanggal 
   var start_date;
   var end_date;
   var DateFilterFunction = (function (oSettings, aData, iDataIndex) {
      var dateStart = parseDateValue(start_date);
      var dateEnd = parseDateValue(end_date);
      //Kolom tanggal yang akan kita gunakan berada dalam urutan 6, karena dihitung mulai dari 0
      var evalDate= parseDateValue(aData[6]);
        if ( ( isNaN( dateStart ) && isNaN( dateEnd ) ) ||
             ( isNaN( dateStart ) && evalDate <= dateEnd ) ||
             ( dateStart <= evalDate && isNaN( dateEnd ) ) ||
             ( dateStart <= evalDate && evalDate <= dateEnd ) )
        {
            return true;
        }
        return false;
  });

  // fungsi untuk converting format tanggal dd/mm/yyyy menjadi format tanggal javascript menggunakan zona aktubrowser
  function parseDateValue(rawDate) {
      var dateArray= rawDate.split("/");
      var parsedDate= new Date(dateArray[2], parseInt(dateArray[1])-1, dateArray[0]);  // -1 because months are from 0 to 11   
      return parsedDate;
  }    

  $( document ).ready(function() {
  //konfigurasi DataTable pada tabel dengan id example dan menambahkan  div class dateseacrhbox dengan dom untuk meletakkan inputan daterangepicker
   var table = $('#example').DataTable({
    // lengthChange: false,
    // buttons: [ 'copy', 'excel', 'pdf', 'colvis' ] +
    "dom": "<'row'<'col-sm-4'l><'col-sm-5' <'datesearchbox'>><'col-sm-3'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>"
      
      
   });
//    var table1 = $('#example').DataTable( {
//             lengthChange: false,
//             buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
//         } );
//    table1.buttons().container()
//                     .appendTo( '#example_wrapper .col-md-6:eq(0)' );

   //menambahkan daterangepicker di dal2am datatables
   $("div.datesearchbox").html('<div class="input-group"> <div class="input-group-addon"> <i class="glyphicon glyphicon-calendar"></i> </div><input type="text" class="form-control pull-right" id="datesearch" placeholder="Search by date range.."> </div>');

   document.getElementsByClassName("datesearchbox")[0].style.textAlign = "right";

   //konfigurasi daterangepicker pada input dengan id datesearch
   $('#datesearch').daterangepicker({
      autoUpdateInput: false
    });

   //menangani proses saat apply date range
    $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
       $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
       start_date=picker.startDate.format('DD/MM/YYYY');
       end_date=picker.endDate.format('DD/MM/YYYY');
       $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
       table.draw();
    });
    //cancel mengembalikan tampilan datagrid data all 
    $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
      start_date='';
      end_date='';
      $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
      table.draw();
    });

      
        // table1.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
  });
//   $(document).ready(function() {
//                 var table = $('#example').DataTable( {
//                     lengthChange: false,
//                     buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
//                 } );
                // $dTable.buttons().container()
                //     .appendTo( '#example_wrapper .col-md-6:eq(0)' );
//             } );
// </script> -->
     <!-- others plugins -->
    <!-- <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script> -->
</body>
</html>

<?php
        foreach ($data as $row) :
?>
<!-- modal edit form master -->
<div class="modal fade modal-edit<?php echo $row['idasuransi']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data asuransi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="editasuransi.php">    
                    <input name="idasuransi" value="<?php echo $row['idasuransi'] ?>" style="display:none">
                    <div class="position-relative form-group"><label for="exampleEmail" class="">Nama Asuransi</label>
                        <input name="nama_asuransi" value="<?php echo $row['nama_asuransi'] ?>" placeholder="ketik nama asuransi disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Perusahaan</label>
                        <input name="perusahaan" value="<?php echo $row['perusahaan'] ?>" placeholder="ketik perusahaan disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Alamat</label>
                        <input name="alamat" value="<?php echo $row['alamat'] ?>" placeholder="ketik alamat disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Nilai</label>
                        <input name="nilai" value="<?php echo $row['nilai'] ?>" placeholder="ketik nilai disini..." type="text" class="form-control" required>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Status</label>
                        <select name="status" id="exampleSelect" class="form-control" required>
                        <option value="0" <?php echo $row['status']==0?'SELECTED':''; ?>>TIDAK AKTIF</option>
                        <option value="1" <?php echo $row['status']==1?'SELECTED':''; ?>>AKTIF</option>
                        </select>
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Tanggal Kontrak Awal</label>
                        <input type="date" name="tanggal_kontrak_awal" id="tanggal_kontrak_awal" class="form-control" value=
                        "<?php echo substr($row['tanggal_kontrak_awal'],0,10); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="examplePassword" class="">Tanggal Kontrak Akhir</label>
                        <input type="date" name="tanggal_kontrak_akhir" id="tanggal_kontrak_akhir" class="form-control" value=
                        "<?php echo substr($row['tanggal_kontrak_akhir'],0,10); ?>" required>
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