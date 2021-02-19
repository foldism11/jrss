<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$cabang=checkPostGet('cabang','');
$tanggal=checkPostGet('tanggal','');
$tanggal2=checkPostGet('tanggal2','');
$brg=checkPostGet('brg','');
$faktur=checkPostGet('faktur','');

$tgl1=explode('/', $tanggal);
$tgl2=explode('/', $tanggal2);
@$tanggal=$tgl1[2].'-'.$tgl1[0].'-'.$tgl1[1];
@$tanggal2=$tgl2[2].'-'.$tgl2[0].'-'.$tgl2[1];
@$tanggal2=str_replace(' ', '', $tanggal2);



$method=checkPostGet('method','');
switch ($method) {

     case'tampilkan':

     if ($cabang!='') {
     	$where=" and cabang='".$cabang."'";
     }
       if ($brg!='') {
     	$where.=" and kode_barang='".$brg."'";
     }

     $str = "select * from " . $dbname . ".trx_atk where 1=1 ".$where." and  substr(createtime,1,10) between '".$tanggal."' and '".$tanggal2."' order by cabang";
     $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
     $n->setFetchMode(PDO::FETCH_ASSOC);
     while ($d = $n->fetch()) {

      $datafakturx[$d['cabang']][$d['faktur']]=1;
      $datafaktur[$d['cabang']][$d['faktur']]=$d['faktur'];
      @$datarupiah[$d['cabang']][$d['faktur']]+=$d['totalrp'];



     }

 foreach ($datafaktur as $cbg => $value) {
   foreach ($value as $faktur => $value2) {

      @$rows[$cbg]+=$datafakturx[$cbg][$faktur];
   }

  }  

$tab='';


  foreach ($datafaktur as $cbg => $value) {
    $row=$rows[$cbg]+1;

    $optcabang=makeOption($dbname,'mst_cabang','kode_cabang,nama_cabang',"kode_cabang='".$cbg."'");
    $no+=1;
    $tab.="<tr class=rowcontent>";

    $tab.="<td rowspan=".$row." align=center>" . $no . "</td>";  
    $tab.="<td rowspan=".$row." align=left>" . $optcabang[$cbg] . "</td>"; 


    foreach ($value as $faktur => $value2) {
          $tab.="<tr class=rowcontent style='cursor:pointer;' title='Click untuk melihat detail' onclick=\"lihatDetail('".$datafaktur[$cbg][$faktur]."',event);\">";
          $tab.="<td align=right>" . $datafaktur[$cbg][$faktur] . "</td>"; 
          $tab.="<td align=right>" . number_format($datarupiah[$cbg][$faktur]) . "</td>"; 

         @$totrp+=$datarupiah[$cbg][$faktur];


    }

    $tab.="<tr class=rowcontent>";
    $tab.="<td colspan=3 align=center>Sub Total</td>";  
    $tab.="<td align=right>" . number_format($totrp) . "</td>";  
    $tab.="</tr>"; 
                 
      @$gtot+=$totrp; 
                  
  } 

  $tab.="<tr class=rowcontent>";
  $tab.="<td colspan=3 align=center>Grand Total</td>";  
  $tab.="<td align=right>" . number_format($gtot) . "</td>";  
  $tab.="</tr>"; 
  
    	$tab.="</tr>"; 

    echo $tab;

  break;
	   
     case'detail':
     $tab='';
     $tab.="<table border=1 width=100%>
     <br>

     <tr  style='background-color: #28a745;'>
     <td>No</td>
     <td>Nama Barang</td>
     <td>Harga</td>
     <td>Qty</td>
     <td>Jumlah Rp</td>
     </tr>";

     $str = "select * from " . $dbname . ".trx_atk where 1=1 and faktur='".$faktur."' order by cabang";
     $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
     $n->setFetchMode(PDO::FETCH_ASSOC);
     while ($d = $n->fetch()) {
      $no+=1;
      $tab.="<tr class=rowcontent>";
      $tab.="<td>".$no."</td>";
      $tab.="<td>".$d['barang']."</td>";
      $tab.="<td align=right>" . number_format($d['harga']). "</td>";
      $tab.="<td align=right>" . number_format($d['qty']). "</td>";
      $tab.="<td align=right>" . number_format($d['totalrp']). "</td>";
      $tab.="</tr>";

      @$totrp+=$d['totalrp'];
     }
     $tab.="<tr class=rowcontent>";
     $tab.="<td colspan=4>Total Rp</td>";
     $tab.="<td align=right>".number_format($totrp)."</td>";
     $tab.="</tr>";




     $tab.="</tbody>
     <tfoot id='footData'>
     </tfoot>
     </table>";

     echo $tab;


       break;
        

   }  



?>