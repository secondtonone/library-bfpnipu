<?php
session_start();
require_once('../../../scripts/connect.php');

    $id = $_POST['id'];
    $datevoz = date("Y-m-d H:i:s");
	$poterya = $_POST['poterya'];
	$prim = $_POST['primechanie'];
	
try {
    $vid = $dbh->prepare('SELECT v.`na_rukah`,v.`poterya`,v.`id_book`,b.`id_kafedra` FROM `vidacha` v INNER JOIN `book` b ON v.`id_book`=b.`id_book` WHERE v.`id_vid`=?');
	$vid->execute(array($id));
	$resvid = $vid->fetch(PDO::FETCH_ASSOC);
	
	if ($resvid['id_kafedra']==$_SESSION["id_kafedra"]){
	
	
	if ($resvid['na_rukah']=="Yes" && $poterya=="Yes" && $resvid['poterya']=="No")
	{
	$poterya1 = $dbh->prepare('UPDATE `vidacha` SET `poterya`=?,`primechanie`=? WHERE `id_vid`=?');
    $poterya1->execute(array($poterya,$prim,$id));
	$vse = $dbh->prepare('UPDATE `book` SET `kolvo_vsego`=`kolvo_vsego`-1 WHERE id =?');
	$vse->execute(array($resvid['id_book']));
	}
	else 
	if ($narukah=="No" && $resvid['na_rukah']=="No")
	{
	exit;
	}  else 
	{
	exit;
	}  }
	else{
		exit;}
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>