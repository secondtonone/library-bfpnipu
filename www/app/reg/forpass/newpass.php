<?php
/*
* Подключаемся к базе
* Смена пароля студента
*/
require_once '../../scripts/connect.php';
require_once '../reg/model/regclass.php';
require_once '../reg/model/queryclass.php';

$RegClass=new RegClass();
$QueryClass=new QueryClass();

if (isset($_GET["id"]) and isset($_GET["code"])){
$id=$RegClass->check_id($_GET["id"]);
if ($id==false) { exit;}
$code=$RegClass->check_code($_GET["code"]);
if ($code==false) { exit;}

$query='SELECT * FROM users WHERE id=?';
$activision=$QueryClass->active_code($query,$id,$dbh);

if($activision==$code){
   echo "<html><head><meta http-equiv='Refresh' content='0; URL=new_pass_form.php?id=".$id."&&code".$code."'></head></html>";
}else{
    echo "<html><head><meta http-equiv='Refresh' content='0; URL=../reg/view/view_end.php?value=4'></head></html>";
}}else{
 echo "<html><head><meta http-equiv='Refresh' content='0; URL=../reg/view/view_end.php?value='></head></html>";
 }
?>