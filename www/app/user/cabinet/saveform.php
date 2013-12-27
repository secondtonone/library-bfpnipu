<?php 
require_once '../../scripts/startsessionstudent.php';
require_once '../../scripts/connect.php';
require_once '../../reg/reg/model/regclass.php';

$RegClass=new RegClass();

if ($_POST["hide"]=="ppl"){
	
	$fam=$RegClass->check_data($_POST["fam"]);
	$name=$RegClass->check_data($_POST["name"]);
	$otch=$RegClass->check_data($_POST["otch"]);
	$telephone=$RegClass->check_data($_POST["telephone"]);
	$mobile=$RegClass->check_data($_POST["mobile"]);
	$workphone=$RegClass->check_data($_POST["workphone"]);
	$email=$RegClass->check_email($_POST["email"]);
	if ($email==false) 
	{exit;}
	
	 $queryupdate=$dbh->prepare('UPDATE `people` SET fam=?,name=?,otchestvo=?,telefon_dom=?,telefon_sot=?,telefon_rabochii=?,e_mail=? WHERE id_man=?');
	 
	 $queryupdate->execute(array($fam,$name,$otch,$telephone,$mobile,$workphone,$email,$_SESSION["id_man"]));
	 
	  $_SESSION["fam"]=$fam;
	  $_SESSION["realname"]=$name;
	  $_SESSION["otchestvo"]=$otch;
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
	 
	 if (!empty($_POST["password"])){
	 $password=$RegClass->check_pass($_POST["password"],$_POST["rpassword"]);
     if ($password==false) { exit;}
	 
	 $queryupdate=$dbh->prepare('UPDATE `users` SET email=?,pass=? WHERE id=?');
	 $queryupdate->execute(array($email,$password,$_SESSION["id"]));
	 
	 $_SESSION["email"]=$email;
	  echo "Данные успешно изменены.";
	 }else{

	 $queryupdate=$dbh->prepare('UPDATE `users` SET email=? WHERE id=?');
	 $queryupdate->execute(array($email,$_SESSION["id"]));
	 
	 $_SESSION["email"]=$email;
	  echo "Данные успешно изменены.";	
	 }
		 }
	 }

?>