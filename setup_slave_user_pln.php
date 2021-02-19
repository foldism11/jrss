<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$password=checkPostGet('password','');
$nama=checkPostGet('nama','');
$email=checkPostGet('email','');
$hak=checkPostGet('hak','');
$status=checkPostGet('status','');
$pos=checkPostGet('pos','');
$kota=checkPostGet('kota','');
$alamat=checkPostGet('alamat','');
$method=checkPostGet('method','');
switch ($method) {

        case 'insert':
   
        
        if ($password=='') {
            exit('Warning : password Tidak Boleh Kosong');
        }
        if ($hak=='') {
            exit('Warning : Hak Akses Tidak Boleh Kosong');
        }
        if ($status=='') {
            exit('Warning : Status Tidak Boleh Kosong');
        }

        ##id kontrak


       
        $str="insert into ".$dbname.".user (namauser,password,email,hak,kodepos,kota,alamat,status)
        values ('" . $nama . "','" . $password . "','" . $email . "','" . $hak . "','" . $pos . "','" . $kota . "','" . $alamat . "','" . $status . "')";
       // exit('error'.$str);
        try{
            $owlPDO->exec($str); 
                if ($hak=='1') {
                       $strx="insert into ".$dbname.".mst_vendor_pbj (kode_vendor,status)
                       values ('" . $nama . "','0')";
                       try{
                        $owlPDO->exec($strx); 
                    }catch(PDOException $e){
                        echo " Gagal," . addslashes($e->getMessage());
                    }
                }
               


        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        break;


        case'update':
  
        $supdt="update ".$dbname.".user set password='".$password."',email='".$email."',hak='".$hak."',kodepos='".$pos."',kota='".$kota."',alamat='".$alamat."',status='".$status."' where namauser = '".$nama."'";

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
                $arrhak= array('0' =>'PLN' ,'1' =>'PBJ' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";  
                $tab.="<td align=left>" . $d['namauser']. "</td>";          
                $tab.="<td align=left>" . $d['password']. "</td>";          
                $tab.="<td align=left>" .  $arrhak[$d['hak']]. "</td>";                 
                $tab.="<td align=left>" . $d['email']. "</td>";                          
                $tab.="<td align=left>" .$arr[$d['status']]. "</td>";          

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['namauser']."');\"><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";

                $tab.="</tr>"; 

 				 }
        
        echo $tab;
    break;


    case 'getuser':

    $strx = "select max(namauser) as jumlah from " . $dbname . ".user where hak='".$hak."'";
    $nx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
    $nx->setFetchMode(PDO::FETCH_ASSOC);
    while ($dx = $nx->fetch()) {
        $jumlah=substr($dx['jumlah'],9,3);
        $jumlah=$jumlah+1;
    }
    if ($hak==0) {
        $kd='admin.pln';
    }
    else
    {
        $kd='admin.pbj';
    }
    
    $nourut = str_pad($jumlah, 3, "0", STR_PAD_LEFT);
    $id=$kd.$nourut;

    echo $id;


    break;


    case'getdata':
    $str = "select * from " . $dbname . ".user where namauser = '".$nama."'";
    $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
    $res->setFetchMode(PDO::FETCH_OBJ);
    while ($bar = $res->fetch()) {
        $data=$bar->namauser.'##'.$bar->password.'##'.$bar->hak.'##'.$bar->status.'##'.$bar->kodepos.'##'.$bar->kota.'##'.$bar->email.'##'.$bar->alamat;
    }
    echo $data;
    break;


   }  



?>