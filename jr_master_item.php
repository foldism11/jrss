  <?php

  require_once('master_validation.php');
  require_once('config/connection.php');
  require_once('lib/nangkoelib.php');
  require_once('lib/zLib.php');
  include('master_mainMenu.php');

  
  ?>
<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/jr_master_item.js'></script>
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
            <h1 class="m-0">Master Item/Barang</h1>
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
                    
                      @$optsatuan=$optcabang=$optstts=$optretur="<option value=''>Pilih Data</option>";
                

                      $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                      foreach ($arr as $key => $value) {
                        $optstts.="<option value='" . $key . "'>" . $value. "</option>";
                      }

                      $arrx= array('0' =>'Retur' ,'1' =>'Tidak Retur' );
                      foreach ($arrx as $key => $valuex) {
                        $optretur.="<option value='" . $key . "'>" . $valuex. "</option>";
                      }


                      $strcabang = "select * from " . $dbname . ".mst_cabang where  status='1'";

                      $rescabang=$owlPDO->query($strcabang) or die(print " Gagal: ".PDOException::getMessage());
                      $rescabang->setFetchMode(PDO::FETCH_OBJ);
                      while ($barcabang = $rescabang->fetch()) {
                         
                            @$optcabang.="<option value='" . $barcabang->kode_cabang ."'>" . $barcabang->nama_cabang. " </option>";
                          
                          
                      }

                      $strsatuan = "select * from " . $dbname . ".mst_satuan where  status='1'";

                      $ressatuan=$owlPDO->query($strsatuan) or die(print " Gagal: ".PDOException::getMessage());
                      $ressatuan->setFetchMode(PDO::FETCH_OBJ);
                      while ($barsatuan = $ressatuan->fetch()) {
                         
                            @$optsatuan.="<option value='" . $barsatuan->nama_satuan ."'>" . $barsatuan->nama_satuan. " </option>";
                          
                          
                      }



               
                                echo"<table style='font-size:12px; width: 450px;'>";

                                 echo"<tr>
                                        <th>ID Barang</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=id name=id onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' / disabled></th>
                                        <td></td>
                                     </tr>";

                                 echo"<tr>
                                        <th>Cabang</th>
                                        <th></th>
                                        <td align='left'><select id=\"cabang\" name=\"cabang\" style='height:25px; width:300px;'>".$optcabang."</select></td>
                                        <td></td>
                                     </tr>";
                              
                          
                                 echo"<tr>
                                        <th>Nama Barang</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=nama name=nama onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                        <td></td>
                                     </tr>"; 

                                echo"<tr>
                                        <th>Satuan</th>
                                        <th></th>
                                        <td align='left'><select id=\"satuan\" name=\"satuan\" style='height:25px; width:300px;'>".$optsatuan."</select></td>
                                        <td></td>
                                     </tr>"; 

                                 echo"<tr>
                                        <th>Konvensi 1 Dus</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=konv name=konv onkeypress=\"return angka_doang(event);\" style='height:25px; width:300px;' /></th>
                                        <td></td>
                                     </tr>";

                                 echo"<tr>
                                        <th>Minimal Stock</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=min name=min onkeypress=\"return angka_doang(event);\" style='height:25px; width:300px;' /></th>
                                        <td></td>
                                     </tr>";  

                                echo"<tr>
                                        <th>Maksimal Stock</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=max name=max onkeypress=\"return angka_doang(event);\" style='height:25px; width:300px;' /></th>
                                        <td></td>
                                     </tr>";   

                              echo"<tr>
                                        <th>Retur</th>
                                        <th></th>
                                        <td align='left'><select id=\"retur\" name=\"retur\" style='height:25px; width:300px;'>".$optretur."</select></td>
                                        <td></td>
                                     </tr>";

                              echo"<tr hidden>
                                        <th>Maksimal Order</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=maxord name=maxord onkeypress=\"return angka_doang(event);\" style='height:25px; width:300px;' /></th>
                                        <td></td>
                                     </tr>";

                              echo"<tr>
                                        <th>Minimal Order</th>
                                        <th></th>
                                        <th align='left'><input class='form-control filter' type=text class=myinputtext id=minord name=minord onkeypress=\"return angka_doang(event);\" style='height:25px; width:300px;' /></th>
                                        <td></td>
                                     </tr>";

                                                          

                                 echo"<tr>                          
                                      <th valign=top>Deskripsi</th>
                                      <th></th>
                                      <td><textarea name=ket id=ket  onkeypress=\"return tanpa_kutip(event);\" rows='2' cols='20' style='width:300px;'></textarea></td>
                                     </tr>";

                                echo"<tr>
                                        <th>Status</th>
                                        <th></th>
                                        <td align='left'><select id=\"status\" name=\"status\" style='height:25px; width:300px;'>".$optstts."</select></td>
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
                      <td>Nama Barang</td>
                      <td>Satuan</td>
                      <td>Cabang</td>
                      <td>Konvensi 1 Dus</td>
                      <td>Min Stock</td>
                      <td>Max Stock</td>
                      <td>Retur</td>
                      <td>Min Order</td>
                      <td hidden>Max Order</td>
                      <td>Deskripsi</td>
                      <td>Status</td>
                      <td>Aksi</td>

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
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
