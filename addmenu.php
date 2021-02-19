<?
#require_once('lib/nangkoelib.php');
require_once ('config/connection.php');
?>

<?

$arrmenubaru = array('1906',	'1907',	'1908',	'1909',	'1910',	'1911',	'1912',	'1913',	'1914');

$str="select * from ".$dbname.".auth where menuid='269'";  
$res=$owlPDO->query($str) or die(print " Gagal: ".PDOException::getMessage());
$res->setFetchMode(PDO::FETCH_ASSOC);
while($bar=$res->fetch()){	
	foreach($arrmenubaru as $baru){
		$ins="INSERT INTO `auth` (`namauser`, `menuid`, `status`, `lastuser`, `detail`) 
			  VALUES ('".$bar['namauser']."','".$baru."','1','','0')";
		try{$owlPDO->exec($ins);}catch(PDOException $e){echo " Gagal," . addslashes($e->getMessage());}
		echo 	$bar['namauser']."=>".$baru."<br>";
	}
} 


?>