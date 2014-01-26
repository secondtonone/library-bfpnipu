<?php
session_start();
require_once('../../../scripts/connect.php');

    $id = $_POST['id_vid'];
    $datevoz = date("Y-m-d H:i:s");
	$narukah = $_POST['na_rukah'];
	$poterya = $_POST['poterya'];
	$prim = $_POST['primechanie'];
	
try {
    $vid = $dbh->prepare('SELECT v.`na_rukah`,v.`poterya`,v.`id_book`,b.`id_kafedra` FROM `vidacha` v INNER JOIN `book` b ON v.`id_book`=b.`id_book` WHERE v.`id_vid`=?');
	$vid->execute(array($id));
	$resvid = $vid->fetch(PDO::FETCH_ASSOC);
	
	if ($resvid['id_kafedra']==$_SESSION["id_kafedra"]){
	if ($resvid['na_rukah']=="No")
	{
	exit;
	} 
	if ($resvid['na_rukah']=="Yes" && $resvid['poterya']=="No")
	{
	$priem = $dbh->prepare('UPDATE `vidacha` SET `data_vozvrata`=?, `na_rukah`=? WHERE `id_vid`=?');
    $priem->execute(array($datevoz, $narukah, $id));
	$ost = $dbh->prepare('UPDATE `book` SET `ostatok`=`ostatok`+1 WHERE `id_book` =?');
	$ost->execute(array($resvid['id_book']));
	}
	}
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>