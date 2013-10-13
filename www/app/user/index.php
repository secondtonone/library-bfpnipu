<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/jquery-1.10.2.js"></script>
</head>
<body>
<?php require_once '../../temp/menuline.php';?>
<?php require_once '../../temp/header.php';?>
<div class="page">
<form id="loginForm">
	<div class="field">
		<label>Имя пользователя:</label>
		<div class="input"><input type="text" id="login" /></div>
	</div>
	<div class="field">
		<a href="../reg/forpass/forget_pass_form.php" id="forgot">Забыли пароль?</a>
		<label>Пароль:</label>
		<div class="input"><input type="password" id="pass" /></div>
	</div>
	<div class="submit">
		<button type="submit">Войти</button>
        <a href="../reg/reg/index_reg.php" class="reg">Регистрация</a>
        </div>
		</form>
</div>
<script src="../reg/auth/enter.js"></script>
<?php require_once '../../temp/footer.php';?>
</body>
</html>