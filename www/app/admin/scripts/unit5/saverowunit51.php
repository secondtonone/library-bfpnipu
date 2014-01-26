<?php
session_start();
require_once('../../../scripts/connect.php');

try {
if ($_POST['oper']=="edit"){
    $query=$dbh->prepare('UPDATE `group` SET `year_postup`=?, `name_group`=?, `form`=?,`kolvo_studentov`=?,`vipusk`=?,`id_specialistic`=?,`year_okonchan`=?,`data_change`=NOW() WHERE `id_group`=?');
    $query->execute(array($_POST['year_postup'],$_POST['name_group'],$_POST['form'],$_POST['kolvo_studentov'],$_POST['vipusk'],$_POST['id_spec'],$_POST['year_okonchan'],$_POST['id']));
}
if ($_POST['oper']=="add")
{
 $query=$dbh->prepare('INSERT INTO `group` (`year_postup`, `name_group`, `form`, `kolvo_studentov`,`vipusk`,`id_specialistic`,`year_okonchan`,`data_change`) VALUES (?,?,?,?,?,?,?,NOW())');
    $query->execute(array($_POST['year_postup'],$_POST['name_group'],$_POST['form'],$_POST['kolvo_studentov'],$_POST['vipusk'],$_POST['id_spec'],$_POST['year_okonchan']));	}
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>