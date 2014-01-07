<?php require_once '../scripts/checksessionstudent.php';?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/jquery-1.10.2.js"></script>
<script src="../scripts/jqgrid/themes/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
</head>
<body>
<?php require_once '../../temp/menuline.php';?>
<?php require_once '../../temp/header.php';?>
<div class="page">
<form id="loginForm">
<div class="field">
<label>Имя пользователя:</label>
<div class="input" ><input type="text" id="login" autocomplete="on" maxlength="20" required pattern="^[a-zA-Z0-9]+$" placeholder="Введите имя пользователя" title="Должно содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов."></div>
</div>
<div class="field">
<a href="../reg/forpass/forget_pass_form.php" id="forgot" title="Перейдите, если вы забыли пароль.">Забыли пароль?</a>
<label>Пароль:</label>
<div class="input"><input type="password" id="pass" maxlength="20" required pattern="^[a-zA-Z0-9]+$" placeholder="Введите пароль" title="Должен содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов."></div>
</div>
<div class="submit">
<button type="submit">Войти</button>
<a href="../reg/reg/index_reg.php" class="reg" title="Если вы здесь в первый раз, то перейдите для регистрации.">Регистрация</a>
</div>
</form>
</div>
<script src="../reg/auth/studententer.js"></script>
<script src="../scripts/tooltip.js"></script>
<?php require_once '../../temp/footer.php';?>
</body>
</html>