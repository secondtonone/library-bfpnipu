<?php
/*
* Стартуем сессию
* Скрипт для входа админа 
*/
session_start();
/*
* Подключаемся к базе
*/
require_once '../../scripts/connect.php';
require_once '../reg/model/regclass.php';
require_once '../reg/model/queryclass.php';
/*
* Обрабатываем переданное имя
*/
$login=$_POST["login"];
$password=$_POST["pass"];

$RegClass=new RegClass();
$QueryClass=new QueryClass();


$login=$RegClass->check_name($login);
if ($login==false) { exit;}
$password=$RegClass->check_pass($password,$password);
if ($password==false) { exit;}

$query='SELECT * FROM `users` WHERE name=?';
$result=$QueryClass->check_repeat($query,$login,$dbh);

if(!empty($result["id"])){
	
if($result["active"]!=='1'){
	
exit("Вы не активировали учетную запись!");
}

if($result["pass"]==$password){
	
$_SESSION["id"]=$result["id"];
$_SESSION["name"]=$result["name"];
$_SESSION["id_man"]=$result["id_man"];
$_SESSION["rights"]=$result["rights"];
$_SESSION["email"]=$result["email"];

$query='SELECT `fam`,`name`,`otchestvo`,`telefon_dom`,`telefon_sot`,`e_mail`,`telefon_rabochii` FROM `people` WHERE id_man=?';
$result=$QueryClass->check_repeat($query,$_SESSION["id_man"],$dbh);

$_SESSION["telefon_dom"]=$result["telefon_dom"];
$_SESSION["telefon_sot"]=$result["telefon_sot"];
$_SESSION["telefon_rabochii"]=$result["telefon_rabochii"];
$_SESSION["e_mail"]=$result["e_mail"];
$_SESSION["fam"]=$result["fam"];
$_SESSION["realname"]=$result["name"];
$_SESSION["otchestvo"]=$result["otchestvo"];

$query='SELECT COUNT(`id_vid`) AS count FROM `vidacha` WHERE id_man=? and na_rukah="Yes"';
$result=$QueryClass->check_repeat($query,$_SESSION["id_man"],$dbh);

$_SESSION["count"]=$result["count"];

echo "user";
}else{
exit("Вы ввели не верный пароль!");
}
}else{
exit("Вы ввели не верные данные!");
}

?>