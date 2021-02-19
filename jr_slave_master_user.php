<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$pass=checkPostGet('pass','');
$nama=checkPostGet('nama','');
$cabang=checkPostGet('cabang','');
$ket=checkPostGet('ket','');
$status=checkPostGet('status','');
$id=checkPostGet('id','');
$tipe=checkPostGet('tipe','');
$method=checkPostGet('method','');
switch ($method) {

        case 'insert':
   
        
        if ($nama=='') {
            exit('Warning : Nama User Tidak Boleh Kosong');
        }
        if ($pass=='') {
            exit('Warning : Password Tidak Boleh Kosong');
        }
        if ($status=='') {
            exit('Warning : Status Tidak Boleh Kosong');
        }
         if ($tipe=='') {
            exit('Warning : Tipe Tidak Boleh Kosong');
        }

        ##id kontrak


        $strx = "select max(id) as jumlah from " . $dbname . ".user";
        $nx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
        $nx->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx = $nx->fetch()) {
            $jumlah=substr($dx['jumlah'],4,3);
            $jumlah=$jumlah+1;
        }
        $kd='ADM_';
        $nourut = str_pad($jumlah, 3, "0", STR_PAD_LEFT);
        $id=$kd.$nourut;
        $str="insert into ".$dbname.".user (id,namauser,password,kodeorg,ket,status,tipe)
        values ('" . $id . "','" . $nama . "','" . $pass . "','" . $cabang . "','" . $ket . "','" . $status . "','" . $tipe . "')";
       //exit('error'.$str);
        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        break;


        case'update':
  
        $supdt="update ".$dbname.".user set namauser='".$nama."',password='".$pass."',kodeorg='".$cabang."',ket='".$ket."',status='".$status."',tipe='".$tipe."' where id = '".$id."'";

        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;
	   

        case'loadData':

            $str = "select * from " . $dbname . ".user order by namauser ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                $arrx= array('0' =>'Non Admin' ,'1' =>'Admin' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $d['namauser']. "</td>";          
                $tab.="<td align=left>" . $d['password']. "</td>";          
                $tab.="<td align=left>" . $d['kodeorg']. "</td>";                 
                $tab.="<td align=left>" . $d['ket']. "</td>";                 
                $tab.="<td align=left>" . $arrx[$d['tipe']]. "</td>";                 
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['namauser']."','".$d['password']."','".$d['kodeorg']."','".$d['ket']."','".$d['status']."','".$d['id']."','".$d['tipe']."');\"><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";

                $tab.="</tr>"; 

 				 }
        
        echo $tab;
    break;


   }  



?>