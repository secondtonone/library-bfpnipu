<?php
/*
* Подключаемся к базе
*/
require_once '../scripts/connect.php';
require_once '../reg/reg/model/mailclass.php';

$date = date("Y-m-d H:i:s");
$objMail = new Lib_Sent();

$query = $dbh->prepare('SELECT `id_mail`,`mail`,`titles` FROM `mail` WHERE `mark`=? LIMIT 0,1');
$query->execute(array("Неотправлено"));
$result  = $query -> fetch();

if (!empty($result)){
$objMail->to = array($result['mail']);
$objMail->from = 'Электронная библиотека кафедр БФ ПНИПУ<librarybfpnipu@yandex.ru>';
$objMail->subject = 'Уведомление о задолжности';
$objMail->body = '<html>
<body>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head> 
</body>
<p>Просрочен срок возврата по следующим изданиям:<b>'.$result['titles'].'</b> верните в ближайшее время!</p> 
</body>
</html>';
$objMail->send();
$res = $dbh->prepare('UPDATE `mail` SET `mark`=?,`date_change`=? WHERE `id_mail`=?');
$res->execute(array("Отправлено",$date,$result['id_mail']));
}
else
{
exit;
}
?>