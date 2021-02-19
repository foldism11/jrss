
<?php
require_once('../master_validation.php');
include('../lib/zLib2.php');
include('../master_mainMenu.php');
?>

<script language=javascript src=../js/zTools.js></script>
<script language=javascript1.2 src='../js/generic.js'></script>
<script language=javascript1.2 src='../js/calendar.js'></script>
<link rel="stylesheet" href="../style/generic.css" />
<script language=JavaScript1.2 src='../js/drag.js'></script>
<script language=JavaScript1.2 src='js/index.js'></script>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PT. OMEGA TRAININDO MANDIRI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="" name="descriptison">
  <meta content="" name="keywords">
  <link href="../assets/img/logoomega.jpg" rel="icon">
  <link href="../assets/img/logoomega.jpg" rel="logoomega">
  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <!-- Style untuk Loading -->
    <style>
        #loading{
      background: whitesmoke;
      position: absolute;
      top: 140px;
      left: 82px;
      padding: 5px 10px;
      border: 1px solid #ccc;
    }
    </style>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../indexadmin.php" class="nav-link"><b>Home</b></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../logout.php" class="nav-link"><b>Logout</b></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <li class="nav-item d-none d-sm-inline-block">
          <h9 class="logo mr-auto"><a href=""><img src="../assets/img/omega.png"></a></h9>
        </a>
</li>
      <!-- Notifications Dropdown Menu -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../images/logoomega.jpg"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><? echo $_SESSION['standard']['username']; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
     

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?

               $str=$owlPDO->query("select * from ".$dbname.".master_admin order by nourut asc");
               $str->setFetchMode(PDO::FETCH_OBJ);
               while($bar=$str->fetch())
               { 
                $nama=$bar->nama;
              
                $folder="../";
                $folder2="/import_csv/";

                $source=$folder.$bar->source;

                if ($bar->id=='5') {
                  $source=$folder2.$bar->source;
                }
               
                
                ?>


                <li class="nav-item has-treeview menu-open">
                  <a href="<? echo $source; ?>" class="nav-link active">
                    <i class="nav-icon fas fa-edit"></i>
                    <p><? echo $nama; ?></p>
                  </a>
                </li>

                <?  
              }

              ?>
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item has-treeview menu-open">
            <a href="masterkonten.php" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Master Konten
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="aksesuser.php" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Master Hak Akses User
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
         <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Master User
                <span class="right badge badge-danger"></span>
              </p>
            </a></li>
            <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Upload Sertifikat
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Jadwal Pelatihan
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li> -->
          
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-white">Upload Sertifikat</h4>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        
 <!-- /.card-body -->


          <div id="list" class="card">
              <div class="card-header">
                <h3 class="card-title">Data Hasil Import</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                          <a href="form.php" class="btn btn-success pull-right">
                            <span class="glyphicon glyphicon-upload"></span> Import Data
                          </a>
                          <hr>

                          <?php
                      
                   
                      $optstsreg=$optsttssertif=$optpelatihan="<option value=''>Seluruhnya</option>";
                      $arr= array('0' =>'Baru' ,'1' =>'On Progress','2' =>'Sudah Upload');
                      foreach ($arr as $key => $value) {
                        $optstsreg.="<option value='" . $key . "'>" . $value. "</option>";
                      }

                      $arr1= array('0' =>'Aktif' ,'2' =>'Kadaluarsa','3' =>'Akan Kadaluarsa');
                      foreach ($arr1 as $key => $value) {
                        $optsttssertif.="<option value='" . $key . "'>" . $value. "</option>";
                      }


                      $str = "select id,nama from " . $dbname . ".menu_pelatihan where status='1'";
                      $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                      $res->setFetchMode(PDO::FETCH_OBJ);
                      while ($bar = $res->fetch()) {
                        $optpelatihan.="<option value='" . $bar->id . "'>" . $bar->nama. "</option>";
                      }

                      $opttgl='';
                      $opttgl.="<option value=''>Pilih Data</option>";
                      $opttgl.="<option value='0'>Tanggal Terbit</option>";
                      $opttgl.="<option value='1'>Tanggal Kadaluarsa</option>";



               
                                echo"<table style='font-size:12px; width: 450px;' >";
                              

                         
                                echo"<tr height='46'>
                                        <th>Nama Pelatihan</th>
                                        <th></th>
                                        <td align='left'><select id=\"pelatihan\" name=\"pelatihan\" style='height:25px; width:300px;'>".$optpelatihan."</select></td>
                                        <td></td>
                                     </tr>";
                                echo"<tr height='46'>
                                        <th>Jenis Tanggal</th>
                                        <th></th>
                                        <td align='left'><select id=\"jns\" name=\"jns\" style='height:25px; width:300px;' onchange=tgl();>".$opttgl."</select></td>
                                        <td></td>
                                     </tr>";
                                echo"<tr hidden id='tgl1'>
                                        <th><span style='color: black'>Tanggal Terbit</span></th>
                                        <th></th>
                                        <td>";
                                             ?>

                                        <div class="form-group">
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="reservation" >
                                        </div>
                                        <!-- /.input group -->
                                        </div>
                                         

                               <?php
                               echo"</td>";
                               echo"</tr> ";  


                               echo"<tr hidden id='tgl2'>
                                        <th><span style='color: black'>Tanggal Kadaluarsa</span></th>
                                        <th></th>
                                        <td>";
                                             ?>

                                        <div class="form-group">
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="reservation2">
                                        </div>
                                        <!-- /.input group -->
                                        </div>
                                         

                               <?php
                               echo"</td>";
                               echo"</tr> ";  
                                    echo"</table>"; 
                                  echo"</td>";
                                 
                                echo"</tr>";
                                
                                echo"</table>";
                          echo"</td>";
                          for ($i=0; $i <8 ; $i++) { 
                            echo"<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                          }

                     echo" </table><br>";
                      
                      echo"<table>";
                      echo"<tr>
        
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-success' onclick=preview() >Tampilkan</button></td>
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-success' onclick=excel('event')>Download</button></td>
                      </tr>
                      </table>";

                         ?>
                         <br><br>
                          <!-- Buat sebuah div dan beri class table-responsive agar tabel jadi responsive -->
                          <div class="table-responsive">

                            <?php
                            echo"<table width=100% cellpading=1 cellspacing=1 border=1>
                            <br>
                

                            <tr bgcolor='#28a745' style='color: white'>
                            <td >No</td>
                            <td>No Sertikat</td>
                            <td>Nama Peserta</td>
                            <td>Pelatihan</td>
                            <td>Mulai Pelatihan</td>
                            <td>Selesai Pelatihan</td>
                            <td>Terbit Sertifikat</td>
                            <td>kadaluarsa</td>
                            <td>Tlp Peserta</td>
                            <td>Email Peserta</td>
                            <td>Nama Perusahaan</td>
                            <td>Tlp Perusahaan</td>
                            <td>Email Perusahaan</td>
                            </tr>
                        
                            <tbody id=container>";
                            echo"</tbody>
                            <tfoot id='footData'>
                            </tfoot>
                            </table>";

                            ?>               


                             <!--  <?php
                    // Load file koneksi.php
                             require_once('../config/connection.php');

                    // Buat query untuk menampilkan semua data siswa
                      $str = "select * from " . $dbname . ".registrasi  where tipe_registrasi='1' order by nosertifikat  ";
                      $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                      $n->setFetchMode(PDO::FETCH_ASSOC);
                      while ($d = $n->fetch()) {
                      @$no+=1;
                      $pelatihan = makeOption($dbname, 'menu_pelatihan','id,nama');
                      echo "<tr>";
                      echo "<td>".@$no."</td>";
                      echo "<td>".@$d['nosertifikat']."</td>";
                      echo "<td>".@$d['nama_peserta']."</td>";
                      echo "<td>".@$pelatihan[$d['nama_pelatihan']]."</td>";
                       echo "<td>".@$d['tanggal_pelatihan']."</td>";
                       echo "<td>".@$d['tanggal_pelatihan2']."</td>";
                      echo "<td>".@$d['terbit_sertifikat']."</td>";
                      echo "<td>".@$d['kadaluarsa']."</td>";
                      echo "<td>".@$d['telp_peserta']."</td>";
                      echo "<td>".@$d['email']."</td>";
                      echo "<td>".@$d['nama_perusahaan']."</td>";
                      echo "<td>".@$d['telp_perusahaan']."</td>";
                      echo "<td>".@$d['emailpt']."</td>";
                      echo "</tr>";
                    }
                    ?>
                  </table> -->
                </div>      


                
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
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page script -->

<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
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
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
     //Date range picker
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





