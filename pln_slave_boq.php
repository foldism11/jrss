<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$notransaksi=checkPostGet('notransaksi','');


$pbj=checkPostGet('pbj','');
$nokontrak=checkPostGet('nokontrak','');
$nilai=checkPostGet('nilai','');
$lokasi=checkPostGet('lokasi','');
$judul=checkPostGet('judul','');
$per1=checkPostGet('per1','');
$per2=checkPostGet('per2','');
$jnspek=checkPostGet('jnspek','');
$brg=checkPostGet('brg','');
$kode=checkPostGet('kode','');
$volume=checkPostGet('volume','');
$satuan=checkPostGet('satuan','');
$harsat=checkPostGet('harsat','');
$jumlah=checkPostGet('jumlah','');
$peritem=checkPostGet('peritem','');
$persen=checkPostGet('persen','');
$nokontrakx=explode('##', $nokontrak);
@$nokontrak=$nokontrakx[0];
@$sifatba=$nokontrakx[1];
@$amandemen=$nokontrakx[2];

$method=checkPostGet('method','');

switch ($method) {

	    case 'insertdet':
   
        
       
        if ($pbj=='') {
        exit('Warning :  PBJ Tidak Boleh Kosong');}
        if ($nokontrak=='') {
        exit('Warning :  Kontrak Tidak Boleh Kosong');}
        if ($nilai=='' || $nilai==0) {
        exit('Warning :  Nilai Tidak Boleh Kosong');}
        if ($jnspek=='') {
        exit('Warning :  Jenis Pekerjaan Tidak Boleh Kosong');}
        if ($brg=='') {
        exit('Warning :  Barang Tidak Boleh Kosong');}
        if ($volume=='' || $volume==0) {
        exit('Warning :  Volume Tidak Boleh Kosong');}
        if ($satuan=='') {
        exit('Warning :  Satuan Tidak Boleh Kosong');}
        if ($harsat=='' || $harsat==0) {
        exit('Warning :  Harga Satuan Tidak Boleh Kosong');}
        if ($jumlah=='' || $jumlah==0) {
        exit('Warning :  Jumlah Tidak Boleh Kosong');}
        

           $nokontrak=explode('##', $nokontrak);
           $nokontrak=$nokontrak[0];

           



 
            $str = "select count(no_transaksi) as jumlah from  " . $dbname . ".mst_boq_dt_pbj where no_transaksi='".$notransaksi."' and jns_item='".$jnspek."'";
            $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $res->setFetchMode(PDO::FETCH_OBJ);
            while ($bar = $res->fetch()) {
                $nourut=$bar->jumlah;
                if ($nourut==0) {
                     $nourut=1;
                }
                else
                {
                    $nourut=$nourut+1;
                }

            }

            $nourutx = str_pad($nourut, 3, "0", STR_PAD_LEFT);
            if ($jnspek==1) {
                $kd='BR_';
            }
            else
            {
                 $kd='JS_';
            }
            $kode=$kd.$nourutx;
 

       

         $str = "select count(no_transaksi) as jumlahx from  " . $dbname . ".mst_boq_ht_pbj where no_transaksi='".$notransaksi."'";
            $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $res->setFetchMode(PDO::FETCH_OBJ);
            while ($bar = $res->fetch()) {
                $jmx=$bar->jumlahx;

            }
            //exit('error'.$str);
            if ($jmx==0) {
                    #insert Header     
                   $date=date('y-m-d h:m:s');            
                   $str="insert into ".$dbname.".mst_boq_ht_pbj (no_transaksi,kode_vendor,no_kontrak,judul_kontrak,nilai_kontrak,lokasi_pekerjaan,create_by,create_time,noamandemen,perkontrak1,perkontrak2)
                   values ('" . $notransaksi . "','" . $pbj . "','" . $nokontrak . "','" . $judul . "','" . $nilai . "','" . $lokasi . "','" . $_SESSION['standard']['username'] . "','" . $date. "','" . $amandemen . "','" . $per1 . "','" . $per2 . "')";

                   try{
                    $owlPDO->exec($str); 
                    $str="insert into ".$dbname.".mst_boq_dt_pbj (no_transaksi,jns_item,kode_item,nama_item,vol_item,satuan_item,harga_item,jum_item,per_satuan_item,per_total_item)
                    values ('" . $notransaksi . "','" . $jnspek . "','".$kode."','".$brg."','".$volume."','".$satuan."','".$harsat."','".$jumlah."','".$peritem."','".$persen."')";
                        //exit('error'.$str);
                    try{
                        $owlPDO->exec($str); 


                    }catch(PDOException $e){
                        echo " Gagal," . addslashes($e->getMessage());
                    }

                }catch(PDOException $e){
                    echo " Gagal," . addslashes($e->getMessage());
                }

            }
            else
            {   

                #cek nilai persentase

                $str = "select sum(per_total_item) as persen from  " . $dbname . ".mst_boq_dt_pbj where no_transaksi='".$notransaksi."'";
                $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                $res->setFetchMode(PDO::FETCH_OBJ);
                while ($bar = $res->fetch()) {
                    $jmpersen=$bar->persen;

                }

                $jumpersen=$jmpersen+$persen;
                if ($jumpersen>100) {
                   exit('Warning : Persentasi Kontrak Melebihi Ketentuan ('. $jumpersen.'%), Maks. 100%');
                }


  
                $str="insert into ".$dbname.".mst_boq_dt_pbj (no_transaksi,jns_item,kode_item,nama_item,vol_item,satuan_item,harga_item,jum_item,per_satuan_item,per_total_item)
                    values ('" . $notransaksi . "','" . $jnspek . "','".$kode."','".$brg."','".$volume."','".$satuan."','".$harsat."','".$jumlah."','".$peritem."','".$persen."')";
                   // exit('error'.$str);
                    try{
                        $owlPDO->exec($str); 


                    }catch(PDOException $e){
                        echo " Gagal," . addslashes($e->getMessage());
                    }
            }

            echo $nokontrak.'##'.$notransaksi;

        
        break;

        case 'getnotras':

                    #generate notransaksi
           $str = "select max(no_transaksi) as max from  " . $dbname . ".mst_boq_ht_pbj ";
            $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $res->setFetchMode(PDO::FETCH_OBJ);
            while ($bar = $res->fetch()) {

                
              $jumlahx=substr(@$bar->max,4,3);

                $nourut=$jumlahx;
                if ($nourut==0) {
                     $nourut=1;
                }
                else
                {
                    $nourut=$nourut+1;
                }

            }

            $nouruts = str_pad($nourut, 3, "0", STR_PAD_LEFT);
         
                 $kd='BOQ_';
        
            $notransaksi=$kd.$nouruts;

            echo $notransaksi;

        break;

        case'loadDatadetail':

            $str = "select * from " . $dbname . ".mst_boq_dt_pbj where no_transaksi='".$notransaksi."'";

            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
                
               $arrjns = array('1' =>'Barang' ,'2' =>'Jasa' );
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $arrjns[$d['jns_item']]. "</td>";          
                $tab.="<td align=left>" . $d['nama_item']. "</td>";          
                $tab.="<td align=right>" . number_format($d['vol_item']). "</td>";          
                @$tab.="<td align=left>" . $d['satuan_item']. "</td>";          
                $tab.="<td align=right>" . number_format($d['harga_item']). "</td>";          
                $tab.="<td align=right>" . number_format($d['jum_item']). "</td>";          
                $tab.="<td align=right>" . $d['per_satuan_item']. "</td>";          
                $tab.="<td align=right>" . $d['per_total_item']. "</td>";          


                  $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"editdet('".$d['jns_item']."','".$d['nama_item']."','".$d['vol_item']."','".$d['satuan_item']."','".$d['harga_item']."','".$d['jum_item']."','".$d['per_satuan_item']."','".$d['per_total_item']."','".$d['kode_item']."');\"><i class='fas fa-pencil-alt'></i>Edit
                          </a>&nbsp;";
                 $tab.="<a style='color:white'; class='btn btn-danger btn-sm' onclick=\"hapusdet('".$notransaksi."','".$d['kode_item']."');\"><i class='fas fa-trash'></i>Delete</a></td>";
                 
                $tab.="</tr>"; 
 				 }
        
        echo $tab;
    break;

    case'loadData':

            $str = "select * from " . $dbname . ".mst_boq_ht_pbj order by no_transaksi ";
           
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
                $nilaikontrak = makeOption($dbname, 'input_kontrak_pln', 'no_kontrak,nilai_kotrak');
                $amd= makeOption($dbname, 'input_kontrak_pln', 'no_kontrak,noamandemen1');
                if ($amd[$d['no_kontrak']]!='') {
                $nilaikontrak = makeOption($dbname, 'input_kontrak_pln', 'no_kontrak,nilaiamandemen');
                }


                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $d['no_transaksi']. "</td>";          
                $tab.="<td align=left>" . $d['no_kontrak']. "</td>";          
                $tab.="<td align=left>" . number_format($nilaikontrak[$d['no_kontrak']]). "</td>";          
                $tab.="<td align=left>" .  $nmvendor[$d['kode_vendor']]. "</td>";          
                     
                   
                    

                  $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['no_transaksi']."','".$d['kode_vendor']."','".$d['no_kontrak']."','".$d['nilai_kontrak']."','".$amd[$d['no_kontrak']]."','".$d['lokasi_pekerjaan']."','".$d['judul_kontrak']."','".$d['perkontrak1']."','".$d['perkontrak2']."');\"><i class='fas fa-pencil-alt'></i>Edit
                          </a></td>";
                 $tab.="<td align=left><a style='color:white'; class='btn btn-danger btn-sm' onclick=\"hapus('".$d['no_transaksi']."','".$d['no_kontrak']."');\"><i class='fas fa-trash'></i>Delete</a></td>";
                 
                $tab.="</tr>"; 
                 }
        
        echo $tab;
    break;


     case'updatedet':
     

         $str = "select sum(per_total_item) as persen from  " . $dbname . ".mst_boq_dt_pbj where no_transaksi='".$notransaksi."'";
         $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
         $res->setFetchMode(PDO::FETCH_OBJ);
         while ($bar = $res->fetch()) {
            $jmpersen=$bar->persen;

        }

        #ammbil data lama
         $strlama = "select per_total_item as persenlama from  " . $dbname . ".mst_boq_dt_pbj where  no_transaksi='".$notransaksi."' and kode_item='".$kode."'";
         $reslama=$owlPDO->query($strlama) or die(print " Gagal: ".PDOException::getMessage());
         $reslama->setFetchMode(PDO::FETCH_OBJ);
         while ($barlama = $reslama->fetch()) {
            $jmpersenlama=$barlama->persenlama;

        }

        $jumpersen=$jmpersen-$jmpersenlama+$persen;
        if ($jumpersen>100) {
           exit('Warning : Persentasi Kontrak Melebihi Ketentuan ('. $jumpersen.'%), Maks. 100%');
       }



                $supdt="update ".$dbname.".mst_boq_dt_pbj set jns_item='".$jnspek."',nama_item='".$brg."',vol_item='".$volume."',satuan_item='".$satuan."',harga_item='".$harsat."',jum_item='".$jumlah."',per_satuan_item='".$peritem."',per_total_item='".$persen."' where kode_item='".$kode."' and no_transaksi='".$notransaksi."'";
               
           
                    try{
                        $owlPDO->exec($supdt); 
                    }
                    catch (PDOException $e){
                        echo"Gagal".$e->getMessage();
                        die();
                    }

                    echo $nokontrak.'##'.$notransaksi;


        
    break;


    case'delete':

        $sIns="delete from ".$dbname.".mst_boq_ht_pbj where no_kontrak = '".$nokontrak."' and no_transaksi='".$notransaksi."'";
        try{
            $owlPDO->exec($sIns); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
            echo $nokontrak.'##'.$notransaksi;
    break;


    case'deletedet':

        $sIns="delete from ".$dbname.".mst_boq_dt_pbj where  kode_item='".$kode."' and no_transaksi='".$notransaksi."'";

        try{
            $owlPDO->exec($sIns); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }

             echo $nokontrak.'##'.$notransaksi;
    break;


    
    case'getdatakontrak':
    @$optkontrak.="<option value=''>Pilih Data</option>";
    $str = "select no_kontrak,noba,noamandemen1,sifatba from " . $dbname . ".input_kontrak_pln where nama_vendor = '".$pbj."'";

    $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
    $res->setFetchMode(PDO::FETCH_OBJ);
    while ($bar = $res->fetch()) {
        $sft=$bar->sifatba;
        $amd=substr($bar->noamandemen1,2,1);
        if ($amd=='') {
            $amd='Baru';
        }
        else
        {
         $amd='AMD '.$amd;
        }

        $optkontrak.="<option value='" . $bar->no_kontrak . "##".$sft."##".$bar->noamandemen1."'>" . $bar->no_kontrak. " (".$amd.")</option>";
        $data=$optkontrak;
    }
    echo $data;
    break;

    case'getdatakontrak2':

    $str = "select no_kontrak,noba,noamandemen1,sifatba from " . $dbname . ".input_kontrak_pln where no_kontrak = '".$nokontrak."'";

    $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
    $res->setFetchMode(PDO::FETCH_OBJ);
    while ($bar = $res->fetch()) {
        $sft=$bar->sifatba;
        $amd=substr($bar->noamandemen1,2,1);
        if ($amd=='') {
            $amd='Baru';
        }
        else
        {
         $amd='AMD '.$amd;
     }
                        
        $optkontrak.="<option value='" . $bar->no_kontrak . "##".$sft."##".$bar->noamandemen1."'>" . $bar->no_kontrak. " (".$amd.")</option>";
        $data=$optkontrak;
    }
    echo $data;
    break;

    case'getnilai':


    $str = "select * from " . $dbname . ".input_kontrak_pln where no_kontrak = '".$nokontrak."' and sifatba='".$sifatba."' and noamandemen1='".$amandemen."'";
    $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
    $res->setFetchMode(PDO::FETCH_OBJ);
    while ($bar = $res->fetch()) {
       
        if ($sifatba=='1') {
        $data=$bar->nilai_kotrak;
        }
        else
        {
         $data=$bar->nilaiamandemen;  
         $amd=$bar->noamandemen1;
        }
        $lokasi=$bar->lokasi_pekerjaan;
        $judul=$bar->judul_kontrak;
        $per1=$bar->perkontrak1;
        $per2=$bar->perkontrak2;
    }
    echo $data.'##'.$nokontrak[1].'##'.@$amd.'##'.@$lokasi.'##'.@$judul.'##'.@$per1.'##'.@$per2;
    break;
        default:

}
?>