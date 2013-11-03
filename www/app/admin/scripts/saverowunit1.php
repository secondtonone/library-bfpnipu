<?php
require_once('dbdata.php');

try {
    //читаем новые значения
	$id = $_POST['id'];
    $datevid = $_POST['bookcount'];
    $datevoz = $_POST['allcount'];

    
    //подключаемся к базе
    $dbh = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
    //указываем, мы хотим использовать utf8
    $dbh->exec('SET CHARACTER SET utf8');

    //определяем количество записей в таблице
    $stm = $dbh->prepare('UPDATE book SET bookcount=?, allcount=? WHERE id=?');
    $stm->execute(array($datevid, $datevoz,$id));
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

// end of saverow.php