<?php 
require_once '../../scripts/startsession.php';
require_once '../../scripts/connect.php';
require_once '../model/userclass.php';
require_once '../../reg/reg/model/regclass.php';





$UserClass=new UserClass();
$RegClass=new RegClass();

if ($_POST["hide"]=="ppl"){
	
	$telephone=$UserClass->check_data($_POST["telephone"]);
	

	$mobile=$UserClass->check_data($_POST["mobile"]);


	$workphone=$UserClass->check_data($_POST["workphone"]);

	
	$email=$RegClass->check_email($_POST["email"]);
	if ($email==false) { exit;}
	
	 $query='SELECT * FROM `people` WHERE id_man=?';
	 $queryupdate='UPDATE `people` SET telefon_dom=?,telefon_sot=?,telefon_rabochii=?,e_mail=? WHERE id_man=?';
	 
     $update=$UserClass->update_ppl($query,$queryupdate,$telephone,$mobile,$workphone,$email,$_SESSION["id_man"],$dbh);
	 
	  $_SESSION["telefon_dom"]=$telephone;
	  $_SESSION["telefon_sot"]=$mobile;
	  $_SESSION["e_mail"]=$email;
	  $_SESSION["telefon_rabochii"]=$workphone;
	 
	 echo "Данные успешно изменены.";
	 
	  }
	  else{
if ($_POST["hide"]=="acc"){
	
	 
	 $email=$RegClass->check_email($_POST["email"]);
	 if ($email==false) { exit;}
	 
	 $password=$RegClass->check_pass($_POST["password"],$_POST["rpassword"]);
     if ($password==false) { exit;}
	 
	 $query='SELECT * FROM `users` WHERE id=?';
	 $queryuodate='UPDATE `users` SET email=?,pass=? WHERE id=?';
     $update=$UserClass->update_user($query,$queryuodate,$email,$password,$_SESSION["id"],$dbh);
	 
	 $_SESSION["email"]=$email;
	  echo "Данные успешно изменены.";	 
		 }
	 }

?>