<?php
session_start();
require_once('../../../scripts/connect.php');

try {
if ($_POST['oper']=="edit"){
    $query=$dbh->prepare('UPDATE `people` SET `fam`=?, `name`=?, `otchestvo`=?,`telefon_dom`=?, `telefon_sot`=?, `e_mail`=?, `mesto_raboti`=?, `ceh_otdel`=?, `doljnost`=?, `telefon_rabochii`=?,`data_change`=NOW() WHERE `id_man`=?');
    $query->execute(array($_POST['fam'],$_POST['name'],$_POST['otchestvo'],$_POST['telefon_dom'],$_POST['telefon_sot'],$_POST['e_mail'],$_POST['mesto_raboti'], $_POST['ceh_otdel'], $_POST['doljnost'], $_POST['telefon_rabochii'],$_POST['id']));
	
	$query=$dbh->prepare('UPDATE `student` SET `number_zach`=?, `id_group`=?, `god_postup`=?,`data_change`=NOW() WHERE `id_man`=?');
    $query->execute(array($_POST['number_zach'],$_POST['id_group'],$_POST['god_postup'],$_POST['id']));
	
}
if ($_POST['oper']=="add")
{
 $query=$dbh->prepare('INSERT INTO `people` (`fam`, `name`, `otchestvo`,`telefon_dom`, `telefon_sot`, `e_mail`, `mesto_raboti`, `ceh_otdel`, `doljnost`, `telefon_rabochii`,`data_change`,`data_zapoln_anketi`) VALUES (?,?,?,?,?,?,?,?,?,?,NOW(),NOW())');
    $query->execute(array($_POST['fam'],$_POST['name'],$_POST['otchestvo'],$_POST['telefon_dom'],$_POST['telefon_sot'],$_POST['e_mail'],$_POST['mesto_raboti'], $_POST['ceh_otdel'], $_POST['doljnost'], $_POST['telefon_rabochii']));	
	$lastid=$dbh->lastInsertId();
	
	$query=$dbh->prepare('INSERT INTO `student` (`id_man`,`number_zach`, `id_group`, `god_postup`,`data_change`) VALUES (?,?,?,?,NOW())');
    $query->execute(array($lastid,$_POST['number_zach'],$_POST['id_group'],$_POST['god_postup']));
	
	}
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>