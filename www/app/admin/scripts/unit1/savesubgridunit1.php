<?php
session_start();
require_once('../../../scripts/connect.php');	
if ($_POST['oper']=="add")
{
 $query=$dbh->prepare('INSERT INTO `napisal` (`id_book`,`id_avtor`,`data_change`) VALUES (?,?,NOW())');
    $query->execute(array($_GET['idbook'],$_POST['id_avtor']));	}
?>