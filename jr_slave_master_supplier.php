<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$id=checkPostGet('id','');
$nama=checkPostGet('nama','');
$ket=checkPostGet('ket','');
$status=checkPostGet('status','');
$tlp=checkPostGet('tlp','');
$email=checkPostGet('email','');
$alamat=checkPostGet('alamat','');
$method=checkPostGet('method','');
switch ($method) {

        case 'insert':
   
        
        if ($nama=='') {
            exit('Warning : Nama Supplier Tidak Boleh Kosong');
        }
        if ($status=='') {
            exit('Warning : Status Tidak Boleh Kosong');
        }

        ##id kontrak


        $strx = "select max(kode_supplier) as jumlah from " . $dbname . ".mst_supplier";
        $nx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
        $nx->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx = $nx->fetch()) {
            $jumlah=substr($dx['jumlah'],3,3);
            $jumlah=$jumlah+1;
        }
        $kd='SP_';
        $nourut = str_pad($jumlah, 3, "0", STR_PAD_LEFT);
        $id=$kd.$nourut;
        $str="insert into ".$dbname.".mst_supplier (kode_supplier,nama_supplier,deskripsi,status,telpon,alamat,email)
        values ('" . $id . "','" . $nama . "','" . $ket . "','" . $status . "','" . $tlp . "','" . $alamat . "','" . $email . "')";
       // exit('error'.$str);
        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        break;


        case'update':
  
        $supdt="update ".$dbname.".mst_supplier set nama_supplier='".$nama."',deskripsi='".$ket."',status='".$status."',telpon='".$tlp."',alamat='".$alamat."',email='".$email."' where kode_supplier = '".$id."'";
 

        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;
	   

        case'loadData':

            $str = "select * from " . $dbname . ".mst_supplier order by kode_supplier ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $d['kode_supplier']. "</td>";          
                $tab.="<td align=left>" . $d['nama_supplier']. "</td>";          
                $tab.="<td align=left>" . $d['telpon']. "</td>";          
                $tab.="<td align=left>" . $d['email']. "</td>";          
                $tab.="<td align=left>" . $d['alamat']. "</td>";          
                $tab.="<td align=left>" . $d['deskripsi']. "</td>";                 
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['kode_supplier']."','".$d['nama_supplier']."','".$d['deskripsi']."','".$d['status']."','".$d['telpon']."','".$d['email']."','".$d['alamat']."');\"><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";

                $tab.="</tr>"; 

 				 }
        
        echo $tab;
    break;


   }  



?>