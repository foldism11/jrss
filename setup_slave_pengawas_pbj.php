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
$kode_pengawas=checkPostGet('kode','');
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


        $strx = "select max(kode_pengawas) as jumlah from " . $dbname . ".mst_pengawas_pekerjaan_pbj";
        $nx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
        $nx->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx = $nx->fetch()) {
            $jumlah=substr($dx['jumlah'],3,3);
            $jumlah=$jumlah+1;
        }
        $kd='PP_';
        $nourut = str_pad($jumlah, 3, "0", STR_PAD_LEFT);
        $id=$kd.$nourut;

        $str="insert into ".$dbname.".mst_pengawas_pekerjaan_pbj (kode_pbj,kode_pengawas,nama_pengawas,status,alamat_pengawas,email_pengawas,telpon_pengawas)
        values ('" . $pbj . "','" . $id . "','" . $nama . "','" . $status . "','" . $alamat . "','" . $email . "','" . $tlp . "')";
       // exit('error'.$str);
        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        break;


        case'update':
  
        $supdt="update ".$dbname.".mst_pengawas_pekerjaan_pbj set kode_pbj='".$pbj."',nama_pengawas='".$nama."',status='".$status."',alamat_pengawas='".$alamat."',email_pengawas='".$email."',telpon_pengawas='".$tlp."' where kode_pengawas = '".$kode_pengawas."'";   
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

            $str = "select * from " . $dbname . ".mst_pengawas_pekerjaan_pbj ".$whr." order by nama_pengawas ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
                $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $nmvendor[$d['kode_pbj']]. "</td>";          
                $tab.="<td align=left>" . $d['nama_pengawas']. "</td>";          
                $tab.="<td align=left>" . $d['telpon_pengawas']. "</td>";          
                $tab.="<td align=left>" . $d['email_pengawas']. "</td>";          
                $tab.="<td align=left>" . $d['alamat_pengawas']. "</td>";          
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=edit('".$d['kode_pengawas']."','".$d['kode_pbj']."','".$d['nama_pengawas']."','".$d['telpon_pengawas']."','".$d['email_pengawas']."','".$d['alamat_pengawas']."','".$d['status']."');><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";

                $tab.="</tr>"; 

 				 }
        
        echo $tab;
    break;


   }  



?>