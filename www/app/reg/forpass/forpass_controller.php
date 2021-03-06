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
$path='librarybfpnipu.besaba.com';
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
	$objMail->from = 'Электронная библиотека кафедр БФ ПНИПУ<librarybfpnipu@yandex.ru>';
	$objMail->subject = 'Восстановление пароля на сайте';
	$objMail->body = '<html>
<body>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head> 
</body>
<p><b>Информация об аккаунте:</b></p> 
<p>Ваш логин - '.$login.'</p> 
<p>Ваш email - '.$email.'</p> 
<p><b>Для создания нового пароля для Вашего аккаунта перейдите по этой ссылке:</b><a href="http://www.'.$path.'/app/reg/forpass/newpass.php?id='.$id.'&&code='.$activation.'">http://www. '.$path.'/app/reg/forpass/newpass.php?id='.$id.'&&code='.$activation.'</p>
</body>
</html>';
	$objMail->send();
    /*
    * Отправляем письмо
    */
     echo "На ваш email было выслано письмо с ссылкой на создание нового пароля!";
}else{
    echo "Не верно введены email или имя пользователя";
}
?>