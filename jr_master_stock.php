  <?php

  require_once('master_validation.php');
  require_once('config/connection.php');
  require_once('lib/nangkoelib.php');
  require_once('lib/zLib.php');
  include('master_mainMenu.php');


  
  ?>
<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/jr_master_stock.js'></script>
<script language=javascript1.2 src='js/generic.js'></script>
<script language=javascript1.2 src='js/calendar.js'></script>
<link rel="stylesheet" href="style/generic.css" />

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
         <a href="index1.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
         <a href="logout.php" class="nav-link">Logout</a>
      </li>
     
    </ul>



    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Master Stock Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <?php

  include('header.php');
  
  ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                 <!--  <label>Minimal</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select> -->
                  <?php
                    
                      @$optcabang=$optsupplier=$optbarang="<option value=''>Pilih Data</option>";
                

                    
                     

                      $strcabang = "select * from " . $dbname . ".mst_cabang where  status='1'";

                      $rescabang=$owlPDO->query($strcabang) or die(print " Gagal: ".PDOException::getMessage());
                      $rescabang->setFetchMode(PDO::FETCH_OBJ);
                      while ($barcabang = $rescabang->fetch()) {
                         
                            @$optcabang.="<option value='" . $barcabang->kode_cabang ."'>" . $barcabang->nama_cabang. " </option>";
                          
                          
                      }


                      $strsupplier = "select * from " . $dbname . ".mst_supplier where  status='1'";

                      $ressupplier=$owlPDO->query($strsupplier) or die(print " Gagal: ".PDOException::getMessage());
                      $ressupplier->setFetchMode(PDO::FETCH_OBJ);
                      while ($barsupplier = $ressupplier->fetch()) {
                         
                            @$optsupplier.="<option value='" . $barsupplier->kode_supplier ."'>" . $barsupplier->nama_supplier. " </option>";
                          
                          
                      }


                      $strbarang = "select * from " . $dbname . ".mst_barang where  status='1'";

                      $resbarang=$owlPDO->query($strbarang) or die(print " Gagal: ".PDOException::getMessage());
                      $resbarang->setFetchMode(PDO::FETCH_OBJ);
                      while ($barbarang = $resbarang->fetch()) {
                         
                            @$optbarang.="<option value='" . $barbarang->kode_barang ."'>" . $barbarang->nama_barang. " </option>";
                          
                          
                      }

                      



               
                                echo"<table style='font-size:12px; width: 450px;'>";

                                /* echo"<tr>
                                        <th>ID Barang</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=id name=id onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' / disabled></th>
                                        <td></td>
                                     </tr>";*/

                                 echo"<tr>
                                        <th>Cabang</th>
                                        <th></th>
                                        <td align='left'><select id=\"cabang\" name=\"cabang\" style='height:25px; width:400px;'>".$optcabang."</select></td>
                                        <td></td>
                                     </tr>";
                              
                              echo"<tr>
                                        <th>Supplier</th>
                                        <th></th>
                                        <td align='left'><select id=\"supp\" name=\"supp\" style='height:25px; width:400px;'>".$optsupplier."</select></td>
                                        <td></td>
                                     </tr>";

                              echo"<tr>                          
                                      <th>Faktur</th>
                                      <th></th>
                                      <th align='left'><input class='form-control filter' type=text class=myinputtext id=faktur name=faktur onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:400px;' /></th>
                                     </tr>";

                              echo"<tr>
                                        <th ><span style='color: black'>Tanggal Tiba</span></th>
                                        <td></td><td>";
                                        ?>

                                       
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                          <input  type="text" id="tgltiba" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                        </div>
                                       

                                        <?php
                                echo"</td>
                                     </tr>";      
                          
                                 echo"<tr>
                                        <th>Nama Barang</th>
                                        <th></th>
                                        <td align='left'><select id=\"brg\" name=\"brg\" style='height:25px; width:400px;'>".$optbarang."</select></td>
                                        <td></td>
                                     </tr>"; 


                                echo"<tr>                          
                                      <th valign=top>Deskripsi</th>
                                      <th></th>
                                      <td><textarea name=ket id=ket  onkeypress=\"return tanpa_kutip(event);\" rows='2' cols='20' style='width:400px;'></textarea></td>
                                     </tr>";

                              echo"<tr>
                                        <th>QTY (Pcs)</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=pcs name=pcs onkeypress=\"return angka_doang(event);\" style='height:25px; width:400px;' /></th>
                                        <td></td>
                                     </tr>";

                              echo"<tr>
                                        <th>QTY (Pack)</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=pack name=pack onkeypress=\"return angka_doang(event);\" style='height:25px; width:400px;' /></th>
                                        <td></td>
                                     </tr>";

                              echo"<tr>
                                        <th>Harga Jual</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=harga name=harga onkeypress=\"return angka_doang(event);\" style='height:25px; width:400px;' /></th>
                                        <td></td>
                                     </tr>";

                              echo"<tr>
                                        <th>Harga Beli</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=hargabeli name=hargabeli onkeypress=\"return angka_doang(event);\" style='height:25px; width:400px;' /></th>
                                        <td></td>
                                     </tr>";


                              echo"<tr>
                                        <th>Total Faktur</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=totfak name=totfak onkeypress=\"return angka_doang(event);\" style='height:25px; width:400px;' /></th>
                                        <td></td>
                                     </tr>";


                                 

                                echo"</table>";
                          echo"</td>";
                          for ($i=0; $i <8 ; $i++) { 
                            echo"<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                          }

                     echo" </table><br><br>";
                      
                      echo"<table>";
                      echo"<tr>
                         <input type=hidden value=insert id=method>
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-success' onclick=simpan() >Simpan</button></td>
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-success' onclick=cancelIsi()>Batal</button></td>
                      </tr>
                      </table>";

                         ?>
                    
                     

                </div>
               
              </div>
              
              </div>
      
            </div>


            
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Data</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                      echo"<table id='example1' class='table table-bordered table-striped'>
                      <br>
                  
                      <tr  style='background-color: #28a745;''>
                      <td>No</td>
                      <td>Cabang</td>
                      <td>Supplier</td>
                      <td>Nama Barang</td>
                      <td>Faktur</td>
                      <td>Tanggal Tiba</td>
                      <td>Nilai Faktur</td>
                      <td>QTY (Pcs)</td>
                      <td>QTY (Pcs)</td>
                      <td>Harga Beli</td>
                      <td>Harga Jual</td>
                      <td>Tot QTY Conv</td>
                      <td>Deskripsi</td>
                      <td colspan=2>Aksi</td>

                      </tr>
                   
                      <tbody id=container>";
                      echo"<script>loadData(0)</script>";
                      echo"</tbody>
                      <tfoot id='footData'>
                      </tfoot>
                      </table>";

                      ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.card -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
  include('footer.php');
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
      format: 'YYYY-MM-DD'
    });
    $('#reservationdate1').datetimepicker({
      format: 'YYYY-MM-DD'
    });
    $('#reservationdate2').datetimepicker({
      format: 'YYYY-MM-DD'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    $('#reservation1').daterangepicker()
    $('#reservation2').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
</body>
</html>
