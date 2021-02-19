<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$idkontrak=checkPostGet('idkontrak','');
$jnskontrak=checkPostGet('jnskontrak','');
$ket=checkPostGet('ket','');
$status=checkPostGet('status','');
$method=checkPostGet('method','');
switch ($method) {

        case 'insert':
   
        
        if ($jnskontrak=='') {
            exit('Warning : jenis Kontrak Tidak Boleh Kosong');
        }
        if ($status=='') {
            exit('Warning : Status Tidak Boleh Kosong');
        }

        ##id kontrak


        $strx = "select max(kode_kontrak) as jumlah from " . $dbname . ".mst_jenis_kontrak_pln";
        $nx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
        $nx->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx = $nx->fetch()) {
            $jumlah=substr($dx['jumlah'],2,3);
            $jumlah=$jumlah+1;
        }
        $kd='K_';
        $nourut = str_pad($jumlah, 3, "0", STR_PAD_LEFT);
        $idkontrak=$kd.$nourut;
        $str="insert into ".$dbname.".mst_jenis_kontrak_pln (kode_kontrak,nama_kontrak,deskripsi,status)
        values ('" . $idkontrak . "','" . $jnskontrak . "','" . $ket . "','" . $status . "')";
       // exit('error'.$str);
        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        break;


        case'update':
  
        $supdt="update ".$dbname.".mst_jenis_kontrak_pln set nama_kontrak='".$jnskontrak."',deskripsi='".$ket."',status='".$status."' where kode_kontrak = '".$idkontrak."'";

        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;
	   

        case'loadData':

            $str = "select * from " . $dbname . ".mst_jenis_kontrak_pln order by kode_kontrak ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
                $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $d['kode_kontrak']. "</td>";          
                $tab.="<td align=left>" . $d['nama_kontrak']. "</td>";          
                $tab.="<td align=left>" . $d['deskripsi']. "</td>";                 
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['kode_kontrak']."','".$d['nama_kontrak']."','".$d['deskripsi']."','".$d['status']."');\"><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";

                $tab.="</tr>"; 

 				 }
        
        echo $tab;
    break;


   }  



?>