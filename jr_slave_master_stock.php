<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');


$cabang=checkPostGet('cabang','');
$supp=checkPostGet('supp','');
$faktur=checkPostGet('faktur','');
$tgltiba=checkPostGet('tgltiba','');
$brg=checkPostGet('brg','');
$ket=checkPostGet('ket','');
$pcs=checkPostGet('pcs','');
$pax=checkPostGet('pax','');
$harga=checkPostGet('harga','');
$hargabeli=checkPostGet('hargabeli','');
$totfax=checkPostGet('totfax','');
$method=checkPostGet('method','');
switch ($method) {

        case 'insert':
   
        
        if ($cabang=='') {
            exit('Warning : Cabang Tidak Boleh Kosong');
        }
        if ($supp=='') {
            exit('Warning : Supplier Tidak Boleh Kosong');
        }
         if ($tgltiba=='') {
            exit('Warning : Tanggal Tidak Boleh Kosong');
        }
   
        ##id kontrak

        $date=date('Y-m-d h:m:s');
        $str="insert into ".$dbname.".mst_stock (cabang,kode_supplier,faktur,tanggal_tiba,nilai_faktur,kode_barang,deskripsi,rec_conv1,rec_conv2,tot_qty_conv1,createtime,cost_sell,cost_buy)
        values ('" . $cabang . "','" . $supp . "','" . $faktur . "','" . $tgltiba . "','" . $totfax . "','" . $brg . "','" . $ket . "','" . $pcs . "','" . $pax . "','0','" . $date . "','" . $harga . "','" . $hargabeli . "')";
      
        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        break;


        case'update':
  
        $supdt="update ".$dbname.".mst_stock set faktur='".$faktur."',tanggal_tiba='".$tgltiba."',nilai_faktur='".$totfax."',deskripsi='".$ket."',rec_conv1='".$pcs."',rec_conv2='".$pax."',cost_sell='".$harga."',cost_buy='".$hargabeli."' where kode_barang = '".$brg."' and cabang='".$cabang."' and kode_supplier='". $supp."'";
        

        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;

       case'delete':
        $sIns="delete from ".$dbname.".mst_stock where cabang = '".$cabang."' and kode_supplier='".$supp."' and kode_barang='".$brg."'";
        try{
            $owlPDO->exec($sIns); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;
	   

        case'loadData':

            $str = "select * from " . $dbname . ".mst_stock order by kode_barang ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
    
                $optcabang=makeOption($dbname,'mst_cabang','kode_cabang,nama_cabang',"kode_cabang='".$d['cabang']."'");
                $optsupp=makeOption($dbname,'mst_supplier','kode_supplier,nama_supplier',"kode_supplier='".$d['kode_supplier']."'");
                $optbrg=makeOption($dbname,'mst_barang','kode_barang,nama_barang',"kode_barang='".$d['kode_barang']."'");
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $optcabang[$d['cabang']]. "</td>";                         
                $tab.="<td align=left>" . $optsupp[$d['kode_supplier']]. "</td>";          
                $tab.="<td align=left>" . $optbrg[$d['kode_barang']]. "</td>";                 
                $tab.="<td align=left>" . $d['faktur']. "</td>";                 
                $tab.="<td align=left>" . $d['tanggal_tiba']. "</td>";                  
                $tab.="<td align=left>" . $d['nilai_faktur']. "</td>";                 
                $tab.="<td align=left>" . $d['rec_conv1']. "</td>";                 
                $tab.="<td align=left>" . $d['rec_conv2']. "</td>";                 
                $tab.="<td align=left>" . $d['cost_buy']. "</td>";                 
                $tab.="<td align=left>" . $d['cost_sell']. "</td>";                 
                $tab.="<td align=left>" . $d['tot_qty_conv1']. "</td>";                 
                $tab.="<td align=left>" . $d['deskripsi']. "</td>";                 
        

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['cabang']."','".$d['kode_supplier']."','".$d['faktur']."','".$d['tanggal_tiba']."','".$d['kode_barang']."','".$d['rec_conv1']."','".$d['rec_conv2']."','".$d['cost_sell']."','".$d['nilai_faktur']."','".$d['deskripsi']."','".$d['cost_buy']."');\"><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";
                $tab.="<td align=left><a style='color:white'; class='btn btn-danger btn-sm' onclick=\"hapus('".$d['cabang']."','".$d['kode_supplier']."','".$d['kode_barang']."');\"><i class='fas fa-trash'></i>Delete</a></td>";

                $tab.="</tr>"; 

 				 }
        
        echo $tab;
    break;


   }  



?>