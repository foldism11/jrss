<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$satuan=checkPostGet('satuan','');
$nama=checkPostGet('nama','');
$cabang=checkPostGet('cabang','');
$ket=checkPostGet('ket','');
$status=checkPostGet('status','');
$konv=checkPostGet('konv','');
$min=checkPostGet('min','');
$max=checkPostGet('max','');
$retur=checkPostGet('retur','');
$maxord=checkPostGet('maxord','');
$minord=checkPostGet('minord','');
$id=checkPostGet('id','');
$method=checkPostGet('method','');
switch ($method) {

        case 'insert':
   
        
        if ($nama=='') {
            exit('Warning : Nama Barang Tidak Boleh Kosong');
        }
        if ($satuan=='') {
            exit('Warning : Satuan Tidak Boleh Kosong');
        }
         if ($cabang=='') {
            exit('Warning : Cabang Tidak Boleh Kosong');
        }
        if ($status=='') {
            exit('Warning : Status Tidak Boleh Kosong');
        }

        ##id kontrak


        $strx = "select max(kode_barang) as jumlah from " . $dbname . ".mst_barang";
        $nx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
        $nx->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx = $nx->fetch()) {
            $jumlah=substr($dx['jumlah'],3,4);
            $jumlah=$jumlah+1;
        }
       
        $kd=$cabang.'-BR-';
        $nourut = str_pad($jumlah, 4, "0", STR_PAD_LEFT);
        $id=$kd.$nourut;
        $date=date('Y-m-d h:m:s');
        $str="insert into ".$dbname.".mst_barang (kode_barang,nama_barang,cabang,satuan,deskripsi,status,conv1,minim_stok,maks_stok,flag_ret,maks_ord,min_ord,createtime)
        values ('" . $id . "','" . $nama . "','" . $cabang . "','" . $satuan . "','" . $ket . "','" . $status . "','" . $konv . "','" . $min . "','" . $max . "','" . $retur . "','" . $maxord . "','" . $minord . "','" . $date . "')";
      
        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        break;


        case'update':
  
        $supdt="update ".$dbname.".mst_barang set nama_barang='".$nama."',cabang='".$cabang."',satuan='".$satuan."',deskripsi='".$ket."',status='".$status."',conv1='".$konv."',minim_stok='".$min."',maks_stok='".$max."',flag_ret='".$retur."',maks_ord='".$maxord."',min_ord='".$minord."' where kode_barang = '".$id."'";

        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;
	   

        case'loadData':

            $str = "select * from " . $dbname . ".mst_barang order by nama_barang ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $arr= array('0' =>'Tidak Aktif' ,'1' =>'Aktif' );
                $arrx= array('0' =>'Retur' ,'1' =>'Tidak Retur' );
                $optcabang=makeOption($dbname,'mst_cabang','kode_cabang,nama_cabang',"kode_cabang='".$d['cabang']."'");
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $d['nama_barang']. "</td>";          
                $tab.="<td align=left>" . $d['satuan']. "</td>";          
                $tab.="<td align=left>" . $optcabang[$d['cabang']]. "</td>";                 
                $tab.="<td align=left>" . $d['conv1']. "</td>";                 
                $tab.="<td align=left>" . $d['minim_stok']. "</td>";                 
                $tab.="<td align=left>" . $d['maks_stok']. "</td>";                 
                $tab.="<td align=left>" . $arrx[$d['flag_ret']]. "</td>";  
                $tab.="<td align=left hidden>" . $d['maks_ord']. "</td>";                 
                $tab.="<td align=left>" . $d['min_ord']. "</td>";                 
                $tab.="<td align=left>" . $d['deskripsi']. "</td>";                 
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['kode_barang']."','".$d['nama_barang']."','".$d['satuan']."','".$d['cabang']."','".$d['deskripsi']."','".$d['status']."','".$d['conv1']."','".$d['minim_stok']."','".$d['maks_stok']."','".$d['flag_ret']."','".$d['maks_ord']."','".$d['min_ord']."');\"><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";

                $tab.="</tr>"; 

 				 }
        
        echo $tab;
    break;


   }  



?>