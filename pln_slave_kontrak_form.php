<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$noba=checkPostGet('noba','');
$nokontrak=checkPostGet('nokontrak','');
$judul=checkPostGet('judul','');
$upt=checkPostGet('upt','');
$penyedia=checkPostGet('penyedia','');
$tanggal=checkPostGet('tanggal','');
$periode1=checkPostGet('periode1','');
$periode2=checkPostGet('periode2','');
$masa=checkPostGet('masa','');
$nilai=checkPostGet('nilai','');
$dirpekrjaan=checkPostGet('dirpekrjaan','');
$dirlap=checkPostGet('dirlap','');
$penglap=checkPostGet('penglap','');
$manupt=checkPostGet('manupt','');
$dirven=checkPostGet('dirven','');
$jeniskontrak=checkPostGet('jeniskontrak','');
$sifatkerja=checkPostGet('sifatkerja','');
$prk=checkPostGet('prk','');
$lokasi=checkPostGet('lokasi','');
$proman=checkPostGet('proman','');
$pengk3=checkPostGet('pengk3','');
$tengker=checkPostGet('tengker','');
$adm=checkPostGet('adm','');
$sifatba=checkPostGet('sifatba','');
$noreferensi=checkPostGet('noreferensi','');
$noamandemen=checkPostGet('noamandemen','');
$tanggalamandemen=checkPostGet('tanggalamandemen','');
$nilaiamandemen=checkPostGet('nilaiamandemen','');
$method=checkPostGet('method','');


$tgl=explode('/', $tanggal);
$tglamandemen=explode('/', $tanggalamandemen);
$prd1=explode('/', $periode1);
$prd2=explode('/', $periode2);
@$tanggal=$tgl[2].$tgl[0].$tgl[1];
@$tanggalamandemen=$tglamandemen[2].$tglamandemen[0].$tglamandemen[1];
@$periode1=$prd1[2].$prd1[0].$prd1[1];
@$periode2=$prd2[2].$prd2[0].$prd2[1];
@$periode2=str_replace(' ', '', $periode2);
switch ($method) {

	    case 'insert':
   
        
       
        if ($nokontrak=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($judul=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($upt=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($penyedia=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($tanggal=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($periode1=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($periode2=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($masa=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($nilai=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($dirpekrjaan=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($dirlap=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($penglap=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($manupt=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($dirven=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($jeniskontrak=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($sifatkerja=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($prk=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($lokasi=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($proman=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($pengk3=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($tengker=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($adm=='') {
        exit('Warning :  Tidak Boleh Kosong');}
        if ($sifatba=='') {
        exit('Warning :  Tidak Boleh Kosong');}



      
        if ($sifatba!=0) {
           $nmupt = makeOption($dbname, 'mst_upt_pln', 'kode_upt,nama_upt');
           $nmjenkontrak = makeOption($dbname, 'mst_jenis_kontrak_pln', 'kode_kontrak,nama_kontrak');
           $nokontrak=$nokontrak.'.'.$nmjenkontrak[$jeniskontrak].'/DAN.02.02/UIT-JBTB/UPT '.$nmupt[$upt].'/'.substr($tanggal,0,4);
        }
        else
        {
            $str = "select count(no_kontrak) as jumlah from  " . $dbname . ".input_kontrak_pln where no_kontrak='".$nokontrak."'";
            $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $res->setFetchMode(PDO::FETCH_OBJ);
            while ($bar = $res->fetch()) {
                $nourut=$bar->jumlah;

            }

            $nourutx = str_pad($nourut, 3, "0", STR_PAD_LEFT);
            $nokontrk=explode('/', $nokontrak);
            $noamandemen=$nourutx.'.AMD/'.$nokontrk[0].'/'.$nokontrk[1].'/'.$nokontrk[3].'/'.substr($tanggalamandemen,0,4);
            $noreferensi=$nokontrak;

        }
       

        
                         
        $str="insert into ".$dbname.".input_kontrak_pln (no_kontrak,noba,judul_kontrak,nama_vendor,tanggal_kontrak,perkontrak1,perkontrak2,masa_pemeliharaan,man_upt,prk,lokasi_pekerjaan,project_manager,pengawas_k3,adm,tenaga_kerja,nilai_kotrak,direksi_pekerjaan,direksi_lapangan,pengawas_lapangan,mst_upt,direktur_vendor,input_wbs,jenis_kontrak,sifat_pekerjaan,sifatba,noreferensi,noamandemen1,tanggal_amandemen,nilaiamandemen)
        values ('" . $nokontrak . "','" . $noba . "','" . $judul . "','" . $penyedia . "','" . $tanggal . "','" . $periode1 . "','" . $periode2 . "','" . $masa . "','" . $manupt . "','" . $prk . "','" . $lokasi . "','" . $proman . "','" . $pengk3 . "','" . $adm . "','" . $tengker . "','" . $nilai . "','" . $dirpekrjaan . "','" . $dirlap . "','" . $penglap . "','" . $upt . "','" . $dirven . "','','" . $jeniskontrak . "','" . $sifatkerja . "','" . $sifatba . "','" . $noreferensi . "','" . $noamandemen . "','" . $tanggalamandemen . "','" . $nilaiamandemen . "')";
        //exit('error'.$str);
	    try{
	    	$owlPDO->exec($str); 
	    }catch(PDOException $e){
	    	echo " Gagal," . addslashes($e->getMessage());
	    }

        break;

        case'loadData':

            $str = "select * from " . $dbname . ".input_kontrak_pln ";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
                $nmupt = makeOption($dbname, 'mst_upt_pln', 'kode_upt,nama_upt');
                $nmdirpek = makeOption($dbname, 'mst_direksi_pekerjaan_pln', 'nik_dp,nama_dp');
                $nmdirlap = makeOption($dbname, 'mst_direksi_lapangan_pln', 'nik_dl,nama_dl');
                $nmpenglap = makeOption($dbname, 'mst_pengawas_lapangan_pln', 'nik_pl,nama_pl');
                $nmdirven = makeOption($dbname, 'mst_dirven_pbj', 'kode_dirven,nama_dirven');
                $nmjenkontrak = makeOption($dbname, 'mst_jenis_kontrak_pln', 'kode_kontrak,nama_kontrak');
                $nmsifat = makeOption($dbname, 'mst_sifat_pekerjaan_pln', 'kode_sp,nama_sp');
                $sft= array('0' =>'Amandemen', '1' =>'Baru');
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $d['no_kontrak']. "</td>";          
                $tab.="<td align=left>" . $d['judul_kontrak']. "</td>";          
                $tab.="<td align=left>" . $d['tanggal_kontrak']. "</td>";          
                @$tab.="<td align=left>" . $nmvendor[$d['nama_vendor']]. "</td>";          
                $tab.="<td align=left>" . number_format($d['nilai_kotrak']). "</td>";          
                //@$tab.="<td align=left>" . $nmupt[$d['mst_upt']]. "</td>";          
               /* @$tab.="<td align=left>" . $nmdirpek[$d['direksi_pekerjaan']]. "</td>";          
                $tab.="<td align=left>" . @$nmdirlap[$d['direksi_lapangan']]. "</td>";          
                $tab.="<td align=left>" . @$nmpenglap[$d['pengawas_lapangan']]. "</td>";          
                $tab.="<td align=left>" . @$nmdirven[$d['direktur_vendor']]. "</td>";      */    
                $tab.="<td align=left>" . @$nmjenkontrak[$d['jenis_kontrak']]. "</td>";          
                $tab.="<td align=left>" . @$nmsifat[$d['sifat_pekerjaan']]. "</td>";          
                $tab.="<td align=left>" . @$sft[$d['sifatba']]. "</td>";          
               /* $tab.="<td align=left><img src=images/application/application_edit.png class=resicon caption='Edit' onclick=\"edit('".$d['no_kontrak']."','".$d['noba']."','".$d['judul_kontrak']."','".$d['nama_vendor']."','".$d['tanggal_kontrak']."','".$d['perkontrak1']."','".$d['perkontrak2']."','".$d['masa_pemeliharaan']."','".$d['man_upt']."','".$d['prk']."','".$d['lokasi_pekerjaan']."','".$d['project_manager']."','".$d['pengawas_k3']."','".$d['tenaga_kerja']."','".$d['nilai_kotrak']."','".$d['direksi_pekerjaan']."','".$d['direksi_lapangan']."','".$d['pengawas_lapangan']."','".$d['mst_upt']."','".$d['direktur_vendor']."','".$d['input_wbs']."','".$d['jenis_kontrak']."','".$d['sifat_pekerjaan']."');\"></td>";
                 $tab.="<td align=left><img src=images/application/application_delete.png class=resicon caption='Edit' onclick=\"hapus('".$d['no_kontrak']."','".$d['noba']."');\"></td>";*/

                  $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edit('".$d['no_kontrak']."','".$d['noamandemen1']."');\"><i class='fas fa-pencil-alt'></i>Edit
                          </a></td>";
                 $tab.="<td align=left><a style='color:white'; class='btn btn-danger btn-sm' onclick=\"hapus('".$d['no_kontrak']."','".$d['noba']."');\"><i class='fas fa-trash'></i>Delete</a></td>";
                 
                $tab.="</tr>"; 
 				 }
        
        echo $tab;
    break;


     case'update':
        
        if ($sifatba==0) {
                if ($tanggalamandemen=='') {
                   exit('Warning : Tanggal Amandemen Kosong');     
                }

                if ($nilaiamandemen=='') {
                   exit('Warning : Nilai Amandemen Kosong');     
                }
        }


                $supdt="update ".$dbname.".input_kontrak_pln set no_kontrak='".$nokontrak."',noba='".$noba."',judul_kontrak='".$judul."',nama_vendor='".$penyedia."',tanggal_kontrak='".$tanggal."',perkontrak1='".$periode1."',perkontrak2='".$periode2."',man_upt='".$manupt."',prk='".$prk."',lokasi_pekerjaan='".$lokasi."',project_manager='".$proman."',pengawas_k3='".$pengk3."',adm='".$adm."',tenaga_kerja='".$tengker."',nilai_kotrak='".$nilai."',direksi_pekerjaan='".$dirpekrjaan."',direksi_lapangan='".$dirlap."',pengawas_lapangan='".$penglap."',mst_upt='".$upt."',direktur_vendor='".$dirven."',jenis_kontrak='".$jeniskontrak."',sifat_pekerjaan='".$sifatkerja."',masa_pemeliharaan='".$masa."',sifatba='".$sifatba."',noreferensi='".$noreferensi."',tanggal_amandemen='".$tanggalamandemen."',nilaiamandemen='".$nilaiamandemen."' where no_kontrak = '".$nokontrak."' and noamandemen1='".$noamandemen."'";
           
                    try{
                        $owlPDO->exec($supdt); 
                    }
                    catch (PDOException $e){
                        echo"Gagal".$e->getMessage();
                        die();
                    }


        
    break;


    case'delete':
        $sIns="delete from ".$dbname.".input_kontrak_pln where no_kontrak = '".$nokontrak."' and noba='".$noba."'";
        try{
            $owlPDO->exec($sIns); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;


    case'getdatapbj':
        $optdirven=$optmgr=$optk3=$optadm="<option value=''>Pilih Data</option>";
        $str = "select kode_dirven,nama_dirven from " . $dbname . ".mst_dirven_pbj where kode_pbj='".$penyedia."'";
        $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($bar = $res->fetch()) {
            $optdirven.="<option value='" . $bar->kode_dirven . "'>" . $bar->nama_dirven. "</option>";
        }

        $str = "select kode_mgr,nama_mgr from " . $dbname . ".mst_mgr_project_pbj where kode_pbj='".$penyedia."'";
        $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($bar = $res->fetch()) {
            $optmgr.="<option value='" . $bar->kode_mgr . "'>" . $bar->nama_mgr. "</option>";
        }

        $str = "select kode_pengawas_k3,nama_pengawas_k3 from " . $dbname . ".mst_pengawas_k3_pbj where kode_pbj='".$penyedia."'";
        $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($bar = $res->fetch()) {
            $optk3.="<option value='" . $bar->kode_pengawas_k3 . "'>" . $bar->nama_pengawas_k3. "</option>";
        }

        $str = "select kode_administrasi,nama_administrasi from " . $dbname . ".mst_administrasi_pbj where kode_pbj='".$penyedia."'";
        $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($bar = $res->fetch()) {
            $optadm.="<option value='" . $bar->kode_administrasi . "'>" . $bar->nama_administrasi. "</option>";
        }
        echo $optdirven.'##'.$optmgr.'##'.$optk3.'##'.$optadm;
    break;


    case'getdataupt':

        $optpenglapangan=$optdirpekerjaan=$optdirlapangan="<option value=''>Pilih Data</option>";

        $str = "select nik_dp,nama_dp from " . $dbname . ".mst_direksi_pekerjaan_pln where kode_upt='".$upt."'";
        $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($bar = $res->fetch()) {
            $optdirpekerjaan.="<option value='" . $bar->nik_dp . "'>" . $bar->nama_dp. "</option>";
        }

        $str = "select nik_dl,nama_dl from " . $dbname . ".mst_direksi_lapangan_pln where kode_upt='".$upt."'";
        $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($bar = $res->fetch()) {
            $optdirlapangan.="<option value='" . $bar->nik_dl . "'>" . $bar->nama_dl. "</option>";
        }

        $str = "select nik_pl,nama_pl from " . $dbname . ".mst_pengawas_lapangan_pln where kode_upt='".$upt."'";
        $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($bar = $res->fetch()) {
            $optpenglapangan.="<option value='" . $bar->nik_pl . "'>" . $bar->nama_pl. "</option>";
        }


        echo $optdirpekerjaan.'##'.$optdirlapangan.'##'.$optpenglapangan;

    break;

    case'getdata':
    $str = "select * from " . $dbname . ".input_kontrak_pln where no_kontrak = '".$nokontrak."' and noamandemen1='".$noamandemen."'";
    $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
    $res->setFetchMode(PDO::FETCH_OBJ);
    while ($bar = $res->fetch()) {

    
        @$data=$bar->no_kontrak.'##'.$bar->judul_kontrak.'##'.$bar->noba.'##'.$bar->mst_upt.'##'.$bar->nama_vendor.'##'.$bar->tanggal_kontrak.'##'.$bar->perkontrak1.'##'.$bar->perkontrak2.'##'.$bar->masa_pemeliharaan.'##'.$bar->nilai_kotrak.'##'.$bar->direksi_pekerjaan.'##'.$bar->direksi_lapangan.'##'.$bar->pengawas_lapangan.'##'.$bar->man_upt.'##'.$bar->direktur_vendor.'##'.$bar->jenis_kontrak.'##'.$bar->sifat_pekerjaan.'##'.$bar->prk.'##'.$bar->lokasi_pekerjaan.'##'.$bar->project_manager.'##'.$bar->pengawas_k3.'##'.$bar->tenaga_kerja.'##'.$bar->adm.'##'.$bar->sifatba.'##'.$bar->noreferensi.'##'.$bar->noamandemen1.'##'.$bar->tanggal_amandemen.'##'.$bar->nilaiamandemen;

    }
    echo $data;
   //exit('error'.$aman);
    break;

    case'getdatakontrak':
    $str = "select * from " . $dbname . ".input_kontrak_pln where no_kontrak = '".$noreferensi."'";
    $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
    $res->setFetchMode(PDO::FETCH_OBJ);
    while ($bar = $res->fetch()) {
        $data=$bar->no_kontrak.'##'.$bar->judul_kontrak.'##'.$bar->noba.'##'.$bar->mst_upt.'##'.$bar->nama_vendor.'##'.$bar->tanggal_kontrak.'##'.$bar->perkontrak1.'##'.$bar->perkontrak2.'##'.$bar->masa_pemeliharaan.'##'.$bar->nilai_kotrak.'##'.$bar->direksi_pekerjaan.'##'.$bar->direksi_lapangan.'##'.$bar->pengawas_lapangan.'##'.$bar->man_upt.'##'.$bar->direktur_vendor.'##'.$bar->jenis_kontrak.'##'.$bar->sifat_pekerjaan.'##'.$bar->prk.'##'.$bar->lokasi_pekerjaan.'##'.$bar->project_manager.'##'.$bar->pengawas_k3.'##'.$bar->tenaga_kerja.'##'.$bar->adm.'##'.$bar->sifatba.'##'.$bar->noreferensi;
    }
    echo $data;
    break;
        default:

}
?>