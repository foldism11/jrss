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
$kode_mgr=checkPostGet('kode','');
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

        $strx = "select max(kode_mgr) as jumlah from " . $dbname . ".mst_mgr_project_pbj";
        $nx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
        $nx->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx = $nx->fetch()) {
            $jumlah=substr($dx['jumlah'],3,3);
            $jumlah=$jumlah+1;
        }
        $kd='MG_';
        $nourut = str_pad($jumlah, 3, "0", STR_PAD_LEFT);
        $id=$kd.$nourut;

        $str="insert into ".$dbname.".mst_mgr_project_pbj (kode_pbj,kode_mgr,nama_mgr,status,alamat,email_mgr,telpon_mgr)
        values ('" . $pbj . "','" . $pbj . "','" . $nama . "','" . $status . "','" . $alamat . "','" . $email . "','" . $tlp . "')";
       // exit('error'.$str);
        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        break;


        case'update':
  
        $supdt="update ".$dbname.".mst_mgr_project_pbj set kode_pbj='".$pbj."',nama_mgr='".$nama."',status='".$status."',alamat='".$alamat."',email_mgr='".$email."',telpon_mgr='".$tlp."' where kode_mgr = '".$kode_mgr."'";   
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

            $str = "select * from " . $dbname . ".mst_mgr_project_pbj ".$whr." order by nama_mgr ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
                $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $nmvendor[$d['kode_pbj']]. "</td>";          
                $tab.="<td align=left>" . $d['nama_mgr']. "</td>";          
                $tab.="<td align=left>" . $d['telpon_mgr']. "</td>";          
                $tab.="<td align=left>" . $d['email_mgr']. "</td>";          
                $tab.="<td align=left>" . $d['alamat']. "</td>";          
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=edit('".$d['kode_mgr']."','".$d['kode_pbj']."','".$d['nama_mgr']."','".$d['telpon_mgr']."','".$d['email_mgr']."','".$d['alamat']."','".$d['status']."');><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";

                $tab.="</tr>"; 

 				 }
        
        echo $tab;
    break;


   }  



?>