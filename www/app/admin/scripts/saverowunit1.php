<?php
session_start();
require_once('../../scripts/connect.php');

try {

    $query=$dbh->prepare('UPDATE `book` SET `kolvo_vsego`=?, `ostatok`=? WHERE `id_book`=?');
    $query->execute(array($_POST['kolvo_vsego'], $_POST['ostatok'],$_POST['id']));
}

catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>