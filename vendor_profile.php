
<?php
require_once('master_validation.php');
include('lib/nangkoelib.php');
include('lib/zLib.php');
include('master_mainMenu.php');
?>

<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/vendor_profile.js'></script>
<script language=javascript1.2 src='js/generic.js'></script>
<script language=javascript1.2 src='js/calendar.js'></script>
<link rel="stylesheet" href="style/generic.css" />
<script language=JavaScript1.2 src='js/drag.js'></script>


<!DOCTYPE html>
<html>
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
        <a href="logout.php" class="nav-link">Logout</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form hidden class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li hidden class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li hidden class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

       <li  class="nav-item dropdown">
        <div class="logo"><a href="indexx.php"><img src="images/bumn.png" width='200px' height="70px"/></a></div>
        
      </li>

      <li hidden class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin PBJ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          
          
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
            <h1>Profile PBJ</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

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

                  

                  $str = "select kode_vendor from " . $dbname . ".mst_vendor_pbj where kode_vendor='".$_SESSION['standard']['username']."'";
                  $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                  $res->setFetchMode(PDO::FETCH_OBJ);
                  while ($bar = $res->fetch()) {
                    $kdpbj=$bar->kode_vendor;
                  }

                  echo "<table style='font-size:12px; width: 500px;' >
                                 <tr>
                                <th>&nbsp;</th>
                                <th ><span style='color: black'>Kode PBJ</span></th>
                                <th>&nbsp;</th>
                                <th align='center'><input type=text class=myinputtext value=".$kdpbj." id=kodepbj name=kodepbj onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' / disabled></th>
                                <td>&nbsp;</td>
                                </tr>
                                <tr>
                                <th>&nbsp;</th>
                                <th ><span style='color: black'>Nama PBJ</span></th>
                                <th>&nbsp;</th>
                                <th align='center'><input type=text class=myinputtext id=namabpj name=namabpj onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' /></th>
                                <td>&nbsp;</td>
                                </tr>
                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: black'>Alamat PBJ</span></th>
                                <th>&nbsp;</th>
                                <th align='center'><input type=text class=myinputtext id=alamatbpj name=alamatbpj onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' /></th>
                                <td>&nbsp;</td>

                                </tr>
                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: black'>Email PBJ</span></th>
                                <th>&nbsp;</th>
                                <td align='center'><input type=text class=myinputtext value=".$_SESSION['standard']['mail']." id=emailbpj name=email onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;'  placeholder='Enter email'/></td>
                                <td>&nbsp;</td>
                                </tr>

                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: black'>No Telepon</span></th>
                                <th>&nbsp;</th>
                                <td align='center'><input type=text class=myinputtext id=tlpbpj name=tlpbpj onkeypress=\"return angka_doang(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td>    
                                </tr> 

                                 <tr>
                                <th>&nbsp;</th>
                                </tr>  
                                <tr>
                                <th>&nbsp;</th>
                                </tr>     


                                 <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: black'></span></th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                
                                 <th><span style='color: black'>Nama</span></th>  
                                <td>&nbsp;</td> 
                                  <th><span style='color: black'>No Telepon</span></th>   
                                <td>&nbsp;</td>  
                                <th><span style='color: black'>Email</span></th>   
                                </tr>

                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: black'>Struktur Organisasi</span></th>
                                <th>&nbsp;</th>
                                

                                <th><span style='color: black'>Direktur</span></th>
                                <td align='center'><input type=text class=myinputtext id=namadir name=namadir onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td> 
                                <td align='center'><input type=text class=myinputtext id=tlpdir name=tlpdir onkeypress=\"return angka_doang(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td>  
                                <td align='center'><input type=text class=myinputtext id=emaildir name=email onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' placeholder='Enter email'/></td>
                                </tr>



                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: black'>&nbsp;</span></th>
                                <th>&nbsp;</th>
                               

                                <th><span style='color: black'>Project Manager</span></th>
                               <td align='center'><input type=text class=myinputtext id=namamgr name=namamgr onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td> 
                                <td align='center'><input type=text class=myinputtext id=tlpmgr name=tlpmgr onkeypress=\"return angka_doang(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td>  
                                <td align='center'><input type=text class=myinputtext id=emailmgr name=email onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' placeholder='Enter email'/></td>
                                </tr>

                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: black'>&nbsp;</span></th>
                                <th>&nbsp;</th>
                                

                                <th><span style='color: black'>Pengawas Pekerjaan</span></th>
                                <td align='center'><input type=text class=myinputtext id=namapengawas name=namapengawas onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td> 
                                <td align='center'><input type=text class=myinputtext id=tlppengawas name=tlppengawas onkeypress=\"return angka_doang(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td>  
                                <td align='center'><input type=text class=myinputtext id=emailpengawas name=email onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' placeholder='Enter email'/></td>
                                </tr>

                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: black'>&nbsp;</span></th>
                                <th>&nbsp;</th>
                                  

                                <th><span style='color: black'>Pengawas K3</span></th>
                                <td align='center'><input type=text class=myinputtext id=nmpengawask3 name=nmpengawask3 onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td> 
                                <td align='center'><input type=text class=myinputtext id=tlppengawask3 name=tlppengawask3 onkeypress=\"return angka_doang(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td>  
                                <td align='center'><input type=text class=myinputtext id=emailpengawask3 name=email onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' placeholder='Enter email'/></td>
                                </tr>

                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: black'>&nbsp;</span></th>
                                <th>&nbsp;</th>
                               

                                <th><span style='color: black'>Bag. Administrasi</span></th>
                               <td align='center'><input type=text class=myinputtext id=nmadmin name=nmdmin onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td> 
                                <td align='center'><input type=text class=myinputtext id=tlpdmin name=tlpdmin onkeypress=\"return angka_doang(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td>  
                                <td align='center'><input type=text class=myinputtext id=emaildmin name=email onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' placeholder='Enter email'/></td>
                                </tr>

                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: black'>&nbsp;</span></th>
                                <th>&nbsp;</th>
                               

                                <th><span style='color: black'>Pelaksana Pekerjaan</span></th>
                                <td align='center'><input type=text class=myinputtext id=nmpp name=nmpp onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td> 
                                <td align='center'><input type=text class=myinputtext id=tlppp name=tlppp onkeypress=\"return angka_doang(event);\" style='height:25px; width:200px;' /></td>
                                <td>&nbsp;</td>  
                                <td align='center'><input type=text class=myinputtext id=emailpp name=email onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:200px;' placeholder='Enter email'/></td>
                                </tr>                                                                               
                         </table> <br><br>

                    <table>
                      <tr>
                         <input type=hidden value=insert id=method>
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=simpan() >Simpan</button></td>
                        <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=cancelIsi()>Batal</button></td>
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


          

       

        

       
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    
  </footer>

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
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
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





