  <?php

  require_once('master_validation.php');
  require_once('config/connection.php');
  require_once('lib/nangkoelib.php');
  require_once('lib/zLib.php');
  include('master_mainMenu.php');

  
  ?>
<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/jr_master_akses.js'></script>
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
            <h1 class="m-0">Master Akses</h1>
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
                      #data nama penyedia barang dan jasa
                      $optuser="<option value=''>Pilih Data</option>";
                

                     /* $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                      foreach ($arr as $key => $value) {
                        $optstts.="<option value='" . $key . "'>" . $value. "</option>";
                      }*/

                       $struser = "select * from " . $dbname . ".user where  status='1'";

                      $resuser=$owlPDO->query($struser) or die(print " Gagal: ".PDOException::getMessage());
                      $resuser->setFetchMode(PDO::FETCH_OBJ);
                      while ($baruser = $resuser->fetch()) {
                         
                            @$optuser.="<option value='" . $baruser->namauser ."'>" . $baruser->namauser. " </option>";
                          
                          
                      }



               
                                echo"<table style='font-size:12px; width: 450px;'>";
                              
                               
                               

                                echo"<tr>
                                        <th>Nama User</th>
                                        <th></th>
                                        <td align='left'><select onchange=getdata('".$_SESSION['standard']['username']."') id=\"nama\" name=\"nama\" style='height:25px; width:300px;'>".$optuser."</select></td>
                                        <td></td>
                                     </tr>";



                                echo"</table>";
                          echo"</td>";
                          for ($i=0; $i <8 ; $i++) { 
                            echo"<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
                          }

                     echo" </table><br>";
                      
                    

                         ?>



                                     <!-- Sidebar Menu -->
                  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <!-- Add icons to the links using the .nav-icon class
                           with font-awesome or any other icon font library -->
                  <?
                    $str=$owlPDO->query("select a.source,a.nama,a.id,b.id as idx,b.subid,b.nama as subnama,b.konten,b.nourut,a.nourut from ".$dbname.".master_admin a left join ".$dbname.".menu_detail b on a.id=b.subid order by a.nourut,b.nourut asc");
                           $str->setFetchMode(PDO::FETCH_OBJ);
                           while($bar=$str->fetch())
                           { 

                            $nama[$bar->nama]=$bar->nama;
                            $id[$bar->nama]=$bar->id;
                            $subnamax[$bar->subnama]=$bar->subnama;
                            $nm[$bar->nama][$bar->subnama]=$bar->subnama;
                            $source[$bar->nama][$bar->subnama]=$bar->konten;
                            $id2[$bar->nama][$bar->subnama]=$bar->idx;

                            ?>

                               
                          <?

                           }


                           foreach ($nama as $nma) {
                              ?>
                               <input  type="checkbox" id="<? echo'check'.$id[$nma]; ?>" onchange=saveheader(<? echo "'$id[$nma]'" ?>)>
                              <li class="nav-item">
                                  <a href="#" class="nav-link">
                                   <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                      <? echo $nma; ?>
                                      <i class="fas fa-angle-left right"></i>
                                    </p>
                                  </a>

                                  <?
                                    foreach ($subnamax as $subnma) {
                                     if (@$nm[$nma][$subnma]!='') {
                                          ?>
                                         <ul class="nav nav-treeview">
                                         <li class="nav-item">
                                         <a class="nav-link">
                                          <input type="checkbox" id=" <? echo @$id2[$nma][$subnma]; ?>">
                                          
                                         <p> <? echo @$nm[$nma][$subnma]; ?></p>
                                         </a>
                                         </li>
                                         </ul>
                                         <?
                                     }

                                      
                                    }
                                      ?>

                                 
                                </li>

                           <?
                           }

                           echo"<table><br>";
                           echo"<tr>
                           <input type=hidden value=insert id=method>
                           <td> <button  style='width:100px;' type='button' class='btn btn-block btn-success' onclick=simpan() >Simpan</button></td>
                           <td> <button  style='width:100px;' type='button' class='btn btn-block btn-success' onclick=cancelIsi()>Batal</button></td>
                           </tr>
                           </table>";

                           ?>
                
                      
                      
                        
                    </ul>
                  </nav>
                     <!-- Sidebar Menu -->

                    
                     

                </div>
               
              </div>
              
              </div>
      
            </div>


            
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          
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
