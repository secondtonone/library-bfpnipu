<?php
session_start();
/*
* Подключаемся к базе
*/
require_once '../scripts/connect.php';
require_once '../reg/reg/model/mailclass.php';

$objMail = new Lib_Sent();







?>