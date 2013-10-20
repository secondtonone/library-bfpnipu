<?php require_once '../scripts/startsession.php';
require_once '../scripts/connect.php';?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once '../../temp/usermenuline.php';
require_once '../../temp/header.php';?>
<?php

if(isset($_SESSION["id"])and($_SESSION["id"]!=='') and ($_SESSION["right"]=='User')){
$inch=$_SESSION["id_man"];	
echo "<h3>Привет, ".$_SESSION["name"]."!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php'>Главная</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='lich.php'>Личный кабинет</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='exit.php'>Выйти</a></h3><br />";
	 include_once '../header.php';
$lich=mysql_query("SELECT fam,name,name2,number_dom, number_sot, e_mail, placework, otdel, dolg, number_rab FROM `student` WHERE id_man='$inch'");
$dan = mysql_fetch_array($lich);
$mail=mysql_query("SELECT email FROM `users` WHERE id_man='$inch'");
$mdan = mysql_fetch_array($mail);

}else{
	 include_once '../header.php';
	   echo "<br>";
	     echo "<br>";
		   echo "<br>";
echo "<fieldset class='field'>
<form action='entry.php' method='post'>
<br />
<label>Имя</label><input type='text' name='login'/><br /><br />
<label>Пароль</label><input type='password' name='pass'/><br /><br />
<input type='submit' name='submit' value='Вход'/>
<label><a href='reg.php'>Регистрация</a> / <a href='ntpass.php'>Забыли пароль</a></label>
</form>
</fieldset>";
}
?>
<div class="block">
<br>
<br>
<div class="lich1">
<h3>Личные данные</h3>
<form action='student.php' method="post">
<div class="dan">
<br>
<h4>Телефон домашний:<input id="a1" name="domnumber" type="text" value="<?php echo $dan['number_dom'] ?>" maxlength="15" size="15"></h4>
<h4>Телефон сотовый:<input id="b1" name="sotnumber" type="text" value="<?php echo $dan['number_sot']?>" maxlength="11" size="11"></h4>
<h4>Электронная почта:<input id="c3" name="email" type="text" value="<?php echo $dan['e_mail']?>"  maxlength="50"></h4> 
<h4>Место работы:<input id="d4" name="wplace" type="text" value="<?php echo $dan['placework']?>" maxlength="150"></h4> 
<h4>Цех, отдел:<input id="f5" name="wplace1" type="text" value="<?php echo $dan['otdel']?>" maxlength="50"></h4> 
<h4>Должность:<input id="g6" name="dol" type="text" value="<?php echo $dan['dolg']?>" maxlength="25"></h4> 
<h4>Рабочий телефон:<input id="h7" name="rabnumber" type="text" value="<?php echo $dan['number_rab']?>" maxlength="15" size="15"></h4> 
</div>
<input class="submit" type="submit" name="submit" value="Редактировать">
</form>
</div>
<div class="pass">
<h3>Почта и пароль</h3>
<form action="change.php" method="post">
<div class="pass1">
<br />
<h4>Почта :<input type="text" name="email" value="<?php echo $mdan['email']?>"></h4><br/>
<h4>Новый пароль :<input type="password" name="pass"></h4>
</div>
<input class="submit"  type="submit" name="submit" value="Редактировать"/>
</form>
</div>
</div>
</body>
</html>