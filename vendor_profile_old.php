
<?php
require_once('master_validation.php');
include('lib/nangkoelib.php');
include('lib/zLib.php');
include('master_mainMenu.php');
?>

<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/tampil.js'></script>
<script language=javascript1.2 src='js/generic.js'></script>
<script language=javascript1.2 src='js/calendar.js'></script>
<link rel="stylesheet" href="style/generic.css" />
<script language=JavaScript1.2 src='js/drag.js'></script>


<!-- CSS untuk bootstrap -->
 <link rel="stylesheet" href="dtp/css/bootstrap.css" type="text/css">
 <!-- CSS untuk bootstrap datetimepicker -->
 <link rel="stylesheet" href="dtp/css/bootstrap-datetimepicker.min.css" type="text/css">  




  <!-- js untuk jquery -->
 <script src="dtp/js/jquery-1.11.2.min.js"></script>
 <!-- js untuk bootstrap -->
 <script src="dtp/js/bootstrap.js"></script>
 <!-- js untuk moment -->
 <script src="dtp/js/moment.js"></script>
 <!-- js untuk bootstrap datetimepicker -->
 <script src="dtp/js/bootstrap-datetimepicker.min.js"></script>

 <script type="text/javascript">
  $(document).ready(function(){

    $('#dtp').datetimepicker({
     format : 'DD-MM-YYYY'
    });

     $('#dtp1').datetimepicker({
     format : 'DD-MM-YYYY'
    });

      $('#dtp2').datetimepicker({
     format : 'DD-MM-YYYY'
    });

    $('#dtp_icon').datetimepicker({
     format : 'DD/MM/YYYY'
    });

    $('#dtp_jam').datetimepicker({
     format : 'HH:mm'
    });

  });
 </script>




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
                      #data nama penyedia barang dan jasa
                      $optpenye=$optupt=$optdirpekerjaan=$optdirlap=$optpenglap=$optjenkontrak=$optsp=$opdirven="<option value=''>Pilih Data</option>";
                      $strpenye = "select kode_vendor,nama_vendor from " . $dbname . ".mst_vendor where status='1'";
                      $respenye=$owlPDO->query($strpenye) or die(print " Gagal: ".PDOException::getMessage());
                      $respenye->setFetchMode(PDO::FETCH_OBJ);
                      while ($barpenye = $respenye->fetch()) {
                        $optpenye.="<option value='" . $barpenye->kode_vendor . "'>" . $barpenye->nama_vendor. "</option>";
                      }

                      #data UPT
                      $strupt = "select kode_upt,nama_upt from " . $dbname . ".mst_upt where status='1'";
                      $resupt=$owlPDO->query($strupt) or die(print " Gagal: ".PDOException::getMessage());
                      $resupt->setFetchMode(PDO::FETCH_OBJ);
                      while ($barupt = $resupt->fetch()) {
                        $optupt.="<option value='" . $barupt->kode_upt . "'>" . $barupt->nama_upt. "</option>";
                      }

                      #data Dir Pekerjaan
                      $strdirpekerjaan = "select nik_dp,nama_dp from " . $dbname . ".mst_direksi_pekerjaan where status='1'";
                      $resdirpekerjaan=$owlPDO->query($strdirpekerjaan) or die(print " Gagal: ".PDOException::getMessage());
                      $resdirpekerjaan->setFetchMode(PDO::FETCH_OBJ);
                      while ($bardirpekerjaan = $resdirpekerjaan->fetch()) {
                        $optdirpekerjaan.="<option value='" . $bardirpekerjaan->nik_dp . "'>" . $bardirpekerjaan->nama_dp. "</option>";
                      }

                      #data Dir Lapangan
                      $strdirlap = "select nik_dl,nama_dl from " . $dbname . ".mst_direksi_lapangan where status='1'";
                      $resdirlap=$owlPDO->query($strdirlap) or die(print " Gagal: ".PDOException::getMessage());
                      $resdirlap->setFetchMode(PDO::FETCH_OBJ);
                      while ($bardirlap = $resdirlap->fetch()) {
                        $optdirlap.="<option value='" . $bardirlap->nik_dl . "'>" . $bardirlap->nama_dl. "</option>";
                      }

                      #data Jenis KOntrak
                      $strjenkontrak = "select kode_kontrak,nama_kontrak from " . $dbname . ".mst_jenis_kontrak where status='1'";
                      $resjenkontrak=$owlPDO->query($strjenkontrak) or die(print " Gagal: ".PDOException::getMessage());
                      $resjenkontrak->setFetchMode(PDO::FETCH_OBJ);
                      while ($barjenkontrak = $resjenkontrak->fetch()) {
                        $optjenkontrak.="<option value='" . $barjenkontrak->kode_kontrak . "'>" . $barjenkontrak->nama_kontrak. "</option>";
                      }


                      #data Sifat Pekerjaan
                      $strsp = "select kode_sp,nama_sp from " . $dbname . ".mst_sifat_pekerjaan where status='1'";
                      $ressp=$owlPDO->query($strsp) or die(print " Gagal: ".PDOException::getMessage());
                      $ressp->setFetchMode(PDO::FETCH_OBJ);
                      while ($barsp = $ressp->fetch()) {
                        $optsp.="<option value='" . $barsp->kode_sp . "'>" . $barsp->nama_sp. "</option>";
                      }

                      #data Pengawas Lapangan
                      $strpenglap = "select nik_pl,nama_pl from " . $dbname . ".mst_pengawas_lapangan where status='1'";
                      $respenglap=$owlPDO->query($strpenglap) or die(print " Gagal: ".PDOException::getMessage());
                      $respenglap->setFetchMode(PDO::FETCH_OBJ);
                      while ($barpenglap = $respenglap->fetch()) {
                        $optpenglap.="<option value='" . $barpenglap->nik_pl . "'>" . $barpenglap->nama_pl. "</option>";
                      }

                      #data Direktur Vendor
                      $str = "select nama_direktur from " . $dbname . ".mst_vendor where status='1'";
                      $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                      $res->setFetchMode(PDO::FETCH_OBJ);
                      while ($bar = $res->fetch()) {
                        $opdirven.="<option value='" . $bar->nama_direktur . "'>" . $bar->nama_direktur. "</option>";
                      }



                      echo"<fieldset>
                      <legend>&nbsp;</legend>
 
                        <table style='font-size:11px;'>
                                <th width='30px'><span></span></th>
                                <th colspan=7 align='right'><span style='color: white'>Profile BPJ</span></th>
                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: white'>Nama BPJ</span></th>
                                <th>&nbsp;</th>
                                <th align='center'><input type=text class=myinputtext id=namabpj name=namabpj onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></th>
                                <td>&nbsp;</td>
                                </tr>
                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: white'>Alamat BPJ</span></th>
                                <th>&nbsp;</th>
                                <th align='center'><input type=text class=myinputtext id=alamatbpj name=alamatbpj onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></th>
                                <td>&nbsp;</td>

                                </tr>
                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: white'>Email BPJ</span></th>
                                <th>&nbsp;</th>
                                <td align='center'><input type=text class=myinputtext id=emailbpj name=emailbpj onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td>
                                </tr>

                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: white'>No Telepon</span></th>
                                <th>&nbsp;</th>
                                <td align='center'><input type=text class=myinputtext id=tlpbpj name=tlpbpj onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
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
                                <th><span style='color: white'></span></th>
                                <th>&nbsp;</th>
                                <td align='center'>&nbsp;</td>
                                <td>&nbsp;</td>   

                                <th></th>
                                 <td>&nbsp;</td>  
                                 <th><span style='color: white'>Nama</span></th>  
                                <td>&nbsp;</td> 
                                  <th><span style='color: white'>No Telepon</span></th>   
                                <td>&nbsp;</td>  
                                <th><span style='color: white'>Email</span></th>   
                                </tr>

                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: white'>Struktur Organisasi</span></th>
                                <th>&nbsp;</th>
                                <td align='center'>&nbsp;</td>
                                <td>&nbsp;</td>   

                                <th><span style='color: white'>Direktur</span></th>
                                <th>&nbsp;</th>
                                <td align='center'><input type=text class=myinputtext id=namadir name=namadir onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td> 
                                <td align='center'><input type=text class=myinputtext id=tlpdir name=tlpdir onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td>  
                                <td align='center'><input type=text class=myinputtext id=emaildir name=emaildir onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                </tr>



                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: white'>&nbsp;</span></th>
                                <th>&nbsp;</th>
                                <td align='center'>&nbsp;</td>
                                <td>&nbsp;</td>   

                                <th><span style='color: white'>Project Manager</span></th>
                                <th>&nbsp;</th>
                               <td align='center'><input type=text class=myinputtext id=namamgr name=namamgr onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td> 
                                <td align='center'><input type=text class=myinputtext id=tlpmgr name=tlpmgr onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td>  
                                <td align='center'><input type=text class=myinputtext id=emailmgr name=emailmgr onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                </tr>

                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: white'>&nbsp;</span></th>
                                <th>&nbsp;</th>
                                <td align='center'>&nbsp;</td>
                                <td>&nbsp;</td>   

                                <th><span style='color: white'>Pengawas Pekerjaan</span></th>
                                <th>&nbsp;</th>
                                <td align='center'><input type=text class=myinputtext id=namapengawas name=namapengawas onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td> 
                                <td align='center'><input type=text class=myinputtext id=tlppengawas name=tlppengawas onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td>  
                                <td align='center'><input type=text class=myinputtext id=emailpengawas name=emailpengawas onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                </tr>

                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: white'>&nbsp;</span></th>
                                <th>&nbsp;</th>
                                <td align='center'>&nbsp;</td>
                                <td>&nbsp;</td>   

                                <th><span style='color: white'>Pengawas K3</span></th>
                                <th>&nbsp;</th>
                                <td align='center'><input type=text class=myinputtext id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td> 
                                <td align='center'><input type=text class=myinputtext id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td>  
                                <td align='center'><input type=text class=myinputtext id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                </tr>

                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: white'>&nbsp;</span></th>
                                <th>&nbsp;</th>
                                <td align='center'>&nbsp;</td>
                                <td>&nbsp;</td>   

                                <th><span style='color: white'>Bag. Administrasi</span></th>
                                <th>&nbsp;</th>
                               <td align='center'><input type=text class=myinputtext id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td> 
                                <td align='center'><input type=text class=myinputtext id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td>  
                                <td align='center'><input type=text class=myinputtext id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                </tr>

                                <tr>
                                <th>&nbsp;</th>
                                <th><span style='color: white'>&nbsp;</span></th>
                                <th>&nbsp;</th>
                                <td align='center'>&nbsp;</td>
                                <td>&nbsp;</td>   

                                <th><span style='color: white'>Pelaksana Pekerjaan</span></th>
                                <th>&nbsp;</th>
                                <td align='center'><input type=text class=myinputtext id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td> 
                                <td align='center'><input type=text class=myinputtext id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                <td>&nbsp;</td>  
                                <td align='center'><input type=text class=myinputtext id=judul name=judul onkeypress=\"return tanpa_kutip(event);\" style='height:25px; width:150px;' /></td>
                                </tr>                                                                               
                         </table> <br><br><br>


                       


                      <br><br>
                       <div>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      <input type=hidden value=insert id=method>
                      <button  onclick=simpan()><span style='color: black'>&nbsp; Simpan &nbsp;</span></button> 
                      &nbsp;
                      <button  onclick=cancelIsi()>&nbsp; Batal &nbsp;</button><br><br>
                      </fieldset> 
                       <div>";

                      ?>
                
         </div>
      </section>



      <section >
         <div class="container">
                          
                      <?php
                      echo"<table class=sortable cellspacing=1 border=1 width=100%>
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


 <!-- js untuk jquery -->
 <script src="dtp/js/jquery-1.11.2.min.js"></script>
 <!-- js untuk bootstrap -->
 <script src="dtp/js/bootstrap.js"></script>
 <!-- js untuk moment -->
 <script src="dtp/js/moment.js"></script>
 <!-- js untuk bootstrap datetimepicker -->
 <script src="dtp/js/bootstrap-datetimepicker.min.js"></script>




