<?php
function cekAkun($noakun){
$akunTanaman=array(	'126',
					'128',
					'611',
					'621');

$akun=  substr(str_replace(" ","",$noakun), 0,3);
$akuncip=  substr(str_replace(" ","",$noakun), 0,5);

$default=false;
foreach($akunTanaman as $val)
{
    if($akun==$val){
        $default=true;       
    }
	if(substr($akuncip,0,5)=='12803'){
		$default=false;     
	}	
}

return $default;
}

function cekAkunPiutang($noakun){
$akunPiutang=array('116');
$akun=  substr(str_replace(" ","",$noakun), 0,3);
$default=false;
if ($noakun=='1160101'){
    $default=false;
}else{
    foreach($akunPiutang as $val)
    {
        if($akun==$val){
            $default=true;       
        }
    }    
}

return $default;
}

function cekAkunHutang($noakun){
$akunHutang=array('211','212');
$akun=  substr(str_replace(" ","",$noakun), 0,3);
$default=false;
foreach($akunHutang as $val)
{

    if($akun==$val){
        $default=true;       
    }
}
return $default;
}
function cekAkunTrans($noakun){
$akunTrans=array('411');
$akun=  substr(str_replace(" ","",$noakun), 0,3);
$default=false;
foreach($akunTrans as $val)
{

    if($akun==$val){
        $default=true;       
    }
}
return $default;
}
?>
