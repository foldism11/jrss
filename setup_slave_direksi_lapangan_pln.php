<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$upt=checkPostGet('upt','');
$nama=checkPostGet('nama','');
$tlp=checkPostGet('tlp','');
$email=checkPostGet('email','');
$alamat=checkPostGet('alamat','');
$status=checkPostGet('status','');
$kode=checkPostGet('kode','');
$method=checkPostGet('method','');
switch ($method) {

        case 'insert':
   
        
        if ($upt=='') {
            exit('Warning : Unit UPT Tidak Boleh Kosong');
        }
        if ($nama=='') {
            exit('Warning : Nama Tidak Boleh Kosong');
        }
        if ($status=='') {
            exit('Warning : Status Tidak Boleh Kosong');
        }

      


        $strx = "select max(nik_dl) as jumlah from " . $dbname . ".mst_direksi_lapangan_pln";
        $nx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
        $nx->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx = $nx->fetch()) {
            $jumlah=substr($dx['jumlah'],3,3);
            $jumlah=$jumlah+1;
        }
        $kd='DL_';
        $nourut = str_pad($jumlah, 3, "0", STR_PAD_LEFT);
        $id=$kd.$nourut;


        $str="insert into ".$dbname.".mst_direksi_lapangan_pln (kode_upt,nik_dl,nama_dl,status,alamat,email,telepon)
        values ('" . $upt . "','" . $id . "','" . $nama . "','" . $status . "','" . $alamat . "','" . $email . "','" . $tlp . "')";
       // exit('error'.$str);
        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        break;


        case'update':
  
        $supdt="update ".$dbname.".mst_direksi_lapangan_pln set kode_upt='".$upt."',nama_dl='".$nama."',status='".$status."',alamat='".$alamat."',email='".$email."',telepon='".$tlp."' where nik_dl = '".$kode."'";

        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;
	   

        case'loadData':

            $str = "select * from " . $dbname . ".mst_direksi_lapangan_pln order by nama_dl ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $nmupt = makeOption($dbname, 'mst_upt_pln', 'kode_upt,nama_upt');
                $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $nmupt[$d['kode_upt']]. "</td>";          
                $tab.="<td align=left>" . $d['nama_dl']. "</td>";          
                $tab.="<td align=left>" . $d['telepon']. "</td>";          
                $tab.="<td align=left>" . $d['email']. "</td>";          
                $tab.="<td align=left>" . $d['alamat']. "</td>";          
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['kode_upt']."','".$d['nik_dl']."','".$d['nama_dl']."','".$d['telepon']."','".$d['email']."','".$d['alamat']."','".$d['status']."');\"><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";

                $tab.="</tr>"; 

 				 }
        
        echo $tab;
    break;


   }  



?>