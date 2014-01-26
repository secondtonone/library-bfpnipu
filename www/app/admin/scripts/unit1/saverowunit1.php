<?php
session_start();
require_once('../../../scripts/connect.php');

try {
if ($_POST['oper']=="edit"){
    $query=$dbh->prepare('UPDATE `book` SET `name_book`=?,`kod_grif`=?,`kod_izdat`=?,`kolvo_str`=?,`year_create`=?, `kolvo_vsego`=?,`UDK`=?,`id_kafedra`=?,`ostatok`=?,`data_change`=NOW() WHERE `id_book`=?');
    $query->execute(array($_POST['name_book'],$_POST['kod_grif'],$_POST['izdatelstvo'],$_POST['kolvo_str'],$_POST['year_create'],$_POST['kolvo_vsego'],$_POST['UDK'],$_POST['id_kafedra'], $_POST['ostatok'],$_POST['id']));
}
if ($_POST['oper']=="add")
{
 $query=$dbh->prepare('INSERT INTO `book` (`name_book`,`kod_grif`,`kod_izdat`,`kolvo_str`,`year_create`, `kolvo_vsego`,`UDK`,`id_kafedra`,`ostatok`,`data_change`) VALUES (?,?,?,?,?,?,?,?,?,NOW())');
    $query->execute(array($_POST['name_book'],$_POST['kod_grif'],$_POST['izdatelstvo'],$_POST['kolvo_str'],$_POST['year_create'],$_POST['kolvo_vsego'],$_POST['UDK'],$_POST['id_kafedra'], $_POST['ostatok']));	}
	$lastid=$dbh->lastInsertId();
	 $query=$dbh->prepare('INSERT INTO `napisal` (`id_book`,`id_avtor`,`data_change`) VALUES (?,?,NOW())');
    $query->execute(array($lastid,$_POST['id_avtor']));	
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>