<?
require_once('config/connection.php');
?>

<div id='progress' style='display:none;border:orange solid 1px;width:150px;position:fixed;right:20px;top:65px;color:#ff0000;font-family:Tahoma;font-size:13px;font-weight:bolder;text-align:center;background-color:#FFFFFF;z-index:10000;'>
  Please wait.....! <br>
  <img src='images/progress.gif'>
</div>


<?if(MD5($_SESSION['org']['holding'])!='30e7dd5164c40a3ad4dec8b74953aba5'){session_destroy();exit();}?>                                