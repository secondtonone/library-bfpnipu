<?php
session_start();
require_once('../../../scripts/connect.php');

    $id = $_POST['id'];
    $datevoz = date("Y-m-d H:i:s");
	$narukah = $_POST['na_rukah'];
	$poterya = $_POST['poterya'];
	$prim = $_POST['primechanie'];
	
try {
    $vid = $dbh->prepare('SELECT `na_rukah`,`poterya`,`id_book` FROM `vidacha` WHERE `id_vid`=?');
	$vid->execute(array($id));
	$resvid = $vid->fetch(PDO::FETCH_ASSOC);
	
	if ($narukah=="No" && $resvid['na_rukah']=="Yes" && $resvid['poterya']=="No" && $poterya=="No")
	{
	$priem = $dbh->prepare('UPDATE `vidacha` SET `data_vozvrata`=?, `na_rukah`=? WHERE `id_vid`=?');
    $priem->execute(array($datevoz, $narukah, $id));
	$ost = $dbh->prepare('UPDATE `book` SET `ostatok`=`ostatok`+? WHERE `id_book` =?');
	$ost->execute(array(1,$resvid['id_book']));
	}else
	if ($narukah=="Yes" && $resvid['na_rukah']=="Yes" && $poterya=="Yes" && $resvid['poterya']=="No")
	{
	$poterya = $dbh->prepare('UPDATE `vidacha` SET `poterya`=? WHERE `id_vid`=?');
    $poterya->execute(array($poterya, $id));
	$vse = $dbh->prepare('UPDATE `book` SET `kolvo_vsego`=`kolvo_vsego`-? WHERE id =?');
	$vse->execute(array(1,$resvid['id_book']));
	}
	else 
	if ($narukah=="No" && $resvid['na_rukah']=="No")
	{
	exit;
	}  else 
	{
	exit;
	}  
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>