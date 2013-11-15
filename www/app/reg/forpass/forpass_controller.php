<?php
/*
* Подключаемся к базе
*/
require_once '../../scripts/connect.php';
require_once '../reg/model/regclass.php';
require_once '../reg/model/queryclass.php';
require_once '../reg/model/mailclass.php';
/*
* Получение значений из полей формы
*/
$login=$_POST["login"];
$email=$_POST["email"];
$path=__DIR__;
/*
* Инициализация классов
*/
$RegClass=new RegClass();
$QueryClass=new QueryClass();
$objMail = new Lib_Sent();
/*
* Проверка значений формы на вредоносный код
*/
$login=$RegClass->check_name($login);
if ($login==false) { exit;}
$email=$RegClass->check_email($email);
if ($email==false) { exit;}
/*
* Вытаскиваем всё из базы о пользователе с указанным именем 
*/
$query='SELECT * FROM `users` WHERE name=?';
$result=$QueryClass->check_repeat($query,$login,$dbh);
$id=$result["id"];
$idman=$result["id_man"];
/*
* Если пользователь с такими данными есть, то отправляем письмо
*/
if(!empty($id) AND $email==$result["email"]){
    /*
    * Создаём код, для подтверждения восстановления пароля
    */
	$query='SELECT * FROM users WHERE id=?';
	$activation=$QueryClass->active_code($query,$id,$dbh);
	/*
	* Отправка письма
	*/
	$objMail->to = array($email);
	$objMail->from = 'Электронная библиотека БФ ПНИПУ';
	$objMail->subject = 'Восстановление пароля на сайте';
	$objMail->body = 'Ваш логин- '.$login.'
Ваш email - '.$email.'
Для создания нового пароля для Вашего аккаунта перейдите по этой ссылке: '.$path.'/newpass.php?id='.$id.'&&code='.$activation.'';
	$objMail->send();
    /*
    * Отправляем письмо
    */
     echo "На ваш email было выслано письмо с ссылкой на создание нового пароля!";
}else{
    echo "Не верно введены email или имя пользователя";
}
?>