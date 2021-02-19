<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');




$id=checkPostGet('id','');
$tipe=checkPostGet('tipe','');
$nama=checkPostGet('nama','');
$method=checkPostGet('method','');
switch ($method) {

        case 'simpanheader':

        if ($nama=='') {
            exit('Warning : Nama Kosong !');
        }

         $str = "select count(*) as jumlah from " . $dbname . ".mst_hak_akses where namauser='".$nama."'";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $jumlah=$d['jumlah'];
            }

        $str = "select * from " . $dbname . ".mst_hak_akses where namauser='".$nama."'";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                if ($tipe==1) {
                    $header=$d['header'];
                    $header.=','.$id;
                }
                else
                {
                     $header=$d['header'];
                     $arrheader=explode(',', $header);

                     $arrheader2= array('0'=>$id );

                     $resultdiff=array_diff($arrheader,$arrheader2);
            
                
                     $header=implode(',',$resultdiff);

                }
                

                $detail=$d['detail'];
            }

        if ($jumlah==0) {
               $str="insert into ".$dbname.".mst_hak_akses (namauser,header)
               values ('" . $nama . "','" . $id . "')";

               try{
                $owlPDO->exec($str); 
                }catch(PDOException $e){
                    echo " Gagal," . addslashes($e->getMessage());
                }

        }
        else
        {
            $supdt="update ".$dbname.".mst_hak_akses set header='".$header."',detail='".$detail."' where namauser = '".$nama."'";

            try{
                $owlPDO->exec($supdt); 
            }
            catch (PDOException $e){
                echo"Gagal".$e->getMessage();
                die();
            }
        }
        
       
        
       
        break;


       
	   

        case'getdata':

            $str = "select * from " . $dbname . ".mst_hak_akses where namauser='".$nama."'";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {        

               $header=$d['header'];
               $detail=$d['detail'];

 			}
            $header=explode(',', $header);
   
            for ($i=0;$i<count($header);$i++)

            {

                $tab.=$header[$i].'##';
            }

            $tab.=count($header);

            echo $tab;

         


        
        
    break;


   }  



?>