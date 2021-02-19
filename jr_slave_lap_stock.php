<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$cabang=checkPostGet('cabang','');
$supp=checkPostGet('supp','');
$brg=checkPostGet('brg','');



$method=checkPostGet('method','');
switch ($method) {

     case'tampilkan':

     if ($cabang!='') {
     	$where=" and cabang='".$cabang."'";
     }
     /* if ($supp!='') {
     	$where.=" and kode_supplier='".$supp."'";
     }*/
       if ($brg!='') {
     	$where.=" and kode_barang='".$brg."'";
     }

     $str = "select * from " . $dbname . ".mst_stock where 1=1 ".$where." order by cabang";

     $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
     $n->setFetchMode(PDO::FETCH_ASSOC);
     while ($d = $n->fetch()) {

      $datafakturx[$d['cabang']][$d['kode_barang']]=1;
      $datafaktur[$d['cabang']][$d['kode_barang']]=$d['kode_barang'];
      $dataqtypcs[$d['cabang']][$d['kode_barang']]=$d['rec_conv1'];
      $dataqtypack[$d['cabang']][$d['kode_barang']]=$d['rec_conv2'];
      $datatotqtypcs[$d['cabang']][$d['kode_barang']]=$d['tot_qty_conv1'];

     }

foreach ($datafaktur as $cbg => $value) {
   foreach ($value as $brg => $value2) {

      @$rows[$cbg]+=$datafakturx[$cbg][$brg];
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

    @$totpcs=0;
    @$totpack=0;
    @$totqtyocs=0;

    foreach ($value as $brg => $value2) {
       $optbarang=makeOption($dbname,'mst_barang','kode_barang,nama_barang',"kode_barang='".$datafaktur[$cbg][$brg]."'");
          $tab.="<tr class=rowcontent>";
          $tab.="<td align=left>" . $optbarang[$datafaktur[$cbg][$brg]] . "</td>"; 
          $tab.="<td align=right>" . number_format($dataqtypcs[$cbg][$brg]) . "</td>"; 
          $tab.="<td align=right>" . number_format($dataqtypack[$cbg][$brg]) . "</td>"; 
          $tab.="<td align=right>" . number_format($datatotqtypcs[$cbg][$brg]) . "</td>"; 

        @$totpcs+=$dataqtypcs[$cbg][$brg];
        @$totpack+=$dataqtypack[$cbg][$brg];
        @$totqtyocs+=$datatotqtypcs[$cbg][$brg];


    }

    $tab.="<tr class=rowcontent style='background-color: #FF7F50;'>";
    $tab.="<td align=center colspan=3 >Sub Total</td>";
    $tab.="<td align=right>" . number_format(@$totpcs) . "</td>";
    $tab.="<td align=right>" . number_format(@$totpack) . "</td>";
    $tab.="<td align=right>" . number_format(@$totqtyocs) . "</td>";
    $tab.="</tr>"; 


    @$grpcs+=$totpcs;
    @$grpack+=$totpack;
    @$grtot+=$totqtyocs;


  } 
  	$tab.="</tr>"; 

   

  

  $tab.="<tr class=rowcontent style='background-color: #DC143C;'>";
              $tab.="<td align=center colspan=3>Grand Total</td>";
              $tab.="<td align=right>" . number_format(@$grpcs) . "</td>";
              $tab.="<td align=right>" . number_format(@$grpack) . "</td>";
              $tab.="<td align=right>" . number_format(@$grtot) . "</td>";
              $tab.="</tr>"; 

  echo $tab;





     //echo $tab;


         break;
	   

        

   }  



?>