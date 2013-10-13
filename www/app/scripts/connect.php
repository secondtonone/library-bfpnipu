<?php
/*
* Подключение к базе
*/
$dbName = 'library';
$dbUser = 'root';
$dbPass = '';
$dbHost = 'localhost';
try{ 
$dbh = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
$dbh->exec('SET CHARACTER SET utf8');
}catch (PDOException $e){
      exit ('Ошибка в подключении к БД!');
 }
?>