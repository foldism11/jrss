<?php
require_once('master_validation.php');
include('lib/nangkoelib.php');
include('lib/zLib.php');
include('master_mainMenu.php');
?>

<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/bpj_rencana_kerja.js'></script>
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
        <a href="indexxvendor.php" class="nav-link">Home</a>
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
      <span class="brand-text font-weight-light">Admin BPJ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
  
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-plus-square"></i>
              <p>
                Setup Master
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="setup_pbj.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PBJ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="setup_direktur_pbj.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Direktur</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="setup_manager_pbj.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manager</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="setup_pengawas_pbj.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengawas Pekerjaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="setup_pengawas_k3_pbj.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengawas K3</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="setup_bg_admin_pbj.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bag. Administrasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="setup_pelaksana_pekerjaan_pbj.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelaksana Pekerjaan</p>
                </a>
              </li>
            </ul>
            <li class="nav-item">
                <a href="bpj_rencana_kerja.php" class="nav-link active">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>Monitoring</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="undercontruction2.php" class="nav-link">
                  <i class="far fa-calendar-alt nav-icon"></i>
                  <p>Rencana Kerja</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="undercontruction2.php" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Pengajuan App Drawing</p>
                </a>
          </li>
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
            <h1>Monitoring Laporan Kerja</h1>
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

             
                  <?php

                      $opttk=$optkontrak=$optcuaca="<option value=''>Pilih Data</option>";
                      $frm = array('','','');
                      $date=date('yy-mm-dd');
                      #data Kontrak
                      $strkontrak = "select no_kontrak,noba,noamandemen1,sifatba from " . $dbname . ".input_kontrak_pln order by no_kontrak";
                      $reskontrak=$owlPDO->query($strkontrak) or die(print " Gagal: ".PDOException::getMessage());
                      $reskontrak->setFetchMode(PDO::FETCH_OBJ);
                      while ($barkontrak = $reskontrak->fetch()) {
                          $amd=substr($barkontrak->noamandemen1,2,1);
                          if ($amd=='') {
                            $amd='Baru';
                          }
                          else
                          {
                           $amd='AMD '.$amd;
                         }

                          @$optkontrak.="<option value='" . $barkontrak->no_kontrak . "##".$barkontrak->noamandemen1."'>" . $barkontrak->no_kontrak. " (".$amd.")</option>";
                      }

                      $cuaca = array('0' => 'Cerah','1' => 'Mendung','2' => 'Hujan');
                      foreach ($cuaca as $cc => $v) {
                        @$optcuaca.="<option value='" . $cc . "'>" . $v. "</option>";
                      }



                     


                      ?>
                        <div class="row">
                          <div class="col-12">
                            <!-- Custom Tabs -->
                            <div class="card">
                              <div class="card-header d-flex p-0">

                                <ul class="nav nav-pills ml-auto p-2">
                                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Laporan Kerja Harian</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Laporan Kerja Mingguan</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Laporan Kerja Bulanan</a></li>
                      
                                </ul>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                <div class="tab-content">
                                  <div class="tab-pane active" id="tab_1">


                                      <!-- HARIAN -->
                                    <div class="card" id="indexharian" style="display:block;">
                                      <div class="card-header">
                                        <h3 class="card-title"></h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="table-responsive">
                                        <?php
                                        echo "<table align=center>
                                        <tr>
                                        <td  style='cursor:pointer;'> <img src=images/adddata.png width='130px' height='100px'  caption='Buat Baru' onclick=buatbaruharian()></td>
                                        <td  style='cursor:pointer;'> <img src=images/listdata.png width='130px' height='100px'  caption='List Data' onclick=listdataharian()></td>
                                        </tr>
                                        <tr>
                                        <td align=center>Buat Baru</td>
                                        <td align=center>List Data</td>
                                        </tr>
                                        </table>";

                                        ?>             



                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->



                                     <div class="card" id="headerharian" style="display:none;">
                                      <div class="card-header">
                                        <h3 class="card-title"></h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="table-responsive">
                                        <?php
                                          echo "<table style='font-size:12px; width: 400px;' >
                                          <tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <td><H3><u>Header</u></H3></td>
                                          </tr>";

                                           echo "<tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <th>No Transaksi</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=notranshr name=notranshr onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr>";

                                          echo "<tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <th>No Kontrak</th>
                                          <th>&nbsp;</th>
                                          <td align='left'><select id=\"nokontrakhr\" name=\"nokontrakhr\" style='height:25px; width:300px;' onclick=getharian()>".$optkontrak."</select></td>
                                          </tr>";

                                          echo "<tr>
                                          <th></th>
                                          <th >Judul Kontrak</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=judulhr name=judulhr onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr>";

                                          echo "<tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <th>PBJ</th>
                                          <th>&nbsp;</th>
                                          <td align='left'><select disabled id=\"pbjhr\" name=\"pbjhr\" style='height:25px; width:300px;' ></select></td>
                                          </tr>";

                                         

                                          echo "<tr>
                                          <th></th>
                                          <th >Tanggal</th>
                                          <th>&nbsp;</th><td>";

                                             ?>

                                            
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input disabled type="text" id="tanggalhr" value=<? echo $date?> class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                          </div>
                                       

                                        <?php
                                          
                                          echo "</td></tr>";

                                          echo "<tr>
                                          <th></th>
                                          <th >Lokasi</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=lokasihr name=lokasihr onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr></table><br>";
                                         

                                          echo "<table>
                                          <tr>
                                          <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=lanjutharianht() >Next</button></td>
                                         
                                          </tr>
                                          </table><br>
                                          ";

                                        ?>             



                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->



                                    <div class="card" id="detailharian" style="display:none;">
                                      <div class="card-header">
                                        <h3 class="card-title"></h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="table-responsive">
                                        <?php
                                          echo "<table style='font-size:12px; width: 400px;' >
                                          <tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <td><H3><u>Detail</u></H3></td>
                                          </tr>
                                          

                                     

                                          <tr>
                                          <th></th>
                                          <th >Kegiatan</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text class=myinputtext id=keghr name=keghr onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr>

                                          <tr>
                                          <th></th>
                                          <th>Nama TK</th>
                                          <th>&nbsp;</th>
                                          <td align='left'><select id=\"tkhr\" name=\"tkhr\" style='height:25px; width:300px;'>".$opttk."</select></td>
                                          </tr>

                                          <tr>
                                          <th></th>
                                          <th >Material</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text class=myinputtext id=mathr name=mathr onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr>

                                          <tr>
                                          <th></th>
                                          <th >Peralatan</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text class=myinputtext id=alathr name=alathr onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr>

                                          <tr>
                                          <th></th>
                                          <th>Keterangan</th>
                                          <th>&nbsp;</th>
                                          <td align='left'><select id=\"kethr\" name=\"kethr\" style='height:25px; width:300px;'>".$optcuaca."</select></td>
                                          </tr>
                                          </table><br>

                                          


                                          <table>
                                          <tr>
                                          <input type=hidden value=inserthr id=methodhr>
                                          <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=simpanhr() >Simpan</button></td>
                                          <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=cancelhr()>Batal</button></td>
                                          </tr>
                                          </table><br>
                                          ";

                                        ?>             



                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->

                                 

                                    <!-- /.List data -->
                                   <div class="card" id="listheaderharian" style="display:block;">
                                    <div class="card-header">
                                      <h3 class="card-title">List Data</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                            <th>No</th>
                                            <th>No Kontrak</th>
                                            <th>Judul Kontrak</th>
                                            <th>PBJ</th>
                                            <th>Tanggal</th>
                                            <th>Lokasi</th>
                                            <th>Dibuat Oleh</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                            <th>Excel</th>
                                          </tr>
                                          </thead>
                                          <tbody id=containerharianht>
                                            <script>loadDatahr(0)</script>
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.card-body -->
                                    </div>


                                    <div class="card" id="listdetailharian" style="display:none;">
                                    <div class="card-header">
                                      <h3 class="card-title">List Data</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table border=1 width="100%" >
                                     
                                          <tr style='background-color: #007bff;'>
                                            <th>No</th>
                                            <th>Kegiatan</th>
                                            <th>Nama TK</th>
                                            <th>Material</th>
                                            <th>Peralatan</th>
                                            <th>Keterangan</th>
                                            <th colspan=2>Aksi</th>
                                          </tr>
                                     
                                          <tbody id=containerhariandt>
                                           
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.card-body -->
                                    </div>




                                  </div>
                                  <!-- /.tab-pane -->
                                  <div class="tab-pane" id="tab_2">
                                    <!-- /.MINGGUAN -->
                                   <div class="card" id="indexmingguan" style="display:block;">
                                      <div class="card-header">
                                        <h3 class="card-title"></h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="table-responsive">
                                        <?php
                                        echo "<table align=center>
                                        <tr>
                                        <td  style='cursor:pointer;'> <img src=images/adddata.png width='130px' height='100px'  caption='Buat Baru' onclick=buatbarumingguan()></td>
                                        <td  style='cursor:pointer;'> <img src=images/listdata.png width='130px' height='100px'  caption='List Data' onclick=listdatamingguan()></td>
                                        </tr>
                                        <tr>
                                        <td align=center>Buat Baru</td>
                                        <td align=center>List Data</td>
                                        </tr>
                                        </table>";

                                        ?>             



                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->

                                    <div class="card" id="headermingguan" style="display:none;">
                                      <div class="card-header">
                                        <h3 class="card-title"></h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="table-responsive">
                                        <?php
                                          echo "<table style='font-size:12px; width: 400px;' >
                                          <tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <td><H3><u>Header</u></H3></td>
                                          </tr>";


                                          echo "<tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <th>No Transaksi</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=notransmg name=notransmg onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr>";

                                          echo "<tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <th>No Kontrak</th>
                                          <th>&nbsp;</th>
                                          <td align='left'><select id=\"nokontrakmg\" name=\"nokontrakmg\" style='height:25px; width:300px;' onclick=getmingguan()>".$optkontrak."</select></td>
                                          </tr>";

                                          echo "<tr>
                                          <th></th>
                                          <th >Judul Kontrak</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=judulmg name=judulmg onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr>";

                                            echo "<tr>
                                          <th></th>
                                          <th >Nilai Kontrak</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=nilaikontrak name=nilaikontrak onkeypress=\"return tanpa_kutip(event);\"  style='height:25px; width:300px;' /></th>
                                          </tr>";


                                          echo "<tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <th>PBJ</th>
                                          <th>&nbsp;</th>
                                          <td align='left'><select disabled id=\"pbjmg\" name=\"pbjmg\" style='height:25px; width:300px;' ></select></td>
                                          </tr>";



                                         

                                          echo "<tr>
                                          <th></th>
                                          <th >Tanggal</th>
                                          <th>&nbsp;</th><td>";

                                             ?>

                                       
                                          <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                            <input type="text" id="tanggalmg" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
                                            <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                          </div>
                                       

                                        <?php
                                          
                                          echo "</td></tr>";

                                          echo "<tr>
                                          <th></th>
                                          <th >Lokasi</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=lokasimg name=lokasimg onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr>";

                                           echo "<tr>
                                          <th></th>
                                          <th >Minggu Ke</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text  class=myinputtext id=mingguke name=mingguke onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr></table><br>";
                                         

                                          echo "<table>
                                          <tr>
                                          <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=lanjutmingguanht() >Next</button></td>
                                         
                                          </tr>
                                          </table><br>
                                          ";

                                        ?>             



                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->



                                    <div class="card" id="detailmingguan" style="display:none;">
                                      <div class="card-header">
                                        <h3 class="card-title"></h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="table-responsive">
                                        <?php

                                        
                                         #data BOQ
                                        $strboq = "select kode_item,nama_item,no_transaksi from " . $dbname . ".mst_boq_dt_pbj order by kode_item";
                                        $resboq=$owlPDO->query($strboq) or die(print " Gagal: ".PDOException::getMessage());
                                        $resboq->setFetchMode(PDO::FETCH_OBJ);
                                        while ($barboq = $resboq->fetch()) {
                                          @$opturaian.="<option value='" . $barboq->kode_item . "'>" . $barboq->nama_item. "</option>";
                                        }




                                          echo "<table style='font-size:12px; width: 400px;' >
                                          <tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <td><H3><u>Detail</u></H3></td>
                                          </tr>
                                          

                                

                                          <tr>
                                          <th></th>
                                          <th>Uraian Pekerjaan</th>
                                          <th>&nbsp;</th>
                                          <td align='left'><select id=\"uraian\" name=\"uraian\" onchange=\"getharsat();\" style='height:25px; width:300px;'>".$opturaian."</select></td>
                                          </tr>

                                          <tr>
                                          <th></th>
                                          <th >Harga Satuan</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=harsat name=harsat onkeyup=\"z.numberFormat('harsat',2);\" onchange=\"getjummg();\" style='height:25px; width:300px;' /></th>
                                          </tr>

                                          <tr>
                                          <th></th>
                                          <th >Volume</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text class=myinputtext id=vol name=vol onkeyup=\"z.numberFormat('vol',2);\" onchange=\"getjummg();\" style='height:25px; width:300px;' /></th>
                                          </tr>

                                          <tr>
                                          <th></th>
                                          <th >Jumlah</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=jum name=jum onkeyup=\"z.numberFormat('jum',2);\" onchange=\"getjummg();\" style='height:25px; width:300px;' /></th>
                                          </tr>


                                          <tr>
                                          <th></th>
                                          <th >Bobot</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=bobot name=bobot onkeyup=\"z.numberFormat('bobot',2);\" onchange=\"getjummg();\" style='height:25px; width:300px;' /></th>
                                          </tr>

                                        
                                          </table><br>

                                          


                                          <table>
                                          <tr>
                                          <input type=hidden value=insertmg id=methodmg>
                                          <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=simpanmg() >Simpan</button></td>
                                          <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=cancelmg()>Batal</button></td>
                                          </tr>
                                          </table><br>
                                          ";

                                        ?>             



                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->

                                 

                                    <!-- /.List data -->
                                   <div class="card" id="listheadermingguan" style="display:block;">
                                    <div class="card-header">
                                      <h3 class="card-title">List Data</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table id="example1x" class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                            <th>No</th>
                                            <th>No Transakasi</th>
                                            <th>No Kontrak</th>
                                            <th>No Amandemen</th>
                                            <th>Judul Kontrak</th>
                                            <th>PBJ</th>
                                            <th>Tanggal</th>
                                            <th>Lokasi</th>
                                            <th>Minggu Ke</th>
                                            <th>Dibuat Oleh</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                            <th>Excel</th>
                                          </tr>
                                          </thead>
                                          <tbody id=containermingguanht>
                                          
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.card-body -->
                                    </div>



                                    <div class="card" id="listdetailmingguan" style="display:none;">
                                    <div class="card-header">
                                      <h3 class="card-title">List Data</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table border=1 width="100%" >
                                     
                                          <tr style='background-color: #007bff;'>
                                            <th>No</th>
                                            <th>Uraian Pekerjaan</th>
                                            <th>Volume</th>
                                            <th>Jumlah</th>
                                            <th>Bobot</th>
                                            <th colspan=2>Aksi</th>
                                          </tr>
                                     
                                          <tbody id=containermingguandt>
                                           
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.card-body -->
                                    </div>

                                    <!-- /.tutup mingguan -->
                                  </div>



                                  <!-- /.tab-pane -->
                                  <div class="tab-pane" id="tab_3">
                                       <!-- /.Bulanan -->
                                   <div class="card" id="indexbulanan" style="display:block;">
                                      <div class="card-header">
                                        <h3 class="card-title"></h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="table-responsive">
                                        <?php
                                        echo "<table align=center>
                                        <tr>
                                        <td  style='cursor:pointer;'> <img src=images/adddata.png width='130px' height='100px'  caption='Buat Baru' onclick=buatbarubulanan()></td>
                                        <td  style='cursor:pointer;'> <img src=images/listdata.png width='130px' height='100px'  caption='List Data' onclick=listdatabulanan()></td>
                                        </tr>
                                        <tr>
                                        <td align=center>Buat Baru</td>
                                        <td align=center>List Data</td>
                                        </tr>
                                        </table>";

                                        ?>             



                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->

                                    <div class="card" id="headerbulanan" style="display:none;">
                                      <div class="card-header">
                                        <h3 class="card-title"></h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="table-responsive">
                                        <?php
                                          echo "<table style='font-size:12px; width: 400px;' >
                                          <tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <td><H3><u>Header</u></H3></td>
                                          </tr>";


                                          echo "<tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <th>No Transaksi</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=notransbl name=notransbl onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr>";

                                          echo "<tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <th>No Kontrak</th>
                                          <th>&nbsp;</th>
                                          <td align='left'><select id=\"nokontrakbl\" name=\"nokontrakbl\" style='height:25px; width:300px;' onclick=getbulanan()>".$optkontrak."</select></td>
                                          </tr>";

                                          echo "<tr>
                                          <th></th>
                                          <th >Judul Kontrak</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=judulbl name=judulbl onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr>";

                                            echo "<tr>
                                          <th></th>
                                          <th >Nilai Kontrak</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=nilaikontrakbl name=nilaikontrakbl onkeypress=\"return tanpa_kutip(event);\"  style='height:25px; width:300px;' /></th>
                                          </tr>";


                                          echo "<tr>
                                          <th>&nbsp;&nbsp;&nbsp;</th>
                                          <th>PBJ</th>
                                          <th>&nbsp;</th>
                                          <td align='left'><select disabled id=\"pbjbl\" name=\"pbjbl\" style='height:25px; width:300px;' ></select></td>
                                          </tr>";



                                         

                                          echo "<tr>
                                          <th></th>
                                          <th >Tanggal</th>
                                          <th>&nbsp;</th><td>";

                                             ?>

                                       
                                          <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                            <input type="text" id="tanggalbl" class="form-control datetimepicker-input" data-target="#reservationdate2"/>
                                            <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                          </div>
                                       

                                        <?php
                                          
                                          echo "</td></tr>";

                                          echo "<tr>
                                          <th></th>
                                          <th >Lokasi</th>
                                          <th>&nbsp;</th>
                                          <th align='left'><input type=text disabled class=myinputtext id=lokasibl name=lokasibl onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:300px;' /></th>
                                          </tr>";

                                          echo "</table><br>";
                                         

                                          echo "<table>
                                          <tr>
                                          <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=lanjutbulananht() >Next</button></td>
                                         
                                          </tr>
                                          </table><br>
                                          ";

                                        ?>             



                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->



                                    <div class="card" id="detailbulanan" style="display:none;">
                                      <div class="card-header">
                                        <h3 class="card-title"></h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="table-responsive">
                                        <?php

                                        
                                         #data BOQ
                                        $strboq = "select kode_item,nama_item,no_transaksi from " . $dbname . ".mst_boq_dt_pbj order by kode_item";
                                        $resboq=$owlPDO->query($strboq) or die(print " Gagal: ".PDOException::getMessage());
                                        $resboq->setFetchMode(PDO::FETCH_OBJ);
                                        while ($barboq = $resboq->fetch()) {
                                          @$opturaian.="<option value='" . $barboq->kode_item . "'>" . $barboq->nama_item. "</option>";
                                        }




                                          echo "<table style='font-size:12px; width: 400px;' >
                                          <tr>
                                          <th>&nbsp;</th>
                                          <td><H3><u>Detail</u></H3></td>
                                          </tr>
                                                                       
                                          </table>";

                                          echo "
                                          <div id=detailbulan>
                                          
                                          </div>
                                        ";

                                         

                                        ?>             



                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->

                                 

                                    <!-- /.List data -->
                                   <div class="card" id="listheaderbulanan" style="display:block;">
                                    <div class="card-header">
                                      <h3 class="card-title">List Data</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table id="example1y" class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                            <th>No</th>
                                            <th>No Transakasi</th>
                                            <th>No Kontrak</th>
                                            <th>No Amandemen</th>
                                            <th>Judul Kontrak</th>
                                            <th>PBJ</th>
                                            <th>Tanggal</th>
                                            <th>Lokasi</th>
                                            <th>Bulan Ke</th>
                                            <th>Dibuat Oleh</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                          </tr>
                                          </thead>
                                          <tbody id=containerbulananht>
                                          
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.card-body -->
                                    </div>



                                    <div class="card" id="listdetailbulanan" style="display:none;">
                                    <div class="card-header">
                                      <h3 class="card-title">List Data</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table border=1 width="100%" >
                                     
                                          <tr style='background-color: #007bff;'>
                                            <th>No</th>
                                            <th>Uraian Pekerjaan</th>
                                            <th>Volume</th>
                                            <th>Jumlah</th>
                                            <th>Bobot</th>
                                            <th colspan=2>Aksi</th>
                                          </tr>
                                     
                                          <tbody id=containerbulanandt>
                                           
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.card-body -->
                                    </div>

                                    <!-- /.tutup Bulanan -->

                                  </div>
                                  <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                              </div><!-- /.card-body -->
                            </div>
                            <!-- ./card -->
                          </div>
                          <!-- /.col -->
                        </div>


                </div>
               
              </div>
              
              </div>
      
            </div>


            
            <!-- /.row -->
          </div>
          <div class="card-footer">
            Visit <a href="index2.php">PLN</a> for more information.
          </div>
 <!-- /.card-body -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
  <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2020 Dhuha Berkah Maju Jaya</strong> All rights
    reserved.
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

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#example1x").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#example1y").DataTable({
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