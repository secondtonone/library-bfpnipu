<?php
session_start();
if(isset($_SESSION["id"])and($_SESSION["id"]!=='')and($_SESSION["rights"]=='Moderator')){
$kodkaf=$_SESSION["id_kafedra"];
echo "<html><head><meta http-equiv='Refresh' content='0; URL=unit1.php'></head></html>";
exit;
}
?>