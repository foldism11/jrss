<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');
require_once('dompdf/autoload.inc.php');
use Dompdf\Dompdf;





$notransaksi=checkPostGet('notransaksi','');
$nokontrak=checkPostGet('nokontrak','');
$nokontrakx=explode('##', $nokontrak);
$nokontrak=$nokontrakx[0];
@$noamandemen=$nokontrakx[1];
$judul=checkPostGet('judul','');
$pbj=checkPostGet('pbj','');
$tanggal=checkPostGet('tanggal','');
$lokasi=checkPostGet('lokasi','');

#harian
$keg=checkPostGet('keg','');
$tk=checkPostGet('tk','');
$mat=checkPostGet('mat','');
$alat=checkPostGet('alat','');
$ket=checkPostGet('ket','');


#Mingguan
$mingguke=checkPostGet('mingguke','');
$uraian=checkPostGet('uraian','');
$harsat=checkPostGet('harsat','');
$vol=checkPostGet('vol','');
$jum=checkPostGet('jum','');
$bobot=checkPostGet('bobot','');

#Bulanan

$kegiatan=checkPostGet('kegiatan','');
$satuan=checkPostGet('satuan','');
$vol=checkPostGet('vol','');
$jum=checkPostGet('jum','');
$bobot=checkPostGet('bobot','');



$method=checkPostGet('method','');

     // exit('error'.$method);

switch ($method) {

	   
        // Harian

         case 'getharian':


            #data Boq
         $strba = "select * from " . $dbname . ".mst_boq_ht_pbj where no_kontrak='".$nokontrak."' and noamandemen='".$noamandemen."' order by no_kontrak";

         $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
         $resba->setFetchMode(PDO::FETCH_OBJ);
         while ($barba = $resba->fetch()) {
            $judul=$barba->judul_kontrak;
            $optpbj = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
            @$pbj.="<option value='" . $barba->kode_vendor . "'>" . $optpbj[$barba->kode_vendor]. "</option>";

            $lokasi=$barba->lokasi_pekerjaan;

         
           
        }

           #data Boq
         $strba = "select * from " . $dbname . ".input_kontrak_pln where no_kontrak='".$nokontrak."' and noamandemen1='".$noamandemen."' order by no_kontrak";

         $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
         $resba->setFetchMode(PDO::FETCH_OBJ);
         while ($barba = $resba->fetch()) {
       

            $tk=$barba->tenaga_kerja;
           
        }

 
        $opttk=preg_split('/\r\n|\r|\n/', $tk);

        @$tkx.="<option value=''>Pilih Data</option>";
        foreach ($opttk as $optk) {
            @$tkx.="<option value='" . substr($optk,3) . "'>" . substr($optk,3). "</option>";
        }
        echo $judul.'##'.$pbj.'##'.$lokasi.'##'.$tkx;
        


         break;


          case 'getnotranshr':

                     #bentuk notransaksi

                  $str = "select no_transaksi from  " . $dbname . ".mst_boq_ht_pbj where no_kontrak='".$nokontrak."' and noamandemen='".$noamandemen."'";

                  $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                  $res->setFetchMode(PDO::FETCH_OBJ);
                  while ($bar = $res->fetch()) {
                    $boq=$bar->no_transaksi;
                    

                  }


                 $str = "select count(notransaksi) as jumlah from  " . $dbname . ".laporan_harian_ht_pbj";
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

            $kd='HR-';

            $kode=$kd.$boq.'-'.$nourutx;

            echo $kode;

        break;

        case 'inserthr':
        
        if ($keg=='') {
            exit('Warning : Kegiatan Tidak Boleh Kosong');
        }
        if ($tk=='') {
            exit('Warning : Tenaga Kerja Tidak Boleh Kosong');
        }
        if ($mat=='') {
            exit('Warning : Material Tidak Boleh Kosong');
        }
         if ($alat=='') {
            exit('Warning : Peralatan Tidak Boleh Kosong');
        }



        $str = "select count(notransaksi) as jumlahx from  " . $dbname . ".laporan_harian_ht_pbj where notransaksi='".$notransaksi."'";
            $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $res->setFetchMode(PDO::FETCH_OBJ);
            while ($bar = $res->fetch()) {
                $jmx=$bar->jumlahx;

            }


            if ($jmx==0) {
                    #insert Header     
                   $date=date('y-m-d h:m:s');            
                   $str="insert into ".$dbname.".laporan_harian_ht_pbj (notransaksi,tanggal_input,lokasi_pekerjaan,create_by,create_time)
                   values ('" . $notransaksi . "','" . $tanggal . "','" . $lokasi . "','" . $_SESSION['standard']['username'] . "','" . $date. "')";

                   try{
                    $owlPDO->exec($str); 
                    $str="insert into ".$dbname.".laporan_harian_dt_pbj (notransaksi,kegiatan_harian,tenaga_kerja_lap,materian_lap,peralatan_lap,keterangan)
                    values ('" . $notransaksi . "','" . $keg . "','".$tk."','".$mat."','".$alat."','".$ket."')";
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
                $str = "select count(notransaksi) as jumlahx from  " . $dbname . ".laporan_harian_dt_pbj where notransaksi='".$notransaksi."' and kegiatan_harian='".$keg."' and tenaga_kerja_lap='".$tk."'";
                $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                $res->setFetchMode(PDO::FETCH_OBJ);
                while ($bar = $res->fetch()) {
                    $jmx=$bar->jumlahx;

                }

                if ($jmx>0) {
                    exit('Warning : Data Sudah Ada !');
                }

                   $str="insert into ".$dbname.".laporan_harian_dt_pbj (notransaksi,kegiatan_harian,tenaga_kerja_lap,materian_lap,peralatan_lap,keterangan)
                    values ('" . $notransaksi . "','" . $keg . "','".$tk."','".$mat."','".$alat."','".$ket."')";
                    //exit('error'.$str);
                    try{
                        $owlPDO->exec($str); 


                    }catch(PDOException $e){
                        echo " Gagal," . addslashes($e->getMessage());
                    }
            }

        break;

        case'updatehr':
  
        $supdt="update ".$dbname.".laporan_harian_dt_pbj set materian_lap='".$mat."',peralatan_lap='".$alat."',keterangan='".$ket."' where notransaksi = '".$notransaksi."' and kegiatan_harian='".$keg."' and tenaga_kerja_lap='".$tk."'";

        try{
            $owlPDO->exec($supdt); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
        break;

        case'loadDatahr':
            $strx = "select * from " . $dbname . ".laporan_harian_ht_pbj order by notransaksi";
            $nx=$owlPDO->query($strx) or die(print " Gagal: ".PDOException::getMessage());
            $nx->setFetchMode(PDO::FETCH_ASSOC);
            while ($dx = $nx->fetch()) {          

                $kodeboq=explode('-', $dx['notransaksi']);
                $boq=$kodeboq[1];
                $nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
                $optnokontrak = makeOption($dbname, 'mst_boq_ht_pbj', 'no_transaksi,no_kontrak');
                $optnoamandemen = makeOption($dbname, 'mst_boq_ht_pbj', 'no_transaksi,noamandemen');
                $optjudul = makeOption($dbname, 'mst_boq_ht_pbj', 'no_transaksi,judul_kontrak');
                $optpbj = makeOption($dbname, 'mst_boq_ht_pbj', 'no_transaksi,kode_vendor');
                $no+=1;
                $tab.="<tr>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $optnokontrak[$boq]. "</td>";          
                $tab.="<td align=left>" . $optjudul[$boq]. "</td>";          
                $tab.="<td align=left>" . $nmvendor[$optpbj[$boq]]. "</td>";          
                $tab.="<td align=left>" . $dx['tanggal_input']. "</td>";          
                $tab.="<td align=left>" . $dx['lokasi_pekerjaan']. "</td>";          
                $tab.="<td align=left>" . $dx['create_by']. "</td>";          
       
                               
                  $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"edithr('".$dx['notransaksi']."','".$optnokontrak[$boq].'##'.$optnoamandemen[$boq]."','".$optjudul[$boq]."','".$optpbj[$boq]."','".$dx['tanggal_input']."','".$dx['lokasi_pekerjaan']."');\"><i class='fas fa-pencil-alt'></i>Edit
                          </a></td>";
                 $tab.="<td align=left><a style='color:white'; class='btn btn-danger btn-sm' onclick=\"hapushr('".$dx['notransaksi']."');\"><i class='fas fa-trash'></i>Delete</a></td>";

                  $tab.="<td align=left><img src=images/excel.jpg class=resicon class=zImgBtn height='30'  title='pdf' onclick=\"pdfhr('" . $dx['notransaksi']. "',event);\" ></i></a></td>";
                      
                $tab.="</tr>"; 
                 }
        
        echo $tab;
        break;


        case'loadDatadetailhr':

            $str = "select * from " . $dbname . ".laporan_harian_dt_pbj where notransaksi='".$notransaksi."'";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
   
               $cuaca = array('0' => 'Cerah','1' => 'Mendung','2' => 'Hujan');
              
                $no+=1;
                $tab.="<tr>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $d['kegiatan_harian']. "</td>";          
                $tab.="<td align=left>" . $d['tenaga_kerja_lap']. "</td>";          
                $tab.="<td align=left>" . $d['materian_lap']. "</td>";          
                $tab.="<td align=left>" . $d['peralatan_lap']. "</td>";          
                $tab.="<td align=left>" . $cuaca[$d['keterangan']]. "</td>";          
                               
                  $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"editdethr('".$d['notransaksi']."','".$d['kegiatan_harian']."','".$d['tenaga_kerja_lap']."','".$d['materian_lap']."','".$d['peralatan_lap']."','".$d['keterangan']."');\"><i class='fas fa-pencil-alt'></i>Edit
                          </a>&nbsp;";
                 $tab.="<a style='color:white'; class='btn btn-danger btn-sm' onclick=\"hapusdethr('".$d['notransaksi']."','".$d['kegiatan_harian']."','".$d['tenaga_kerja_lap']."');\"><i class='fas fa-trash'></i>Delete</a></td>";
                      
                $tab.="</tr>"; 
                 }
        
        echo $tab;

             break;

             case'deletedethr':
             $sIns="delete from ".$dbname.".laporan_harian_dt_pbj where notransaksi='".$notransaksi."' and kegiatan_harian='".$keg."' and tenaga_kerja_lap='".$tk."'";

             try{
                $owlPDO->exec($sIns); 
            }
            catch (PDOException $e){
                echo"Gagal".$e->getMessage();
                die();
            }
            break;


            case'deletehr':
             $sIns="delete from ".$dbname.".laporan_harian_ht_pbj where notransaksi = '".$notransaksi."'";
             try{
                $owlPDO->exec($sIns); 
            }
            catch (PDOException $e){
                echo"Gagal".$e->getMessage();
                die();
            }
            break;


            case'getdata':
            $str = "select * from " . $dbname . ".laporan_kerja_harian_pbj where nokontrak = '".$nokontrak."' and noba='".$noba."'";
            $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $res->setFetchMode(PDO::FETCH_OBJ);
            while ($bar = $res->fetch()) {
                $data=$bar->nokontrak.'##'.$bar->noba.'##'.$bar->hari.'##'.$bar->tanggal1.'##'.$bar->tanggal2.'##'.$bar->manager.'##'.$bar->pengawas_lapangan.'##'.$bar->kegiatan.'##'.$bar->tenaga_kerja.'##'.$bar->material.'##'.$bar->peralatan.'##'.$bar->keterangan;
            }
            echo $data;
            break;

             case'deletemg':
             $sIns="delete from ".$dbname.".laporan_mingguan_ht_pbj where notransaksi = '".$notransaksi."'";
         
             try{
                $owlPDO->exec($sIns); 
            }
            catch (PDOException $e){
                echo"Gagal".$e->getMessage();
                die();
            }
            break;

             case 'pdfhr':

             $kodeboq=explode('-', $notransaksi);
             $boq=$kodeboq[1];

             $strba = "select * from " . $dbname . ".mst_boq_ht_pbj where no_transaksi='".$boq."'";
             $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
             $resba->setFetchMode(PDO::FETCH_OBJ);
             while ($barba = $resba->fetch()) {
              //$notransaksiboq=$barba->no_transaksi;
              $nokontrak=$barba->no_kontrak;
              $judul=$barba->judul_kontrak;
              $pbj=$barba->kode_vendor;
              $optpbj = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');

              $lokasi=$barba->lokasi_pekerjaan;

            }

            $strba = "select * from " . $dbname . ".laporan_harian_ht_pbj where notransaksi='".$notransaksi."'";
            $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
            $resba->setFetchMode(PDO::FETCH_OBJ);
            while ($barba = $resba->fetch()) {
              $tanggal=$barba->tanggal_input;

       

            }
             $stream='';

             $stream.='<table border=0 width=100%>';
             $stream.='<tr>';
             $stream.='<th align=center colspan=6>LAPORAN HARIAN</th>';
             $stream.='</tr>';
             $stream.='</table><br><br>';
    
             $stream.='<table border=0 width=100%>';
             $stream.='<tr>';
             $stream.='<td width=20%>Nama Pekerjaan</td>';
             $stream.='<td>:</td>';
             $stream.='<td>'.$judul.'</td>';
             $stream.='</tr>';
             $stream.='<tr>';
             $stream.='<td>Nomor Surat Perjanjian</td>';
             $stream.='<td>:</td>';
             $stream.='<td>'.$nokontrak.'</td>';
             $stream.='</tr>';
             $stream.='<tr>';
             $stream.='<td>Kontraktor Pelaksana</td>';
             $stream.='<td>:</td>';
             $stream.='<td>'.$optpbj[$pbj].'</td>';
             $stream.='</tr>';
             $stream.='<tr>';
             $stream.='<td>Tanggal</td>';
             $stream.='<td>:</td>';
             $stream.='<td>'.$tanggal.'</td>';
             $stream.='</tr>';
             $stream.='<tr>';
             $stream.='<td>Hari</td>';
             $stream.='<td>:</td>';
             $stream.='<td>'.hari(substr($tanggal,8,2)).'</td>';
             $stream.='</tr>';
             $stream.='<tr>';
             $stream.='<td>Lokasi</td>';
             $stream.='<td>:</td>';
             $stream.='<td>'.$lokasi.'</td>';
             $stream.='</tr>';
             $stream.='</table><br>';

             $stream.='<table border=1 cellspacing=0 width=100%>';
             $stream.='<tr style="background-color: #90bdec;">';
             $stream.='<th width=1%>No</th>';
             $stream.='<th>Kegiatan</th>';
             $stream.='<th>Nama Tenaga Kerja</th>';
             $stream.='<th>Material yg Digunakan</th>';
             $stream.='<th>Peralatan yg Digunakan</th>';
             $stream.='<th>Keterangan</th>';
             $stream.='</tr>';

            $no=0;
            $strba = "select * from " . $dbname . ".laporan_harian_dt_pbj where notransaksi='".$notransaksi."'";
            $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
            $resba->setFetchMode(PDO::FETCH_OBJ);
            while ($barba = $resba->fetch()) {
              $no+=1;
              $kegiatan=$barba->kegiatan_harian;
              $tk=$barba->tenaga_kerja_lap;
              $mat=$barba->materian_lap;
              $alat=$barba->peralatan_lap;
              $ket=$barba->keterangan;
              $cuaca = array('0' => 'Cerah','1' => 'Mendung','2' => 'Hujan');
              $stream.='<tr>';
              $stream.='<th width=1%>'.$no.'</th>';
              $stream.='<th align=left>'.$kegiatan.'</th>';
              $stream.='<th align=left>'.$tk.'</th>';
              $stream.='<th align=left>'.$mat.'</th>';
              $stream.='<th align=left>'.$alat.'</th>';
              $stream.='<th align=left>'. $cuaca[$ket].'</th>';
              $stream.='</tr>';

            }



             $stream.='</table><br><br>';




          /*   echo $stream;
             exit('error');*/
             $tglSkrg=date("Ymd");
             $nop_="laporan_Harian";
             if(strlen($stream)>0)
             {
              if ($handle = opendir('tempExcel')) {
                while (false !== ($file = readdir($handle))) {
                  if ($file != "." && $file != ".." && $file != "index.html") {
                    @unlink('tempExcel/'.$file);
                  }
                }   
                closedir($handle);
              }
              $handle=fopen("tempExcel/".$nop_.".xls",'w');
              if(!fwrite($handle,$stream))
              {
                echo "<script language=javascript1.2>
                parent.window.alert('Can't convert to excel format');
                </script>";
                exit;
              }
              else
              {
                echo "<script language=javascript1.2>
                window.location='tempExcel/".$nop_.".xls';
                </script>";
              }
              fclose($handle);
            }     

            /* $dompdf = new Dompdf();
             $dompdf->loadHtml($stream);
             $dompdf->setPaper('A4', 'portrait');
             $dompdf->render();
             $dompdf->stream("form survey",array("Attachment"=>0));
*/
             break;
            //////tutup harian//////

        // Mingguan

          case 'getmingguan':

         function jml_minggu($tgl_awal, $tgl_akhir){
            $detik = 24 * 3600;
            $tgl_awal = strtotime($tgl_awal);
            $tgl_akhir = strtotime($tgl_akhir);

            $minggu = 0;
            for ($i=$tgl_awal; $i < $tgl_akhir; $i += $detik)
            {
                if (date('w', $i) == '0'){
                    $minggu++;
                }
            }
            return $minggu;
        }

        /* function mingguke($tgl_awal, $tgl_akhir,$jumlah){
            for ($i=$tgl_awal; $i < $jumlah; $i ++)
            {
                $i;
            }
            return $i;
        }*/




        /*function week_of_today($tgl_awal, $tgl_akhir)
        {

            $month = date('m');
            $month = str_pad($month,2,'0',STR_PAD_LEFT);
            $today = date('Y-m-d');

            $tgl_awal = strtotime($tgl_awal);
            $tgl_akhir = strtotime($tgl_akhir);

            $minggu = 0;
            $week_end = 0;

            $last_date =  last_date_ofthe_month();

            for($i = 1; $i<=$last_date; $i++)
            {
                $i = str_pad($i,2,'0',STR_PAD_LEFT);
                $date =  date('Y-{$month}-{$i}');
                $day  =  date('D', strtotime($date));


                if($day == 'Sat')
                {
                    $minggu = $minggu + 1;
                }
                if($date == $today)
                {
                    $minggu = $minggu + 1;
                    break;

                }
            }
            return $minggu;

        }

        function last_date_ofthe_month($month='', $year='')
        {
            if(!$year)   $year   = date('Y');
            if(!$month)  $month  = date('m');
            $date = $year.'-'.$month.'-01';

            $next_month = strtotime('+ 1 month', strtotime($date));

            $last_date  = date('d', strtotime('-1 minutes',  $next_month));
            return $last_date;

        }*/




            #data Kontrak
        /* $strba = "select * from " . $dbname . ".input_kontrak_pln where no_kontrak='".$nokontrak."' and noamandemen1='".$noamandemen."' order by no_kontrak";
         $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
         $resba->setFetchMode(PDO::FETCH_OBJ);
         while ($barba = $resba->fetch()) {
            $judul=$barba->judul_kontrak;
            $optpbj = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
            @$pbj.="<option value='" . $barba->nama_vendor . "'>" . $optpbj[$barba->nama_vendor]. "</option>";

            $lokasi=$barba->lokasi_pekerjaan;
            $per1=$barba->perkontrak1;
            $per2=$barba->perkontrak2;
            $nilai=$barba->nilai_kotrak;

            $tk=$barba->tenaga_kerja;
           
        }*/


        $strba = "select * from " . $dbname . ".mst_boq_ht_pbj where no_kontrak='".$nokontrak."' and noamandemen='".$noamandemen."' order by no_kontrak";
        $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
        $resba->setFetchMode(PDO::FETCH_OBJ);
        while ($barba = $resba->fetch()) {
            $notransaksi=$barba->no_transaksi;
            $nokontrak=$barba->no_kontrak;
            $judul=$barba->judul_kontrak;
            $optpbj = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
            $optper1 = makeOption($dbname, 'input_kontrak_pln', 'no_kontrak,perkontrak1');
            $optper2 = makeOption($dbname, 'input_kontrak_pln', 'no_kontrak,perkontrak2');
            @$pbj.="<option value='" . $barba->kode_vendor . "'>" . $optpbj[$barba->kode_vendor]. "</option>";

            $lokasi=$barba->lokasi_pekerjaan;
           /* $per1=$barba->perkontrak1;
            $per2=$barba->perkontrak2;*/

            $nilai=$barba->nilai_kontrak;

        }

          #data Boq
        @$uraian.="<option value=''>Pilih Data</option>";
         $strba = "select kode_item,nama_item from " . $dbname . ".mst_boq_dt_pbj where no_transaksi='".$notransaksi."'";
         $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
         $resba->setFetchMode(PDO::FETCH_OBJ);
         while ($barba = $resba->fetch()) {

           
            @$uraian.="<option value='" . $barba->kode_item . "'>" . $barba->nama_item. "</option>";
           
        }

 
        $opttk=preg_split('/\r\n|\r|\n/', $tk);

        @$tkx.="<option value=''>Pilih Data</option>";
        foreach ($opttk as $optk) {
            @$tkx.="<option value='" . substr($optk,3) . "'>" . substr($optk,3). "</option>";
        }
       // $jmlmg=jml_minggu($per1, $per2);
        //exit('error'.mingguke($per1, $per2,$jmlmg));
      
        echo $judul.'##'.$pbj.'##'.$lokasi.'##'.$uraian.'##'.$nilai;

        


         break;

         case 'getharsat':

             #data Boq
             $kodeboq=explode('-', $notransaksi);
             $boq=$kodeboq[1];

             $strba = "select kode_item,nama_item,harga_item from " . $dbname . ".mst_boq_dt_pbj where no_transaksi='".$boq."' and kode_item='".$uraian."' order by no_transaksi";
             $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
             $resba->setFetchMode(PDO::FETCH_OBJ);
             while ($barba = $resba->fetch()) {

               
             $harsat=$barba->harga_item;
               
            }
        echo $harsat;


         break;

         case 'getnotransmg':

                     #bentuk notransaksi

                  $str = "select no_transaksi from  " . $dbname . ".mst_boq_ht_pbj where no_kontrak='".$nokontrak."' and noamandemen='".$noamandemen."'";

                  $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                  $res->setFetchMode(PDO::FETCH_OBJ);
                  while ($bar = $res->fetch()) {
                    $boq=$bar->no_transaksi;
                    

                  }

                 $str = "select count(notransaksi) as jumlah from  " . $dbname . ".laporan_mingguan_ht_pbj";
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

            $kd='MG-';

            $kode=$kd.$boq.'-'.$nourutx;

            echo $kode;

        break;


        
        case 'insertmg':
        
        if ($uraian=='') {
            exit('Warning : Uraian Tidak Boleh Kosong');
        }
        if ($vol=='') {
            exit('Warning : volume Kerja Tidak Boleh Kosong');
        }


       

            $str = "select count(notransaksi) as jumlahx from  " . $dbname . ".laporan_mingguan_ht_pbj where notransaksi='".$notransaksi."'";
            $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $res->setFetchMode(PDO::FETCH_OBJ);
            while ($bar = $res->fetch()) {
                $jmx=$bar->jumlahx;

            }
            
             $jnsitm=explode('_', $uraian);
                   $jnsx=$jnsitm[0];
                   if ($jnsx=='BR') {
                     $jns='1';
                   }
                   else
                   {
                    $jns='2';
                   }
         
            if ($jmx==0) {
                    #insert Header     
                   $date=date('y-m-d h:m:s');   
                   $kodeboq=explode('-', $notransaksi);
                   $boq=$kodeboq[1];

                  

                   $per1 = makeOption($dbname, 'mst_boq_ht_pbj', 'no_transaksi,perkontrak1');         
                   $per2 = makeOption($dbname, 'mst_boq_ht_pbj', 'no_transaksi,perkontrak2');         
                   $item = makeOption($dbname, 'mst_boq_dt_pbj', 'kode_item,nama_item');         
                   $str="insert into ".$dbname.".laporan_mingguan_ht_pbj (notransaksi,tanggal_input,periode_minggu_1  ,periode_minggu_2,lokasi_pekerjaan,minggu_ke,create_by,create_time)
                   values ('" . $notransaksi . "','" . $tanggal . "','" . $per1[$boq] . "','" . $per2[$boq] . "','" . $lokasi . "','" . $mingguke . "','" . $_SESSION['standard']['username'] . "','" . $date. "')";

                   try{
                    $owlPDO->exec($str); 
                    $str="insert into ".$dbname.".laporan_mingguan_dt_pbj (notransaksi,jns_item,kode_item,minggu_ke,vol_item,jum_item,bobot_item)
                    values ('" . $notransaksi . "','".$jns."','".$uraian."','".$mingguke."','".$vol."','".$jum."','".$bobot."')";

                        //exit('error'.$str);
                    try{
                        $owlPDO->exec($str); 


                    }catch(PDOException $e){
                        echo " Gagal," . addslashes($e->getMessage());
                    }

                }catch(PDOException $e){
                    echo " Gagal," . addslashes($e->getMessage());
                }

                echo $nokontrak.'##'.$noamandemen.'##'.$kode;
            }
            else
            {
                $str = "select count(notransaksi) as jumlahx from  " . $dbname . ".laporan_mingguan_dt_pbj where notransaksi='".$notransaksi."' and kode_item='".$uraian."'";
                $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                $res->setFetchMode(PDO::FETCH_OBJ);
                while ($bar = $res->fetch()) {
                    $jmx=$bar->jumlahx;

                }

                if ($jmx>0) {
                    exit('Warning : Data Sudah Ada !');
                }

                  $str="insert into ".$dbname.".laporan_mingguan_dt_pbj (notransaksi,jns_item,kode_item,minggu_ke,vol_item,jum_item,bobot_item)
                    values ('" . $notransaksi . "','".$jns."','".$uraian."','".$mingguke."','".$vol."','".$jum."','".$bobot."')";
                    //exit('error'.$str);
                    try{
                        $owlPDO->exec($str); 


                    }catch(PDOException $e){
                        echo " Gagal," . addslashes($e->getMessage());
                    }

                    echo $nokontrak.'##'.$noamandemen.'##'.$kode;
            }

        break;

        case'loadDatadetailmg':

             $kodeboq=explode('-', $notransaksi);
                $boq=$kodeboq[1];
            $str = "select * from " . $dbname . ".laporan_mingguan_dt_pbj where notransaksi='".$notransaksi."'";

            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
   
               $item = makeOption($dbname, 'mst_boq_dt_pbj', 'kode_item,nama_item','no_transaksi="'.$boq.'"');
              
                $no+=1;
                $tab.="<tr>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $item[$d['kode_item']]. "</td>";                 
                $tab.="<td align=right>" . number_format($d['vol_item'],1). "</td>";          
                $tab.="<td align=right>" . number_format($d['jum_item']). "</td>";          
                $tab.="<td align=right>" . number_format($d['bobot_item']). "</td>";          
                               
                  $tab.="<td align=center><a style='color:white'; class='btn btn-info btn-sm' onclick=\"editdetmg('".$d['notransaksi']."','".$d['kode_item']."','".$d['vol_item']."','".$d['jum_item']."','".$d['bobot_item']."');\"><i class='fas fa-pencil-alt'></i>Edit
                          </a>&nbsp;";
                 $tab.="<a style='color:white'; class='btn btn-danger btn-sm' onclick=\"hapusdetmg('".$d['notransaksi']."','".$d['kode_item']."');\"><i class='fas fa-trash'></i>Delete</a></td>";
                      
                $tab.="</tr>"; 
                 }
        
        echo $tab;

             break;


        case'loadDatamg':


             $str = "select * from " . $dbname . ".laporan_mingguan_ht_pbj ";
             $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
             $n->setFetchMode(PDO::FETCH_ASSOC);
             while ($d = $n->fetch()) {

                $kodeboq=explode('-', $d['notransaksi']);
                $boq=$kodeboq[1];
                $nmvendor = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
                $optnokontrak = makeOption($dbname, 'mst_boq_ht_pbj', 'no_transaksi,no_kontrak');
                $optnoamandemen = makeOption($dbname, 'mst_boq_ht_pbj', 'no_transaksi,noamandemen');
                $optjudul = makeOption($dbname, 'mst_boq_ht_pbj', 'no_transaksi,judul_kontrak');
                $optpbj = makeOption($dbname, 'mst_boq_ht_pbj', 'no_transaksi,kode_vendor');

                //$optpbj = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');

                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $d['notransaksi']. "</td>";          
                $tab.="<td align=left>" . $optnokontrak[$boq]. "</td>";          
                $tab.="<td align=left>" . $optnoamandemen[$boq]. "</td>";                   
                $tab.="<td align=left>" . $optjudul[$boq]. "</td>";                   
                $tab.="<td align=left>" . $nmvendor[$optpbj[$boq]]. "</td>";                   
                $tab.="<td align=left>" . $d['tanggal_input']. "</td>";                   
                $tab.="<td align=left>" . $d['lokasi_pekerjaan']. "</td>";                   
                $tab.="<td align=left>" . $d['minggu_ke']. "</td>";                 
                $tab.="<td align=left>" . $d['create_by']. "</td>";                 
                       

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"editmg('".$d['notransaksi']."','".$optnokontrak[$boq].'##'.$optnoamandemen[$boq]."','".$optjudul[$boq]."','".$optpbj[$boq]."','".$d['tanggal_input']."','".$d['lokasi_pekerjaan']."','".$d['minggu_ke']."');\"><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";
                $tab.="<td align=left><a style='color:white'; class='btn btn-danger btn-sm' onclick=hapusmg('".$d['notransaksi']."');><i class='fas fa-trash'></i>Delete</a></td>";
                 $tab.="<td align=left><img src=images/excel.jpg class=resicon class=zImgBtn height='30'  title='pdf' onclick=\"pdfmg('" . $d['notransaksi']. "',event);\" ></i></a></td>";

                $tab.="</tr>"; 
            }

            echo $tab;

            break;


            case'updatemg':

            $supdt="update ".$dbname.".laporan_mingguan_dt_pbj set vol_item='".$vol."',jum_item='".$jum."',bobot_item='".$bobot."' where notransaksi = '".$notransaksi."' and kode_item='".$uraian."'";
      

            try{
                $owlPDO->exec($supdt); 
            }
            catch (PDOException $e){
                echo"Gagal".$e->getMessage();
                die();
            }
            break;



           case'deletedetmg':
             $sIns="delete from ".$dbname.".laporan_mingguan_dt_pbj where notransaksi = '".$notransaksi."' and kode_item='".$uraian."'";
         
             try{
                $owlPDO->exec($sIns); 
            }
            catch (PDOException $e){
                echo"Gagal".$e->getMessage();
                die();
            }
            break;


            case 'pdfmg':

             $kodeboq=explode('-', $notransaksi);
             $boq=$kodeboq[1];

             $strba = "select * from " . $dbname . ".mst_boq_ht_pbj where no_transaksi='".$boq."'";
             $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
             $resba->setFetchMode(PDO::FETCH_OBJ);
             while ($barba = $resba->fetch()) {
              //$notransaksiboq=$barba->no_transaksi;
              $nokontrak=$barba->no_kontrak;
              $judul=$barba->judul_kontrak;
              $pbj=$barba->kode_vendor;
              $optpbj = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');

              $lokasi=$barba->lokasi_pekerjaan;

            }

            $strba = "select * from " . $dbname . ".laporan_mingguan_ht_pbj where notransaksi='".$notransaksi."'";
            $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
            $resba->setFetchMode(PDO::FETCH_OBJ);
            while ($barba = $resba->fetch()) {
              $tanggal=$barba->tanggal_input;
              $per1=$barba->periode_minggu_1;
              $per2=$barba->periode_minggu_2;
              $mingguke=$barba->minggu_ke;

       

            }
             $stream='';

             $stream.='<table border=0 width=100%>';
             $stream.='<tr>';
             $stream.='<th align=center colspan=9>LAPORAN MINGGUAN</th>';
             $stream.='</tr>';
             $stream.='</table><br><br>';
    
             $stream.='<table border=0 width=100%>';
             $stream.='<tr>';
             $stream.='<td width=20%>Nama Pekerjaan</td>';
             $stream.='<td>: '.$judul.'</td>';
             $stream.='</tr>';
             $stream.='<tr>';
             $stream.='<td>Nomor Surat Perjanjian</td>';
             $stream.='<td>: '.$nokontrak.'</td>';
             $stream.='</tr>';
             $stream.='<tr>';
             $stream.='<td>Kontraktor Pelaksana</td>';
             $stream.='<td>: '.$optpbj[$pbj].'</td>';
             $stream.='</tr>';
             $stream.='<tr>';
             $stream.='<td>Periode Tanggal</td>';
             $stream.='<td>: '.$per1.' S/D '.$per2.'</td>';
             $stream.='</tr>';
             $stream.='<tr>';
             $stream.='<td>Minggu Ke</td>';
             $stream.='<td>: '.$mingguke.'</td>';
             $stream.='</tr>';
             $stream.='<tr>';
           
             $stream.='</table><br>';

             $stream.='<table border=1 cellspacing=0 width=100%>';
             $stream.='<tr style="background-color: #90bdec;">';
             $stream.='<th width=1% rowspan=2>No</th>';
             $stream.='<th rowspan=2>Uraian Pekerjaan</th>';
             $stream.='<th colspan=4>Kontrak</th>';
             $stream.='<th colspan=3>Bobot(%)</th>';
             $stream.='<tr style="background-color: #90bdec;">';
             $stream.='<th>Volume</th>';
             $stream.='<th>Satuan</th>';
             $stream.='<th>Jumlah (Rp)</th>';
             $stream.='<th>Bobot (%)</th>';
             $stream.='<th>Minggu Lalu</th>';
             $stream.='<th>Minggu Ini</th>';
             $stream.='<th>Total</th>';
             $stream.='</tr>';
            
             $stream.='</tr>';

            $no=0;
            #minggu lalau
            $mnggulalu=$mingguke-1;
           /* if ($mnggulalu>0) {
              # code...
            }*/
            $strba = "select * from " . $dbname . ".laporan_mingguan_ht_pbj where notransaksi like '%".$boq."%' and minggu_ke='".$mnggulalu."'";
            $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
            $resba->setFetchMode(PDO::FETCH_OBJ);
            while ($barba = $resba->fetch()) {
              @$notrans=$barba->notransaksi;
            }


           




            $strba = "select * from " . $dbname . ".laporan_mingguan_dt_pbj where notransaksi='".$notransaksi."'";
            $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
            $resba->setFetchMode(PDO::FETCH_OBJ);
            while ($barba = $resba->fetch()) {
             
              $notransaksix[$barba->notransaksi]=$barba->notransaksi;
              $uraianx[$barba->kode_item]=$barba->kode_item;
              
              $uraian_[$barba->notransaksi][$barba->kode_item]=$barba->kode_item;
              $vol_[$barba->notransaksi][$barba->kode_item]=$barba->vol_item;
              $jum_[$barba->notransaksi][$barba->kode_item]=$barba->jum_item;
              $bobot_[$barba->notransaksi][$barba->kode_item]=$barba->bobot_item;
           
            

            }

      

            $strba = "select * from " . $dbname . ".laporan_mingguan_dt_pbj where notransaksi ='". @$notrans."'";
            $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
            $resba->setFetchMode(PDO::FETCH_OBJ);
            while ($barba = $resba->fetch()) {
             @$bobotlalu[$notransaksi][$barba->kode_item]=$barba->bobot_item;
            }
    
            foreach ($notransaksix as $notr) {
           
               $item = makeOption($dbname, 'mst_boq_dt_pbj', 'kode_item,nama_item','no_transaksi="'.$boq.'"');
               $satuan = makeOption($dbname, 'mst_boq_dt_pbj', 'kode_item,satuan_item','no_transaksi="'.$boq.'"');
           
               foreach ($uraianx as $kditm) {
                  $no+=1;
                 $stream.='<tr>';
                 $stream.='<th width=1%>'.$no.'</th>';
                 $stream.='<th align=left>'.$item[$uraian_[$notr][$kditm]].'</th>';
                 $stream.='<th align=left>'.number_format($vol_[$notr][$kditm]).'</th>';
                 $stream.='<th align=left>'.$satuan[$uraian_[$notr][$kditm]].'</th>';
                 $stream.='<th align=left>'.number_format($jum_[$notr][$kditm]).'</th>';
                 $stream.='<th align=left>'.number_format($bobot_[$notr][$kditm]).'</th>';
                $stream.='<th align=left>'.number_format(@$bobotlalu[$notr][$kditm]).'</th>';
                $stream.='<th align=left>'.number_format($bobot_[$notr][$kditm]).'</th>';
                $stream.='<th align=left>'.number_format(@$bobotlalu[$notr][$kditm]+$bobot_[$notr][$kditm]).'</th>';
               }
              

               $stream.='</tr>';
            }



             $stream.='</table><br><br>';




          /*   echo $stream;
             exit('error');*/
             $tglSkrg=date("Ymd");
             $nop_="laporan_Harian";
             if(strlen($stream)>0)
             {
              if ($handle = opendir('tempExcel')) {
                while (false !== ($file = readdir($handle))) {
                  if ($file != "." && $file != ".." && $file != "index.html") {
                    @unlink('tempExcel/'.$file);
                  }
                }   
                closedir($handle);
              }
              $handle=fopen("tempExcel/".$nop_.".xls",'w');
              if(!fwrite($handle,$stream))
              {
                echo "<script language=javascript1.2>
                parent.window.alert('Can't convert to excel format');
                </script>";
                exit;
              }
              else
              {
                echo "<script language=javascript1.2>
                window.location='tempExcel/".$nop_.".xls';
                </script>";
              }
              fclose($handle);
            }     

            /* $dompdf = new Dompdf();
             $dompdf->loadHtml($stream);
             $dompdf->setPaper('A4', 'portrait');
             $dompdf->render();
             $dompdf->stream("form survey",array("Attachment"=>0));
*/
             break;

        // Tutup Mingguan 

        // Bulanan

              case 'getbulanan':

         function jml_minggu($tgl_awal, $tgl_akhir){
            $detik = 24 * 3600;
            $tgl_awal = strtotime($tgl_awal);
            $tgl_akhir = strtotime($tgl_akhir);

            $minggu = 0;
            for ($i=$tgl_awal; $i < $tgl_akhir; $i += $detik)
            {
                if (date('w', $i) == '0'){
                    $minggu++;
                }
            }
            return $minggu;
        }

        /* function mingguke($tgl_awal, $tgl_akhir,$jumlah){
            for ($i=$tgl_awal; $i < $jumlah; $i ++)
            {
                $i;
            }
            return $i;
        }*/




        /*function week_of_today($tgl_awal, $tgl_akhir)
        {

            $month = date('m');
            $month = str_pad($month,2,'0',STR_PAD_LEFT);
            $today = date('Y-m-d');

            $tgl_awal = strtotime($tgl_awal);
            $tgl_akhir = strtotime($tgl_akhir);

            $minggu = 0;
            $week_end = 0;

            $last_date =  last_date_ofthe_month();

            for($i = 1; $i<=$last_date; $i++)
            {
                $i = str_pad($i,2,'0',STR_PAD_LEFT);
                $date =  date('Y-{$month}-{$i}');
                $day  =  date('D', strtotime($date));


                if($day == 'Sat')
                {
                    $minggu = $minggu + 1;
                }
                if($date == $today)
                {
                    $minggu = $minggu + 1;
                    break;

                }
            }
            return $minggu;

        }

        function last_date_ofthe_month($month='', $year='')
        {
            if(!$year)   $year   = date('Y');
            if(!$month)  $month  = date('m');
            $date = $year.'-'.$month.'-01';

            $next_month = strtotime('+ 1 month', strtotime($date));

            $last_date  = date('d', strtotime('-1 minutes',  $next_month));
            return $last_date;

        }*/




            #data Kontrak
/*         $strba = "select * from " . $dbname . ".input_kontrak_pln where no_kontrak='".$nokontrak."' and noamandemen1='".$noamandemen."' order by no_kontrak";
         $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
         $resba->setFetchMode(PDO::FETCH_OBJ);
         while ($barba = $resba->fetch()) {
            $judul=$barba->judul_kontrak;
            $optpbj = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
            @$pbj.="<option value='" . $barba->nama_vendor . "'>" . $optpbj[$barba->nama_vendor]. "</option>";

            $lokasi=$barba->lokasi_pekerjaan;
            $per1=$barba->perkontrak1;
            $per2=$barba->perkontrak2;
            $nilai=$barba->nilai_kotrak;

            $tk=$barba->tenaga_kerja;
           
        }*/


         $strba = "select * from " . $dbname . ".mst_boq_ht_pbj where no_kontrak='".$nokontrak."' and noamandemen='".$noamandemen."' order by no_kontrak";
        $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
        $resba->setFetchMode(PDO::FETCH_OBJ);
        while ($barba = $resba->fetch()) {
            $notransaksi=$barba->no_transaksi;
            $nokontrak=$barba->no_kontrak;
            $judul=$barba->judul_kontrak;
            $optpbj = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');
            $optper1 = makeOption($dbname, 'input_kontrak_pln', 'no_kontrak,perkontrak1');
            $optper2 = makeOption($dbname, 'input_kontrak_pln', 'no_kontrak,perkontrak2');
            @$pbj.="<option value='" . $barba->kode_vendor . "'>" . $optpbj[$barba->kode_vendor]. "</option>";

            $lokasi=$barba->lokasi_pekerjaan;
           /* $per1=$barba->perkontrak1;
            $per2=$barba->perkontrak2;*/

            $nilai=$barba->nilai_kontrak;

        }

          #data Boq
        @$uraian.="<option value=''>Pilih Data</option>";
         $strba = "select kode_item,nama_item from " . $dbname . ".mst_boq_dt_pbj where no_transaksi='".$notransaksi."'";
         $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
         $resba->setFetchMode(PDO::FETCH_OBJ);
         while ($barba = $resba->fetch()) {

           
            @$uraian.="<option value='" . $barba->kode_item . "'>" . $barba->nama_item. "</option>";
           
        }



 
      
      
        echo $judul.'##'.$pbj.'##'.$lokasi.'##'.$uraian.'##'.$nilai;

        


         break;

         case 'getharsatbl':

             #data Boq
             $strba = "select kode_item,nama_item,harga_item from " . $dbname . ".mst_boq_dt_pbj where no_kontrak='".$nokontrak."' and noamandemen='".$noamandemen."' and kode_item='".$uraian."' order by no_kontrak";
          
             $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
             $resba->setFetchMode(PDO::FETCH_OBJ);
             while ($barba = $resba->fetch()) {

               
             $harsat=$barba->harga_item;
               
            }
        echo $harsat;



         break;

         case 'getnotransbl':

                     #bentuk notransaksi


                  $str = "select no_transaksi from  " . $dbname . ".mst_boq_ht_pbj where no_kontrak='".$nokontrak."' and noamandemen='".$noamandemen."'";

                  $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
                  $res->setFetchMode(PDO::FETCH_OBJ);
                  while ($bar = $res->fetch()) {
                    $boq=$bar->no_transaksi;
                    

                  }

                 $str = "select count(notransaksi) as jumlah from  " . $dbname . ".laporan_bulanan_ht_pbj";
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

            $kd='BL-';

            $kode=$kd.$boq.'-'.$nourutx;

            echo $kode;

        break;

        case 'detailbulan':

        $stream='';
        $stream.= "<table border=1 width=100%>";
        $stream.='<tr style="background-color: #90bdec;">';
        $stream.='<th>No</th>';
        $stream.='<th>Uraian Pekerjaan</th>';
        $stream.='<th width=10%>Volume</th>';
        $stream.='<th>Satuan</th>';
        $stream.='<th>Jumlah (Rp)</th>';
        $stream.='<th>Bobot (%)</th>';
        $stream.='</tr>';


        $kodeboq=explode('-', $notransaksi);
        $boq=$kodeboq[1];
        
        $strba = "select kode_item as uraian,sum(vol_item) as volume,sum(jum_item) as jumlah,sum(bobot_item) as bobot from " . $dbname . ".laporan_mingguan_dt_pbj where notransaksi like '%".$boq."%' group by kode_item";
  
        $resba=$owlPDO->query($strba) or die(print " Gagal: ".PDOException::getMessage());
        $resba->setFetchMode(PDO::FETCH_OBJ);
        while ($barba = $resba->fetch()) {
          $no+=1;
          $kegiatan=$barba->uraian;
          $volume=$barba->volume;
          $jumlah=$barba->jumlah;
          $bobot=$barba->bobot;
          $item = makeOption($dbname, 'mst_boq_dt_pbj', 'kode_item,nama_item','no_transaksi="'.$boq.'"');
          $satuan = makeOption($dbname, 'mst_boq_dt_pbj', 'kode_item,satuan_item','no_transaksi="'.$boq.'"');



          $stream.='<tr>';
          $stream.='<th width=1%>'.$no.'</th>';
           $stream.='<th align=right hidden><input type=text readonly class=myinputtextnumber id=kegiatanx'.$no.' name=kegiatanx onkeypress=\"return tanpa_kutip(event);\" style="height:25px; width:100%;" value='.$kegiatan.'></th>';

          $stream.='<th align=left id=kegiatan'.$no.' value='.$kegiatan.'>'.$item[$kegiatan].'</th>';

          $stream.='<th align=right><input type=text readonly class=myinputtextnumber id=vol'.$no.' name=vol onkeypress=\"return tanpa_kutip(event);\" style="height:25px; width:100%;" value='.number_format($volume).'></th>';
          $stream.='<th align=left><input type=text readonly class=myinputtext id=satuan'.$no.' name=satuan onkeypress=\"return tanpa_kutip(event);\" style="height:25px; width:100%;" value='.$satuan[$kegiatan].'></th>';
          $stream.='<th align=right><input type=text readonly class=myinputtextnumber id=jum'.$no.' name=jum onkeypress=\"return tanpa_kutip(event);\" style="height:25px; width:100%;" value='.number_format($jumlah).'></th>';
          $stream.='<th align=right><input type=text readonly class=myinputtextnumber id=bobot'.$no.' name=bobot onkeypress=\"return tanpa_kutip(event);\" style="height:25px; width:100%;" value='.number_format($bobot).'></th>';
          $stream.='</tr>
          <br>';



      }

      $stream.= "</table><br>";
      ?>
<script language=javascript1.2 src='js/bpj_rencana_kerja.js'></script>
<?
      $stream.= "<table>
          <tr>
          <input type=hidden value=insertbl id=methodbl>
          <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=save(".$no.") >Simpan</button></td>
          <td> <button  style='width:100px;' type='button' class='btn btn-block btn-primary' onclick=cancelbl()>Batal</button></td>
          </tr>
          </table><br>
          ";
    
        echo $stream;


        break;


        
        case 'insertbl':
        
        if ($kegiatan=='') {
            exit('Warning : Uraian Tidak Boleh Kosong');
        }
        if ($vol=='') {
            exit('Warning : volume Kerja Tidak Boleh Kosong');
        }


                $jnsitm=explode('_', $kegiatan);
                $jnsx=$jnsitm[0];
                if ($jnsx=='BR') {
                   $jns='1';
               }
               else
               {
                $jns='2';
            }
  
            $str = "select count(notransaksi) as jumlahx from  " . $dbname . ".laporan_bulanan_ht_pbj where notransaksi='".$notransaksi."'";
            $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $res->setFetchMode(PDO::FETCH_OBJ);
            while ($bar = $res->fetch()) {
                $jmx=$bar->jumlahx;

            }
   
      
            if ($jmx==0) {
                    #insert Header     
                   $date=date('y-m-d h:m:s');            
                   $str="insert into ".$dbname.".laporan_bulanan_ht_pbj (notransaksi,no_kontrak,judul_kontrak,kode_vendor,tanggal_kontrak,lokasi_pekerjaan,create_by,create_time)
                   values ('" . $notransaksi . "','" . $nokontrak . "','" . $judul . "','" . $pbj . "','" . $tanggal . "','" . $lokasi . "','" . $_SESSION['standard']['username'] . "','" . $date. "')";

                   try{
                    $owlPDO->exec($str); 
                    $str="insert into ".$dbname.".laporan_bulanan_dt_pbj (notransaksi,no_kontrak,kode_item,jns_item,vol_item,jum_item,bobot_item)
                    values ('" . $notransaksi . "','" . $nokontrak . "','".$kegiatan."','" . $jns . "','".$vol."','".$jum."','".$bobot."')";

                        //exit('error'.$str);
                    try{
                        $owlPDO->exec($str); 


                    }catch(PDOException $e){
                        echo " Gagal," . addslashes($e->getMessage());
                    }

                }catch(PDOException $e){
                    echo " Gagal," . addslashes($e->getMessage());
                }

                echo $nokontrak.'##'.$noamandemen.'##'.$kode;
            }
            else
            {
              

                $str="insert into ".$dbname.".laporan_bulanan_dt_pbj (notransaksi,no_kontrak,kode_item,jns_item,vol_item,jum_item,bobot_item)
                    values ('" . $notransaksi . "','" . $nokontrak . "','".$kegiatan."','" . $jns . "','".$vol."','".$jum."','".$bobot."')";
                    //exit('error'.$str);
                    try{
                        $owlPDO->exec($str); 


                    }catch(PDOException $e){
                        echo " Gagal," . addslashes($e->getMessage());
                    }

                    echo $nokontrak.'##'.$noamandemen.'##'.$kode;
            }

        break;

        case'loadDatadetailbl':

            $str = "select * from " . $dbname . ".laporan_bulanan_dt_pbj where notransaksi='".$notransaksi."'";

            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
   
               $item = makeOption($dbname, 'mst_boq_dt_pbj', 'kode_item,nama_item');
              
                $no+=1;
                $tab.="<tr>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $item[$d['kode_item']]. "</td>";                 
                $tab.="<td align=right>" . number_format($d['vol_item'],1). "</td>";          
                $tab.="<td align=right>" . number_format($d['jum_item']). "</td>";          
                $tab.="<td align=right>" . number_format($d['bobot_item']). "</td>";          
                               
                  $tab.="<td align=center><a style='color:white'; class='btn btn-info btn-sm' onclick=\"editdetbl('".$d['notransaksi']."','".$d['no_kontrak']."','".$d['kode_item']."','".$d['vol_item']."','".$d['jum_item']."','".$d['bobot_item']."');\"><i class='fas fa-pencil-alt'></i>Edit
                          </a>&nbsp;";
                 $tab.="<a style='color:white'; class='btn btn-danger btn-sm' onclick=\"hapusdetbl('".$d['notransaksi']."','".$d['no_kontrak']."','".$d['kode_item']."');\"><i class='fas fa-trash'></i>Delete</a></td>";
                      
                $tab.="</tr>"; 
                 }
        
        echo $tab;

             break;


        case'loadDatabl':

             $str = "select * from " . $dbname . ".laporan_bulanan_ht_pbj ";
             $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
             $n->setFetchMode(PDO::FETCH_ASSOC);
             while ($d = $n->fetch()) {
                $optpbj = makeOption($dbname, 'mst_vendor_pbj', 'kode_vendor,nama_vendor');

                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $d['notransaksi']. "</td>";          
                $tab.="<td align=left>" . $d['no_kontrak']. "</td>";          
                $tab.="<td align=left>" . $d['noamandemen']. "</td>";                   
                $tab.="<td align=left>" . $d['judul_kontrak']. "</td>";                   
                $tab.="<td align=left>" . $optpbj[$d['kode_vendor']]. "</td>";                   
                $tab.="<td align=left>" . $d['tanggal_kontrak']. "</td>";                   
                $tab.="<td align=left>" . $d['lokasi_pekerjaan']. "</td>";                   
                $tab.="<td align=left>" . $d['bulan_ke']. "</td>";                 
                $tab.="<td align=left>" . $d['create_by']. "</td>";                 
                       

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"editbl('".$d['notransaksi']."','".$d['no_kontrak'].'##'.$d['noamandemen']."','".$d['judul_kontrak']."','".$d['kode_vendor']."','".$d['tanggal_kontrak']."','".$d['lokasi_pekerjaan']."','".$d['bulan_ke']."');\"><i class='fas fa-pencil-alt'></i>Edit
                </a></td>";
                $tab.="<td align=left><a style='color:white'; class='btn btn-danger btn-sm' onclick=hapusmg('".$d['notransaksi']."');><i class='fas fa-trash'></i>Delete</a></td>";

                $tab.="</tr>"; 
            }

            echo $tab;

            break;


            case'updatebl':

            $supdt="update ".$dbname.".laporan_bulanan_dt_pbj set vol_item='".$vol."',jum_item='".$jum."',bobot_item='".$bobot."' where notransaksi = '".$notransaksi."' and kode_item='".$uraian."'";
      

            try{
                $owlPDO->exec($supdt); 
            }
            catch (PDOException $e){
                echo"Gagal".$e->getMessage();
                die();
            }
            break;



           case'deletedetbl':
             $sIns="delete from ".$dbname.".laporan_bulanan_dt_pbj where notransaksi = '".$notransaksi."' and kode_item='".$uraian."'";
         
             try{
                $owlPDO->exec($sIns); 
            }
            catch (PDOException $e){
                echo"Gagal".$e->getMessage();
                die();
            }
            break;
        
        // Tutup Bulanan 
       

        default:

}
?>