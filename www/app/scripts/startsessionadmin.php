<?php
session_start();
if(isset($_SESSION["id"]) && ($_SESSION["id"]!=='') && ($_SESSION["rights"]=='Moderator')){
$kodkaf=$_SESSION["id_kafedra"];
}else{
echo "<html><head><meta http-equiv='Refresh' content='0; URL=../../index.php'></head></html>";
exit;
}
?>