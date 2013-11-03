<?php
session_start();
if(isset($_SESSION["id"])and($_SESSION["id"]!=='')and($_SESSION["rights"]=='Moderator')){
echo "<html><head><meta http-equiv='Refresh' content='0; URL=/app/admin/unit1.php'></head></html>";
}else{
if(isset($_SESSION["id"])and($_SESSION["id"]!=='') and ($_SESSION["rights"]=='User')){
$id=$_SESSION["id_man"];
echo "<html><head><meta http-equiv='Refresh' content='0; URL=/app/user/unit1.php'></head></html>";
}else {exit;}
}
?>