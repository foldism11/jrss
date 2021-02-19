<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$id=checkPostGet('id','');
$nama=checkPostGet('nama','');
$email=checkPostGet('email','');
$tlpn=checkPostGet('tlpn','');
$status=checkPostGet('status','');
$propinsi=checkPostGet('propinsi','');
$pos=checkPostGet('pos','');
$kota=checkPostGet('kota','');
$alamat=checkPostGet('alamat','');
$method=checkPostGet('method','');
switch ($method) {

        case 'insert':
   
        
        if ($nama=='') {
            exit('Warning : Nama UPT Tidak Boleh Kosong');
        }
        if ($status=='') {
            exit('Warning : Status Tidak Boleh Kosong');
        }

        ##id kontrak


        $strx = "select max(kode_upt) as jumlah from " . $dbname . ".mst_upt_pln";
        $nx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
        $nx->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx = $nx->fetch()) {
            $jumlah=substr($dx['jumlah'],4,3);
            $jumlah=$jumlah+1;
        }
        $kd='UPT_';
        $nourut = str_pad($jumlah, 3, "0", STR_PAD_LEFT);
        $id=$kd.$nourut;
        $str="insert into ".$dbname.".mst_upt_pln (kode_upt,nama_upt,email,telepon,kodepos,provinsi,kota,alamat,status)
        values ('" . $id . "','" . $nama . "','" . $email . "','" . $tlpn . "','" . $pos . "','" . $propinsi . "','" . $kota . "','" . $alamat . "','" . $status . "')";
       // exit('error'.$str);
        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        break;


        case'update':
  
        $supdt="update ".$dbname.".mst_upt_pln set nama_upt='".$nama."',email='".$email."',telepon='".$tlpn."',kodepos='".$pos."',provinsi='".$propinsi."',kota='".$kota."',alamat='".$alamat."',status='".$status."' where kode_upt = '".$id."'";

        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;
	   

        case'loadData':

            $str = "select * from " . $dbname . ".mst_upt_pln order by kode_upt ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $d['kode_upt']. "</td>";          
                $tab.="<td align=left>" . $d['nama_upt']. "</td>";          
                $tab.="<td align=left>" . $d['email']. "</td>";                 
                $tab.="<td align=left>" . $d['telepon']. "</td>";                 
                $tab.="<td align=left>" . $d['kodepos']. "</td>";                 
                $tab.="<td align=left>" . $d['provinsi']. "</td>";                 
                $tab.="<td align=left>" . $d['kota']. "</td>";                 
                $tab.="<td align=left>" . $d['alamat']. "</td>";                 
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['kode_upt']."','".$d['nama_upt']."','".$d['email']."','".$d['telepon']."','".$d['kodepos']."','".$d['provinsi']."','".$d['kota']."','".$d['alamat']."','".$d['status']."');\"><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";

                $tab.="</tr>"; 

 				 }
        
        echo $tab;
    break;


   }  



?>