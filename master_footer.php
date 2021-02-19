<?
include_once('lib/nangkoelib.php');
include_once('lib/zLib.php');
include_once('lib/rTable.php');
include_once('lib/zFunction.php');

$karyawanid = $_SESSION['standard']['userid'];
$bagian = $_SESSION['empl']['bagian'];
$kodejabatan = $_SESSION['empl']['kodejabatan'];
$tipekaryawan = $_SESSION['empl']['tipekaryawan'];
@$str="select count(id) as count from ".$dbname.".list_notification a 
	left join ".$dbname.".setup_notification_ht b on a.kodenotification = b.kodejenis 
	where (a.karyawanid='".$karyawanid."' or a.kodedepartement='".$bagian."' or a.kodetipekaryawan='".$tipekaryawan."' or a.kodejabatan='".$kodejabatan."') and shownotif='0' and readnotif='0' order by a.tanggal desc";
$res=fetchdata($str);
$countnotif = $res[0]['count'];

@$str="select a.id,b.namajenis, a.detail, a.readnotif from ".$dbname.".list_notification a 
	left join ".$dbname.".setup_notification_ht b on a.kodenotification = b.kodejenis 
	where (a.karyawanid='".$karyawanid."' or a.kodedepartement='".$bagian."' or a.kodetipekaryawan='".$tipekaryawan."' or a.kodejabatan='".$kodejabatan."') and shownotif='0' order by a.tanggal desc limit 10";
$res=fetchdata($str);
$countnotif2 = count($res);
$tab='';
if($countnotif2 <= 0){
	@$tab.="<label style='color:grey'>No Notifications</label>";
}else{
	$no=0;
	foreach($res as $key=>$val){
		$no++;
		if($val['readnotif']=='0'){
			$tagntf = "tagntf";
			$image = "unread.png";
			$title = "Mark as Read";
			$onclick = "markasread('".$val['id']."')";
		}else{
			$tagntf = "tagntfoff";
			$image = "read.png";
			$title = "Mark as Unread";
			$onclick = "markasunread('".$val['id']."')";
		}
		$tab.="<table id='tablenotif_".$val['id']."' width='100%' class='".$tagntf."'>
			<tr>
				<td><label style='color:#365899;font-weight:bold;'>".$val['namajenis']."</label></td>
				<td rowspan=2 style='vertical-align:bottom'><img id='imgnotif_".$val['id']."' style='cursor:pointer' src='images/".$image."' width='20px' title='".$title."' onclick=\"".$onclick."\"></td>
			</tr>
			<tr>
				<td><label style='color:grey;font-style:italic;'>".$val['detail']."</label></td>
			</tr>
		</table>";
		
		if($countnotif2==$no){}else{
			$tab.="<hr>";
		}
	}
	
	if($countnotif > 10){
		$tab.="<div id='divshowmore_1'></div><div id='divmore'><hr>";
		$tab.="<input type='hidden' id='xnotif' value='1'><span style='text-align:center;'><div class='tagntfmore' onclick='showmorenotif()'>
			show more
		</div></span></div>";
	}	
}

$lbl = "<label class='badge1' data-badge='".$countnotif."'></label>";
?>
<style>

.badge1 {
   position:relative;
}
.badge1[data-badge]:after {
   content:attr(data-badge);
   position:absolute;
   top:-5px;
   right:-15px;
   font-size:.7em;
   background:#EC002B;
   color:white;
   width:18px;height:18px;
   text-align:center;
   line-height:18px;
   border-radius:50%;
   box-shadow:0 0 1px #333;
}
</style>

<div style='border-top:#9D9D9D solid 1px; width:100%;background-color:#EFEFEF;color:#ADADAD;text-align:center;position:fixed;bottom:0px'>
<table border=0 cellspacing=1 width=100% class=tableWrSystem>
<tr>
<td align=left id=warningContainer width=33% class=WrContainer onclick=displayMiniWin()></td>		
<td align=center>&copy OWL System</td>
<td id=chatContainer width=33% class=ChContainer onclick="chatPop()" style='user-select: none;-moz-user-select: none;'>Reminder System&nbsp;&nbsp;<label id='lblnotification'><?php echo $lbl; ?></label></td>
</tr>
</table>
</div>
<div id=chatWindow class=chat-window style='display: none'>
	<div class='title'>
		Reminder System<span id='chatWindowTitle'></span>
	</div>
	<div>
		<!--<input id='chatWindowSearch' class='search-box'>-->
		<!--<div id='chatWindowContact' style='margin-bottom:250px'>-->
			<div id="chatWindowContact" style="height:295px;position:relative;">
				<div id="div2" style="max-height:100%;overflow:auto;">
					<div id="div3" style='padding:5px;'><?php echo $tab ?></div>
				</div>
			</div>
		<!--</div>-->
	</div>
</div>