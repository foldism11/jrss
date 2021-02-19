<?php
require_once('master_validation.php');
require_once('config/connection.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
require_once('lib/fpdf.php');
require_once('lib/terbilang.php');



$noba=checkPostGet('noba','');
$nokontrak=checkPostGet('nokontrak','');
$sifatba=checkPostGet('sifatba','');
$jenisba=checkPostGet('jenisba','');
$tanggal=checkPostGet('tanggal','');
$tanggalx=explode('/', $tanggal);
@$tanggal=$tanggalx[2].$tanggalx[0].$tanggalx[1];
$method=checkPostGet('method','');

//exit('error'.$method);
    if ($jenisba=='bakp') {
        $tanggallkp=checkPostGet('tanggallkp','');
        $tanggalxlkp=explode('/', $tanggallkp);
        @$tanggallkp=$tanggalxlkp[2].$tanggalxlkp[0].$tanggalxlkp[0];
        $persenbakp=checkPostGet('persenbakp','');
        $refkontrakbakp=checkPostGet('refkontrakbakp','');
        
    }

    else if ($jenisba=='basp') {
        $pasalbasp=checkPostGet('pasalbasp','');
        $tahapbasp=checkPostGet('tahapbasp','');
        $sampaibasp=checkPostGet('sampaibasp','');
        $nominalbasp=checkPostGet('nominalbasp','');
        $waktubasp=checkPostGet('waktubasp','');
        $dendabasp=checkPostGet('dendabasp','');
        $waktuterlambatbasp=checkPostGet('waktuterlambatbasp','');
        $persenbasp=checkPostGet('persenbasp','');
        
    }

    else if ($jenisba=='bast') {
        $ketpbjbast=checkPostGet('ketpbjbast','');
        $nobaspbast=checkPostGet('nobaspbast','');
        $tanggalbaspbast=checkPostGet('tanggalbaspbast','');
        $tanggalxbast=explode('/', $tanggalbaspbast);
        @$tanggalbaspbast=$tanggalxbast[2].$tanggalxbast[0].$tanggalxbast[0];
        
    }

        else if ($jenisba=='bastb') {
        $ketpbjbastb=checkPostGet('ketpbjbastb','');
        $nobaspbastb=checkPostGet('nobaspbastb','');
        $tanggalbaspbastb=checkPostGet('tanggalbaspbastb','');
        $tanggalxbastb=explode('/', $tanggalbaspbastb);
        @$tanggalbaspbastb=$tanggalxbastb[2].$tanggalxbastb[0].$tanggalxbastb[0];
        
    }
    
    

    else if ($jenisba=='bak') {
        $nobappbak=checkPostGet('nobappbak','');
        $tanggalbappbak=checkPostGet('tanggalbappbak','');
        $tanggalxbak=explode('/', $tanggalbappbak);
        @$tanggalbappbak=$tanggalxbak[2].$tanggalxbak[0].$tanggalxbak[0];
        $terlambatbak=checkPostGet('terlambatbak','');
        $persenbak=checkPostGet('persenbak','');
       
    }

    else if ($jenisba=='bap') {
       $nobakpbap=checkPostGet('nobakpbap','');
       $nobappbap=checkPostGet('nobappbap','');
       $nobakbap=checkPostGet('nobakbap','');
       $persenbap=checkPostGet('persenbap','');
       $terminbap=checkPostGet('terminbap','');
       $persen2bap=checkPostGet('persen2bap','');
       $nominalbap=checkPostGet('nominalbap','');
       
    }

    else if ($jenisba=='basmp') {
        $lamamasabasmp=checkPostGet('lamamasabasmp','');
        $pasalbasmp=checkPostGet('pasalbasmp','');
        $tahapbasmp=checkPostGet('tahapbasmp','');
        $terbayarbasmp=checkPostGet('terbayarbasmp','');

    }

    else if ($jenisba=='bast_2') {
        $ketpbjbast2=checkPostGet('ketpbjbast2','');
        $nobaspbast2=checkPostGet('nobaspbast2','');
        $tanggalbaspbast5=checkPostGet('tanggalbaspbast5','');
        $tanggalxbast5=explode('/', $tanggalbaspbast5);
        @$tanggalbaspbast5=$tanggalxbast5[2].$tanggalxbast5[0].$tanggalxbast5[1];

    }

     else if ($jenisba=='baepw') {
        $sebabbaepw=checkPostGet('sebabbaepw','');
        $tglevaluasibaepw=checkPostGet('tglevaluasibaepw','');
        $tglevaluasibaepwx=explode('/', $tglevaluasibaepw);
        @$tglevaluasibaepw=$tglevaluasibaepwx[2].$tglevaluasibaepwx[0].$tglevaluasibaepwx[1];
        $wktperpanjangbaepw=checkPostGet('wktperpanjangbaepw','');
        $mulaibaepw=checkPostGet('mulaibaepw','');
        $batasbaepw=checkPostGet('batasbaepw','');
        $batasbaepwx=explode('/', $batasbaepw);
        @$batasbaepw=$batasbaepwx[2].$batasbaepwx[0].$batasbaepwx[1];
        $tanggaljaminanbaepw=checkPostGet('batasbaepw','');
        $tanggaljaminanbaepwx=explode('/', $tanggaljaminanbaepw);
        @$tanggaljaminanbaepw=$tanggaljaminanbaepwx[2].$tanggaljaminanbaepwx[0].$tanggaljaminanbaepwx[1];
        $dendabaepw=checkPostGet('dendabaepw','');
        $urutbaepw=checkPostGet('urutbaepw','');
        

    }
    else if ($jenisba=='baetk') {
        $suratbaetk=checkPostGet('suratbaetk','');
        $resumebaetk=checkPostGet('resumebaetk','');
        $fcrbaetk=checkPostGet('fcrbaetk','');
        $perhitunganbaetk=checkPostGet('perhitunganbaetk','');
        $evaluasibaetk=checkPostGet('evaluasibaetk','');
        $ppnbaetk=checkPostGet('ppnbaetk','');
        $ppn2baetk=checkPostGet('ppn2baetk','');
        $urutbaetk=checkPostGet('urutbaetk','');        

    }
     else if ($jenisba=='bapjd') {
        $suratbapjd=checkPostGet('suratbapjd','');
        $resumebapjd=checkPostGet('resumebapjd','');
        $judulbapjd=checkPostGet('judulbapjd','');
       
    }

switch ($method) {
    case 'insert':



        if ($jenisba=='bastap') {

            $str="insert into ".$dbname.".input_ba_pln (no_kontrak,noba,jenis_ba,tanggal_ba,sifatba)
            values ('" . $nokontrak . "','" . $noba . "','" . $jenisba . "','" . $tanggal . "','" . $sifatba . "')";
        }

        else if ($jenisba=='bakp') {

            $str="insert into ".$dbname.".input_ba_pln (no_kontrak,noba,jenis_ba,tanggal_ba,sifatba,tanggallkp,persenbakp,refkontrakbakp)
            values ('" . $nokontrak . "','" . $noba . "','" . $jenisba . "','" . $tanggal . "','" . $sifatba . "','" . $tanggallkp . "','" . $persenbakp . "','" . $refkontrakbakp . "')";
        }

        else if ($jenisba=='bapp') {

            exit('warning : Jenis BAPP Bersifat Upload');
        }

        else if ($jenisba=='basp') {

            $str="insert into ".$dbname.".input_ba_pln (no_kontrak,noba,jenis_ba,tanggal_ba,sifatba,pasalbasp,tahapbasp,sampaibasp,nominalbasp,waktubasp,dendabasp,waktuterlambatbasp,persenbasp)
            values ('" . $nokontrak . "','" . $noba . "','" . $jenisba . "','" . $tanggal . "','" . $sifatba . "','" . $pasalbasp . "','" . $tahapbasp . "','" . $sampaibasp . "','" . $nominalbasp . "','" . $waktubasp . "','" . $dendabasp . "','" . $waktuterlambatbasp . "','" . $persenbasp . "')";
        }

         if ($jenisba=='bastb') {

             $str="insert into ".$dbname.".input_ba_pln (no_kontrak,noba,jenis_ba,tanggal_ba,sifatba,ketpbjbastb,nobaspbastb,tanggalbaspbastb)
           values ('" . $nokontrak . "','" . $noba . "','" . $jenisba . "','" . $tanggal . "','" . $sifatba . "','" . $ketpbjbastb . "','" . $nobaspbastb . "','" . $tanggalbaspbastb . "')";
        }

        else if ($jenisba=='bast') {
           $str="insert into ".$dbname.".input_ba_pln (no_kontrak,noba,jenis_ba,tanggal_ba,sifatba,ketpbjbast,nobaspbast,tanggalbaspbast)
           values ('" . $nokontrak . "','" . $noba . "','" . $jenisba . "','" . $tanggal . "','" . $sifatba . "','" . $ketpbjbast . "','" . $nobaspbast . "','" . $tanggalbaspbast . "')";

        }


        else if ($jenisba=='bak') {

           $str="insert into ".$dbname.".input_ba_pln (no_kontrak,noba,jenis_ba,tanggal_ba,sifatba,nobappbak,tanggalbappbak,terlambatbak,persenbak)
           values ('" . $nokontrak . "','" . $noba . "','" . $jenisba . "','" . $tanggal . "','" . $sifatba . "','" . $nobappbak . "','" . $tanggalbappbak . "','" . $terlambatbak . "','" . $persenbak . "')";

        }

        else if ($jenisba=='bap') {

           $str="insert into ".$dbname.".input_ba_pln (no_kontrak,noba,jenis_ba,tanggal_ba,sifatba,nobakpbap,nobappbap,nobakbap,persenbap,terminbap,persen2bap,nominalbap)
           values ('" . $nokontrak . "','" . $noba . "','" . $jenisba . "','" . $tanggal . "','" . $sifatba . "','" . $nobakpbap . "','" . $nobappbap . "','" . $nobakbap . "','" . $persenbap . "','" . $terminbap . "','" . $persen2bap . "','" . $nominalbap . "')";

        }

        else if ($jenisba=='basmp') {

             $str="insert into ".$dbname.".input_ba_pln (no_kontrak,noba,jenis_ba,tanggal_ba,sifatba,lamamasabasmp,pasalbasmp,tahapbasmp,terbayarbasmp)
           values ('" . $nokontrak . "','" . $noba . "','" . $jenisba . "','" . $tanggal . "','" . $sifatba . "','" . $lamamasabasmp . "','" . $pasalbasmp . "','" . $tahapbasmp . "','" . $terbayarbasmp . "')";

        }

        else if ($jenisba=='bast_2') {

             $str="insert into ".$dbname.".input_ba_pln (no_kontrak,noba,jenis_ba,tanggal_ba,sifatba,ketpbjbast2,nobaspbast2,tanggalbaspbast5)
           values ('" . $nokontrak . "','" . $noba . "','" . $jenisba . "','" . $tanggal . "','" . $sifatba . "','" . $ketpbjbast2 . "','" . $nobaspbast2 . "','" . $tanggalbaspbast5 . "')";
        }
        else if ($jenisba=='baepw') {

             $str="insert into ".$dbname.".input_ba_pln (no_kontrak,noba,jenis_ba,tanggal_ba,sifatba,sebabbaepw,tglevaluasibaepw,wktperpanjangbaepw,mulaibaepw,batasbaepw,tanggaljaminanbaepw,dendabaepw,urutbaepw)
           values ('" . $nokontrak . "','" . $noba . "','" . $jenisba . "','" . $tanggal . "','" . $sifatba . "','" . $sebabbaepw . "','" . $tglevaluasibaepw . "','" . $wktperpanjangbaepw . "','" . $mulaibaepw . "','" . $batasbaepw . "','" . $tanggaljaminanbaepw . "','" . $dendabaepw . "','" . $urutbaepw . "')";
        }

        else if ($jenisba=='baetk') {

             $str="insert into ".$dbname.".input_ba_pln (no_kontrak,noba,jenis_ba,tanggal_ba,sifatba,suratbaetk,resumebaetk,fcrbaetk,perhitunganbaetk,evaluasibaetk,ppnbaetk,ppn2baetk,urutbaetk)
           values ('" . $nokontrak . "','" . $noba . "','" . $jenisba . "','" . $tanggal . "','" . $sifatba . "','" . $suratbaetk . "','" . $resumebaetk . "','" . $fcrbaetk . "','" . $perhitunganbaetk . "','" . $evaluasibaetk . "','" . $ppnbaetk . "','" . $ppn2baetk . "','" . $urutbaetk . "')";
        }
        else if ($jenisba=='bapjd') {

             $str="insert into ".$dbname.".input_ba_pln (no_kontrak,noba,jenis_ba,tanggal_ba,sifatba,suratbapjd,resumebapjd,judulbapjd)
           values ('" . $nokontrak . "','" . $noba . "','" . $jenisba . "','" . $tanggal . "','" . $sifatba . "','" . $suratbapjd . "','" . $resumebapjd . "','" . $judulbapjd . "')";
        }

    
        
	    try{
	    	$owlPDO->exec($str); 
	    }catch(PDOException $e){
	    	echo " Gagal," . addslashes($e->getMessage());
	    }

        break;

        case'loadData':

            $str = "select * from " . $dbname . ".input_ba_pln group by no_kontrak";
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $sft= array('0' =>'Amandemen', '1' =>'Baru');
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $d['no_kontrak']. "</td>"; 
                $tab.="<td align=left>" .  $sft[$d['sifatba']]. "</td>"; 
                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"editheader('".$d['no_kontrak']."','".$d['sifatba']."');\"><i class='fas fa-pencil-alt'></i>Detail
                          </a>&nbsp;&nbsp;";
                 $tab.="<a style='color:white'; class='btn btn-danger btn-sm' onclick=\"hapusheader('".$d['no_kontrak']."','".$d['sifatba']."');\"><i class='fas fa-trash'></i>Delete</a></td>";

              
                      
                $tab.="</tr>"; 
 				 }
        
        echo $tab;
    break;


     case'update':

        if ($jenisba=='bakp') {

             $supdt="update ".$dbname.".input_ba_pln set tanggallkp='".$tanggallkp."',persenbakp='".$persenbakp."',refkontrakbakp='".$refkontrakbakp."' where no_kontrak = '".$nokontrak."' and noba='".$noba."' and jenis_ba='" . $jenisba . "' and sifatba='" . $sifatba . "'";
        }

        else if ($jenisba=='basp') {

            $supdt="update ".$dbname.".input_ba_pln set pasalbasp='".$pasalbasp."',tahapbasp='".$tahapbasp."',sampaibasp='".$sampaibasp."',nominalbasp='".$nominalbasp."',waktubasp='".$waktubasp."',dendabasp='".$dendabasp."',waktuterlambatbasp='".$waktuterlambatbasp."',persenbasp='".$persenbasp."' where no_kontrak = '".$nokontrak."' and noba='".$noba."' and jenis_ba='" . $jenisba . "' and sifatba='" . $sifatba . "'";
        }

        else if ($jenisba=='bast') {

             $supdt="update ".$dbname.".input_ba_pln set ketpbjbast='".$ketpbjbast."',nobaspbast='".$nobaspbast."',tanggalbaspbast='".$tanggalbaspbast."' where no_kontrak = '".$nokontrak."' and noba='".$noba."' and jenis_ba='" . $jenisba . "' and sifatba='" . $sifatba . "'";

        }

        else if ($jenisba=='bastb') {

             $supdt="update ".$dbname.".input_ba_pln set ketpbjbastb='".$ketpbjbastb."',nobaspbastb='".$nobaspbastb."',tanggalbaspbastb='".$tanggalbaspbastb."' where no_kontrak = '".$nokontrak."' and noba='".$noba."' and jenis_ba='" . $jenisba . "' and sifatba='" . $sifatba . "'";

        }


        else if ($jenisba=='bak') {

             $supdt="update ".$dbname.".input_ba_pln set nobappbak='".$nobappbak."',tanggalbappbak='".$tanggalbappbak."',terlambatbak='".$terlambatbak."',persenbak='".$persenbak."' where no_kontrak = '".$nokontrak."' and noba='".$noba."' and jenis_ba='" . $jenisba . "' and sifatba='" . $sifatba . "'";
        }

        else if ($jenisba=='bap') {

            $supdt="update ".$dbname.".input_ba_pln set nobakpbap='".$nobakpbap."',nobappbap='".$nobappbap."',nobakbap='".$nobakbap."',persenbap='".$persenbap."',terminbap='".$terminbap."',persen2bap='".$persen2bap."',nominalbap='".$nominalbap."' where no_kontrak = '".$nokontrak."' and noba='".$noba."' and jenis_ba='" . $jenisba . "' and sifatba='" . $sifatba . "'";
        }

        else if ($jenisba=='basmp') {

             $supdt="update ".$dbname.".input_ba_pln set lamamasabasmp='".$lamamasabasmp."',pasalbasmp='".$pasalbasmp."',tahapbasmp='".$tahapbasmp."',terbayarbasmp='".$terbayarbasmp."' where no_kontrak = '".$nokontrak."' and noba='".$noba."' and jenis_ba='" . $jenisba . "' and sifatba='" . $sifatba . "'";
        }

        else if ($jenisba=='bast_2') {

            $supdt="update ".$dbname.".input_ba_pln set ketpbjbast2='".$ketpbjbast2."',nobaspbast2='".$nobaspbast2."',tanggalbaspbast5='".$tanggalbaspbast5."' where no_kontrak = '".$nokontrak."' and noba='".$noba."' and jenis_ba='" . $jenisba . "' and sifatba='" . $sifatba . "'";

        }

        else if ($jenisba=='BAEPW') {

            $supdt="update ".$dbname.".input_ba_pln set sebabbaepw='".$sebabbaepw."',tglevaluasibaepw='".$tglevaluasibaepw."',wktperpanjangbaepw='".$wktperpanjangbaepw."',mulaibaepw='".$mulaibaepw."',batasbaepw='".$batasbaepw."',tanggaljaminanbaepw='".$tanggaljaminanbaepw."',dendabaepw='".$dendabaepw."',urutbaepw='".$urutbaepw."' where no_kontrak = '".$nokontrak."' and noba='".$noba."' and jenis_ba='" . $jenisba . "' and sifatba='" . $sifatba . "'";

        }

        else if ($jenisba=='BAETK') {

            $supdt="update ".$dbname.".input_ba_pln set suratbaetk='".$suratbaetk."',resumebaetk='".$resumebaetk."',fcrbaetk='".$fcrbaetk."',perhitunganbaetk='".$perhitunganbaetk."',evaluasibaetk='".$evaluasibaetk."',ppnbaetk='".$ppnbaetk."',ppn2baetk='".$ppn2baetk."',urutbaetk='".$urutbaetk."' where no_kontrak = '".$nokontrak."' and noba='".$noba."' and jenis_ba='" . $jenisba . "' and sifatba='" . $sifatba . "'";

        }

        else if ($jenisba=='BAPJD') {

            $supdt="update ".$dbname.".input_ba_pln set suratbapjd='".$suratbapjd."',resumebapjd='".$resumebapjd."',judulbapjd='".$judulbapjd."' where no_kontrak = '".$nokontrak."' and noba='".$noba."' and jenis_ba='" . $jenisba . "' and sifatba='" . $sifatba . "'";

        }
        
        try{
            $owlPDO->exec($supdt); 
        }catch(PDOException $e){
            echo " Gagal," . addslashes($e->getMessage());
        }
      
    break;


    case'deleteheader':
        $sIns="delete from ".$dbname.".input_ba_pln where no_kontrak = '".$nokontrak."'";
        try{
            $owlPDO->exec($sIns); 
        }
        catch (PDOException $e){
            echo"Gagal".$e->getMessage();
            die();
        }
    break;

    case'deletedetail':
    $sIns="delete from ".$dbname.".input_ba_pln where no_kontrak = '".$nokontrak."' and noba='".$noba."' and jenis_ba='".$jenisba."' and sifatba='".$sifatba."'";
    try{
        $owlPDO->exec($sIns); 
    }
    catch (PDOException $e){
        echo"Gagal".$e->getMessage();
        die();
    }
    break;


    case'loadDatadetail':
            $str = "select * from " . $dbname . ".input_ba_pln where no_kontrak='".$nokontrak."' and sifatba='".$sifatba."'";
            //exit('error'.$str);
            $n=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
            $n->setFetchMode(PDO::FETCH_ASSOC);
            while ($d = $n->fetch()) {
                $nmba = makeOption($dbname, 'mst_jnsba_pln', 'kode_ba,nama_ba');
                $no+=1;
                $tab.="<tr class=rowcontent>";
                $tab.="<td align=center>" . $no . "</td>";
                $tab.="<td align=left>" . $d['no_kontrak']. "</td>";          
                $tab.="<td align=left>" . $d['noba']. "</td>";          
                $tab.="<td align=left>" . $nmba[$d['jenis_ba']]. " (".strtoupper($d['jenis_ba']).")</td>";  

                $tab.="<td align=left><a style='color:white'; class='btn btn-info btn-sm' onclick=\"editdetail('".$d['no_kontrak']."','".$d['noba']."','".$d['jenis_ba']."','".$d['sifatba']."');\"><i class='fas fa-pencil-alt'></i>Edit
                          </a></td>";
                 $tab.="<td align=left><a style='color:white'; class='btn btn-danger btn-sm' onclick=\"hapusdetail('".$d['no_kontrak']."','".$d['noba']."','".$d['jenis_ba']."','".$d['sifatba']."');\"><i class='fas fa-trash'></i>Delete</a></td>";

                     
                $tab.="</tr>"; 
                 }
        
        echo $tab;
    break;


    

    case'getnoba':

        if ($nokontrak=='') {
            exit('Warning : Silahkan Pilih No Kontrak ');
        }

        if ($tanggal=='') {
            exit('Warning : Silahkan Pilih Tanggal ');
        }
        $str = "select max(noba) as jumlah from " . $dbname . ".input_ba_pln ";
        $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($bar = $res->fetch()) {
            $jumlah=substr($bar->jumlah,3,3);
            $jumlah=$jumlah+1;

            
        }

        $str = "select no_kontrak,jenis_kontrak,mst_upt,tanggal_kontrak from " . $dbname . ".input_kontrak_pln where no_kontrak='".$nokontrak."'";
        $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
        $res->setFetchMode(PDO::FETCH_OBJ);
        while ($bar = $res->fetch()) {
            $nokontrak=$bar->no_kontrak;
            $jnsnokontrak=$bar->jenis_kontrak;
            $upt=$bar->mst_upt;
            $tahun=substr($bar->tanggal_kontrak,0,4);
                
        }
        $nourut = str_pad($jumlah, 3, "0", STR_PAD_LEFT);


        $jnsktr = makeOption($dbname, 'mst_jenis_kontrak_pln', 'kode_kontrak,nama_kontrak');
        $nmupt = makeOption($dbname, 'mst_upt_pln', 'kode_upt,nama_upt');
        
        if ($jenisba=='bapjd') {
            $jenisba='bapjk';
        }
        echo strtoupper($nourut.'/'.substr($nokontrak,0,3).'.'.$jnsktr[$jnsnokontrak].'/'.$jenisba.'/UIT-JBTB/UPT'.$nmupt[$upt].'/'.substr($tanggal,0,4));


    break;

    case'getdata':
    $str = "select * from " . $dbname . ".input_ba_pln where no_kontrak = '".$nokontrak."' and noba='".$noba."' and sifatba='".$sifatba."'";

    $res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
    $res->setFetchMode(PDO::FETCH_OBJ);
    while ($bar = $res->fetch()) {

                $data=$bar->no_kontrak.'##'.$bar->tanggal_ba.'##'.$bar->jenis_ba.'##'.$bar->noba.'##';

                if ($jenisba=='bakp') {
                    $data.=$bar->tanggallkp.'##'.$bar->persenbakp.'##'.$bar->refkontrakbakp;
                }

                else if ($jenisba=='basp') {

                    $data.=$bar->pasalbasp.'##'.$bar->tahapbasp.'##'.$bar->sampaibasp.'##'.$bar->nominalbasp.'##'.$bar->waktubasp.'##'.$bar->dendabasp.'##'.$bar->waktuterlambatbasp.'##'.$bar->persenbasp;
                }

                else if ($jenisba=='bast') {
                    @$data.=$bar->ketpbjbast.'##'.$bar->nobaspbast.'##'.$bar->tanggalbaspbast.'##'.$bar->tanggalxbast;
                }

                else if ($jenisba=='bastb') {
                    @$data.=$bar->ketpbjbastb.'##'.$bar->nobaspbastb.'##'.$bar->tanggalbaspbastb.'##'.$bar->tanggalxbastb;
                }
                

                else if ($jenisba=='bak') {
                    $data.=$bar->nobappbak.'##'.$bar->tanggalbappbak.'##'.$bar->terlambatbak.'##'.$bar->persenbak;
                }

                else if ($jenisba=='bap') {
                     $data.=$bar->nobakpbap.'##'.$bar->nobappbap.'##'.$bar->nobakbap.'##'.$bar->persenbap.'##'.$bar->terminbap.'##'.$bar->persen2bap.'##'.$bar->nominalbap;
                }

                else if ($jenisba=='basmp') {
                     $data.=$bar->lamamasabasmp.'##'.$bar->pasalbasmp.'##'.$bar->tahapbasmp.'##'.$bar->terbayarbasmp;
                }

                else if ($jenisba=='bast_2') {
                     $data.=$bar->ketpbjbast2.'##'.$bar->nobaspbast2.'##'.$bar->tanggalbaspbast5;

                }
                else if ($jenisba=='baepw') {
                     $data.=$bar->sebabbaepw.'##'.$bar->tglevaluasibaepw.'##'.$bar->wktperpanjangbaepw.'##'.$bar->mulaibaepw.'##'.$bar->batasbaepw.'##'.$bar->tanggaljaminanbaepw.'##'.$bar->dendabaepw.'##'.$bar->urutbaepw;

                }
                else if ($jenisba=='baetk') {
                     $data.=$bar->suratbaetk.'##'.$bar->resumebaetk.'##'.$bar->fcrbaetk.'##'.$bar->perhitunganbaetk.'##'.$bar->evaluasibaetk.'##'.$bar->ppnbaetk.'##'.$bar->ppn2baetk.'##'.$bar->urutbaetk;

                }
                else if ($jenisba=='bapjd') {
                     $data.=$bar->suratbapjd.'##'.$bar->resumebapjd.'##'.$bar->judulbapjd;

                }

               // exit('error'.$data);

    }
    echo $data;
    break;
        default:

}
?>