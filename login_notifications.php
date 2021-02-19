
<?
$men='';
$gen='';
$theme ='';
if($theme=='skyblue' || $theme==''){
  $men='menu.css';
  $gen='generic.css';
 }else if($theme=='red'){
  $men='menuRed.css';
  $gen='genericRed.css';
  }else{
  $men='menuGray.css';
  $gen='genericGray.css';
}
//exit;
require_once('config/connection.php');
@require_once('master_validation.php');
require_once('lib/nangkoelib.php');
require_once('lib/zLib.php');
echo  "<link rel=stylesheet type=text/css href='style/".$gen."'>";
echo  "<script language=JavaScript1.2 src=js/".$men."></script>";

$karyawanid = $_GET['karyawanid'];
$bahasanya = $_GET['bahasa'];
$jabatan = $_GET['jabatan'];
$lokasitugas = $_GET['lokasitugas'];

$tanggal = date('d-m-Y', time());
$hariini = date('Y-m-d', time());
$bulan = date('m', time());
$tahun = date('Y', time());

$updatetime=date('d M Y H:i:s', time());

//                $hariini = '2014-01-20';
//                $bulan = '01';
//                $tahun = '2014';

$dt = strtotime($hariini);
$kemarin = date('Y-m-d', $dt-172800);
$kemarin2 = date('d-m-Y', $dt-172800);

$jumlahnotif=0;
$modulenotif=array();
$modulenotifextras=array();
// load bahasa
$str=$owlPDO->query("SELECT * FROM ".$dbname.".bahasa WHERE 1");
$str->setFetchMode(PDO::FETCH_OBJ);
while($bar=$str->fetch())
{
    if($bahasanya=='ID')
    {
        $isiBahasa=$bar->ID;
    }
    else if ($bahasanya=='EN')
    {
         $isiBahasa=$bar->EN;
    }
    else if ($bahasanya=='MY')
    {
        $isiBahasa=$bar->MY;
    }
   // if($bahasanya=='ID')$bahasa[$bar->legend]=$bar->ID;
    $bahasa[$bar->legend]=$isiBahasa;
}
$jumlahnotif = 0;
$optnm = makeOption($dbname,'setup_jenisapproval','jenis,nama');
##Outstanding Approval
$str="select count(karyawanid) as jumlah, jenispersetujuan from ".$dbname.".approval 
where status='0' and karyawanid='".$_SESSION['standard']['userid']."' and notransaksi!='' group by jenispersetujuan order by jenispersetujuan";

$res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
$res->setFetchMode(PDO::FETCH_ASSOC);
while($bar=$res->fetch())
{
	$tipetransaksi=ucfirst(strtolower($optnm[$bar['jenispersetujuan']]));
	$dataApprove[$bar['jenispersetujuan']]['title'] = $tipetransaksi;
	$dataApprove[$bar['jenispersetujuan']]['note'] = $tipetransaksi;
	$dataApprove[$bar['jenispersetujuan']]['jumlah'] = $bar['jumlah'];
	$dataApprove[$bar['jenispersetujuan']]['file'] = 'log_approval';
	$m['jumlah']=$bar['jumlah'];
	
	if($bar['jenispersetujuan']=='PO'){
		$strpo="select * from ".$dbname.".approval where jenispersetujuan='PO' and karyawanid='".$_SESSION['standard']['userid']."' and status='0' group by notransaksi";
		$respo=fetchData($strpo);
		
		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
	}else if($bar['jenispersetujuan']=='HBT'){
		$strpo="select * from ".$dbname.".approval where jenispersetujuan='HBT' and karyawanid='".$_SESSION['standard']['userid']."' and status='0' group by notransaksi";
		$respo=fetchData($strpo);
		
		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
	}else if($bar['jenispersetujuan']=='BAPP'){
		$strpo="select a.notransaksi from ".$dbname.".approval a left join ".$dbname.".log_baspk b on a.notransaksi = b.nopengajuan where a.jenispersetujuan='BAPP' and a.status='0' and b.notransaksi!='null' and a.karyawanid='".$_SESSION['standard']['userid']."' group by b.nopengajuan";
		$respo=fetchData($strpo);
		
		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
	}else if($bar['jenispersetujuan']=='CB'){
		$strpo="select * from ".$dbname.".approval where jenispersetujuan='CB' and karyawanid='".$_SESSION['standard']['userid']."' and status='0' group by notransaksi";
		$respo=fetchData($strpo);
		
		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
	}else if($bar['jenispersetujuan']=='SCR'){
		$strpo="select * from ".$dbname.".approval where jenispersetujuan='SCR' and karyawanid='".$_SESSION['standard']['userid']."' and status='0' group by notransaksi";
		$respo=fetchData($strpo);
		
		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
	}else if($bar['jenispersetujuan']=='CPX'){
		$strpo="select * from ".$dbname.".approval where jenispersetujuan='CPX' and karyawanid='".$_SESSION['standard']['userid']."' and status='0' group by notransaksi";
		$respo=fetchData($strpo);
		
		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
	}else if($bar['jenispersetujuan']=='SPK'){
		$strpo="select * from ".$dbname.".approval where jenispersetujuan='SPK' and karyawanid='".$_SESSION['standard']['userid']."' and status='0' group by notransaksi";
		$respo=fetchData($strpo);
		
		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
	}else if($bar['jenispersetujuan']=='IJS'){
		$strpo="select * from ".$dbname.".approval where jenispersetujuan='IJS' and karyawanid='".$_SESSION['standard']['userid']."' and status='0' group by notransaksi";
		$respo=fetchData($strpo);
		
		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
		
	}else if($bar['jenispersetujuan']=='ANGGARAN'){
		$strpo="select * from ".$dbname.".approval where jenispersetujuan='ANGGARAN' and karyawanid='".$_SESSION['standard']['userid']."' and status='0' group by notransaksi";
		$respo=fetchData($strpo);
		
		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
		
	}else if($bar['jenispersetujuan']=='SERTIPIKAT'){
		$strpo="select * from ".$dbname.".approval where jenispersetujuan='SERTIPIKAT' and karyawanid='".$_SESSION['standard']['userid']."' and status='0' group by notransaksi";
		$respo=fetchData($strpo);
		
		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
		
	}else if($bar['jenispersetujuan']=='PERIZINAN'){
		$strpo="select * from ".$dbname.".approval where jenispersetujuan='PERIZINAN' and karyawanid='".$_SESSION['standard']['userid']."' and status='0' group by notransaksi";
		$respo=fetchData($strpo);
		
		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
		
	}else if($bar['jenispersetujuan']=='JM'){
		$strpo="select a.*, b.tanggal from ".$dbname.".approval a 
						left join ".$dbname.".keu_jurnalht b on a.notransaksi = b.nojurnal 
						where a.jenispersetujuan='".$proses."' and a.status='0' and karyawanid='".$_SESSION['standard']['userid']."' and b.revisi=0 order by b.tanggal desc";
		$respo=fetchData($strpo);

		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
	}else if($bar['jenispersetujuan']=='BOR'){
		$strpo="select * from ".$dbname.".approval where jenispersetujuan='BOR' and karyawanid='".$_SESSION['standard']['userid']."' and status='0' group by notransaksi";
		$respo=fetchData($strpo);
		
		$jumlahnotif += count($respo);
		$m['jumlah'] = count($respo);
		
	}
	else{
		$jumlahnotif += $bar['jumlah'];
	}
	$dataApprove[$bar['jenispersetujuan']]['jumlah'] = $m['jumlah'];
}

$str="select a.level,a.jenispersetujuan,b.nama from ".$dbname.".setup_approval a 
left join setup_jenisapproval b on a.jenispersetujuan = b.jenis 
where a.jenispersetujuan='PJDINAS' and a.tipe='1' and (a.tipekaryawan='".$_SESSION['empl']['tipekaryawan']."' or a.karyawanid='".$_SESSION['standard']['userid']."') group by a.jenispersetujuan";
$res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
$res->setFetchMode(PDO::FETCH_ASSOC);
while($bar=$res->fetch())
{
	//echo $bar['jenispersetujuan'];
	$tipetransaksi=ucfirst(strtolower($bar['nama']));
	if (empty($dataApprove[$bar['jenispersetujuan']]['jumlah'])){
	$dataApprove[$bar['jenispersetujuan']]['title'] = $tipetransaksi;
	$dataApprove[$bar['jenispersetujuan']]['note'] = $tipetransaksi;
	$dataApprove[$bar['jenispersetujuan']]['jumlah'] = 0;
	$dataApprove[$bar['jenispersetujuan']]['file'] = 'log_approval';
	}

	$level=$bar['level'];
		if ($level>1){

					$levelap=$level-1;
					$lstTrans=array();
					$strz="select karyawanid,notransaksi,level,count(notransaksi) as jmlhnotrans,status from ".$dbname.".approval where jenispersetujuan='".$bar['jenispersetujuan']."' and status='1' group by notransaksi having max(level)='".$levelap."' and count(notransaksi)='1'";
					//echo $str;
					$resz=$owlPDO->query($strz) or die(print " Gagal: ".PDOException::getMessage());
					$resz=fetchData($strz);
					
					$jumlah=count($resz);
				}
	$jumlahnotif += $jumlah;
	if($jumlah>0){
	$dataApprove[$bar['jenispersetujuan']]['jumlah'] += $jumlah;
	}
}
/*echo"<pre>";
print_r($dataApprove);
echo"</pre>";*/
$jumlahnotif=0;
if(!empty($dataApprove))foreach($dataApprove as $key => $mod){
	if($mod['jumlah']>0 and $mod['title']!=''){
		$jumlahnotif+=$mod['jumlah'];
	}
}
$qwe="You've got <font color=red><b>".number_format($jumlahnotif)."</b></font> Approval";

echo"<div style='background:#D7EBFA;padding:3px;'>".$qwe."</div>";

echo"<!--marquee height=150 onmouseout=\"this.setAttribute('scrollamount', 1, 0);\" onmouseover=\"this.setAttribute('scrollamount', 0, 0);\" scrolldelay=20 scrollamount=1 behavior=scroll direction=up-->
    <table class=sortable cellspacing=1 border=0 style='width:100%;'>
    <thead>
    <tr class=rowtitle>
        <td align=center style='width:180px;'>Module</td>
        <td align=center style='width:10px;'>#</td>
    </tr>  
    </thead>";

echo"<tbody>";

if(!empty($dataApprove))foreach($dataApprove as $key => $mod){
	if($mod['jumlah']>0 and $mod['title']!=''){
echo"<tr class=rowcontent onclick=\"javascript:parent.do_load('".$mod['file']."')\" title='".$mod['note']."' style='cursor:pointer;'>
        <td  align=left style='width:180px;'>".$mod['title']."</td>
        <td align=center style=''>".$mod['jumlah']."</td>
    </tr>";      }
}

echo"</tbody>
    </table>
    <!--* sumber data: OWL-->
    </marquee>";
	
	####NOTIFICATION PORTAL
	$str="select * from ".$dbname.".list_notification where kodenotification='PORTAL' and readnotif='0' and karyawanid='".$_SESSION['standard']['userid']."'";
	$res=fetchdata($str);
	$jlhnotif = count($res);
	$nonotif = 0;
	if($jlhnotif > 0){
		$headernotif = "You've got <font color=red><b>".number_format($jlhnotif)."</b></font> Notification";
		echo"<div style='background:#D7EBFA;padding:3px;margin-top:10px'>".$headernotif."</div>
		<table class=sortable cellspacing=1 border=0 style='width:100%;'>
			<tbody>";
			foreach($res as $val){
				$nonotif++;
				echo"<tr class=rowcontent onclick=\"javascript:parent.open_notif('log_5dataSupplier','".$val['kodetransaksi']."')\" title='".$val['detail']."' style='cursor:pointer;'>
					<td align=center style='vertical-align:top'>".$nonotif."</td>
					<td  align=left style='width:180px;vertical-align:top'>".$val['detail']."</td>
				</tr>";
			}
		echo"</tbody>
		</table>";
	}
?>