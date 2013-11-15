<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../scripts/jquery-1.10.2.js"></script>
</head>
<body>
<?php require_once '../../../temp/menuline.php';?>
<?php require_once '../../../temp/header.php';?>
<div class="page">
<form id="loginForm">
	<div class="field">
		<label>Имя пользователя:</label>
		<div class="input"><input type="text"  id="login" maxlength="20" placeholder="Введите имя пользователя" required="required" pattern="^[a-zA-Z0-9]+$"></div>
	</div>
	<div class="field">
		<label>E-mail:</label>
		<div class="input"><input type="email"  id="email" maxlength="35" placeholder="Введите электронный адрес" required="required"></div>
	</div>
	<div class="submit">
		<button type="submit">Отправить</button>
        </div>
		</form>
</div>
<script src="forget_pass_form.js"></script>
<?php require_once '../../../temp/footer.php';?>
</body>
</html>