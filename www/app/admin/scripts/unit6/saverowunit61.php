<?php
session_start();
require_once('../../../scripts/connect.php');

try {
	
	$datevid = date("Y-m-d H:i:s");
    $id_book = $_POST['id_book'];
    $id_man = $_POST['id_man'];
        $vid = $dbh->prepare('INSERT INTO `vidacha`(`id_man`,`id_book`,`data_vidachi`,`na_rukah`,`poterya`) VALUES (?,?,?,?,?)');
        $vid->execute(array($id_man,$id_book,$datevid,"Yes","No"));
        $ost = $dbh->prepare('UPDATE `book` SET `ostatok`=`ostatok`-? WHERE `id_book` =?');
        $ost->execute(array(1,$id_book ));
		echo "Записи добавлены!";
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>