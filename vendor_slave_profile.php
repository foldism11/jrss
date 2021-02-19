<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$namabpj=checkPostGet('namabpj','');
$alamatbpj=checkPostGet('alamatbpj','');
$emailbpj=checkPostGet('emailbpj','');
$tlpbpj=checkPostGet('tlpbpj','');
$namadir=checkPostGet('namadir','');
$tlpdir=checkPostGet('tlpdir','');
$emaildir=checkPostGet('emaildir','');
$namamgr=checkPostGet('namamgr','');
$tlpmgr=checkPostGet('tlpmgr','');
$emailmgr=checkPostGet('emailmgr','');
$namapengawas=checkPostGet('namapengawas','');
$tlppengawas=checkPostGet('tlppengawas','');
$emailpengawas=checkPostGet('emailpengawas','');
$nmpengawask3=checkPostGet('nmpengawask3','');
$tlppengawask3=checkPostGet('tlppengawask3','');
$emailpengawask3=checkPostGet('emailpengawask3','');
$nmadmin=checkPostGet('nmadmin','');
$tlpdmin=checkPostGet('tlpdmin','');
$emaildmin=checkPostGet('emaildmin','');
$nmpp=checkPostGet('nmpp','');
$tlppp=checkPostGet('tlppp','');
$emailpp=checkPostGet('emailpp','');
$method=checkPostGet('method','');

switch ($method) {

	    case 'insert':
   
  
        if ($namabpj=='') {
            exit('Warning : Nama BPJ Tidak Boleh Kosong');
        }
        if ($alamatbpj=='') {
            exit('Warning : Alamat BPJ Tidak Boleh Kosong');
        }
        if ($emailbpj=='') {
            exit('Warning : Email BPJ Tidak Boleh Kosong');
        }
        if ($tlpbpj=='') {
            exit('Warning : No Tlp BPJ Tidak Boleh Kosong');
        }
        if ($namadir=='') {
            exit('Warning : Nama Direktur Tidak Boleh Kosong');
        }
        if ($tlpdir=='') {
            exit('Warning : Tlp Direktur Tidak Boleh Kosong');
        }
        if ($emaildir=='') {
            exit('Warning : Email Direktur Tidak Boleh Kosong');
        }
        if ($namamgr=='') {
            exit('Warning : Nama Manager Tidak Boleh Kosong');
        }
        if ($tlpmgr=='') {
            exit('Warning : Tlp Manager Tidak Boleh Kosong');
        }
        if ($emailmgr=='') {
            exit('Warning : Email Manager Tidak Boleh Kosong');
        }
        if ($namapengawas=='') {
            exit('Warning : Nama Pengawas Tidak Boleh Kosong');
        }
        if ($tlppengawas=='') {
            exit('Warning : Tlp Pengawas Tidak Boleh Kosong');
        }
        if ($emailpengawas=='') {
            exit('Warning : Email Pengawas Tidak Boleh Kosong');
        }
        if ($nmpengawask3=='') {
            exit('Warning : Nama Pengawas K3 Tidak Boleh Kosong');
        }
        if ($tlppengawask3=='') {
            exit('Warning : Tlp Pengawas K3 Tidak Boleh Kosong');
        }
        if ($emailpengawask3=='') {
            exit('Warning : Email Pengawas K3 Tidak Boleh Kosong');
        }
        if ($nmadmin=='') {
            exit('Warning : Nama Bag. Admin Tidak Boleh Kosong');
        }
        if ($tlpdmin=='') {
            exit('Warning : Tlp Bag. Admin Tidak Boleh Kosong');
        }
        if ($emaildmin=='') {
            exit('Warning : Email Bag. Admin Tidak Boleh Kosong');
        }
        if ($nmpp=='') {
            exit('Warning : Nama Pelaksana Pekerjaan Tidak Boleh Kosong');
        }
        if ($tlppp=='') {
            exit('Warning : Tlp  Pelaksana Pekerjaan Tidak Boleh Kosong');
        }
        if ($emailpp=='') {
            exit('Warning : Email Pelaksana Pekerjaan Tidak Boleh Kosong');
        }

        
        #master PBJ
	    $str="update ".$dbname.".mst_vendor_pbj set nama_vendor='".$namabpj."',status='1',alamat='".$alamatbpj."',email_vendor='".$emailbpj."',telpon_vendor='".$tlpbpj."' where kode_vendor='".$_SESSION['standard']['username']."'";
      
        try{
            $owlPDO->exec($str); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }


        #Master Direktur

        $strx = "select max(kode_dirven) as jumlah from " . $dbname . ".mst_dirven_pbj";
        $nx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
        $nx->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx = $nx->fetch()) {
            $jumlah=substr($dx['jumlah'],3,3);
            $jumlah=$jumlah+1;
        }
        $kd='DR_';
        $nourut = str_pad($jumlah, 3, "0", STR_PAD_LEFT);
        $id=$kd.$nourut;


        $str1="insert into ".$dbname.".mst_dirven_pbj (kode_pbj,kode_dirven,nama_dirven,status,email_dirven,telpon_dirven)
        values ('" . $_SESSION['standard']['username'] . "','".$id."','" . $namadir . "','1','" . $emaildir . "','" . $tlpdir . "')";
        try{
            $owlPDO->exec($str1); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }


        #Project Manager

        $strx2 = "select max(kode_mgr) as jumlah from " . $dbname . ".mst_mgr_project_pbj";
        $nx2=$owlPDO->query($strx2) or die(print " Gagal: ".PDOException::getMessage());
        $nx2->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx2 = $nx2->fetch()) {
            $jumlah2=substr($dx2['jumlah'],3,3);
            $jumlah2=$jumlah2+1;
        }
        $kd2='MG_';
        $nourut2 = str_pad($jumlah2, 3, "0", STR_PAD_LEFT);
        $id2=$kd2.$nourut2;

        $str2="insert into ".$dbname.".mst_mgr_project_pbj (kode_pbj,kode_mgr,nama_mgr,status,email_mgr,telpon_mgr)
        values ('" . $_SESSION['standard']['username'] . "','" . $id2 . "','" . $namamgr . "','1','" . $emailmgr . "','" . $tlpmgr . "')";
        try{
            $owlPDO->exec($str2); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        #Pengawas Pekerjaan

        $strx3 = "select max(kode_pengawas) as jumlah from " . $dbname . ".mst_pengawas_pekerjaan_pbj";
        $nx3=$owlPDO->query($strx3) or die(print " Gagal: ".PDOException::getMessage());
        $nx3->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx3 = $nx3->fetch()) {
            $jumlah3=substr($dx3['jumlah'],3,3);
            $jumlah3=$jumlah3+1;
        }
        $kd3='PP_';
        $nourut3 = str_pad($jumlah3, 3, "0", STR_PAD_LEFT);
        $id3=$kd3.$nourut3;

        $str3="insert into ".$dbname.".mst_pengawas_pekerjaan_pbj (kode_pbj,kode_pengawas,nama_pengawas,status,email_pengawas,telpon_pengawas)
        values ('" . $_SESSION['standard']['username'] . "','" . $id3 . "','" . $namapengawas . "','1','" . $emailpengawas . "','" . $tlppengawas . "')";
        try{
            $owlPDO->exec($str3); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }


        #Pengawas K3

        $strx4 = "select max(kode_pengawas_k3) as jumlah from " . $dbname . ".mst_pengawas_k3_pbj";
        $nx4=$owlPDO->query($strx4) or die(print " Gagal: ".PDOException::getMessage());
        $nx4->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx4 = $nx4->fetch()) {
            $jumlah4=substr($dx4['jumlah'],3,3);
            $jumlah4=$jumlah4+1;
        }
        $kd4='PK_';
        $nourut4 = str_pad($jumlah4, 3, "0", STR_PAD_LEFT);
        $id4=$kd4.$nourut4;

        $str4="insert into ".$dbname.".mst_pengawas_k3_pbj (kode_pbj,kode_pengawas_k3,nama_pengawas_k3,status,email_pengawas_k3,telpon_pengawas_k3)
        values ('" . $_SESSION['standard']['username'] . "','" . $id4 . "','" . $nmpengawask3 . "','1','" . $emailpengawask3 . "','" . $tlppengawask3 . "')";
        try{
            $owlPDO->exec($str4); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        #Bag. Administrasi

        $strx5 = "select max(kode_administrasi) as jumlah from " . $dbname . ".mst_administrasi_pbj";
        $nx5=$owlPDO->query($strx5) or die(print " Gagal: ".PDOException::getMessage());
        $nx5->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx5 = $nx5->fetch()) {
            $jumlah5=substr($dx5['jumlah'],3,3);
            $jumlah5=$jumlah5+1;
        }
        $kd5='AD_';
        $nourut5 = str_pad($jumlah5, 3, "0", STR_PAD_LEFT);
        $id5=$kd5.$nourut5;

        $str5="insert into ".$dbname.".mst_administrasi_pbj (kode_pbj,kode_administrasi,nama_administrasi,status,email_administrasi,telpon_administrasi)
        values ('" . $_SESSION['standard']['username'] . "','" . $id5 . "','" . $nmadmin . "','1','" . $emaildmin . "','" . $tlpdmin . "')";
        try{
            $owlPDO->exec($str5); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        #Pelaksana Pekerjaan

        $strx6 = "select max(kode_pelaksana) as jumlah from " . $dbname . ".mst_pelaksana_pbj";
        $nx6=$owlPDO->query($strx6) or die(print " Gagal: ".PDOException::getMessage());
        $nx6->setFetchMode(PDO::FETCH_ASSOC);
        while ($dx6 = $nx6->fetch()) {
            $jumlah6=substr($dx6['jumlah'],3,3);
            $jumlah6=$jumlah6+1;
        }
        $kd6='PX_';
        $nourut6 = str_pad($jumlah6, 3, "0", STR_PAD_LEFT);
        $id6=$kd6.$nourut6;
        $str6="insert into ".$dbname.".mst_pelaksana_pbj (kode_pbj,kode_pelaksana,nama_pelaksana,status,email_pelaksana,telpon_pelaksana)
        values ('" . $_SESSION['standard']['username'] . "','" . $id6 . "','" . $nmpp . "','1','" . $tlppp . "','" . $emailpp . "')";
        try{
            $owlPDO->exec($str6); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }

        $supdt="update ".$dbname.".user set new='1' where namauser = '".$_SESSION['standard']['username']."' and status=1";
        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }

        break;

        
        default:

}
?>