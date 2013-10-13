<?php
/*
* Подключаемся к базе
*смена маила и пароля
*/
include_once 'soed.php';

if(isset($_POST["email"])and($_POST["email"]!=='')){
$email=$_POST["email"];
$email=trim($email);
$email=htmlspecialchars($email);
$email=stripslashes($email);
if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $email)){
die("E-mail введён не корректно");
}
}else{
die("Вы не ввели email");
}
$pass=$_POST["pass"];
$pass=trim($pass);
$pass=htmlspecialchars($pass);
$pass=stripslashes($pass);
$pass=md5($pass);

 $query1 = "UPDATE `users` SET `email`='$email',`pass`='$pass'";  
  mysql_query($query1) or die(mysql_error());
  mysql_close();
  echo ("<div style=\"text-align: center; margin-top: 10px;\">
<font color=\"navy\">Данные успешно сохранены!</font>");
echo "<html><head><meta http-equiv='Refresh' content='0; URL=index.php'></head></html>";