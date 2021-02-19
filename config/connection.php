<?
$dbserver='localhost';
$dbport  ='3306';



/*$dbname  ='sthprd';
$uname	='owlApplication';
$passwd	='P455w0rd+B3r4t';*/


$dbname  ='jrss';
$uname	='root';
$passwd	='';
try {
  $owlPDO = new PDO('mysql:host='.$dbserver.';dbname='.$dbname, $uname, $passwd, array(PDO::ATTR_PERSISTENT => false));
  $owlPDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $e) {
       print " Gagal, could not connect\n";	
       print "Error!: " . $e->getMessage() . "<br/>";
   die();
}
@require_once('activity_log.php');
?>
