<?php
/*
* Подключаемся к базе
*/
require_once '../scripts/connect.php';


$titles='';


$query = $dbh->query('TRUNCATE TABLE `mail`');

$query = $dbh->prepare('SELECT `id_man`,`e_mail` FROM `people` WHERE `e_mail`<>""');
$query->execute();

while($row = $query->fetch(PDO::FETCH_ASSOC)) 
     {

	$res = $dbh->prepare('SELECT `name_book` FROM `book` as b INNER JOIN `vidacha` as v  ON v.`id_book`=b.`id_book` INNER JOIN `people` as p ON v.`id_man`=p.`id_man` WHERE `na_rukah`="Yes" AND `poterya`="No" AND ((YEAR(CURDATE())-YEAR(data_vidachi)>=1) OR (YEAR(CURDATE())-YEAR(`data_vidachi`)=1) OR (YEAR(CURDATE())-YEAR(data_vidachi)=0 AND MONTH(CURDATE())>6 AND MONTH(`data_vidachi`)<=5)) AND v.id_man=?');
	$res->execute(array($row["id_man"]));
		 while($rs = $res->fetch(PDO::FETCH_ASSOC)) 
	 {
	$titles=$titles.'"'.trim($rs['name_book']).'", ';
     }
	 if (!empty($titles) AND preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $row["e_mail"]))
	 {
	$titles=rtrim($titles,',');
    $res = $dbh->prepare('INSERT INTO `mail`(`mail`,`id_man`,`titles`,`mark`) VALUES (?,?,?,?)');
    $res->execute(array($row["e_mail"],$row["id_man"],$titles,"Неотправлено"));
	$titles='';
	 }
	 }
?>