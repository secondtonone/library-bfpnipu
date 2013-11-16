<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../scripts/jqgrid/js/jquery-1.9.0.min.js"></script>
<script src="../../scripts/jqgrid/themes/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
</head>
<body>
<div class="menuline"></div>
<?php require_once '../../../temp/header.php';?>
<div class="page">
<form id="regForm">
<div class="left">
<div class="field">
<label>Имя</label>
<input type='text' id='login' maxlength="20" required pattern="^[a-zA-Z0-9]+$" placeholder="Введите имя пользователя" title="Должно содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов.">
</div>
<div class="field">
<label>Пароль</label>
<input type='password' id='pass' maxlength="20" required pattern="^[a-zA-Z0-9]+$" placeholder="Введите пароль" title="Должен содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов.">
</div>
<div class="field">
<label>Повторите пароль</label>
<input type='password' id='pass2' maxlength="20" required pattern="^[a-zA-Z0-9]+$" placeholder="Повторите пароль" title="Должен содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов.">
</div>
</div>
<div class="right">
<div class="field">
<label>E-mail</label>
<input type='email' id='email' required maxlength="35" placeholder="Введите электронный адрес" title="Например: example@mymail.ru">
</div>
<div class="field">
<label>Фамилия</label>
<input type='text' id='fam' required maxlength="35" placeholder="Введите свою фамилию" pattern="^[А-Яа-яЁё]+$" title="Должна начинаться с заглавной и содержать только русские буквы.">
</div>
<div class="field">
<label>Номер зачетки</label>
<input type='text' id='number_zach' required maxlength="7" placeholder="Введите номер своей зачетной книжки" pattern="^[0-9]+$-^[0-9]+$" title="Например: 123-12">
</div>
</div>
<div class="submit">
<button type="submit">Регистрация</button>
</div>
</form>
</div>
<script src="index_reg.js"></script>
<script src="../../scripts/tooltip.js"></script>
<?php require_once '../../../temp/footer.php';?>
</body>
</html>