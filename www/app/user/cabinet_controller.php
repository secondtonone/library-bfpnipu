﻿<?php 
require_once '../scripts/startsession.php';
require_once '../scripts/connect.php';
require_once 'model/userclass.php';

$UserClass=new UserClass();

$query='SELECT `telefon_dom`,`telefon_sot`,`e_mail`,`telefon_rabochii` FROM `people` WHERE id_man=?';
$result=$UserClass->get_data($query,$id_man,$dbh);

$query='SELECT `email` FROM `users` WHERE id=?';
$email=$UserClass->get_data($query,$id,$dbh);

require_once 'cabinet/cabinet.php'; 

?>