<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$pbj=checkPostGet('pbj','');
$nama=checkPostGet('nama','');
$tlp=checkPostGet('tlp','');
$email=checkPostGet('email','');
$alamat=checkPostGet('alamat','');
$status=checkPostGet('status','');
$kode=checkPostGet('kode','');
$method=checkPostGet('method','');
switch ($method) {

        case 'insert':
   
        
        if ($pbj=='') {
            exit('Warning : Unit PBJ Tidak Boleh Kosong');
        }
        if ($nama=='') {
            exit('Warning : Nama Tidak Boleh Kosong');
        }
        if ($status=='') {
            exit('Warning : Status Tidak Boleh Kosong');
        }

        $strx = "select max(kode_pengawas_k3) as jumlah from " . $dbname . ".mst_pengawas_k3_pbj";
        $nx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
        $nx->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx = $nx->fetch()) {
            $jumlah=substr($dx['jumlah'],3,3);
            $jumlah=$jumlah+1;
        }
        $kd='PK_';
        $nourut = str_pad($jumlah, 3, "0", STR_PAD_LEFT);
        $id=$kd.$nourut;

        $str="insert into ".$dbname.".mst_pengawas_k3_pbj (kode_pbj,kode_pengawas_k3,nama_pengawas_k3,status,alamat_pengawas_k3,email_pengawas_k3,telpon_pengawas_k3)
        values ('" . $pbj . "','" . $id . "','" . $nama . "','" . $status . "','" . $alamat . "','" . $email . "','" . $tlp . "')";
       // exit('error'.$str);
        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        break;


        case'update':
  
        $supdt="update ".$dbname.".mst_pengawas_k3_pbj set kode_pbj='".$pbj."',nama_pengawas_k3='".$nama."',status='".$status."',alamat_pengawas_k3='".$alamat."',email_pengawas_k3='".$email."',telpon_pengawas_k3='".$tlp."' where kode_pengawas_k3 = '".$kode."'";   
        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;
	   

        case'loadData':

            if ($_SESSION['standard']['tipex']=='1') {
                $whr=" where kode_pbj='".$_SESSION['standard']['username']."'";
            }

            $str = "select * from " . $dbname . ".mst_pengawas_k3_pbj ".$whr." order by nama_pengawas_k3 ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
                $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $nmvendor[$d['kode_pbj']]. "</td>";          
                $tab.="<td align=left>" . $d['nama_pengawas_k3']. "</td>";          
                $tab.="<td align=left>" . $d['telpon_pengawas_k3']. "</td>";          
                $tab.="<td align=left>" . $d['email_pengawas_k3']. "</td>";          
                $tab.="<td align=left>" . $d['alamat_pengawas_k3']. "</td>";          
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['kode_pengawas_k3']."','".$d['kode_pbj']."','".$d['nama_pengawas_k3']."','".$d['telpon_pengawas_k3']."','".$d['email_pengawas_k3']."','".$d['alamat_pengawas_k3']."','".$d['status']."');\"><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";

                $tab.="</tr>"; 

 				 }
        
        echo $tab;
    break;


   }  



?>