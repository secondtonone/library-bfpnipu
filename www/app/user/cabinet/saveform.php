<?php 
require_once '../../scripts/startsession.php';
require_once '../../scripts/connect.php';
require_once '../model/userclass.php';
require_once '../../reg/reg/model/regclass.php';





$UserClass=new UserClass();
$RegClass=new RegClass();

if ($_POST["hide"]=="ppl"){
	
	$telephone=$UserClass->check_number($_POST["telephone"]);
	if ($telephone==false) { exit;}

	$mobile=$UserClass->check_number($_POST["mobile"]);
	if ($mobile==false) { exit;}

	$workphone=$UserClass->check_number($_POST["workphone"]);
	if ($workphone==false) { exit;}
	
	$email=$RegClass->check_email($_POST["email"]);
	if ($email==false) { exit;}
	
	 $query='UPDATE `people` SET telefon_dom=?,telefon_sot=?,telefon_rabochii=?,e_mail=? WHERE id=?';
	 
     $update=$UserClass->update_ppl($query,$telephone,$mobile,$workphone,$email,$_SESSION["id"],$dbh);
	 echo "Данные успешно изменены.";
	  }
	  else{
if ($_POST["hide"]=="acc"){
	
	 
	 $email=$RegClass->check_email($_POST["email"]);
	 if ($email==false) { exit;}
	 
	 $password=$RegClass->check_pass($_POST["password"],$_POST["rpassword"]);
     if ($password==false) { exit;}
	 
	 $query='UPDATE `users` SET email=?,pass=? WHERE id=?';
     $update=$UserClass->update_user($query,$email,$password,$_SESSION["id"],$dbh);
	  echo "Данные успешно изменены.";	 
		 }
	 }

?>