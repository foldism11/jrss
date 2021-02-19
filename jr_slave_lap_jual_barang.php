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

     $str = "select * from " . $dbname . ".trx_beli where 1=1 ".$where." and  substr(createtime,1,10) between '".$tanggal."' and '".$tanggal2."' and tipetransaksi=1  and flag=1 order by cabang";
     $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
     $n->setFetchMode(PDO::FETCH_ASSOC);
     while ($d = $n->fetch()) {

 


      $cabangx[$d['cabang']]=$d['cabang'];
      $tanggalx[substr($d['createtime'],0,10)]=substr($d['createtime'],0,10);
      $barang[$d['kode_barang']]=$d['kode_barang'];

      $datatanggal1[$d['cabang']][substr($d['createtime'],0,10)]=substr($d['createtime'],0,10);
      $datatanggal1x[$d['cabang']][substr($d['createtime'],0,10)]=1;
      $databarang1[$d['cabang']][substr($d['createtime'],0,10)][$d['kode_barang']]=$d['kode_barang'];
      $databarang1x[$d['cabang']][substr($d['createtime'],0,10)][$d['kode_barang']]=1;
      @$dataqty1[$d['cabang']][substr($d['createtime'],0,10)][$d['kode_barang']]+=$d['rec_conv1'];
      @$datarp1[$d['cabang']][substr($d['createtime'],0,10)][$d['kode_barang']]+=$d['hargarupiah'];


     }

foreach ($cabangx as $cbg ) {
   foreach ($tanggalx as $tgl) {
    @$rows[$cbg]+=$datatanggal1x[$cbg][$tgl];
      foreach ($barang as $brg) {
          @$rows2[$cbg][$tgl]+=$databarang1x[$cbg][$tgl][$brg];
          @$rows3[$cbg]+=$databarang1x[$cbg][$tgl][$brg];
      }
      
   }

}  

/*
  echo "<pre>";
  print_r($rows3);
  echo "</pre>";
*/



$tab='';


  foreach ($cabangx as $cbg) {
   $row=$rows3[$cbg]+$rows[$cbg]+1;

    $optcabang=makeOption($dbname,'mst_cabang','kode_cabang,nama_cabang',"kode_cabang='".$cbg."'");
    if ($cbg!='') {
      $no+=1;
      $tab.="<tr class=rowcontent>";
      $tab.="<td rowspan=".$row." align=center>" . $no . "</td>";  
      $tab.="<td  rowspan=".$row." align=left>" . $optcabang[$cbg] . "</td>"; 
    }
     
           @$totqty=0;
            @$totrp=0;
    foreach ($tanggalx as $tgl) {
          $row2=$rows2[$cbg][$tgl]+1;
      if ($datatanggal1[$cbg][$tgl]!='') {
          $tab.="<tr class=rowcontent>";
          $tab.="<td  rowspan=".$row2." align=left>" . tanggalnormal($datatanggal1[$cbg][$tgl]) . "</td>";  


      }

     
          foreach ($barang as $brg) {
            $optbarang=makeOption($dbname,'mst_barang','kode_barang,nama_barang',"kode_barang='".@$databarang1[$cbg][$tgl][$brg]."'");
            if (@$databarang1[$cbg][$tgl][$brg]!='') {
               $tab.="<tr class=rowcontent>";
               $tab.="<td  align=left>" . $databarang1[$cbg][$tgl][$brg] . "</td>";  
               $tab.="<td  align=left>" . $optbarang[$databarang1[$cbg][$tgl][$brg]] . "</td>";  
               $tab.="<td  align=right>" . number_format($dataqty1[$cbg][$tgl][$brg]) . "</td>";   
               $tab.="<td  align=right>" . number_format($datarp1[$cbg][$tgl][$brg]) . "</td>";  

               @$totqty+=$dataqty1[$cbg][$tgl][$brg];
               @$totrp+=$datarp1[$cbg][$tgl][$brg];

            }
           
            
          }
       

      
    }

        $tab.="<tr class=rowcontent style='background-color: #FF7F50;'>";
        $tab.="<td colspan=5 align=left>Sub Total</td>";  
        $tab.="<td  align=right>" . number_format($totqty) . "</td>"; 
        $tab.="<td  align=right>" . number_format($totrp) . "</td>"; 
        $tab.="</tr>"; 

        @$gtotqty+=$totqty;
        @$gtotrp+=$totrp;
    
                  
  } 


        $tab.="<tr class=rowcontent style='background-color: #DC143C;'>";
        $tab.="<td colspan=5 align=left>Grand Total</td>";  
        $tab.="<td  align=right>" . number_format($gtotqty) . "</td>"; 
        $tab.="<td  align=right>" . number_format($gtotrp) . "</td>"; 
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
     <td>Satuan</td>
     <td>Harga</td>
     <td>Qty</td>
     <td>Jumlah Rp</td>
     </tr>";

     $str = "select * from " . $dbname . ".trx_beli where 1=1 and faktur='".$faktur."' and tipetransaksi=1  and flag=1 order by cabang";
     $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
     $n->setFetchMode(PDO::FETCH_ASSOC);
     while ($d = $n->fetch()) {
      $optbarang=makeOption($dbname,'mst_barang','kode_barang,nama_barang',"kode_barang='".$d['kode_barang']."'");
      $optsatuan=makeOption($dbname,'mst_barang','kode_barang,satuan',"kode_barang='".$d['kode_barang']."'");
      $optharsat=makeOption($dbname,'mst_stock','kode_barang,cost_sell',"kode_barang='".$d['kode_barang']."'");
      $no+=1;
      $tab.="<tr class=rowcontent>";
      $tab.="<td>".$no."</td>";
      $tab.="<td>".$optbarang[$d['kode_barang']]."</td>";
      $tab.="<td>".$optsatuan[$d['kode_barang']]."</td>";
      $tab.="<td>".$optharsat[$d['kode_barang']]."</td>";
      $tab.="<td align=right>" . number_format($d['rec_conv1']). "</td>";
      $tab.="<td align=right>" . number_format($d['hargarupiah']). "</td>";
      $tab.="</tr>";

      @$totrp+=$d['hargarupiah'];
     }
     $tab.="<tr class=rowcontent>";
     $tab.="<td colspan=5>Total Rp</td>";
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