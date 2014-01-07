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


$query='SELECT * FROM `admin` WHERE name=?';
$result=$QueryClass->check_repeat($query,$login,$dbh);
/*
* Если такой пользователь есть, то проверяем пароли
*/
if(!empty($result["id"])){
	
if($result["pass"]==$password){
	
$_SESSION["id"]=$result["id"];
$_SESSION["name"]=$result["name"];
$_SESSION["id_kafedra"]=$result["id_kafedra"];
$_SESSION["rights"]=$result["rights"];

echo "admin";
}else{
exit("Вы ввели не верный пароль");
}
}else{
exit("Вы ввели не верные данные!");
}

?>