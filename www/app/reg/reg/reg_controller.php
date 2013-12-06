<?php
/*
* Подключиние скриптов для обработки формы регистрации
*/
require_once '../../scripts/connect.php';
require_once 'model/regclass.php';
require_once 'model/mailclass.php';
require_once 'model/queryclass.php';
/*
* Получение значений из полей формы
*/
$login=$_POST["login"];
$password=$_POST["pass"];
$pass2=$_POST["pass2"];
$email=$_POST["email"];
$fam=$_POST["fam"];
$number_zach=$_POST["number_zach"];
$path=$_SERVER['SERVER_NAME'];
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
$pass=$RegClass->check_pass($password,$pass2);
if ($pass==false) { exit;}
$email=$RegClass->check_email($email);
if ($email==false) { exit;}
$fam=$RegClass->check_sur($fam);
if ($fam==false) { exit;}
$number_zach=$RegClass->check_num($number_zach);
if ($number_zach==false) { exit;}
/*
* Проверка значений формы по БД на совпадение
*/
$query='SELECT `name` FROM `users` WHERE name=?';
$result=$QueryClass->check_login($query,$login,$dbh);
if (!empty($result)) { exit;}
$query='SELECT `email` FROM `users` WHERE email=?';
$result=$QueryClass->check_email($query,$email,$dbh);
if (!empty($result)) { exit;}
$query='SELECT s.id_man FROM `people` p INNER JOIN `student` s ON p.id_man = s.id_man AND p.fam=? AND s.number_zach=?';
$idman=$QueryClass->check_hit($query,$fam,$number_zach,$dbh);
if (empty($idman)) { exit;}
$query='SELECT `id_man` FROM `users` WHERE id_man=?';
$result=$QueryClass->check_user($query,$idman,$dbh);
if (!empty($result)) { exit;}
/*
* Запись значений в БД 
*/
$queryinsert='INSERT INTO `users` (name, pass, email, rights, id_man) VALUES (?,?,?,?,?)';
$adduser=$QueryClass->insert_inf($query,$queryinsert,$login,$pass,$email,$idman,$dbh);
/*
* Отправка письма с кодом подтверждения
*/
if(!empty($adduser)){
/*
* Генерация кода
*/
$query='SELECT * FROM `users` WHERE id_man=?';
$activation=$QueryClass->active_code($query,$idman,$dbh);
$array=$QueryClass->check_repeat($query,$idman,$dbh);
/*
* Отправка письма
*/
$objMail->to = array($email);
$objMail->from = 'Электронная библиотека БФ ПНИПУ';
$objMail->subject = 'Подтверждение регистрации на сайте';
$objMail->body = 'Спасибо за регистрацию
Для продолжения перейдите по ссылке: '.$path.'/app/reg/reg/reg_end.php?id='.$array["id"].'&&code='.$activation.'
Информация об аккаунте: 
Логин - '.$array["name"].'
Пароль-'.$password.'
Почта-'.$array["email"].'';
$objMail->send();
/*
* Конец регистрации
*/
echo "Спасибо за регистрацию! Ваш аккаунт был успешно создан! Вам на email было выслано письмо с инструкциями для завершения регистрации!";
}else{
exit ("Ваш аккаунт создать не удалось");
}
?>
