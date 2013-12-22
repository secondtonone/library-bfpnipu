<?php
/*
* Подключаемся к базе
*/
require_once '../scripts/connect.php';

$titles='';

$query = $dbh->query('TRUNCATE TABLE `mail`');

$query = $dbh->prepare('SELECT `id_man`,`email` FROM `users`');
$query->execute();

while($row = $query->fetch(PDO::FETCH_ASSOC)) 
     {
	$res = $dbh->prepare('SELECT `name_book` FROM `book` as b INNER JOIN `vidacha` as v  ON v.`id_book`=b.`id_book` INNER JOIN `users` as u ON v.`id_man`=u.`id_man` WHERE `na_rukah`=? AND ((YEAR(CURDATE())-YEAR(data_vidachi)>=1) OR (MONTH(data_vidachi)<=11 AND YEAR(CURDATE())-YEAR(`data_vidachi`)=1 AND MONTH(CURDATE())>5) OR (YEAR(CURDATE())-YEAR(data_vidachi)=0 AND MONTH(CURDATE())>6 AND MONTH(`data_vidachi`)<=5)) AND v.id_man=?');
	$res->execute(array("Yes",$row["id_man"]));
	 
	 while($rs = $res->fetch(PDO::FETCH_ASSOC)) 
	 {
	$titles=$titles.'"'.$rs['name_book'].'", ';
     }
	 
	 if (!empty($titles))
	 {
    $res = $dbh->prepare('INSERT INTO `mail`(`mail`,`id_man`,`titles`,`mark`) VALUES (?,?,?,?)');
    $res->execute(array($row["email"],$row["id_man"], $titles,"Неотправлено"));
	 }
	 }
?>