
<?php
require_once('master_validation.php');
include('lib/nangkoelib.php');
include('lib/zLib.php');
include('master_mainMenu.php');
?>

<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/tampil.js'></script>
<script language=javascript1.2 src='js/generic.js'></script>

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
      <section id="banner_parallax" class="slide_banner1">
         <div class="container">
           <div class="slide_cont">
            <!-- <div class="row">
               <div class="col-md-6">
                  <div class="full">
                     <div class="slide_cont"> -->
                       



                       
                        <?php  
                         echo "<table>";
                            echo "<tr>";
                               echo "<td>";
                                 echo "<table>";
                                  echo "<tr>";
                                     echo " <td align=center width='450px' class='active'><a href='pln_kontrak_form.php'><img src=images/kontrak1.png width='150px' height='120px' class=resicon caption='Input Kontrak'></a></td>";
                                     echo " <td align=center width='450px'><a href='pln_monitoring_kontrak.php'><img src=images/monitoring1.png width='150px' height='120px' class=resicon caption='monitoring'></a></td>";
                                     echo " <td align=center width='450px'><a href='pln_kelengkapan_berkas.php'><img src=images/kelengkapan.png width='150px' height='120px' class=resicon caption='kelengkapan'</a></td>";
                                  echo "</tr>";

                                  echo "<tr>";
                                   echo " <td align=center>Input Kontrak</td>";
                                   echo " <td align=center>Monitoring Kontrak</td>";
                                   echo " <td align=center>Kelengkapan Berkas Pembayaran</td>";
                                echo "</tr>";

                                echo "<tr>";
                                   echo " <td align=center>&nbsp;</td>";
                                echo "</tr>";
                                echo "<tr>";
                                   echo " <td align=center>&nbsp;</td>";
                                echo "</tr>";

                                echo "<tr>";
                                  echo " <td align=center><a href='pln_kontrak_form.php'><img src=images/setifikat.png width='150px' height='120px' class=resicon caption='setifikat'></a></td>";
                                  echo " <td align=center><a href='pln_kontrak_form.php'><img src=images/appdrawing.png width='150px' height='120px' class=resicon caption='appdrawing'></a></td>";
                               echo "</tr>";

                               echo "<tr>";
                                  echo " <td align=center>Sertifikat Laik Operasi</td>";
                                  echo " <td align=center>App Drawing</td>";
                               echo "</tr>";
                            echo "</table>";
                         echo "</td>";
                         echo " <td align=center><a href='pln_kontrak_form.php'><img src=images/orgpln.png width='150px' height='300px' class=resicon caption='appdrawing'></a></td>";
                         echo "<td>";

                         echo "</td>";
                      echo "</tr>";
                   echo "</table>";
                   
                   
               

                /*  echo "<footer>
                     <p><img src=images/garisbawah.png width='100%' height='70px' class=resicon caption='appdrawing'></p>
                  </footer>";*/

                ?>





                    </div>   
                
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