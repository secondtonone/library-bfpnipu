<?php
/*
* Смена пароля студента
*/
require_once '../../scripts/connect.php';
require_once '../reg/model/regclass.php';
require_once '../reg/model/queryclass.php';
require_once '../reg/model/mailclass.php';
 
if(isset($_POST["hideid"]) and isset($_POST["code"])){

$newpass=$_POST["newpass"];
$rnewpass=$_POST["rnewpass"];
$id=$_POST["hideid"];
$code=$_POST["code"];

$RegClass=new RegClass();
$QueryClass=new QueryClass();
$objMail = new Lib_Sent();
 
$id=$RegClass->check_id($id);
if ($id==false) { exit;}
$newpass=$RegClass->check_pass($newpass,$rnewpass);
if ($newpass==false) { exit;}
$code=$RegClass->check_code($code);
if ($code==false) { exit;}

$query='SELECT * FROM `users` WHERE id=?';
$result=$QueryClass->check_repeat($query,$id,$dbh);
$activision=$QueryClass->active_code($query,$id,$dbh);

if($result["id"]!=='' and $activision==$code){

$query='UPDATE `users` SET pass=? WHERE id=?';
$update=$QueryClass->update_pass($query,$newpass,$id,$dbh);
		
if($update["pass"]==$newpass){
	
$email=$result["email"];

$objMail->to = array($email);
$objMail->from = 'Электронная библиотека кафедр БФ ПНИПУ<librarybfpnipu@yandex.ru>';
$objMail->subject = 'Новые данные вашего аккаунта';
$objMail->body = '<p>По вашему запросу у вашего аккаунта был создан новый пароль.</p>
<p><b>Данные вашего аккаунта:</b></p> 
<p>Имя - '.$result["name"].'</p>
<p>Пароль - '.$rnewpass.'</p>
<p>E-mail - '.$email.'</p>';
$objMail->send();

echo "Вам на email было отправлено письмо с данными вашего аккаунта, в том числе и новый пароль.";
}else{
exit("Добавить новый пароль не удалось. Заново перейдите по ссылке.");
}
}else{
exit("Вы перешли на страницу с не верными параметрами. Заново перейдите по ссылке.");
}
}else{
echo "<html><head><meta http-equiv='Refresh' content='0; URL=../reg/view/view_end.php?value='></head></html>";}
?>