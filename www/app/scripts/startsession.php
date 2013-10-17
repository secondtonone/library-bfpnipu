<?php
session_start();
if(isset($_SESSION["id"])and($_SESSION["id"]!=='')and($_SESSION["rights"]=='Moderator')){
$kodkaf=$_SESSION["id_kafedra"];	
}else{
if(isset($_SESSION["id"])and($_SESSION["id"]!=='') and ($_SESSION["rights"]=='User')){
$id=$_SESSION["id_man"];
}
else{
echo "<html><head><meta http-equiv='Refresh' content='0; URL=../../index.php'></head></html>";
}}
?>