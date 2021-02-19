
<?php
require_once('master_validation.php');
include('lib/nangkoelib.php');
include('lib/zLib.php');
include('master_mainMenu.php');
?>

<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/pln_monitoring_kontrak.js'></script>
<script language=javascript1.2 src='js/generic.js'></script>
<link rel="stylesheet" href="style/generic.css" />
<script language=JavaScript1.2 src='js/drag.js'></script>



<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Auricle - The Multi-Purpose Responsive HTML5 Template</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icons -->
      <link rel="icon" href="images/fevicon/fevicon.png" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="css/style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- colors css -->
      <link rel="stylesheet" href="css/colors.css" />
      <!-- wow animation css -->
      <link rel="stylesheet" href="css/animate.css" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body id="default_theme" class="home_page1">
      <!-- header -->
      <header class="header header_style1">
         <div class="container">
            <div class="row">
               <div class="col-md-9 col-lg-10">
                  <div class="logo"><a href="indexx.php"><img src="images/bumn.png" width='50px' height="70px"/></a></div>
                  <div class="main_menu float-left">
                     <div class="menu">
                        <ul class="clearfix">
                           <li class="active"><a href="indexx.php">Home</a></li>
                           <li><a href="about.html">About</a></li>
                          
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-lg-2">
                <!--   <div class="right_bt"><a class="bt_main">Get Support</a></div> -->
               </div>
            </div>
         </div>
      </header>
      <section>
         <div class="container">
              
                      <?php
                      
                     $optjenkontrak="<option value=''>Seluruhnya</option>";
                       #data Jenis KOntrak
                      $strjenkontrak = "select kode_kontrak,nama_kontrak from " . $dbname . ".mst_jenis_kontrak_pln where status='1'";
                      $resjenkontrak=$owlPDO->query($strjenkontrak) or die(print " Gagal: ".PDOException::getMessage());
                      $resjenkontrak->setFetchMode(PDO::FETCH_OBJ);
                      while ($barjenkontrak = $resjenkontrak->fetch()) {
                        $optjenkontrak.="<option value='" . $barjenkontrak->kode_kontrak . "'>" . $barjenkontrak->nama_kontrak. "</option>";
                      }


                      echo"<fieldset>
                      <legend>&nbsp;</legend>
                      <table>
                      <th width='30px'><span></span></th>
                      <th colspan=7 align='right'><span style='color: white'>MONITORING KONTRAK</span></th>
                      <tr>
                      <th>&nbsp;</th>
                      <th><span style='color: white'>No Kontrak</span></th>
                      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th><input type=text class=myinputtext id=nokontrak name=nokontrak onkeypress=\"return tanpa_kutip(event);\" style=\"width:150px;\" /></th>
                      <td>&nbsp;</td>

                    

                      </tr>
                      <tr>
                      <th>&nbsp;</th>
                      <th><span style='color: white'>Judul Kontrak</span></th>
                         <th>&nbsp;</th>
                      <td><input type=text class=myinputtext id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" style=\"width:150px;\" /></td>
            
                      </tr>
                      <tr>
                      <th>&nbsp;</th>
                      <th><span style='color: white'>Tanggal Kontrak</span></th>
                         <th>&nbsp;</th><td>";
                      ?>

                      <form action="#" method="POST" name="forminputtanggal" enctype="multipart/form-data">

                        <input name="tgl_upload" id='tanggal' value="" size="8">&nbsp;<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.forminputtanggal.tgl_upload);return false;" ><img name="popcal" align="absmiddle" src="calender/calbtn.gif" width="34" height="22" border="0" alt=""></a>                   

                      </form>
                           <span style='color: white'> S/D </span>

                      <form action="#" method="POST" name="forminputtanggal1" enctype="multipart/form-data">
                        <input name="tgl_upload1" id='tanggal2' value="" size="8">&nbsp;<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.forminputtanggal1.tgl_upload1);return false;" ><img name="popcal" align="absmiddle" src="calender/calbtn.gif" width="34" height="22" border="0" alt=""></a>    
                      </form>

                      <iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
                      </iframe> 




                      <?php
                      echo "</td>
                      </tr>

                       <tr>
                       <th>&nbsp;</th>
                       <th><span style='color: white'>Jenis Kontrak</span></th>
                      <th>&nbsp;</th>
                      <td><select id=\"jeniskontrak\" name=\"jeniskontrak\" style='height:25px; width:150px;'>".$optjenkontrak."</select></td>
                
                      </tr>
                     

                      </table><br><br>
                       <div>
                       <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      <button class='field_bt' onclick=preview()>&nbsp; Tampilkan &nbsp;</button>  <br><br>
                      </fieldset> 
                       <div>";

                      ?>
                
         </div>
      </section>



      <section >
         <div class="container">
                          
                      <?php
                    
                      echo"<table class=sortable cellspacing=1 border=1>
                      <br>
                      <thead>
                      <tr class=rowheader>
                      <td>No</td>
                      <td>No Kontrak</td>
                      <td>Judul Kontrak</td>
                      <td>Tanggal Kontrak</td>
                      <td>Nama Vendor</td>
                      <td>Nilai Kontrak</td>
                      <td>Man UPT</td>
                      <td>Direksi Pekerjaan</td>
                      <td>Direksi Lapangan</td>
                      <td>Pengawas Lapangan</td>
                      <td>Direksi Vendor</td>
                      <td>WBS</td>
                      <td>Jenis Kontrak</td>
                      <td>Sifat Pekerjaan</td>
                      <td colspan=2>Aksi</td>

                      </tr>
                      </thead>
                      <tbody id=container>";
                      echo"<script>loadData(0)</script>";
                      echo"</tbody>
                      <tfoot id='footData'>
                      </tfoot>
                      </table>";

                      ?>             
                
         </div>
      </section>
      <!-- end header -->
      <!-- section -->
     
      <!-- end section -->
      <!-- section -->
      
      <!-- end section -->
      <!-- footer -->
      <footer class="footer_style_2">
        
         <!-- footer bottom -->
         <div class="footer_bottom">
            <p>Dessigned and developed by <strong>D.A</strong></p>
         </div>
      </footer>
      <!-- end footer -->
      <!--=========== js section ===========-->
      <!-- jQuery (necessary for Bootstrap's JavaScript) -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/wow.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <!-- google map js -->
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
      <!-- end google map js -->
   </body>
</html>

