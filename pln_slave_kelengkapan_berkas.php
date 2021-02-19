<?php

require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/terbilang.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('dompdf/autoload.inc.php');
use Dompdf\Dompdf;



$nokontrak=checkPostGet('nokontrak','');
$judul=checkPostGet('judul','');
$tanggal=checkPostGet('tanggal','');
$tanggal2=checkPostGet('tanggal2','');
$jeniskontrak=checkPostGet('jeniskontrak','');
$jenisba=checkPostGet('jenis','');
$sifatba=checkPostGet('sifatba','');
$method=checkPostGet('method','');
$arrwktu=array('0' => 'Sesuai','1' => 'Tidak Sesuai' );
$arrdenda=array('0' => 'Dikenakan','1' => 'Tidak Dikenakan' );

$tgl1=explode('/', $tanggal);
$tgl2=explode('/', $tanggal2);
@$tanggal=$tgl1[2].$tgl1[0].$tgl1[1];
@$tanggal2=$tgl2[2].$tgl2[0].$tgl2[1];
@$tanggal2=str_replace(' ', '', $tanggal2);

$alamatvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,alamat');
$alamatupt = makeOption($dbname, 'mst_upt_pln', 'kode_upt,alamat');
$path='fileupload/';
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
              
                $nmjenkontrak = makeOption($dbname, 'mst_jenis_kontrak_pln', 'kode_kontrak,nama_kontrak');
                $nmsifat = makeOption($dbname, 'mst_sifat_pekerjaan_pln', 'kode_sp,nama_sp');
                $sft= array('0' =>'Amandemen', '1' =>'Baru');
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $d['no_kontrak']. "</td>";          
                $tab.="<td align=left>" . $d['judul_kontrak']. "</td>";          
                $tab.="<td align=left>" . $d['tanggal_kontrak']. "</td>";          
                $tab.="<td align=left>" . $nmvendor[$d['nama_vendor']]. "</td>";          
                $tab.="<td align=left>" . number_format($d['nilai_kotrak']). "</td>";            
                $tab.="<td align=left>" . $nmjenkontrak[$d['jenis_kontrak']]. "</td>";          
                $tab.="<td align=left>" . @$nmsifat[$d['sifat_pekerjaan']]. "</td>";  
                $tab.="<td align=left>" . @$sft[$d['sifatba']]. "</td>";  

                $tab.="<td align=left><img src=images/pdf.jpg class=resicon class=zImgBtn height='30'  title='pdf' onclick=\"pdf('" . $d['no_kontrak']. "','" . $d['sifatba']. "');\" >
                        <img src=images/download.png class=resicon class=zImgBtn height='30'  title='upload' onclick=\"uploaddata('" . $d['no_kontrak']. "');\" ></td>";

               /*  $tab.="<td align=left><img src=images/download.png class=resicon class=zImgBtn height='30'  title='upload' onclick=\"uploaddata('" . $d['no_kontrak']. "');\" ></td>";
                 $tab.="<td align=left></td>";*/
                      
                $tab.="</tr>"; 
                 }
        
        echo $tab;
    break;


case 'pdf':
        #data Jenis BA
        $optba="<option value=''>Pilih Jenis</option>";
        $strba = "select kode_ba,nama_ba,nourut from " . $dbname . ".mst_jnsba_pln where status='1' order by nourut";
        $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
        $resba->setFetchMode(PDO::FETCH_OBJ);
        while ($barba = $resba->fetch()) {
            $optba.="<option value='" . $barba->kode_ba . "'>" . $barba->nourut. ". " . $barba->nama_ba. "</option>";
        }

        echo"
        <table class=sortable cellspacing=1 cellpadding=5 border=0 width=100%>
            <thead> 
            <tr>
                <td align=center>Jenis BA</td>
                <td align=center>:</td>
                <td align=center>&nbsp;</td>
                <td>
                <select id='idba'  style='height:25px; width:400px;'>".$optba."</select>
                </td>
                <td>
                <button class='field_bt' onclick=\"cetak('".$nokontrak."','".$sifatba."','event')\">Cetak</button> 
                </td>
            </tr>";
            
        echo"</table>
       ";
        

    break;

    case 'cetak':

    $stream='';

    #get data jenis ba
    $strba = "select kode_ba,nama_ba from " . $dbname . ".mst_jnsba_pln where kode_ba='".$jenisba."' and status='1'";
    $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
    $resba->setFetchMode(PDO::FETCH_OBJ);
    while ($barba = $resba->fetch()) {
        $namaba=$barba->nama_ba;
        $kodeba=$barba->kode_ba;
    }

     #get data Kontrak
    $str = "select * from " . $dbname . ".input_kontrak_pln where no_kontrak='".$nokontrak."' and sifatba='".$sifatba."'";
    $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
    $res->setFetchMode(PDO::FETCH_OBJ);
    while ($bar = $res->fetch()) {
        $nokntrk=$bar->no_kontrak;
        $upt=$bar->mst_upt;
        $tgl=$bar->tanggal_kontrak;
        $vendor=$bar->nama_vendor;
        $dirpekerjaan=$bar->direksi_pekerjaan;
        $dirlap=$bar->direksi_lapangan;
        $penglap=$bar->pengawas_lapangan;
        $proman=$bar->project_manager;
        $judul=$bar->judul_kontrak;
        $nilai=$bar->nilai_kotrak;
        $dirven=$bar->direktur_vendor;
        $dirven=$bar->direktur_vendor;
        $sifatba=$bar->sifatba;
        $manupt=$bar->man_upt;
        $noamandemen1=$bar->noamandemen1;
        $tanggalamandemen=$bar->tanggal_amandemen;
        
    }

    #get data BA
    $strba = "select * from " . $dbname . ".input_ba_pln where no_kontrak='".$nokontrak."' and jenis_ba='".$jenisba."' and sifatba='".$sifatba."'";
    $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
    $resba->setFetchMode(PDO::FETCH_OBJ);
    while ($barba = $resba->fetch()) {
       $noba=$barba->noba;
       $tglba=$barba->tanggal_ba;
       $tgllkp=$barba->tanggallkp;
       $persenbakp=$barba->persenbakp;
       $refkontrakbakp=$barba->refkontrakbakp;
       $pasalbasp=$barba->pasalbasp;
       $tahapbasp=$barba->tahapbasp;
       $sampaibasp=$barba->sampaibasp;
       $nominalbasp=$barba->nominalbasp;
       $waktubasp=$barba->waktubasp;
       $dendabasp=$barba->dendabasp;
       $waktuterlambatbasp=$barba->waktuterlambatbasp;
       $persenbasp=$barba->persenbasp;
       $ketpbjbast=$barba->ketpbjbast;
       $nobaspbast=$barba->nobaspbast;
       $tanggalbaspbast=$barba->tanggalbaspbast;

       $ketpbjbastb=$barba->ketpbjbastb;
       $nobaspbastb=$barba->nobaspbastb;
       $tanggalbaspbastb=$barba->tanggalbaspbastb;

       $nobappbak=$barba->nobappbak;
       $tanggalbappbak=$barba->tanggalbappbak;
       $terlambatbak=$barba->terlambatbak;
       $persenbak=$barba->persenbak;
       $nobakpbap=$barba->nobakpbap;
       $nobappbap=$barba->nobappbap;
       $nobakbap=$barba->nobakbap;
       $persenbap=$barba->persenbap;
       $terminbap=$barba->terminbap;
       $persen2bap=$barba->persen2bap;
       $nominalbap=$barba->nominalbap;
       $lamamasabasmp=$barba->lamamasabasmp;
       $pasalbasmp=$barba->pasalbasmp;
       $tahapbasmp=$barba->tahapbasmp;
       $terbayarbasmp=$barba->terbayarbasmp;

       $sebabbaepw=$barba->sebabbaepw;
       $tglevaluasibaepw=$barba->tglevaluasibaepw;
       $wktperpanjangbaepw=$barba->wktperpanjangbaepw;
       $mulaibaepw=$barba->mulaibaepw;
       $batasbaepw=$barba->batasbaepw;
       $tanggaljaminanbaepw=$barba->tanggaljaminanbaepw;
       $dendabaepw=$barba->dendabaepw;
       $urutbaepw=$barba->urutbaepw;

       $suratbaetk=$barba->suratbaetk;
       $resumebaetk=$barba->resumebaetk;
       $fcrbaetk=$barba->fcrbaetk;
       $perhitunganbaetk=$barba->perhitunganbaetk;
       $evaluasibaetk=$barba->evaluasibaetk;
       $ppnbaetk=$barba->ppnbaetk;
       $ppn2baetk=$barba->ppn2baetk;
       $urutbaetk=$barba->urutbaetk;


       $suratbapjd=$barba->suratbapjd;
       $resumebapjd=$barba->resumebapjd;
       $judulbapjd=$barba->judulbapjd;
    }

    $stream='';
            $stream.="<style>
            @page {
                margin-top: 30px;
                margin-left: 30px;
                margin-right: 30px;
                margin-bottom: 30px;
            }
            
            
            footer {
                position: fixed; 
                bottom: -20px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
            }
            div.page_break {
                page-break-before: always;
            }
        </style>";


    $nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
    $nmupt = makeOption($dbname, 'mst_upt_pln', 'kode_upt,nama_upt');
    $nmdirpek = makeOption($dbname, 'mst_direksi_pekerjaan_pln', 'nik_dp,nama_dp');
    $nmproman = makeOption($dbname, 'mst_mgr_project_pbj', 'kode_mgr,nama_mgr');
    $nmdirlap = makeOption($dbname, 'mst_direksi_lapangan_pln', 'nik_dl,nama_dl');
    $nmdirven = makeOption($dbname, 'mst_dirven_pbj', 'kode_dirven,nama_dirven');

     if ($jenisba=='bastap') {


        # KOP
         $stream.="<div style='page-break-after: always;'>";
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=substr($namaba,13).' ('.$kodeba.')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>".substr($namaba,0,13)."</font></td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17><u>".strtoupper($nmba)."</u></font></td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td>No : ".$noba."</td>";
         $stream.="</tr>";
         $stream.="</table>";


         #Body
         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td>Pada hari ini <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".tanggalnormal($tglba).") </b>, kami  yang bertandatangan di bawah ini :</td>";
         $stream.="</tr>";
         $stream.="</table>";


         $stream.="<table border=0 width=100%>";
         $stream.="<tr>";
         $stream.="<td width=50%>Nama</td>";
         $stream.="<td width=50%>Jabatan</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td width=50%>".$nmdirpek[$dirpekerjaan]."</td>";
         $stream.="<td width=50%>Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td width=50%>".$nmdirlap[$dirlap]."</td>";
         $stream.="<td width=50%>Direksi Lapangan</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td width=50%>".$nmproman[$proman]."</td>";
         $stream.="<td width=50%>Project Manager</td>";
         $stream.="</tr>";
         $stream.="<br>";
         $stream.="</table>";


         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td >Sesuai dengan Surat Perjanjian/Kontrak Nomor ".$nokntrk." Tanggal ".substr($tglba,8,2)." ".bulan(substr($tglba,5,2))." ".substr($tglba,0,4)." Pekerjaan Rekonfigurasi single Phi menjadi Double Phi GI Balong Bendo.</td>";
     /*    $stream.="<td >Sesuai dengan Surat Perjanjian/Kontrak Nomor ".$nokntrk." Tanggal ".tanggalnormal($tglba)." Pekerjaan ".$judul."</td>";*/
         $stream.="</tr>";
         $stream.="</table>";
         $stream.="<br>";

         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td >Bahwa sehubungan dengan Pelaksanaan Perjanjian tersebut, PT PLN (Persero) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI /UPT ".$nmupt[$upt]." menyerahkan Area/Lahan Pekerjaan sesuai dengan dokumen “Denah Area/Lahan Pekerjaan” terlampir selama masa pekerjaan yang disepakati dalam Surat Perjanjian.</td>";
         $stream.="</tr>";
         $stream.="</table>";
         $stream.="<br>";

         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td >Demikian Berita Acara Serah Terima Area/Lahan Pekerjaan ini dibuat untuk dipergunakan sebagaimana mestinya.</td>";
         $stream.="</tr>";
         $stream.="</table>";
         $stream.="<br>";

        $stream.="<table border=0 align=center>";
         $stream.="<tr>";
         $stream.="<td >Yang Membuat Berita Acara,</td>";
         $stream.="</tr>";
         $stream.="</table>";
         $stream.="<br>";

         #TTD
         $stream.="<table border=0 align=center width=100%>";
         $stream.="<tr>";
         $stream.="<td width=40%>".$nmvendor[$vendor]."</td>";
         $stream.="<td >PT PLN (Persero) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI/UPT ".$nmupt[$upt]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td ><b>".$nmdirpek[$dirpekerjaan]."</b><br>Direksi Pekerjaan</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td ><b>".$nmproman[$proman]."</b><br>Project Manager</td>";
         $stream.="<td >PT PLN (Persero) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI/UPT ".$nmupt[$upt]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td ><b>Nama</b><br>Direksi Pekerjaan</td>";
         $stream.="<td >".$nmdirpek[$dirpekerjaan]."</td>";
         $stream.="</tr>";
         $stream.="</table>";
         $stream.="</div>"; 


         # KOP
         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td>";
         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
         $stream.="</tr>";
         $stream.="</table>";
         $stream.="</td>";

         $stream.="<td>";
         $stream.="<table border=0>";
         $stream.="<tr style='font-weight:bold'>";
         $stream.="<td>PT PLN (Persero)</td>";
         $stream.="</tr>";
         $stream.="<tr style='font-weight:bold'>";
         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
         $stream.="</tr>";
         $stream.="<tr style='font-weight:bold'>";
         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
         $stream.="</tr>";
         $stream.="</table>";
         $stream.="</td>";
         $stream.="<hr />";
         $stream.="</tr>";
         $stream.="</table>";


         #Header
         $nmba=substr($namaba,13).' ('.$kodeba.')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>Lampiran ".strtoupper($kodeba)."</font></td>";
         $stream.="</tr>";
         $stream.="</table><br>";


         #Body
         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td>Surat Perjanjian</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$nokntrk."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td>Tanggal Kontrak</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td>Pelaksana Pekerjaan</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$nmvendor[$vendor]."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td style='font-weight:bold'><b>Tertib Administrasi dan Pekerjaan :</b></td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td valign=top width=2%>1.</td>";
         $stream.="<td colspan=3>  PT PLN (PERSERO) UIT-JBTB / UPT  ".$nmupt[$upt]." mulai tanggal ".substr($tglba,8,2)." ".bulan(substr($tglba,5,2))." ".substr($tglba,0,4)." sampai dengan berakhirnya kontrak mengijinkan ".$nmvendor[$vendor]." untuk menggunakan area/lahan proyek mulai dari pintu masuk sampai dengan area/lahan bekerja yang sudah ditentukan sesuai dengan ”denah area/lahan pekerjaan” terlampir.</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td valign=top width=2%width=2%>2.</td>";
         $stream.="<td colspan=3>  ".$nmvendor[$vendor]." harus melakukan hal-hal sebagai berikut:</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>a.</td>";
         $stream.="<td colspan=2>Melaksanakan sistem aturan ”Sistem Manajemen Keselamatan dan Kesehatan Kerja (SMK3)” yang diberlakukan di GI Balong Bendo yang berkoordinasi dengan Direksi Lapangan, diantaranya:</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td  width=2%></td>";
         $stream.="<td valign=top width=2%>V</td>";
         $stream.="<td >Untuk Pekerjaan yang berhubungan dengan sistem maka Working Permit (WP) dibuat sesuai masa pelaksanaan.</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td  width=2%></td>";
         $stream.="<td valign=top width=2%>V</td>";
         $stream.="<td >Untuk pekerjaan yang tidak berhubungan dengan sistem eksisting maka Working Permit dibuat per 14 hari kalender.</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>b.</td>";
         $stream.="<td colspan=2>Selama masa waktu pelaksanaan pekerjaan agar memasang informasi gambar kerja, Kurva-S, dan laporan pencapaian progres pada tempat yang disediakan oleh pengawas lapangan.</td>";
         $stream.="</tr>";


         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>c.</td>";
         $stream.="<td colspan=2>Memberi informasi jumlah tenaga kerja yang bekerja pada lahan yang disediakan dan waktu bekerja pada petugas keamanan setempat dan tenaga kerja diwajibkan menggunakan seragam dan Name Tag/Identitas Perusahaan.</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>d.</td>";
         $stream.="<td colspan=2>Seluruh kerusakan, keamanan, kebersihan area/lahan terkait jalan akses masuk kendaraan berat, storage Area dan Temporary Direksi Kit menjadi tanggungjawab ".$nmvendor[$vendor]."</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>e.</td>";
         $stream.="<td colspan=2>Tenaga kerja yang bekerja tidak diijnkan menginap/tinggal di area/lahan pekerjaan terkecuali petugas keamanan (dari ".$nmvendor[$vendor].") yang menjaga peralatan/material dan jadwal pekerjaan yang membutuhkan shift malam atas persetujuan Pengawas Lapangan.</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td valign=top width=2%width=2%>3.</td>";
         $stream.="<td colspan=3>  ".$nmvendor[$vendor]." tetap memperhatikan dan melaksanakan sesuai pasal-pasal yang ada dalam Surat Perjanjian sebagai berikut:</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>a.</td>";
         $stream.="<td colspan=2>Pasal 1 ”Lingkup Pekerjaan”</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>b.</td>";
         $stream.="<td colspan=2>Pasal 4 ” Jangka Waktu Pelaksanaan”</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>c.</td>";
         $stream.="<td colspan=2>Pasal 7 ” Tata Cara pelaksanaan”</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>d.</td>";
         $stream.="<td colspan=2>Pasal 8 ”Keselamatan Tenaga Kerja dan Asuransi”</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>e.</td>";
         $stream.="<td colspan=2>Pasal 9 ” Hak dan Kewajiban Para Pihak”</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>f.</td>";
         $stream.="<td colspan=2>Pasal 11 ” Pemberitahuan Pengiriman Barang”</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>g.</td>";
         $stream.="<td colspan=2>Pasal 15 ” Jadwal Pelaksanaan Pekerjaan dan Laporan”</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>h.</td>";
         $stream.="<td colspan=2>Pasal 16 ” Pemeriksaan dan Pengujian”</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2%>&nbsp;</td>";
         $stream.="<td width=2%></td>";
         $stream.="<td valign=top width=2%>i.</td>";
         $stream.="<td colspan=2>Pasal 26 ” Larangan”</td>";
         $stream.="</tr>";
    }



    else if ($jenisba=='bast') {


        # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=substr($namaba,13).' ('.$kodeba.')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>".substr($namaba,0,13)."</font></td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17><u>".strtoupper($nmba)."</u></font></td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td>No : ".$noba."</td>";
         $stream.="</tr>";
         $stream.="</table>";


         #Body
         $stream.="<table border=0>";
         $stream.="<tr>";
         if ($sifatba==0) {
          $stream.="<td>Pada hari ini <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".tanggalnormal($tglba).") </b>, berdasarkan Surat Perjanjian/Kontrak Nomor ".$nokntrk." tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)." dan Amandemen Kontrak Nomor ".$noamandemen1." tanggal ".substr($tanggalamandemen,8,2)." ".bulan(substr($tanggalamandemen,5,2))." ".substr($tanggalamandemen,0,4)."</td>";
         }
         else
        {
          $stream.="<td>Pada hari ini <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".$tglba.") </b>, berdasarkan Surat Perjanjian/Kontrak Nomor ".$nokntrk." tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
        }
         
         $stream.="</tr>";
         $stream.="</table>";


         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td width=25%>Nama Pekerjaan/Jasa</td>";
         $stream.="<td width=2%>:</td>";
         $stream.="<td>".$judul."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td>Maka Dengan ini,</td>";
         $stream.="</tr>";
         $stream.="<tr style='vertical-align:top'>";
         $stream.="<td >". $manupt."</td>";
         $stream.="<td>:</td>";
         $stream.="<td align=justify>Selaku Manajer Unit Pelaksana Transmisi PT.PLN (Persero) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI, yang berkedudukan di ".$alamatupt[$upt].", berdasarkan Surat Keputusan Direksi PT PLN (Persero) Nomor 0664.K/SDM.00.03/DIR/2019 tanggal 01 Februari 2019 selanjutnya disebut PENGGUNA BARANG/JASA</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr style='vertical-align:top'>";
         $stream.="<td >". $nmvendor[$vendor]."</td>";
         $stream.="<td>:</td>";
         $stream.="<td align=justify>Selaku ".$ketpbjbast."</td>";
         $stream.="</tr>";
         $stream.="<br>";
         $stream.="</table>";


         $stream.="<table border=0 width=100%>";
         $stream.="<tr>";
         $stream.="<td colspan=2>menyatakan bahwasanya :</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td width=1% valign=top>a</td>";
         $stream.="<td >&nbsp;PENYEDIA BARANG/JASA telah menyerahkan Pekerjaan tersebut diatas untuk pertama kalinya kepada PENGGUNA BARANG/JASA</td>";
         $stream.="</tr>";
          $stream.="<br><br><br>";
         $stream.="<tr>";
         $stream.="<td width=1% valign=top>b</td>";
         $stream.="<td >&nbsp;PENGGUNA BARANG/JASA telah menerima Pekerjaan yang telah diselesaikan seluruhnya 100% (seratus) persen dengan baik sesuai dengan Surat Perjanjian tersebut diatas dari  PENYEDIA BARANG/JASA, berdasarkan Berita Acara Selesainya Pekerjaan (BASP) Nomor ".$nobaspbast." Tanggal ".$tanggalbaspbast."</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td >Demikian Berita Acara Serah Terima Pekerjaan ini dilakukan dan dibuat rangkap 3 (tiga) yang sama bunyinya.</td>";
         $stream.="</tr>";
         $stream.="</table>";

         #TTD
         $stream.="<table border=0 align=center>";
         $stream.="<tr>";
         $stream.="<td style='font-weight:bold' align=center>PENYEDIA BARANG/JASA</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td width=50% style='font-weight:bold' align=center>PENGGUNA BARANG/JASA</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >". $nmvendor[$vendor]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td align=center>PT PLN (Persero) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI/UPT ".$nmupt[$upt]."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td style='font-weight:bold' align=center>".$nmdirven[$dirven]." </td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold' align=center>".$manupt."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td align=center>Direktur</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td align=center>Manager UPT</td>";
         $stream.="</tr>";
         $stream.="</table>";
    }

    else if ($jenisba=='bast_2') {


        # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=substr($namaba,13).' ('.$kodeba.')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>".substr($namaba,0,13)."</font></td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17><u>".strtoupper($nmba)."</u></font></td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td>No : ".$noba."</td>";
         $stream.="</tr>";
         $stream.="</table>";


         #Body
         $stream.="<table border=0>";
         $stream.="<tr>";
         if ($sifatba==0) {
              $stream.="<td>Pada hari ini <b>".hari(substr($tgl,8,2))."</b>  tanggal <b>".kekata(substr($tgl,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".tanggalnormal($tglba).") </b>, berdasarkan Surat Perjanjian/Kontrak Nomor ".$nokntrk." tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)." dan Nomor Amandemen ".$noamandemen1." tanggal ".substr($tanggalamandemen,8,2)." ".bulan(substr($tanggalamandemen,5,2))." ".substr($tanggalamandemen,0,4)."</td>";
         }
         else
        {
            $stream.="<td>Pada hari ini <b>".hari(substr($tgl,8,2))."</b>  tanggal <b>".kekata(substr($tgl,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".$tglba.") </b>, berdasarkan Surat Perjanjian/Kontrak Nomor ".$nokntrk." tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
         $stream.="</tr>";
        }
         
         $stream.="</table>";


         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td width=25%>Nama Pekerjaan/Jasa</td>";
         $stream.="<td width=2%>:</td>";
         $stream.="<td>".$judul."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td>Maka Dengan ini,</td>";
         $stream.="</tr>";
         $stream.="<tr style='vertical-align:top'>";
         $stream.="<td >". $manupt."</td>";
         $stream.="<td>:</td>";
         $stream.="<td align=justify>Selaku Manajer PT PLN (Persero) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI, yang berkedudukan di ".$alamatupt[$upt].", berdasarkan Surat Keputusan Direksi PT PLN (Persero) Nomor 0664.K/SDM.00.03/DIR/2019 tanggal 1 Februari 2019, selanjutnya disebut <b>PENGGUNA BARANG/JASA</b></td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr style='vertical-align:top'>";
         $stream.="<td >". $nmdirven[$dirven]."</td>";
         $stream.="<td>:</td>";
         $stream.="<td align=justify>Selaku direktur ".$nmvendor[$vendor].", yang berkedudukan di ".$alamatvendor[$vendor].", yang dalam hal ini bertindak untuk dan atas nama ".$nmvendor[$vendor]." selanjutnya disebut : <b>PENYEDIA BARANG/JASA</b></td>";
         $stream.="</tr>";
         $stream.="<br>";
         $stream.="</table>";


         $stream.="<table border=0 width=100%>";
         $stream.="<tr>";
         $stream.="<td colspan=2>menyatakan bahwasanya :</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td width=1% valign=top>a.</td>";
         $stream.="<td colspan=2>&nbsp;<b>PENYEDIA BARANG/JASA</b> telah menyerahkan Pekerjaan tersebut diatas untuk kedua kalinya kepada <b>PENGGUNA BARANG/JASA</b></td>";
         $stream.="</tr>";
          $stream.="<br><br><br>";
         $stream.="<tr>";
         $stream.="<td width=1% valign=top>b.</td>";
         $stream.="<td colspan=2>&nbsp;<b>PENGGUNA BARANG/JASA</b> telah menerima Pekerjaan  yang telah diselesaikan dengan baik sesuai dengan Surat Perjanjian tersebut diatas dari <b>PENYEDIA BARANG/JASA</b></td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td width=1% valign=top>c.</td>";
         $stream.="<td colspan=2>&nbsp;Kerusakan dan kekurangan yang terdapat pada waktu penyerahan pekerjaan untuk yang kedua kalinya telah dilaksanakan perbaikannya sebagaimana mestinya dalam masa Pemeliharaan</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td >Demikian Berita Acara Serah Terima Pekerjaan ini dilakukan dan dibuat rangkap 3 (tiga) yang sama bunyinya.</td>";
         $stream.="</tr>";
         $stream.="</table>";

         #TTD
         $stream.="<table border=0 align=center>";
         $stream.="<tr>";
         $stream.="<td style='font-weight:bold' align=center>PENYEDIA BARANG/JASA</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td width=50% style='font-weight:bold' align=center>PENGGUNA BARANG/JASA</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td align=center>".$nmvendor[$vendor]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td align=center>PT PLN (Persero) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI/UPT ".$nmupt[$upt]."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td style='font-weight:bold' align=center>".$nmdirven[$dirven]." </td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold' align=center>".$manupt."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td align=center>Direktur</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td align=center>Manager UPT</td>";
         $stream.="</tr>";
         $stream.="</table>";
    }

    if ($jenisba=='bastb') {

         # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=substr($namaba,13).' (BAST-B)';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>".substr($namaba,0,13)."</font></td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17><u>".strtoupper($nmba)."</u></font></td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td>No : ".$noba."</td>";
         $stream.="</tr>";
         $stream.="</table>";


         #Body
         $stream.="<table border=0>";
         $stream.="<tr>";
         if ($sifatba==0) {
          $stream.="<td>Pada hari ini <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".tanggalnormal($tglba).") </b>, berdasarkan Surat Perjanjian/Kontrak Nomor ".$nokntrk." tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)." dan Amandemen Kontrak Nomor ".$noamandemen1." tanggal ".substr($tanggalamandemen,8,2)." ".bulan(substr($tanggalamandemen,5,2))." ".substr($tanggalamandemen,0,4)."</td>";
         }
         else
        {
          $stream.="<td>Pada hari ini <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".$tglba.") </b>, berdasarkan Surat Perjanjian/Kontrak Nomor ".$nokntrk." tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
        }
         
         $stream.="</tr>";
         $stream.="</table>";


         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td width=25%>Nama Pekerjaan/Jasa</td>";
         $stream.="<td width=2%>:</td>";
         $stream.="<td>".$judul."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td>Maka Dengan ini,</td>";
         $stream.="</tr>";
         $stream.="<tr style='vertical-align:top'>";
         $stream.="<td >". $manupt."</td>";
         $stream.="<td>:</td>";
         $stream.="<td align=justify>Selaku Manajer Unit Pelaksana Transmisi PT.PLN (Persero) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI, yang berkedudukan di ".$alamatupt[$upt].", berdasarkan Surat Keputusan Direksi PT PLN (Persero) Nomor 0664.K/SDM.00.03/DIR/2019 tanggal 01 Februari 2019 selanjutnya disebut PENGGUNA BARANG/JASA</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr style='vertical-align:top'>";
         $stream.="<td >". $nmvendor[$vendor]."</td>";
         $stream.="<td>:</td>";
         $stream.="<td align=justify>Selaku ".$ketpbjbastb."</td>";
         $stream.="</tr>";
         $stream.="<br>";
         $stream.="</table>";


         $stream.="<table border=0 width=100%>";
         $stream.="<tr>";
         $stream.="<td colspan=2>menyatakan bahwasanya :</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td width=1% valign=top>a</td>";
         $stream.="<td >&nbsp;PENYEDIA BARANG/JASA telah menyerahkan Pekerjaan tersebut diatas untuk pertama kalinya kepada PENGGUNA BARANG/JASA</td>";
         $stream.="</tr>";
          $stream.="<br><br><br>";
         $stream.="<tr>";
         $stream.="<td width=1% valign=top>b</td>";
         $stream.="<td >&nbsp;PENGGUNA BARANG/JASA telah menerima Pekerjaan yang telah diselesaikan seluruhnya 100% (seratus) persen dengan baik sesuai dengan Surat Perjanjian tersebut diatas dari  PENYEDIA BARANG/JASA, berdasarkan Berita Acara Selesainya Pekerjaan (BASP) Nomor ".$nobaspbastb." Tanggal ".$tanggalbaspbastb."</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td >Demikian Berita Acara Serah Terima Pekerjaan ini dilakukan dan dibuat rangkap 3 (tiga) yang sama bunyinya.</td>";
         $stream.="</tr>";
         $stream.="</table>";

         #TTD
         $stream.="<table border=0 align=center>";
         $stream.="<tr>";
         $stream.="<td style='font-weight:bold' align=center>PENYEDIA BARANG/JASA</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td width=50% style='font-weight:bold' align=center>PENGGUNA BARANG/JASA</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >". $nmvendor[$vendor]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td align=center>PT PLN (Persero) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI/UPT ".$nmupt[$upt]."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td style='font-weight:bold' align=center>".$nmdirven[$dirven]." </td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold' align=center>".$manupt."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td align=center>Direktur</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td align=center>Manager UPT</td>";
         $stream.="</tr>";
         $stream.="</table>";
       
    }

    if ($jenisba=='bastdb') {


        # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=strtoupper(substr($namaba,13)).' ('.strtoupper($kodeba).')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>BERITA ACARA <br>".$nmba."</font></td>";
         $stream.="</tr>";
         $stream.="<hr size='2.1' noshade/>";
         $stream.="</table>";

         #Body
         $stream.="<table align=center border=0>";
         $stream.="<tr align=center>";
         $stream.="<td>NOMOR : ".$nokntrk."/PJ/BAST 1/UITJBTB/ UPT ".$nmupt[$upt]."/".substr($tgl,0,4)."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Pada hari ini <b>".hari(substr($tgl,8,2))."</b>  tanggal <b>".kekata(substr($tgl,8,2))."</b> bulan <b>".bulan(substr($tgl,5,2))."</b> tahun <b>".kekata(substr($tgl,0,4))."  (".$tgl.") </b>, kami yang bertandatangan di bawah ini :</td>";
         $stream.="</tr>";
         $stream.="</table>";
         
         $stream.="<table border=0 width=100%>";
         $stream.="<tr align=center>";
         $stream.="<td ></td>";
         $stream.="<td >Nama</td>";
         $stream.="<td>Jabatan</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td>1.</td>";
         $stream.="<td>".$nmdirpek[$dirpekerjaan]."</td>";
         $stream.="<td>Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td>2.</td>";
         $stream.="<td>".$nmproman[$proman]."</td>";
         $stream.="<td>Project Manager</td>";
         $stream.="</tr>";
         $stream.="</table>";


         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Sesuai surat perjanjian nomor 014.PJ/DAN.02.02/TJBTB/2016 perihal PENGADAAN OLTC TRAFO KONDISI KRITIS DI GI BABAT DAN GI LAMONGAN UNTUK PENINGKATAN KEANDALAN, kami telah melakukan pemeriksaan mutu atas barang dan telah diserahkan kepada PT PLN (Persero) Transmisi Jawa Bagian Timur dan Bali dokumen barang sebagai berikut :</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0>";
         $stream.="<tr style='vertical-align:top'> <br>";
         $stream.="<td >1. </td>";
         $stream.="<td >Certificate Of Origin (COO)</td>";
         $stream.="</tr>";
         $stream.="<tr style='vertical-align:top'>";
         $stream.="<td >2. </td>";
         $stream.="<td >Certificate Of Manufacture (COM)</td>";
         $stream.="</tr>";

         $stream.="<tr style='vertical-align:top'>";
         $stream.="<td >3. </td>";
         $stream.="<td >Surat Keterangan Barang Baru</td>";
         $stream.="</tr>";

         $stream.="<tr style='vertical-align:top'>";
         $stream.="<td >4. </td>";
         $stream.="<td >Sertifikat Masa Garansi</td>";
         $stream.="</tr>";

         $stream.="<tr style='vertical-align:top'>";
         $stream.="<td >5. </td>";
         $stream.="<td >Factory Test Certificate/ Routine Test dari Pabrik</td>";
         $stream.="</tr>";
         $stream.="</table>";

         #Akhir point perjanjian
         $stream.="<table border=0>";
         $stream.="<br>";
         $stream.="<tr>";
         $stream.="<td >Demikian <b>Berita Acara Penerimaan Dokumen Barang (BAPD-B) </b> dibuat untuk dipergunakan sebagaimana mestinya.</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0 align=center>";
         $stream.="<tr>";
         $stream.="<td>Yang Membuat Berita Acara,</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         #TTD
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>PENYEDIA BARANG/JASA</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td width=50% style='font-weight:bold'>PENGGUNA BARANG/JASA</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >".$nmvendor[$vendor]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td >PT PLN (Persero) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI/UPT ".$nmupt[$upt]."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>".$nmproman[$proman]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold'>".$nmdirpek[$dirpekerjaan]."</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >Project Manager</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td >Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="</table>";
    }
    if ($jenisba=='basp') {



        # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=strtoupper(substr($namaba,13)).' ('.strtoupper($kodeba).')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>BERITA ACARA <br>".$nmba."</font></td>";
         $stream.="</tr>";
         $stream.="<hr size='2.1' noshade/>";
         $stream.="</table>";

         #Body
         $stream.="<table align=center border=0>";
         $stream.="<tr align=center>";
         $stream.="<td>No : ".$noba."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr >";
         $stream.="<td>Nama Pekerjaan / Jasa</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$judul."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Pada hari <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".tanggalnormal($tglba).") </b>, kami :</td>";
         $stream.="</tr>";
         $stream.="</table>";
         
         $stream.="<table border=0 width=100%>";
         $stream.="<tr align=center>";
         $stream.="<td >".$nmdirpek[$dirpekerjaan]."</td>";
         $stream.="<td width=20%>Jabatan :</td>";
         $stream.="<td align=left>Direksi Pekerjaan</td>";
         $stream.="</tr>";

         $stream.="<tr align=center>";
         $stream.="<td >".$nmdirlap[$dirlap]."</td>";
         $stream.="<td width=20%>Jabatan :</td>";
         $stream.="<td align=left>Direksi Lapangan</td>";
         $stream.="</tr>";
         $stream.="</table>";


         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Sebagai pelaksana pengawasan dan pengendalian pekerjaan tersebut diatas :</td>";
         $stream.="</tr>";
         $stream.="</table>";

  /*       $stream.="<table border=0>";
         $stream.="<tr > <br>";
         $stream.="<td >1. Telah mengadakan pemeriksaan atas penyelesaian seluruh pekerjaan / jasa :</td>";
         $stream.="</tr>";
         $stream.="</table>";*/

         $stream.="<table border=0 width=100%>";
          $stream.="<tr>";
         $stream.="<td colspan=4>1. Telah mengadakan pemeriksaan atas penyelesaian seluruh pekerjaan / jasa :</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1%>&nbsp;</td>";
         $stream.="<td width=1%>1.1</td>";
         $stream.="<td >&nbsp;Nama Pekerjaan / Jasa</td>";
         $stream.="<td >: ".$judul."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td ></td>";
         $stream.="<td >1.2</td>";
         $stream.="<td >&nbsp;Lokasi</td>";
         $stream.="<td >: ".$nmupt[$upt]."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td ></td>";
         $stream.="<td >1.3</td>";
         $stream.="<td >&nbsp;Nomor Kontrak / Tanggal</td>";
         $stream.="<td >: ".$nokntrk." / tanggal ".substr($tglba,8,2)." ".bulan(substr($tglba,5,2))." ".substr($tglba,0,4)."</td>";
         $stream.="</tr>";

         if ($sifatba==0) {
           $stream.="<tr >";
           $stream.="<td ></td>";
           $stream.="<td >1.4</td>";
           $stream.="<td >&nbsp;Nomor Amandemen / Tanggal</td>";
           $stream.="<td >: ".$noamandemen1." / tanggal ".substr($tanggalamandemen,8,2)." ".bulan(substr($tanggalamandemen,5,2))." ".substr($tanggalamandemen,0,4)."</td>";
           $stream.="</tr>";
            $stream.="<tr>";
            $stream.="<td ></td>";
            $stream.="<td >1.5</td>";
            $stream.="<td >&nbsp;Penyedia Barang/Jasa</td>";
            $stream.="<td >: ".$nmvendor[$vendor]."</td>";
            $stream.="</tr>";
            $stream.="<tr >";
            $stream.="<td ></td>";
            $stream.="<td >1.6</td>";
            $stream.="<td >Nilai Amandemen</td>";
            $stream.="<td >: Rp ".number_format($nilai)." ".kekata($nilai)."</td>";
            $stream.="</tr>";
         }
         else
        {
           $stream.="<tr>";
           $stream.="<td ></td>";
           $stream.="<td >1.4</td>";
           $stream.="<td >&nbsp;Penyedia Barang/Jasa</td>";
           $stream.="<td >: ".$nmvendor[$vendor]."</td>";
           $stream.="</tr>";
           $stream.="<tr >";
           $stream.="<td ></td>";
           $stream.="<td >1.5</td>";
           $stream.="<td >&nbsp;Nilai Kontrak</td>";
           $stream.="<td >: Rp ".number_format($nilai)." (".kekata($nilai).")</td>";
           $stream.="</tr>";
        }
        
         $stream.="</table>";

         $stream.="<table border=0 width=100% >";
         $stream.="<tr >";
         $stream.="<td colspan=5>2. Dengan ini menyatakan  :</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1% >&nbsp;</td>";
         $stream.="<td width=1% valign=top>2.1</td>";
         $stream.="<td colspan=3>&nbsp;Telah  mengadakan  penelitian  dan  penilaian  atas  penyelesaian  pekerjaan dengan bobot kemajuan sebesar 100% (seratus persen).</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td ></td>";
         $stream.="<td valign=top>2.2</td>";
         $stream.="<td colspan=3>&nbsp;Penelitian atas kebenaran Berita Acara Kemajuan Pekerjaan 100% Nomor ".$nokntrk." Tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td ></td>";
         $stream.="<td valign=top>2.3</td>";
         $stream.="<td colspan=3>&nbsp;Berpendapat bahwa seluruh pekerjaan  telah diselesaikan  dengan baik sesuai dengan Surat Perjanjian pekerjaan tersebut diatas.</td>";  
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td ></td>";
         $stream.="<td valign=top>2.4 </td>";
         $stream.="<td colspan=3>&nbsp;Berdasarkan pasal ".$pasalbasp." Surat Pejanjian tersebut diatas, maka Penyedia Barang/Jasa yang bersangkutan telah dibayarkan pada tahap ke ".$tahapbasp." ( ke".kekata($tahapbasp).") sampai dengan ke ".$sampaibasp." ( ke".kekata($sampaibasp)." ) sebesar Rp ".number_format($nominalbasp)." (".kekata($nominalbasp).").</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td ></td>";
         $stream.="<td valign=top>2.5</td>";
         
         if ($dendabasp==0) {
            $ket="selama ".$waktuterlambatbasp." hari kalender / sebesar (".$persenbasp." %) dari nilai total Surat Perjanjian";
         }
         else
        {
            $ket='';
        }
         $stream.="<td colspan=3>&nbsp;Pelaksanaan waktu pekerjaan  ".$arrwktu[$waktubasp]." Surat Perjanjian dan ".$arrdenda[$dendabasp]." denda keterlambatan ".$ket."</td>";
         $stream.="</tr>";
         $stream.="</table>";
 
         $stream.="</table>";

         #Akhir point perjanjian
         $stream.="<table border=0>";
         $stream.="<br>";
         $stream.="<tr>";
         $stream.="<td >Demikian Berita Acara Pemeriksaan Selesainya Pekerjaan ini dibuat untuk dipergunakan seperlunya.</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0 align=center>";
         $stream.="<tr>";
         $stream.="<td>Yang Membuat Berita Acara,</td>";
         $stream.="</tr>";
         $stream.="</table><br><br>";

         #TTD
         $stream.="<table border=0 align=center width=100%>";
         $stream.="<tr align=center>";
         $stream.="<td >".$nmvendor[$vendor]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td width=50% >1. ".$nmdirpek[$dirpekerjaan]."<br>Direksi Pekerjaan</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";


         $stream.="<tr align=center>";
         $stream.="<td >".$nmdirven[$dirven]."<br>Direktur</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td width=50% >2. ".$nmdirlap[$dirlap]."<br>Direksi Lapangan</td>";
         $stream.="</tr>";
         $stream.="</table>";
    }

    if ($jenisba=='basmp') {



        # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=strtoupper(substr($namaba,13)).' ('.strtoupper($kodeba).')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>BERITA ACARA <br>".$nmba."</font></td>";
         $stream.="</tr>";
         $stream.="<hr size='2.1' noshade/>";
         $stream.="</table>";

         #Body
         $stream.="<table align=center border=0>";
         $stream.="<tr align=center>";
         $stream.="<td>No : ".$noba."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr >";
         $stream.="<td>Nama Pekerjaan / Jasa</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$judul."</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Pada hari ini <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".tanggalnormal($tglba).") </b>, kami :</td>";
         $stream.="</tr>";
         $stream.="</table>";
         
         $stream.="<table border=0 width=100%>";
         $stream.="<tr >";
         $stream.="<td ></td>";
         $stream.="<td >Nama</td>";
         $stream.="<td>Jabatan</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1%>1.</td>";
         $stream.="<td>".$nmdirpek[$dirpekerjaan]."</td>";
         $stream.="<td>Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1%>2.</td>";
         $stream.="<td>".$nmdirlap[$dirlap]."</td>";
         $stream.="<td>Direksi Lapangan</td>";
         $stream.="</tr>";
         $stream.="</table>";


         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Sebagai pelaksana pengawasan dan pengendalian pekerjaan tersebut diatas :</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0 width=100%>";
         $stream.="<tr >";
         $stream.="<td colspan=5>1. Telah mengadakan pemeriksaan atas penyelesaian seluruh pekerjaan / jasa :</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1%></td>";
         $stream.="<td width=1% valign=top>1.1</td>";
         $stream.="<td >&nbsp;Nama Pekerjaan / Jasa</td>";
         $stream.="<td width=1%>:</td>";
         $stream.="<td >".$judul."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1%></td>";
         $stream.="<td width=1% valign=top>1.2</td>";
         $stream.="<td >&nbsp;Lokasi</td>";
         $stream.="<td width=1%>:</td>";
         $stream.="<td >".$nmupt[$upt]."</td>";
         $stream.="</tr>";
         if ($sifatba==0) {
           $stream.="<tr >";
           $stream.="<td width=1%></td>";
           $stream.="<td width=1% valign=top>1.3</td>"; 
           $stream.="<td valign=top>&nbsp; Nomor Kontrak / Tanggal</td>";
           $stream.="<td width=1%>:</td>";
           $stream.="<td >".$nokntrk." Tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
           $stream.="</tr>";
           $stream.="<tr >";
           $stream.="<td width=1%></td>";
           $stream.="<td width=1% valign=top>1.4</td>";
           $stream.="<td valign=top>&nbsp;Nomor Amandemen / Tanggal</td>";
           $stream.="<td width=1%>:</td>";
           $stream.="<td >".$noamandemen1." Tanggal ".substr($tanggalamandemen,8,2)." ".bulan(substr($tanggalamandemen,5,2))." ".substr($tanggalamandemen,0,4)."</td>";
           $stream.="</tr>";
           $stream.="<tr>";
           $stream.="<td width=1%></td>";
           $stream.="<td width=1% valign=top>1.5</td>";
           $stream.="<td >&nbsp;Penyedia Barang/Jasa</td>";
           $stream.="<td width=1%>:</td>";
           $stream.="<td >".$nmvendor[$vendor]."</td>";
           $stream.="</tr>";
           $stream.="<tr >";
           $stream.="<td width=1%></td>";
           $stream.="<td width=1% valign=top>1.6</td>";
           $stream.="<td >&nbsp;Nilai Kontrak</td>";
           $stream.="<td width=1%>:</td>";
           $stream.="<td >Rp ".number_format($nilai)."</td>";
           $stream.="</tr>";
         }
         else
        {
         $stream.="<tr >";
         $stream.="<td width=1%></td>";
         $stream.="<td width=1% valign=top>1.3</td>";
         $stream.="<td valign=top>&nbsp;Nomor Kontrak / Tanggal</td>";
         $stream.="<td width=1%>:</td>";
         $stream.="<td >".$nokntrk." Tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td width=1%></td>";
         $stream.="<td width=1% valign=top>1.4</td>";
         $stream.="<td >&nbsp;Penyedia Barang/Jasa</td>";
         $stream.="<td width=1%>:</td>";
         $stream.="<td >".$nmvendor[$vendor]."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1%></td>";
         $stream.="<td width=1% valign=top>1.5</td>";
         $stream.="<td >&nbsp;Nilai Kontrak</td>";
         $stream.="<td width=1%>:</td>";
         $stream.="<td >Rp ".number_format($nilai)."</td>";
         $stream.="</tr>";  
        }
          
         $stream.="</table>";

         $stream.="<table border=0 width=100% >";
         $stream.="<tr >";
         $stream.="<td colspan=5>2. Dengan ini menyatakan  :</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1%></td>";
         $stream.="<td width=1% valign=top>2.1</td>";
         $stream.="<td colspan=3>&nbsp;Telah mengadakan penelitian dan penilaian atas penyelesaian seluruh pekerjaan/ Jasa</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1%></td>";
         $stream.="<td width=1% valign=top>2.2</td>";
         $stream.="<td colspan=3>&nbsp;Penelitian atas kebenaran Laporan Selesainya Masa Pemeliharaan Pekerjaan selama ".$lamamasabasmp." (".kekata($lamamasabasmp).") Hari.</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1%></td>";
         $stream.="<td width=1% valign=top>2.3</td>";
         $stream.="<td colspan=3>&nbsp;Berpendapat bahwa seluruh pekerjaan telah diselesaikan dengan baik sesuai dengan Surat  Perjanjian  tersebut diatas dan berdasarkan Pasal ".$pasalbasmp." maka dapat diadakan Serah Terima Tahap Kedua (BAST II).</td>";  
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1%></td>";
         $stream.="<td width=1% valign=top>2.4</td>";
        
         if ($tahapbasmp=='0' || $tahapbasmp=='') {
              $ketbasmp="";
         }
         else
         {
             $ketbasmp="tahap ".$tahapbasmp." (".kekata($tahapbasmp).")";
         }
         $stream.="<td colspan=3>&nbsp;Kepada Penyedia Barang/Jasa yang bersangkutan telah dibayarkan  ".$ketbasmp." sebesar Rp. ".number_format($terbayarbasmp)." (".kekata($terbayarbasmp)."). </td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1%></td>";
         $stream.="<td width=1% valign=top>2.5</td>";
         $stream.="<td colspan=3>&nbsp;Berdasarkan pernyataan diatas, maka Penyedia Barang/Jasa yang bersangkutan telah berhak menerima pembayaran ".$ketbasmp." sebesar ".($nilai-$terbayarbasmp)." dari nilai total Surat Perjanjian. apabila ada retensi</td>";
         $stream.="</tr>";
         $stream.="</table><br>";



        
         $stream.="</table>";

         #Akhir point perjanjian
         $stream.="<table border=0>";
         $stream.="";
         $stream.="<tr>";
         $stream.="<td >Demikianlah Berita Acara Selesainya Masa Pemeliharaan Pekerjaan (BASMP) pekerjaan ini dibuat untuk dipergunakan seperlunya.</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0 align=center>";
         $stream.="<tr>";
         $stream.="<td>Yang Membuat Berita Acara,</td>";
         $stream.="</tr>";
         $stream.="</table><br><br>";

         #TTD
         $stream.="<table border=0 align=center width=100%>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'></td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td width=50% align=left><b>1. ".$nmdirpek[$dirpekerjaan]."</b>&nbsp;&nbsp;&nbsp;&nbsp; ....................</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >".$nmvendor[$vendor]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td align=left>&nbsp;&nbsp;&nbsp;Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
        /* $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";*/
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>".$nmproman[$proman]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td align=left><b>2. ".$nmdirlap[$dirlap]."</b>&nbsp;&nbsp;&nbsp;&nbsp; ....................</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >Project Manager</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td align=left>&nbsp;&nbsp;&nbsp;Direksi Lapangan</td>";
         $stream.="</tr>";
         $stream.="</table>";
    }

    if ($jenisba=='bapjd') {



        # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=strtoupper(substr($namaba,13)).' ('.strtoupper('bapjk').')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>BERITA ACARA <br>".$nmba."</font></td>";
         $stream.="</tr>";
         $stream.="<hr size='2.1' noshade/>";
         $stream.="</table>";

         #Body
         $stream.="<table align=center border=0>";
         $stream.="<tr align=center>";
         $stream.="<td>NOMOR : ".$noba."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr >";
         $stream.="<td>Surat Perjanjian Nomor</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$nokntrk." Tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
         $stream.="</tr>";
         if ($sifatba==0) {
           $stream.="<tr >";
           $stream.="<td>Amandemen Nomor</td>";
           $stream.="<td>:</td>";
           $stream.="<td>".$noamandemen1." Tanggal ".substr($tanggalamandemen,8,2)." ".bulan(substr($tanggalamandemen,5,2))." ".substr($tanggalamandemen,0,4)."</td>";
           $stream.="</tr>";
         }
         $stream.="<tr >";
         $stream.="<td>Nama Pekerjaan / Jasa </td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$judul."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Pada hari ini <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".$tglba.") </b>, kami :</td>";
         $stream.="</tr>";
         $stream.="</table><br>";
         
         $stream.="<table border=0 width=100%>";
         $stream.="<tr>";
         $stream.="<td >Mewakili PT PLN (Persero) Unit Induk Transmisi Jawa Bagian Timur dan Bali :</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >".$nmdirpek[$dirpekerjaan].",sebagai Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td ></td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >Mewakili PT Prima Layanan Nasional Enjiniring :</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >".$nmdirven[$dirven].",sebagai Direktur/Leader</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Berdasarkan hal – hal sebagai berikut :</td>";
         $stream.="</tr>";
         $stream.="<tr > <br>";
         $stream.="<td >1. Surat Perjanjian no:".$nokntrk."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >2. Amandemen no:".$noamandemen1."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >3. Surat ".$suratbapjd."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >4. Resume Rapat ".$resumebapjd."</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0>";
         $stream.="<tr > <br>";
         $stream.="<td >Dalam hal ini kedua belah pihak bersama-sama telah melakukan evaluasi perubahan judul kontrak.
         Berdasarkan evaluasi bersama, maka dapat disimpulkan sebagai berikut :
         </td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0 >";
         $stream.="<tr >";
         $stream.="<td >1. Perubahan Judul Kontrak </td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >Semula :</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >".$judul."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >Menjadi :</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >".$judulbapjd."</td>";
         $stream.="</tr>";    
         $stream.="</table>";

         #Akhir point perjanjian
         $stream.="<table border=0>";
         $stream.="<tr>";
         $amd=substr($noamandemen1,2,1);
         $stream.="<td >Demikian Berita Acara ini dibuat dengan sebenarnya untuk dilaksanakan dan akan diusulkan sebagai bahan penyusunan amandemen ke ".$amd." kontrak Nomor ".$nokontrak." Tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0 align=center>";
         $stream.="<tr><br>";
         $stream.="<td>Yang Membuat Berita Acara,</td>";
         $stream.="</tr>";
         $stream.="</table>";

         #TTD
         $stream.="<table border=0 align=center width=100%>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>".$nmvendor[$vendor]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td width=50% style='font-weight:bold'>PT PLN (Persero) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR & BALI</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td ></td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td ></td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
        /* $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";*/
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>".$nmdirven[$dirven]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold'>".$nmdirpek[$dirpekerjaan]."</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >Direktur</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td >Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="</table>";
    }


    if ($jenisba=='bapdb') {



        # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=strtoupper(substr($namaba,13)).' ('.strtoupper($kodeba).')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>BERITA ACARA <br>".$nmba."</font></td>";
         $stream.="</tr>";
         $stream.="<hr size='2.1' noshade/>";
         $stream.="</table>";

         #Body

         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Pada hari ini <b>".hari(substr($tgl,8,2))."</b>  tanggal <b>".kekata(substr($tgl,8,2))."</b> bulan <b>".bulan(substr($tgl,5,2))."</b> tahun <b>".kekata(substr($tgl,0,4))."  (".$tgl.") </b>, kami yang bertandatangan di bawah ini :</td>";
         $stream.="</tr>";
         $stream.="</table><br>";
         
         $stream.="<table border=0 width=100%>";
         $stream.="<tr>";
         $stream.="<td >Nama</td>";
         $stream.="<td >Jabatan</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >Nama</td>";
         $stream.="<td >Direksi Pekerjaan</td>";
         $stream.="</tr><br>";
         $stream.="<tr>";
         $stream.="<td >Nama</td>";
         $stream.="<td >Project Manajer </td>";
         $stream.="</tr><br>";
         $stream.="</table><br>";


         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Sesuai surat perjanjian nomor 014.PJ/DAN.02.02/TJBTB/2016 perihal PENGADAAN OLTC TRAFO KONDISI KRITIS DI GI BABAT DAN GI LAMONGAN UNTUK PENINGKATAN KEANDALAN, kami telah melakukan pemeriksaan mutu atas barang dan telah diserahkan kepada PT PLN (Persero) Transmisi Jawa Bagian Timur dan Bali dokumen barang sebagai berikut :</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0>";
         $stream.="<tr > <br>";
         $stream.="<td >1. Certificate Of Origin (COO)</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >2. Certificate Of Manufacture (COM)</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >3. Surat Keterangan Barang Baru</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >4. Sertifikat Masa Garansi</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >5. Factory Test Certificate/ Routine Test dari Pabrik</td>";
         $stream.="</tr>";
         $stream.="</table>";

    

         #Akhir point perjanjian
         $stream.="<table border=0>";
         $stream.="<br><br>";
         $stream.="<tr>";
         $stream.="<td >Demikianlah Berita Berita Acara Penerimaan Dokumen Barang (BAPD-B) ini dibuat untuk dipergunakan sebagaimana mestinya.</td>";
         $stream.="</tr>";
         $stream.="</table><br><br><br><br><br>";

         $stream.="<table border=0 align=center>";
         $stream.="<tr>";
         $stream.="<td>Yang Membuat Berita Acara,</td>";
         $stream.="</tr>";
         $stream.="</table><br><br>";

         #TTD
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>PT ABB SAKTI INDUSTRI</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td width=50% style='font-weight:bold'>PT PLN (Persero) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR & BALI</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >Nama</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td >Nama</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>".$nmproman[$proman]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold'>Nama</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >Project Manajer</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td >Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="</table>";
    }

    if ($jenisba=='bakp') {



        # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=strtoupper(substr($namaba,13)).' ('.strtoupper($kodeba).')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>BERITA ACARA <br>".$nmba."</font></td>";
         $stream.="</tr>";
         $stream.="<hr size='2.1' noshade/>";
         $stream.="</table>";

         #Body
         $stream.="<table align=center border=0>";
         $stream.="<tr align=center>";
         $stream.="<td>NOMOR : ".$nokntrk."/PJ/BAST 1/UITJBTB/ UPT ".$nmupt[$upt]."/".substr($tgl,0,4)."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td>Nama Pekerjaan / Jasa</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$judul."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Pada hari ini <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".$tglba.") </b>, kami :</td>";
         $stream.="</tr>";
         $stream.="</table><br>";
         
         $stream.="<table border=0 width=100%>";
         $stream.="<tr>";
         $stream.="<th width=33%>Nama</th>";
         $stream.="<th width=33%>Jabatan</th>";
         $stream.="<th width=33%>Selaku <th>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td >".$nmdirpek[$dirpekerjaan]."</td>";
         $stream.="<td >Direksi Pekerjaan</td>";
         $stream.="<td >Pihak Ke Satu</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td >".$nmdirven[$dirven]."</td>";
         $stream.="<td >Direktur</td>";
         $stream.="<td >Pihak Ke Dua</td>";
         $stream.="</tr>";
         $stream.="</table><br>";


         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td width=2% valign=top>1. </td>";
         $stream.="<td colspan=5>Telah mengadakan penelitian dan penilaian atas kebenaran Laporan Kemajuan Pekerjaan / Jasa pada tanggal ".substr($tgllkp,8,2)." ".bulan(substr($tgllkp,5,2))." ".substr($tgllkp,0,4)." seperti terlampir untuk pekerjaan.</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td>&nbsp;</td>";
         $stream.="<td width=2%>1.1</td>";
         $stream.="<td width=30%>Nama Pekerjaan / Jasa</td>";
         $stream.="<td width=2%>:</td>";
         $stream.="<td>".$judul."</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td>&nbsp;</td>";
         $stream.="<td width=2%>1.2</td>";
         $stream.="<td width=30%>Lokasi</td>";
         $stream.="<td width=2%>:</td>";
         $stream.="<td>".$nmupt[$upt]."</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td>&nbsp;</td>";
         $stream.="<td width=2%>1.3</td>";
         $stream.="<td width=30%>No Kontrak/Tanggal</td>";
         $stream.="<td width=2%>:</td>";
         $stream.="<td>".$nokntrk."/Tanggal ".substr($tglba,8,2)." ".bulan(substr($tglba,5,2))." ".substr($tglba,0,4)."</td>";
         $stream.="</tr>";

         if ($sifatba==0) {

           $stream.="<tr>";
           $stream.="<td>&nbsp;</td>";
           $stream.="<td width=2%>1.4</td>";
           $stream.="<td width=30%>No Amandemen</td>";
           $stream.="<td width=2%>:</td>";
           $stream.="<td>".$noamandemen1." Tanggal  ".substr($tanggalamandemen,8,2)." ".bulan(substr($tanggalamandemen,5,2))." ".substr($tanggalamandemen,0,4)."</td>";
           $stream.="</tr>";

           $stream.="<tr>";
           $stream.="<td>&nbsp;</td>";
           $stream.="<td width=2%>1.5</td>";
           $stream.="<td width=30%>Penyedia Barang/Jasa</td>";
           $stream.="<td width=2%>:</td>";
           $stream.="<td>".$nmvendor[$vendor]."</td>";
           $stream.="</tr>";

           $stream.="<tr>";
           $stream.="<td>&nbsp;</td>";
           $stream.="<td width=2%>1.6</td>";
           $stream.="<td width=30%>Nilai Kontrak</td>";
           $stream.="<td width=2%>:</td>";
           $stream.="<th>Rp.".number_format($nilai).",- termasuk PPN 10%</th>";
           $stream.="</tr>";
         }
         else
         {
           $stream.="<tr>";
           $stream.="<td>&nbsp;</td>";
           $stream.="<td width=2%>1.4</td>";
           $stream.="<td width=30%>Penyedia Barang/Jasa</td>";
           $stream.="<td width=2%>:</td>";
           $stream.="<td>".$nmvendor[$vendor]."</td>";
           $stream.="</tr>";

           $stream.="<tr>";
           $stream.="<td>&nbsp;</td>";
           $stream.="<td width=2%>1.5</td>";
           $stream.="<td width=30%>Nilai Kontrak</td>";
           $stream.="<td width=2%>:</td>";
           $stream.="<th>Rp.".number_format($nilai).",- termasuk PPN 10%</th>";
           $stream.="</tr>";
         }
        

         $stream.="<tr>";
         $stream.="<td>&nbsp;</td>";
         $stream.="</tr>";

         $stream.="<tr align=justify>";
         $stream.="<td>&nbsp;</td>";
         $stream.="<td colspan=5>dan telah terbukti bahwa tingkat penyelesaian/kemajuan pekerjaan mencapai prosentase sebesar <b>".$persenbakp."%  (".kekata($persenbakp)." persen)</b> sesuai dengan Laporan Kemajuan Pekerjaan (LKP) pada tanggal ".substr($tgllkp,8,2)." ".bulan(substr($tgllkp,5,2))." ".substr($tgllkp,0,4)."</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td>&nbsp;</td>";
         $stream.="</tr>";

         $stream.="<tr align=justify>"; 
         $stream.="<td width=2% valign=top>2. </td>";
         $stream.="<td colspan=5>Berdasarkan Point ".$refkontrakbakp." Surat Perjanjian/Kontrak tersebut diatas, maka Penyedia Barang/Jasa yang bersangkutan telah berhak menerima pembayaran dalam satu tahap sebesar ".$persenbakp."%  (".kekata($persenbakp)." persen)  dari nilai kontrak, senilai Rp.".number_format($nilai).",- <i>( ".kekata($nilai).")</i></td>";
         $stream.="</tr>";

         $stream.="</table><br>";


         #Akhir point perjanjian
         $stream.="<table border=0>";
         $stream.="<br>";
         $stream.="<tr>";
         $stream.="<td >Demikian Berita Acara Kemajuan Pekerjaan ini dibuat untuk dipergunakan seperlunya.</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0 align=center>";
         $stream.="<tr>";
         $stream.="<td>Yang Membuat Berita Acara,</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         #TTD
         $stream.="<table border=0 align=center width=100%>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold' width=45%>".$nmvendor[$vendor]."</td>";
         $stream.="<td width=10%>&nbsp;</td>";
         $stream.="<td width=45% style='font-weight:bold'>PT PLN (PERSERO) UIT JBTB <br>UPT ".$nmupt[$upt]."</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
        /* $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";*/
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>".$nmdirven[$dirven]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold'>".$nmdirpek[$dirpekerjaan]."</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>Direktur</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold'>Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="</table>";
    }


    if ($jenisba=='bak') {

        # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=strtoupper(substr($namaba,13)).' ('.strtoupper($kodeba).')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>BERITA ACARA ".$nmba."</font></td>";
         $stream.="</tr>";
         $stream.="</table>";

         #Body
         $stream.="<table align=center border=0>";
         $stream.="<tr align=center>";
         $stream.="<td>".$noba."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td>Judul Pekerjaan</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$judul."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td>Nomor Surat Perjanjian</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$nokntrk."</td>";
         $stream.="</tr>";
         if ($sifatba==0) {
         $stream.="<tr>";
         $stream.="<td>Nomor Amandemen</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$noamandemen1."</td>";
         $stream.="</tr>";
         }
         $stream.="<tr>";
         $stream.="<td>Penyedia Barang/Jasa</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$nmvendor[$vendor]."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Pada hari ini <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".tanggalnormal($tglba).") </b>, telah dilaksanakan evaluasi dengan rincian sebgai berikut:</td>";
         $stream.="</tr>";
         $stream.="</table><br>";
         
         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<td width=2% valign=top>1. </td>";
         $stream.="<td colspan=3>Penyelesaian Pekerjaan</td>";
         $stream.="</tr>";

         $stream.="<tr align=justify>";
         $stream.="<td width=2% valign=top></td>";
         $stream.="<td colspan=3>Pekerjaan telah diselesaikan pada tanggal ".substr($tglba,8,2)." ".bulan(substr($tglba,5,2))." ".substr($tglba,0,4)." sesuai dengan terbitnya hasil dari Pemeriksaan yang dilakukan oleh Tim Pemeriksa. Dengan nomor ".$nobappbak." tanggal ".substr($tanggalbappbak,8,2)." ".bulan(substr($tanggalbappbak,5,2))." ".substr($tanggalbappbak,0,4)."</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<td width=2% valign=top>2. </td>";
         $stream.="<td colspan=3>Keterlambatan Penyelesaian Pekerjaan</td>";
         $stream.="</tr>";

         $stream.="<tr align=justify>";
         $stream.="<td width=2% valign=top></td>";
         $stream.="<td width=2% valign=top>a.</td>";
         $stream.="<td colspan=2>Terdapat keterlambatan dalam penyelesaian pekerjaan. Merupakan murni kelalaian Pihak Penyedia Barang/Jasa, Keterlambatan selama ".$terlambatbak." ( ".kekata($terlambatbak)." ) hari oleh karena itu kepada Pihak Penyedia Barang/ Jasa dikenakan denda ".$persenbak."% dari nilai kontrak.</td>";
         $stream.="</tr>";

         $stream.="<tr align=justify>";
         $stream.="<td width=2% valign=top></td>";
         $stream.="<td width=2% valign=top>b.</td>";
         $nilaikont=($persenbak/100)*$nilai;

         if ($nilaikont<0.5) {
            $param=floor($nilaikont);
         }
         else
         {
            $param=round($nilaikont);
         }
         $stream.="<td colspan=2>Penyedia barang/jasa dikenakan denda keterlambatan sebesar ".$persenbak."% x nilai kontrak sebesar Rp. ".number_format($nilaikont)." ( ".kekata($nilaikont)." Rupiah) </td>";
         $stream.="</tr>";


         $stream.="</table><br>";


         #Akhir point perjanjian
         $stream.="<table border=0>";
         $stream.="<br>";
         $stream.="<tr>";
         $stream.="<td >Demikian berita acara ini dibuat untuk dapat dipergunakan sebaiknya.</td>";
         $stream.="</tr>";
         $stream.="</table><br>";


         #TTD
         $stream.="<table border=0 align=center width=100%>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold' width=45%>&nbsp;</td>";
         $stream.="<td width=10%>&nbsp;</td>";
         $stream.="<td width=45% >".$nmupt[$upt].",".substr($tglba,8,2)." ".bulan(substr($tglba,5,2))." ".substr($tglba,0,4)."</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold' width=45%>".$nmvendor[$vendor]."</td>";
         $stream.="<td width=10%>&nbsp;</td>";
         $stream.="<td width=45% style='font-weight:bold'>PT PLN (PERSERO) UIT JBTB <br>UPT ".$nmupt[$upt]."</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>".$nmdirven[$dirven]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold'>".$nmdirpek[$dirpekerjaan]."</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>Direktur</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold'>Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="</table>";
    }

    if ($jenisba=='bap') {

        # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=strtoupper(substr($namaba,13)).' ('.strtoupper($kodeba).')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>BERITA ACARA ".$nmba."</font></td>";
         $stream.="</tr>";
         $stream.="</table>";

         #Body
         $stream.="<table align=center border=0>";
         $stream.="<tr align=center>";
         $stream.="<td>".$noba."</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td>antara</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td>PT PLN ( PERSERO) UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td>UNIT  PELAKSANA TRANSMISI GRESIK</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td>dengan</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td>".$nmvendor[$vendor]."</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td>SURAT PERJANJIAN  ".$nokntrk."</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td>Tanggal  ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
         $stream.="</tr>";
         if ($sifatba==0) {
            $stream.="<tr align=center>";
            $stream.="<td>AMANDEMEN PERJANJIAN  ".$noamandemen1."</td>";
            $stream.="</tr>";
            $stream.="<tr align=center>";
            $stream.="<td>Tanggal  ".substr($tanggalamandemen,8,2)." ".bulan(substr($tanggalamandemen,5,2))." ".substr($tanggalamandemen,0,4)."</td>";
            $stream.="</tr>";
         }
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Pada hari ini <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".$tglba.") </b>, kami  yang bertandatangan  dibawah ini :</td>";
         $stream.="</tr>";
         $stream.="</table><br>";
         
         $stream.="<table border=0>";
         $stream.="<tr>";
         $stream.="<th width=2% valign=top>I.</th>";
         $stream.="<td colspan=3>PT PLN ( Persero ) Unit Induk Transmisi Jawa Bagian Timur dan Bali Unit Pelaksana Transmisi Gresik,  berkedudukan  di  ".$alamatupt[$upt].",  dalam hal ini diwakili  ".$nmdirpek[$dirpekerjaan]."  selaku Manager Unit Pelaksana Transmisi Gresik, sebagai PENGGUNA BARANG/JASA, yang selanjutnya disebut: PIHAK PERTAMA</td>";
         $stream.="</tr>";

         $stream.="<tr>";
         $stream.="<th width=2% valign=top>II.</th>";
         $stream.="<td colspan=3>".$nmvendor[$vendor].", yang berkedudukan di ".$alamatvendor[$vendor]." dalam hal ini diwakili oleh ".$nmdirven[$dirven].", selaku  Direktur Utama, sebagai PENYEDIA BARANG/JASA, yang selanjutnya disebut: PIHAK KEDUA</td>";
         $stream.="</tr>";
         $stream.="</table><br>";
         $stream.="<table border=0 width=100%>";
         $stream.="<tr align=justify>";
         $stream.="<td colspan=3>Kedua belah pihak bersama-sama telah menyepakati pembayaran pekerjaan sebagai berikut :</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td>Nama Pekerjaan</td>";
         $stream.="<td width=2%>:</td>";
         $stream.="<td>".$judul."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td>No.Surat Perjanjian</td>";
         $stream.="<td width=2%>:</td>";
         $stream.="<td>".$nokntrk." Tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td>Nilai Perjanjian</td>";
         $stream.="<td width=2%>:</td>";
         $stream.="<td>Rp.".number_format($nilai)." (termasuk PPN 10% )</td>";
         $stream.="</tr>";
         $stream.="</table>";

 
         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td colspan=3>Dengan dasar – dasar sebagai berikut :</td>";
         $stream.="</tr>";
         $stream.="<tr align=justify>";
         $stream.="<th width=2% valign=top>1.</th>";
         $stream.="<td colspan=3>Sesuai Berita Acara Kemajuan Pekerjaan (BAKP) No : ".$nobakpbap.", Berita Acara Pemeriksaan Pekerjaan (BAPP) No : ".$nobappbap.", pekerjaan tersebut diatas telah mencapai prosentase sebesar ".$persenbap."%. Sesuai Surat  Perjanjian diatas, maka Penyedia Barang / Jasa berhak menerima pembayaran termin ".kekata($terminbap)." sebesar ".$persen2bap."% (".kekata($persen2bap).") dan sudah  termasuk PPN 10 % = Rp. ".number_format($nominalbap).",- ( ".kekata($nominalbap)." Rupiah).</td>";
         $stream.="</tr>";
        
         $stream.="</table>";


         #Akhir point perjanjian
         $stream.="<table border=0>";
         $stream.="<br>";
         $stream.="<tr>";
         $stream.="<td >Demikian Berita Acara ini di buat untuk dipergunakan sebagaimana mestinya</td>";
         $stream.="</tr>";
         $stream.="</table>";


         #TTD
         $stream.="<table border=0 align=center width=100%>";

         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold' width=45%>".$nmvendor[$vendor]."</td>";
         $stream.="<td width=10%>&nbsp;</td>";
         $stream.="<td width=45% style='font-weight:bold'>PT PLN (PERSERO) UIT JBTB <br>UPT ".$nmupt[$upt]."</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>".$nmdirven[$dirven]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold'>".$manupt."</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>Direktur</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold'>Manager UPT</td>";
         $stream.="</tr>";
         $stream.="</table>";
    }

    if ($jenisba=='baetk') {



        # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=strtoupper(substr($namaba,13)).' ('.strtoupper($kodeba).')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>BERITA ACARA <br>".$nmba."</font></td>";
         $stream.="</tr>";
         $stream.="<hr size='2.1' noshade/>";
         $stream.="</table>";

         #Body
         $stream.="<table align=center border=0>";
         $stream.="<tr align=center>";
         $stream.="<td>NOMOR : ".$noba."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr >";
         $stream.="<td>Surat Perjanjian Nomor</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$nokontrak."</td>";
         $stream.="</tr>";
         if ($sifatba==0) {
           $stream.="<tr >";
           $stream.="<td>Amandemen Nomor</td>";
           $stream.="<td>:</td>";
           $stream.="<td>".$noamandemen1."</td>";
           $stream.="</tr>";
         }
         $stream.="<tr >";
         $stream.="<td>Nama Pekerjaan / Jasa </td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$judul."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Pada hari ini <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".tanggalnormal($tglba).") </b>, kami :</td>";
         $stream.="</tr>";
         $stream.="</table><br>";
         
         $stream.="<table border=0 width=100%>";
         $stream.="<tr>";
         $stream.="<td >Mewakili PT PLN (Persero) / UPT :</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >".$nmdirpek[$dirpekerjaan].",sebagai Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td ></td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >Mewakili : ".$nmvendor[$vendor]."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >".$nmdirven[$dirven].",sebagai Direktur </td>";
         $stream.="</tr>";
         $stream.="</table><br>";


         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Dalam hal ini kedua belah pihak bersama-sama telah melakukan evaluasi harga kerja tambah /  kurang dan berdasarkan hal – hal terlampir sebagai berikut :</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0>";
         $stream.="<tr > <br>";
         $stream.="<td >1.  Surat ".$suratbaetk."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >2.  Resume Rapat ".$resumebaetk."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >3.  Field Change Request (FCR) ".$fcrbaetk."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >4.  Perhitunga Kerja Tambah / Kurang ".$perhitunganbaetk."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >5.  Evaluasi Kerja Tambah / Kurang ".$evaluasibaetk."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td >6.  Setelah dilakukan evaluasi bersama atas pekerjaan Tambah / Kurang, disepakati perubahan harga sebagai berikut :</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0>";
         $stream.="<tr >";
         $stream.="<td >I.</td>";
         $stream.="<td >Semula (termasuk PPN 10%)</td>";
         $stream.="<td >:</td>";
         $stream.="<td >Rp ".number_format($ppnbaetk)."</td>";
         $stream.="</tr>";
         $stream.="<td >II.</td>";
         $stream.="<td >Menjadi (termasuk PPN 10%)</td>";
         $stream.="<td >:</td>";
         $stream.="<td >Rp ".number_format($ppn2baetk)."</td>";
         $stream.="</tr>";
         $stream.="</table>";

        

         #Akhir point perjanjian
         $stream.="<table border=0>";
         $stream.="<br>";
         $stream.="<tr>";
         $stream.="<td >Demikian Berita Acara ini dibuat dengan sebenarnya untuk dilaksanakan dan akan diusulkan sebagai bahan penyusunan amandemen ke ".$urutbaetk." kontrak Nomor ".$nokontrak." Tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0 align=center>";
         $stream.="<tr>";
         $stream.="<td>Yang Membuat Berita Acara,</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         #TTD
         $stream.="<table border=0 align=center width=100%>";
         $stream.="<tr >";
         $stream.="<td style='font-weight:bold' align=center>".$nmvendor[$vendor]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td  style='font-weight:bold' align=center align=center>PT PLN (Persero) UPT ".$nmupt[$upt]."</td>";
         $stream.="</tr>";

         $stream.="<tr >";
         $stream.="<td ></td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td ></td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td style='font-weight:bold' align=center>".$nmdirven[$dirven]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold' align=center>".$nmdirpek[$dirpekerjaan]."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td align=center>Direktur</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td align=center align=center>Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="</table>";
    }

    if ($jenisba=='baepw') {



        # KOP
         $stream.="<table border=0>";
             $stream.="<tr>";
                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr>";
                         $stream.="<td><img src='images/Logo_PLN.png' width='50px' height='80px'/></td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";

                 $stream.="<td>";
                         $stream.="<table border=0>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>PT PLN (Persero)</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</td>";
                         $stream.="</tr>";
                         $stream.="<tr style='font-weight:bold'>";
                         $stream.="<td>UPT ".$nmupt[$upt]."</td>";
                         $stream.="</tr>";
                         $stream.="</table>";
                 $stream.="</td>";
                 $stream.="<hr />";
             $stream.="</tr>";
         $stream.="</table>";


        #Header
         $nmba=strtoupper(substr($namaba,13)).' ('.strtoupper($kodeba).')';
         $stream.="<table border=0 align=center>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'><font size=17>BERITA ACARA <br>".$nmba."</font></td>";
         $stream.="</tr>";
         $stream.="<hr size='2.1' noshade/>";
         $stream.="</table>";

         #Body
         $stream.="<table align=center border=0>";
         $stream.="<tr align=center>";
         $stream.="<td>NOMOR : ".$noba."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr >";
         $stream.="<td>Surat Perjanjian Nomor</td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$nokontrak."</td>";
         $stream.="</tr>";
         if ($sifatba==0) {
          $stream.="<tr >";
          $stream.="<td>Surat Amandemen Nomor</td>";
          $stream.="<td>:</td>";
          $stream.="<td>".$noamandemen1."</td>";
          $stream.="</tr>";
         }
         $stream.="<tr >";
         $stream.="<td>Nama Pekerjaan / Jasa </td>";
         $stream.="<td>:</td>";
         $stream.="<td>".$judul."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Pada hari ini <b>".hari(substr($tglba,8,2))."</b>  tanggal <b>".kekata(substr($tglba,8,2))."</b> bulan <b>".bulan(substr($tglba,5,2))."</b> tahun <b>".kekata(substr($tglba,0,4))."  (".$tglba.") </b>, kami :</td>";
         $stream.="</tr>";
         $stream.="</table><br>";
         
         $stream.="<table border=0 width=100%>";
         $stream.="<tr>";
         $stream.="<td >Mewakili PT PLN (Persero) UITJBTB / UPT : ".$nmupt[$upt]."</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >".$nmdirpek[$dirpekerjaan].",sebagai Direksi Pekerjaan</td>";
         $stream.="</tr><br>";
         $stream.="<tr>";
         $stream.="<td >Mewakili :</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >".$nmdirven[$dirven].",sebagai Direktur</td>";
         $stream.="</tr>";
         $stream.="</table><br>";


         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Dalam hal ini kedua belah pihak bersama-sama telah melakukan evaluasi perpanjangan waktu akibat ".$sebabbaepw." berdasarkan Lembar  Hasil Evaluasi Perpanjangan Waktu terlampir tanggal ".substr($tglevaluasibaepw,8,2)." ".bulan(substr($tglevaluasibaepw,5,2))." ".substr($tglevaluasibaepw,0,4)." </td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0>";
         $stream.="<tr align=justify>";
         $stream.="<td>Berdasarkan evaluasi bersama maka dapat disimpulkan sebagai berikut :</td>";
         $stream.="</tr>";
         $stream.="</table>";

         $stream.="<table border=0 width=100%>";
         $stream.="<tr > <br>";
         $stream.="<td width=1% valign=top>1.</td>";
         $stream.="<td >&nbsp;Memperpanjang waktu pelaksanaan pekerjaan selama ".$wktperpanjangbaepw." (".kekata($wktperpanjangbaepw).") hari kalender sejak tanggal ".$mulaibaepw.", atau paling lambat pekerjaan harus selesai tanggal ".substr($batasbaepw,8,2)." ".bulan(substr($batasbaepw,5,2))." ".substr($batasbaepw,0,4)."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1% valign=top>2.</td>";
         $stream.="<td >&nbsp;Penyedia Barang / Jasa memperpanjang Jaminan Pelaksanaan sampai dengan ".substr($tanggaljaminanbaepw,8,2)." ".bulan(substr($tanggaljaminanbaepw,5,2))." ".substr($tanggaljaminanbaepw,0,4)."</td>";
         $stream.="</tr>";
         $stream.="<tr >";
         $stream.="<td width=1% valign=top>3.</td>";
         $dedbaepw = array('0' =>'Dikenakan' ,'0' =>'Tidak Dikenakan' );
         $stream.="<td >&nbsp;Penyedia Barang/Jasa ". $dedbaepw[$dendabaepw]." denda keterlambatan</td>";
         $stream.="</tr>";
         $stream.="</table>";


         #Akhir point perjanjian
         $stream.="<table border=0>";
         $stream.="<br><br>";
         $stream.="<tr>";
         $stream.="<td >Demikian Berita Acara ini dibuat dengan sebenarnya untuk dilaksanakan dan akan diusulkan sebagai bahan penyusunan amandemen ke ".$urutbaepw." kontrak Nomor ".$nokontrak." tanggal ".substr($tgl,8,2)." ".bulan(substr($tgl,5,2))." ".substr($tgl,0,4)."</td>";
         $stream.="</tr>";
         $stream.="</table><br>";

         $stream.="<table border=0 align=center>";
         $stream.="<tr>";
         $stream.="<td>Yang Membuat Berita Acara,</td>";
         $stream.="</tr>";
         $stream.="</table><br><br>";
      
         #TTD
         $stream.="<table border=0 align=center width=100%>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>".$nmvendor[$vendor]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td width=50% style='font-weight:bold'>PT PLN (Persero) UITJBTB/UPT</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td ></td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td ></td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr>";
         $stream.="<td >&nbsp;</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td style='font-weight:bold'>".$nmproman[$proman]."</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td style='font-weight:bold'>".$nmdirpek[$dirpekerjaan]."</td>";
         $stream.="</tr>";
         $stream.="<tr align=center>";
         $stream.="<td >Direktur/Leader</td>";
         $stream.="<td >&nbsp;</td>";
         $stream.="<td >Direksi Pekerjaan</td>";
         $stream.="</tr>";
         $stream.="</table>";
    }


    $dompdf = new Dompdf();
    $dompdf->loadHtml($stream);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("form survey",array("Attachment"=>0));
    break;


    case 'uploaddata':
  
        
        @$table .="
        <table class=sortable cellspacing=1 cellpadding=5 border=0 width=100%>
            <thead> 
            <tr>
               
                <td align=center>No</td>
                <td align=center>Nama File</td>
                <td align=center colspan=2>Aksi</td>
            </tr>
            </thead>
            <tbody id=containerupload></tbody>";
            

                    $table.="<tbody>
                    <tr>
                       <td></td>
                        <td>
                            <input type='file' name='upload' id='upload' class=mybutton style='height:30px;'>
                        </td>
                        <td style='text-align:center'>
                            <img src=images/plus.png class=resicon id='addfile'  title='Add File ' onclick=\"addfile('".$nokontrak."');\">
                        </td>
                        
                    </tr>
                    </tbody>";
            
        $table.="</table>";
        
        echo $table;

    break;

    case'loadfiles':


        $data=$_POST;
        $tab="";
        $no=0;
        $str="select * from ".$dbname.".listfileupload where nokontrak='".$nokontrak."'";
        $res=fetchData($str);
        if(count($res) <= 0){
            $tab.="<tr class='rowcontent'><td colspan='5' style='text-align:center'>Data Tidak Di Temukan</td></tr>";
        }else{
            foreach($res as $val){
                $no++;
                $tab.="<tr class='rowcontent'>";
                $tab.="<td style='text-align:center'>".$no."</td>";
                $tab.="<td style='text-align:left;'>".$val['namafile']."</td>";
                $tab.="<td align=center>
                        <a href='".$path.$val['namafile']."' download><img src=images/dwnld8.png class=resicon  title='download'></a>";
                $tab.="<td align=center>
               <img src=images/application/application_delete.png class=resicon  title='Delete' onclick=\"deletefile('".$nokontrak."','".$val['namafile']."');\" ></td>";
        
                       
                $tab."  </td>
                </tr>";
            }
        }
        
        echo $tab;
    break;


    case 'simpanupload':
        $data=$_POST;
        $tgl = date("YmdHis");
        $his = date("His");
        $data = $_POST;
        if($data['fileupload']!=''){
            if($_FILES['file']['error']==0){    
                $filetype = strtolower('.'.substr($_FILES['file']['name'],strripos($_FILES['file']['name'],'.')+1));
                $newfilename = str_replace($filetype,'',$_FILES['file']['name']);
                $filename = $newfilename."_".$tgl."".$filetype;
                $file_tmpname = file_get_contents($_FILES['file']['tmp_name']); 
                
                if(($filetype=='.jpeg')||($filetype=='.jpg')||($filetype=='.png')||($filetype=='.pdf')||($filetype=='.xls')||($filetype=='.xlsx')||($filetype=='.doc')||($filetype=='.docx')){
                    if($_FILES['file']['size'] <= 512000){
                        $str = "insert into ".$dbname.".listfileupload values ('','".$nokontrak."','".$filename."','".$filetype."','1','".$_SESSION['standard']['userid']."','".date('Y-m-d H:i:s')."')";
                        try{
                            $owlPDO->exec($str);
                            if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                            file_put_contents($path.$filename,$file_tmpname);
                        }
                        catch(PDOException $e){
                            echo " Gagal," . addslashes($e->getMessage());
                        }
                    }else{
                        exit("warning : Ukuran file upload maksimal 512kb");
                    }
                }else{
                    exit("Warning : Format file upload harus .jpg | .jpeg | .png | .pdf | .xls | .xlsx | .doc | .docx");
                }
            }
        }
    break;

    case 'deletefile':
        $data=$_POST;
        $str="delete from ".$dbname.".listfileupload where nokontrak='".$nokontrak."' and namafile='".$data['namafile']."'";
        try{
            $owlPDO->exec($str);
            $pathx = $path.$data['namafile'];
            unlink($pathx);
        }
        catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }
    break;
    
        default:

}
?>