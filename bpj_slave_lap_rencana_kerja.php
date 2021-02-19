<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$nokontrak=checkPostGet('nokontrak','');
$noba=checkPostGet('noba','');
$hari=checkPostGet('hari','');
$bobot=checkPostGet('bobot','');
$mingguke=checkPostGet('mingguke','');
$bulanke=checkPostGet('bulanke','');
$minggu1=checkPostGet('minggu1','');
$minggu2=checkPostGet('minggu2','');
$bulanke=checkPostGet('bulanke','');
$tanggal=checkPostGet('tanggal','');
$tanggal2=checkPostGet('tanggal2','');
$proman=checkPostGet('proman','');
$penglap=checkPostGet('penglap','');
$kegiatan=checkPostGet('kegiatan','');
$nmtk=checkPostGet('nmtk','');
$material=checkPostGet('material','');
$peralatan=checkPostGet('peralatan','');
$keg_mingguini=checkPostGet('mingguini','');
$keg_minggulalu=checkPostGet('minggulalu','');
$keg_bulanini=checkPostGet('bulanini','');
$keg_bulanlalu=checkPostGet('bulanlalu','');
$ket=checkPostGet('ket','');
$method=checkPostGet('method','');

$tgl1=explode('/', $tanggal);
$tgl2=explode('/', $tanggal2);
@$tanggal=$tgl1[2].$tgl1[0].$tgl1[1];
@$tanggal2=$tgl2[2].$tgl2[0].$tgl2[1];
@$tanggal2=str_replace(' ', '', $tanggal2);


switch ($method) {

        case'loadData':
        $tab="<tr>";
        $tab.="<td align='center' colspan=3>LAPORAN HARIAN</td>";
        $tab.="</tr>";
        $tab.="<tr>";
        $tab.="<td align='left' width=300px>Nama Pekerjaan</td>";
        $tab.="<td align='left' width=20px>:</td>";
        $tab.="<td align='left'></td>";
        $tab.="</tr>";
        $tab.="<tr>";
        $tab.="<td align='left' width=300px>Nomor Surat Perjanjian</td>";
        $tab.="<td align='left' width=20px>:</td>";
        $tab.="<td align='left'></td>";
        $tab.="</tr>";
        $tab.="<tr>";
        $tab.="<td align='left' width=300px>Kontraktor Pelaksana</td>";
        $tab.="<td align='left' width=20px>:</td>";
        $tab.="<td align='left'></td>";
        $tab.="</tr>";
        $tab.="<tr>";
        $tab.="<td align='left' width=300px>Tanggal</td>";
        $tab.="<td align='left' width=20px>:</td>";
        $tab.="<td align='left'></td>";
        $tab.="</tr>";
        $tab.="<tr>";
        $tab.="<td align='left' width=300px>Hari</td>";
        $tab.="<td align='left' width=20px>:</td>";
        $tab.="<td align='left'></td>";
        $tab.="</tr>";
        $tab.="<tr>";
        $tab.="<td align='left' width=300px>Lokasi</td>";
        $tab.="<td align='left' width=20px>:</td>";
        $tab.="<td align='left'></td>";
        $tab.="</tr>";

        if ($noba!='') {
            $whr=" and noba='".$noba."'";
        }
            $str = "select * from " . $dbname . ".laporan_kerja_harian_pbj where nokontrak='".$nokontrak."' ".$whr." and hari='".$hari."' and tanggal1 >= '".$tanggal."' and tanggal2 <= '".$tanggal2."'";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
              $no+=1;

                $nokontrakx[$d['nokontrak']]=$d['nokontrak'];
                $nobax[$d['noba']]=$d['noba'];
                $tanggalx[$d['nokontrak'].$d['noba']]=$d['tanggal1'];
                $harix[$d['nokontrak'].$d['noba']]=$d['hari'];
                $lsIndex[$d['nokontrak'].$d['noba']]=$d['nokontrak'].$d['noba'];


                $tabx.="<tr>";
                $tabx.="<td rowspan='4'>".$no."</td>";
                $tabx.="<td rowspan='4'>".$d['hari']."</td>";
                $tabx.="<td rowspan='4'>".$d['tanggal1']."</td>";
                $tabx.="<td rowspan='4'>".$d['kegiatan']."</td>";
                $tabx.="<td rowspan='4'>".$d['tenaga_kerja']."</td>";
                $tabx.="<td rowspan='4'>".$d['material']."</td>";
              

                $tabx.="</tr>";
          }

                
                $tmpd="";
                $str = "select * from " . $dbname . ".laporan_kerja_harian_pbj_keg where nokontrak='".$nokontrak."' ".$whr." and hari='".$hari."' and tanggal1 >= '".$tanggal."' and tanggal2 <= '".$tanggal2."'";
                $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                $n->setFetchMode(PDO::FETCH_ASSOC);
                while ($d = $n->fetch()) {
                    $tempdt=$d['nokontrak'].$d['noba'];
                    if($tempd!=$tempdt){
                      $tempd=$tempdt;
                      $awal=1;
                    }else{
                      $awal+=1;
                    }
                    $kegiatanx[$d['nokontrak'].$d['noba']][$awal][]=$d['kegiatan'];
                     

                }
                $awal=1;
                $str = "select * from " . $dbname . ".laporan_kerja_harian_pbj_tk where nokontrak='".$nokontrak."' ".$whr." and hari='".$hari."' and tanggal1 >= '".$tanggal."' and tanggal2 <= '".$tanggal2."'";
                $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                $n->setFetchMode(PDO::FETCH_ASSOC);
                while ($d = $n->fetch()) {
                     $tempdt=$d['nokontrak'].$d['noba'];
                    if($tempd!=$tempdt){
                      $tempd=$tempdt;
                      $awal=1;
                    }else{
                      $awal+=1;
                    }
                    $tkx[$d['nokontrak'].$d['noba']][$awal][]=$d['tenaga_kerja'];
                }

               /* foreach($lsIndex as $dt){
                   $rowData[$dt]=count($kegiatanx[$dt]);
                   if(count($kegiatanx[$dt])<count($tkx[$dt])){
                      $rowData[$dt]=count($tkx[$dt]);
                   }
                }
                echo "<pre>";
                print_r($tkx);
                echo "</pre>";


                  echo "<pre>";
                print_r($kegiatanx);
                echo "</pre>";

                foreach ($nokontrakx as $ktrk) {
                    foreach ($nobax as $nb) {
                       $no+=1;
                       $isi=$ktrk.$nb;
                       $tabx.="<tr>";
                       $tabx.="<td rowspan='4'>".$no."</td>";
                       $tabx.="<td rowspan='4'>".$harix[$isi]."</td>";
                       $tabx.="<td rowspan='4'>".$tanggalx[$isi]."</td>";
                       foreach ($kegiatanx[$ktrk.$nb] as $keg) {
                          $tabx.="<tr>";
                       $tabx.="<td>".$keg."</td>";
                       }

                       foreach ($tkx[$ktrk.$nb] as $tk) {
                          
                       $tabx.="<td>".$tk."</td>";
                       }

                       $tabx.="</tr>";

                      

                    }
                   
                }
                */


              
        
                echo $tab."##".$tabx;

             break;

             case 'getba':

            #data BA
             $strba = "select no_kontrak,noba from " . $dbname . ".input_kontrak_pln where no_kontrak='".$nokontrak."' order by no_kontrak";
             $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
             $resba->setFetchMode(PDO::FETCH_OBJ);
             while ($barba = $resba->fetch()) {
                @$optba.="<option value='" . $barba->noba . "'>" . $barba->noba. "</option>";
            }
            echo $optba;


            break;

        default:

}
?>