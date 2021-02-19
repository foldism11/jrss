<?
session_start();
require_once('config/connection.php');
require_once('lib/detailSession.php');
require_once('lib/nangkoelib.php');
 $strj=$owlPDO->query("select * from ".$dbname.".tipeakses where status=1");
 $count = owlBaris($strj);
 if($count>0)
 {
	$_SESSION['security']='on';
 }
 else
 {
	$_SESSION['security']='off'; 	
 }

/*if($_POST['theme']!='' && is_dir('images/'.$_POST['theme'])){
	$_SESSION['theme']=$_POST['theme'];
}*/
//load local ini++++++++++++++++++++++++++++++++
$ini_array = parse_ini_file("lib/nangkoel.ini");
$_SESSION['MAXLIFETIME']=$ini_array['MAXLIFETIME'];
$_SESSION['DIE']=time()+$_SESSION['MAXLIFETIME'];
//++++++++++++++++++++++++++++++++++

   if(isset($_SERVER["REMOTE_ADDR"]) ) {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    else if(isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ) {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    else if(isset($_SERVER["HTTP_CLIENT_IP"]) ) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } 
   
$hostname = gethostbyaddr($ip);

try{
    $uname   =addslashes($_POST['uname']);
    $password=addslashes($_POST['password']);
    $language=$_POST['language'];
    $str1    =$owlPDO->query("select * from ".$dbname.".user   where namauser='".$uname."'  and password='".$password."'");
    $str1->setFetchMode(PDO::FETCH_OBJ);
    $uid=0;
    $count = owlBaris($str1);
	if($count>0)
	{
		
 
		//set standard session
		while($bar1=$str1->fetch())
		{
			$_SESSION['standard']['username']=$bar1->namauser;
			$_SESSION['standard']['access_level']=$bar1->hak;
			$_SESSION['standard']['lastupdate']=$bar1->lastupdate;			
			$_SESSION['standard']['userid']=$bar1->karyawanid;
			$_SESSION['standard']['status']=$bar1->status;
			$_SESSION['standard']['logged']=$bar1->logged;
			$_SESSION['standard']['lastip']=$bar1->lastip;
			$_SESSION['standard']['lastcomp']=$bar1->lastcomp;
			$_SESSION['standard']['tipex']=$bar1->hak;
			$_SESSION['standard']['tipeuser']=$bar1->tipe;
			$_SESSION['standard']['new']=$bar1->new;
			$_SESSION['standard']['mail']=$bar1->email;
			$_SESSION['standard']['cabang']=$bar1->kodeorg;
		}

		if($_SESSION['standard']['status']==0)//if user status is inactive
		{
			 $stream.=" Gagal, Your Account is inactive";
			 session_destroy();
			 exit;
		}
		//set language session
		/*$_SESSION['language']=$language;
		$strlang=$owlPDO->query("select legend,".$language." from ".$dbname.".bahasa order by legend");
		$strlang->setFetchMode(PDO::FETCH_NUM);
		while($barlang=$strlang->fetch())
		{
			$_SESSION['lang'][$barlang[0]]=$barlang[1];
		}*/
		//set other sessio and  variables
		if(isset($_SESSION['standard']['username']))
		{
			//get all data from user_empl table
			setEmplSession($owlPDO,$_SESSION['standard']['userid'],$dbname);

			if($isPrivillaged=getPrivillageType($owlPDO,$dbname))//get access_type, if nothong then kick
			{}
			else
			{
				 if($_SESSION['security']=='on')//if turned on
				 {
					 $stream.=" Gagal, Sorry, No Privillage available for all\ncontact Administrator";
					 session_destroy();
					 exit;
				 }
				 else
				 {
				 	
				 }
			}
			
			/*$privable=getPrivillages($owlPDO,$_SESSION['standard']['username'],$dbname);//get user privillages
			if(!$privable AND $_SESSION['access_type']=='detail')// if nothong then kick
			{
				 echo" Gagal, Sorry, No Privillage available for your account";
				 session_destroy();
				 exit;				
			}		*/
			/*else if($_SESSION['standard']['access_level']==0 AND $_SESSION['access_type']!='detail')
			{
				 if($_SESSION['security']=='on'){//if security is turned on
				 echo" Gagal, Sorry, System uses Levelization Privillages, but you don't have any.\nContact your Administrator";
				 session_destroy();
				 exit;
				 }
				 else
				 {
				 	//if turned off, grant all privillages
				 }
			}*/
				
			setEmployer($owlPDO,$dbname);//get employer detail and active transaction periode
		}
	}
	else
	{
		$stream.= "<font color=#AA3322 style='background-color:#FFFFFF'>Wrong username and/or password</font><br><span   style='background-color:#FFFFFF'>Att: This uses case-sensitif</span>";
	}

	echo $stream.'##'.$_SESSION['standard']['tipex'].'##'.$_SESSION['standard']['new'];
	
}
catch (PDOException $e) {
       $stream.= " Gagal, System meet some difficulties to preform your request.\n
	        Please contact administrator regarding your login problem";	
       print "Error!: " . $e->getMessage() . "<br/>";
       echo $stream;
   die();
}
?>