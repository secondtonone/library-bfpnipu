<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../scripts/jquery-1.10.2.js"></script>
<script src="../../scripts/jqgrid/themes/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
</head>
<body>
<?php require_once '../../../temp/menuline.php';?>
<?php require_once '../../../temp/header.php';?>
<div class="page">
<form id="loginForm">
	<div class="field">
		<label>Логин:</label>
		<div class="input"><input type="text"  id="login" maxlength="20" placeholder="Введите имя пользователя" required pattern="^[a-zA-Z0-9]+$" title="Должно содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов."></div>
	</div>
	<div class="field">
		<label>E-mail:</label>
		<div class="input"><input type="email"  id="email" maxlength="35" placeholder="Введите электронный адрес" required title="Например: example@mymail.ru"></div>
	</div>
	<div class="submit">
		<button type="submit">Отправить</button>
        </div>
		</form>
</div>
<script src="forget_pass_form.js"></script>
<script src="../../scripts/tooltip.js"></script>
<?php require_once '../../../temp/footer.php';?>
</body>
</html>