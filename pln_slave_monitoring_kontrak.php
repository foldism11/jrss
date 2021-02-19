<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$nokontrak=checkPostGet('nokontrak','');
$judul=checkPostGet('judul','');
$tanggal=checkPostGet('tanggal','');
$tanggal2=checkPostGet('tanggal2','');
$jeniskontrak=checkPostGet('jeniskontrak','');
$method=checkPostGet('method','');

$tgl1=explode('/', $tanggal);
$tgl2=explode('/', $tanggal2);
@$tanggal=$tgl1[2].$tgl1[1].$tgl1[0];
@$tanggal2=$tgl2[2].$tgl2[0].$tgl2[1];
@$tanggal2=str_replace(' ', '', $tanggal2);


switch ($method) {

	   

        case'preview':

            if ($nokontrak!='') {
               $whr.=" and no_kontrak like '%".$nokontrak."%'";
            }
            if ($judul!='') {
               $whr.=" and judul_kontrak like '%".$judul."%'";
            }
            if ($jeniskontrak!='') {
               $whr.=" and jenis_kontrak like '%".$jeniskontrak."%'";
            }

            $str = "select * from " . $dbname . ".input_kontrak_pln where 1=1 ".$whr." and tanggal_kontrak between '".$tanggal."' and '".$tanggal2."' order by no_kontrak";
        
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
                $nmupt = makeOption($dbname, 'mst_upt_pln', 'kode_upt,nama_upt');
                $nmdirpek = makeOption($dbname, 'mst_direksi_pekerjaan_pln', 'nik_dp,nama_dp');
                $nmdirlap = makeOption($dbname, 'mst_direksi_lapangan_pln', 'nik_dl,nama_dl');
                $nmpenglap = makeOption($dbname, 'mst_pengawas_lapangan_pln', 'nik_pl,nama_pl');
                $nmjenkontrak = makeOption($dbname, 'mst_jenis_kontrak_pln', 'kode_kontrak,nama_kontrak');
                $nmsifat = makeOption($dbname, 'mst_sifat_pekerjaan_pln', 'kode_sp,nama_sp');
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $d['no_kontrak']. "</td>";          
                $tab.="<td align=left>" . $d['judul_kontrak']. "</td>";          
                $tab.="<td align=left>" . $d['tanggal_kontrak']. "</td>";          
                $tab.="<td align=left>" . $nmvendor[$d['nama_vendor']]. "</td>";          
                $tab.="<td align=left>" . number_format($d['nilai_kotrak']). "</td>";          
                $tab.="<td align=left>" . $nmupt[$d['mst_upt']]. "</td>";          
                $tab.="<td align=left>" . $nmdirpek[$d['direksi_pekerjaan']]. "</td>";          
                $tab.="<td align=left>" . @$nmdirlap[$d['direksi_lapangan']]. "</td>";          
                $tab.="<td align=left>" . $nmpenglap[$d['pengawas_lapangan']]. "</td>";          
                $tab.="<td align=left>" . $d['direktur_vendor']. "</td>";          
                $tab.="<td align=left>" . @$d['input_wbs']. "</td>";          
                $tab.="<td align=left>" . $nmjenkontrak[$d['jenis_kontrak']]. "</td>";          
                $tab.="<td align=left>" . @$nmsifat[$d['sifat_pekerjaan']]. "</td>";          
                $tab.="<td align=left></td>";
                 $tab.="<td align=left></td>";
                      
                $tab.="</tr>"; 
                $test=$d['tenaga_kerja'];
 				 }

                    $pattern = "/[\s]/";
                    $test1=preg_split($pattern, $test);


        echo $tab;
    break;


    
        default:

}
?>