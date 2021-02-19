<?php
//@Copy nangkoelframework
require_once('master_validation.php');
include('lib/nangkoelib.php');
include('lib/zLib.php');


//echo open_body();
include('master_mainMenu.php');
?>

<script language=javascript src=js/zTools.js></script>
<script language=javascript1.2 src='js/tampil.js'></script>
<script language=javascript1.2 src='js/generic.js'></script>
<?php



echo "<table>";
echo "<tr>";
echo "<td width='300px'><img src=images/halamanutamapln.png width='100%' height='70px' class=resicon caption='appdrawing'></td>";
echo "<td width='1500px' align='right'><img src=images/logo_pln.png width='150px' height='120px' class=resicon caption='Input Kontrak'></td>";
echo "</tr>";
echo "</table>";


echo"<fieldset>
     <legend></legend>";
     echo "<table>";
	     echo "<tr>";
		     echo "<td>";
				echo "<table>";
				  echo "<tr>";
					  echo " <td align=center width='450px'><a href='pln_kontrak_form.php'><img src=images/kontrak.png width='150px' height='120px' class=resicon caption='Input Kontrak'></a></td>";
					  echo " <td align=center width='450px'><a href='pln_monitoring_kontrak.php'><img src=images/monitoring.png width='150px' height='120px' class=resicon caption='monitoring'></a></td>";
					  echo " <td align=center width='450px'><a href='pln_kontrak_form.php'><img src=images/kelengkapan.png width='150px' height='120px' class=resicon caption='kelengkapan'</a></td>";
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
 
      
echo "</fieldset>";

echo "<footer>
  <p><img src=images/garisbawah.png width='100%' height='70px' class=resicon caption='appdrawing'></p>
</footer>";

?>

