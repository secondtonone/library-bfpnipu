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
		<label>Новый пароль:</label>
		<div class="input"><input type="password" id="newpass" maxlength="20" required pattern="^[a-zA-Z0-9]+$" placeholder="Введите новый пароль" title="Должен содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов."></div>
	</div>
	<div class="field">
		<label>Подтверждение нового пароля:</label>
		<div class="input"><input type="password"  id="rnewpass" maxlength="20" required pattern="^[a-zA-Z0-9]+$" placeholder="Повторите новый пароль" title="Должен содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов."></div>
        <input type="hidden" id="hideid" value="<?php echo $_GET["id"]; ?>">
        <input type="hidden" id="code" value="<?php echo $_GET["code"]; ?>">
	</div>
	<div class="submit">
		<button type="submit">Отправить</button>
        </div>
		</form>
        </div>
<script src="new_pass_form.js"></script>
<script src="../../scripts/tooltip.js"></script>
<?php require_once '../../../temp/footer.php';?>
</body>
</html>