  <?php

  require_once('master_validation.php');
  require_once('config/connection.php');
  require_once('lib/nangkoelib.php');
  require_once('lib/zLib.php');
  include('master_mainMenu.php');

  
  ?>
<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/jr_trx_beli.js'></script>
<script language=javascript1.2 src='js/generic.js'></script>
<script language=javascript1.2 src='js/calendar.js'></script>
<link rel="stylesheet" href="style/generic.css" />

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Advanced form elements</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <script type="text/javascript" src="assets/js/jquery-1.10.1.min.js"></script>
  <script type="text/javascript" src="assets/js/highcharts.js"></script>
  <script type="text/javascript" src="assets/js/exporting.js"></script>
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
     <?php
  include('logosamping.php');
  ?>
    
  </nav>
  <!-- /.navbar -->

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transaksi Pembelian</h1>
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

         <div class="card" id="index" style="display:block;">
                
                  <!-- /.card-header -->
            
                    <?php
                    echo "<table align=center>
                    <tr>
                    <td  style='cursor:pointer;'> <img src=images/adddata.png width='130px' height='100px'  caption='Buat Baru' onclick=buatbaru()></td>
                    <td  style='cursor:pointer;'> <img src=images/listdata.png width='130px' height='100px'  caption='List Data' onclick=listdata()></td>
                    <td  style='cursor:pointer;'> <img src=images/import.png width='130px' height='100px'  caption='List Data' onclick=upload()></td>
                    </tr>
                    <tr>
                    <td align=center>Buat Baru</td>
                    <td align=center>List Data</td>
                    <td align=center>Upload</td>
                    </tr>
                    </table>";

                    ?>             



      
                  <!-- /.card-body -->
          </div>

        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">

          
          <!-- /.card-header -->
          <div class="card-body"  id="header" style="display:none;">
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">



                 <div class="card-header">
                  <h3 class="card-title">Header</h3>
                </div><br>


                  <?php
                    
                      @$optbarang=$optsupp="<option value=''>Pilih Data</option>";
                

                      $strbarang = "select * from " . $dbname . ".mst_barang where  status='1' and cabang='".$_SESSION['standard']['cabang']."'";
                      $resbarang=$owlPDO->query($strbarang) or die(print " Gagal: ".PDOException::getMessage());
                      $resbarang->setFetchMode(PDO::FETCH_OBJ);
                      while ($barbarang = $resbarang->fetch()) {
                         
                            @$optbarang.="<option value='" . $barbarang->kode_barang ."'>" . $barbarang->nama_barang. " </option>";
                          
                          
                      }


                      $strcabang = "select * from " . $dbname . ".mst_cabang where  status='1' and kode_cabang='".$_SESSION['standard']['cabang']."'";
                      $rescabang=$owlPDO->query($strcabang) or die(print " Gagal: ".PDOException::getMessage());
                      $rescabang->setFetchMode(PDO::FETCH_OBJ);
                      while ($barcabang = $rescabang->fetch()) {
                         
                            @$optcabang.="<option value='" . $barcabang->kode_cabang ."'>" . $barcabang->nama_cabang. " </option>";
                          
                          
                      }

                      $strsupp = "select * from " . $dbname . ".mst_supplier where  status='1'";
                      $ressupp=$owlPDO->query($strsupp) or die(print " Gagal: ".PDOException::getMessage());
                      $ressupp->setFetchMode(PDO::FETCH_OBJ);
                      while ($barsupp = $ressupp->fetch()) {
                         
                            @$optsupp.="<option value='" . $barsupp->kode_supplier ."'>" . $barsupp->nama_supplier. " </option>";
                          
                          
                      }

                      /* $strfaktur = "select max(faktur) as faktur from " . $dbname . ".trx_jual limit 1";
                      $resfaktur=$owlPDO->query($strfaktur) or die(print " Gagal: ".PDOException::getMessage());
                      $resfaktur->setFetchMode(PDO::FETCH_OBJ);
                      while ($barfaktur = $resfaktur->fetch()) {
                         $faktur=$barfaktur->faktur;

                         if ($faktur=='') {
                           $faktur=$faktur+1;
                         }
                         else
                          {
                            $faktur+=1;
                          }

                           $faktur = str_pad($faktur, 10, "0", STR_PAD_LEFT);
                           
                          
                          
                      }*/






               
                                echo"<table style='font-size:12px; width: 450px;'>";
                                 echo"<tr>
                                        <th>Faktur</th>
                                        <th></th>
                                        <th align='left'><input disabled class='form-control filter' type=text class=myinputtext id=faktur name=faktur onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:350px;'></th>
                                        <td></td>
                                     </tr>";

                                  echo"<tr>
                                        <th>Cabang</th>
                                        <th></th>
                                        <td align='left' ><select disabled id=\"cabang\" name=\"cabang\" style='height:25px; width:350px;'>".$optcabang."</select></td>
                                        <td></td>
                                     </tr>";

                                   echo"<tr>
                                        <th>Supplier</th>
                                        <th></th>
                                        <td align='left' ><select id=\"supp\" name=\"supp\" onchange=\"getnofak()\" style='height:25px; width:350px;'>".$optsupp."</select></td>
                                        <td></td>
                                     </tr>";  

                             


                             echo"<tr>
                                        <th ><span style='color: black'>Tanggal Beli</span></th>
                                        <td></td><td>";
                                        ?>

                                       
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                          <input  type="text" id="tgl" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                        </div>
                                       

                                        <?php
                                echo"</td>
                                     </tr>";

                             echo"<tr>
                                        <th ><span style='color: black'>Tanggal Tiba</span></th>
                                        <td></td><td>";
                                        ?>

                                       
                                        <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                          <input  type="text" id="tgl2" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
                                          <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                        </div>
                                       

                                        <?php
                                echo"</td>
                                     </tr>";            

                             

                                echo"</table>";
                          echo"</td>";
                          for ($i=0; $i <8 ; $i++) { 
                            echo"<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                          }

                     echo" </table><br><br>";
                      
                      echo"<table>";
                      echo"<tr>
                   
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-success' onclick=simpanhead() >Lanjut</button></td>
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
          <div class="card" id="detail" style="display:none;">

             <div class="card-header">
                  <h3 class="card-title">Detail</h3>
                </div>
             
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                 echo"<table style='font-size:12px; width: 450px;'>";
                echo"<tr>
                <th>Nama Barang</th>
                <th></th>
                <td align='left' id=\"brgx\"><select id=\"brg\" name=\"brg\" class='form-control select2' style='height:35px; width:300px;' >".$optbarang."</select></td>
                <td align='left' hidden id=\"brg2x\"><select id=\"brg2\" name=\"brg2\"  style='height:35px; width:300px;' >".$optbarang."</select></td>
                </tr>"; 

                echo"<tr>
                <th>QTY PCS</th>
                <th></th>
                <th align='left'><input class='form-control filter' type=text class=myinputtext id=qtypcs name=qty onkeyup=\"z.numberFormat('qtypcs',2);\" onkeypress=\"return angka_doang(event);\" onchange=\"getjum();\"  style='height:25px; width:350px;' /></th>
                <td></td>
                </tr>"; 

                echo"<tr>
                <th>QTY Pack</th>
                <th></th>
                <th align='left'><input class='form-control filter' type=text class=myinputtext id=qtypack name=qtypack onkeyup=\"z.numberFormat('qtypack',2);\" onkeypress=\"return angka_doang(event);\" onchange=\"getjum();\"  style='height:25px; width:350px;' /></th>
                <td></td>
                </tr>"; 

                echo"<tr>
                <th>Harga Beli</th>
                <th></th>
                <th align='left'><input class='form-control filter' type=text class=myinputtext id=hargabeli name=hargabeli onkeyup=\"z.numberFormat('hargabeli',2);\" onkeypress=\"return angka_doang(event);\"  onchange=\"getjum();\" style='height:25px; width:350px;' /></th>
                <td></td>
                </tr>"; 


                echo"<tr>
                <th>Harga Jual</th>
                <th></th>
                <th align='left'><input class='form-control filter' type=text class=myinputtext id=hargajual name=hargajual onkeyup=\"z.numberFormat('hargajual',2);\" onkeypress=\"return angka_doang(event);\" style='height:25px; width:350px;' /></th>
                <td></td>
                </tr>"; 

                echo"<tr>
                <th>Jumlah (Rp)</th>
                <th></th>
                <th align='left'><input disabled class='form-control filter' type=text class=myinputtext id=jum name=jum onkeyup=\"z.numberFormat('jum',2);\" onkeypress=\"return angka_doang(event);\" style='height:25px; width:350px;' /></th>
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
                <td> <button  style='width:100px;' type='button' class='btn btn-block btn-success' onclick=simpan() >Tambah</button></td>
                <td> <button  style='width:100px;' type='button' class='btn btn-block btn-success' onclick=cancelIsidetail()>Batal</button></td>

                </tr>
                </table>";

                ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>



        <div class="card" id="headerlist" style="display:block;">
             
              <!-- /.card-header -->
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
                      <td>Faktur</td>
                      <td>Cabang</td>
                      <td>Supplier</td>
                      <td>Tanggal Beli</td>
                      <td>Tanggal Tiba</td>
                      <td>Tot Faktur (Rp)</td>
                      <td>Dibuat Oleh</td>
                      <td>Tanggal Transaksi</td>
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
            <!-- /.card -->
        </div>


        <div class="card" id="detaillist" style="display:none;">
              <div class="card-header">
                <h3 class="card-title">List Data Detail</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                      echo"<table id='example1' class='table table-bordered table-striped'>
                      <br>
                  
                      <tr  style='background-color: #28a745;''>
                      <td>No</td>
                      <td>Nama Barang</td>
                      <td>QTY PCS</td>
                      <td>QTY PACK</td>
                      <td>Harga Beli</td>
                      <td>Harga Jual</td>
                      <td>Total QTY</td>
                      <td colspan=2>Aksi</td>

                      </tr>
                   
                      <tbody id=containerdet>";
                     
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

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
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
      format: 'YYYY-MM-DD hh:mm:ss'
    });
    $('#reservationdate1').datetimepicker({
      format: 'YYYY-MM-DD hh:mm:ss'
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
