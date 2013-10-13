<?php
/*
*Конец регистрации активация аккаунта
*/
require_once '../../scripts/connect.php';
require_once 'model/regclass.php';
require_once 'model/queryclass.php';
/*
* Инициализация классов
*/
$RegClass=new RegClass();
$QueryClass=new QueryClass();
/*
* Проверка значений формы на вредоносный код
*/
if (isset($_GET["id"]) and isset($_GET["code"])){
	
$id=$RegClass->check_id($_GET["id"]);
if ($id==false) { exit;}
$code=$RegClass->check_code($_GET["code"]);
if ($code==false) { exit;}
/*
* Вытаскиваем все данные по пользователю с id равным переменной $id
*/
$query='SELECT * FROM users WHERE id=?';
$activision=$QueryClass->check_repeat($query,$id,$dbh);
if (empty($activision)) { 
echo "<html><head><meta http-equiv='Refresh' content='0; URL=view/view_end.php?value=4'></head></html>";
}
/*
* Генерируем код для сравнения с кодом из письма
*/
$activision=md5($activision["id"]).md5($activision["name"]);
/*
* Если наш код равен коду из письма, то активируем аккаунт
*/
if($activision==$code){
/*
* Активируем аккаунт
*/
$updatequery='UPDATE users SET active=? WHERE id=?';
$update=$QueryClass->update_inf($updatequery,$id,$dbh);
/*
* Если активация прошла успешно, то выводим сообщение о успешной активации
*/
if(!empty($update)){
echo "<html><head><meta http-equiv='Refresh' content='0; URL=view/view_end.php?value=1'></head></html>";
}else{
echo "<html><head><meta http-equiv='Refresh' content='0; URL=view/view_end.php?value=2'></head></html>";	
}
}else{
echo "<html><head><meta http-equiv='Refresh' content='0; URL=view/view_end.php?value=3'></head></html>";
}}else{
echo "<html><head><meta http-equiv='Refresh' content='0; URL=../../../index.php'></head></html>";
}
?>