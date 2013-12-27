<?php
session_start();
if(isset($_SESSION["id"])and($_SESSION["id"]!=='') and ($_SESSION["rights"]=='User')){
$id_man=$_SESSION["id_man"];
$id=$_SESSION["id"];
echo "<html><head><meta http-equiv='Refresh' content='0; URL=unit1.php'></head></html>";
exit;
}
?>